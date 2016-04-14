<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of search module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     search
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class searchModel extends model
{
    /**
     * get search results of keywords.
     * 
     * @param  string    $keywords 
     * @param  object    $pager 
     * @access public
     * @return array
     */
    public function getList($keywords, $pager)
    {
        $spliter = $this->app->loadClass('spliter');
        $words   = explode(' ', seo::unify($keywords, ' '));

        $against = '';
        foreach($words as $word)
        {
            $splitedWords = $spliter->utf8Split($word);
            $against .= '"' . $splitedWords['words'] . '"'; 
        }
        
        $words = str_replace('"', '', $against);
        $words = str_pad($words, 5, '_');
    
        $scoreColumn = "((1 * (MATCH(title) AGAINST('{$against}' IN BOOLEAN MODE))) + (0.6 * (MATCH(title) AGAINST('{$against}' IN BOOLEAN MODE))) )";
        $results = $this->dao->select("*, {$scoreColumn} as score")
            ->from(TABLE_SEARCH_INDEX)
            ->where("MATCH(title,content) AGAINST('+{$against}' IN BOOLEAN MODE) >= 1")
            ->andWhere('status')->eq('normal')
            ->andWhere('addedDate')->le(helper::now())
            ->orderBy('score_desc, editedDate_desc')
            ->page($pager)
            ->fetchAll('id');

        foreach($results as $record)
        {
            $record->title   = str_replace('</span> ', '</span>', $this->decode($this->markKeywords($record->title, $words)));
            $record->title   = str_replace('_', '', $this->decode($this->markKeywords($record->title, $words)));
            $record->summary = $this->getSummary($record->content, $words);
            $record->summary = str_replace('_', '', $record->summary);
        }

        return $this->processLinks($results);
    }

    /**
     * Save an index item.
     * 
     * @param  string    $objectType article|blog|page|product|thread|reply|
     * @param  int       $objectID 
     * @access public
     * @return void
     */
    public function save($objectType, $object)
    {
        $fields = $this->config->search->fields->{$objectType};

        $index = new stdclass();
        $index->objectID   = $object->{$fields->id};
        $index->objectType = $objectType;
        $index->title      = $object->{$fields->title};
        $index->status     = !empty($object->{$fields->status}) ? $object->{$fields->status} : 'normal' ;
        $index->addedDate  = isset($object->{$fields->addedDate}) ? $object->{$fields->addedDate} : '0000-00-00 00:00:00';
        $index->editedDate = isset($object->{$fields->editedDate}) ? $object->{$fields->editedDate} : '0000-00-00 00:00:00';

        $paramFields = explode(',', $fields->params);
        foreach($paramFields as $field)
        {
            $params[$field] = isset($object->$field) ? $object->$field : ''; 
        }

        $index->params = json_encode($params);

        $index->content = '';
        $contentFields  = explode(',', $fields->content);
        foreach($contentFields as $field) $index->content .= $object->$field;

        $spliter = $this->app->loadClass('spliter');

        $titleSplited   = $spliter->utf8Split($index->title);
        $index->title   = $titleSplited['words'];
        $contentSplited = $spliter->utf8Split(strip_tags($index->content));
        $index->content = $contentSplited['words'];

        $this->saveDict($titleSplited['dict'] + $contentSplited['dict']);
        $this->dao->replace(TABLE_SEARCH_INDEX)->data($index)->exec();
        return true;
    }

    /**
     * Save dict info. 
     * 
     * @param  array    $words 
     * @access public
     * @return void
     */
    public function saveDict($dict)
    {
        foreach($dict as $key => $value)
        {
            if(!is_numeric($key) or empty($value) or strlen($key) != 5) continue;
            $this->dao->replace(TABLE_SEARCH_DICT)->data(array('key' => $key, 'value' => $value))->exec();
        }
    }

    /**
     * Transfer unicode to words.
     * 
     * @param  string    $string 
     * @access public
     * @return void
     */
    public function decode($string)
    {
        if(strpos($string, ' ') === false and !is_numeric($string)) return $string;
        $dict   = $this->dao->select("concat(`key`, ' ') as `key`, value")->from(TABLE_SEARCH_DICT)->fetchPairs();
        $dict['|'] = '';
        return str_replace(array_keys($dict), array_values($dict), $string . ' ');
    }

    /**
     * Get summary of results.
     * 
     * @param  string    $content 
     * @param  string    $words 
     * @access public
     * @return string
     */
    public function getSummary($content, $words)
    {
        $length = $this->config->search->summaryLength;
        if(strlen($content) <= $length) return $this->decode($this->markKeywords($content, $words));

        $content = $this->markKeywords($content, $words);
        preg_match_all("/\<span class='text-danger'\>.*?\<\/span\>/", $content, $matches);

        if(empty($matches[0])) return $this->decode($this->markKeywords(substr($content, 0, $length), $words));

        $matches = $matches[0];
        $score   = 0;
        $needle  = '';
        foreach($matches as $matched) 
        {
            if(strlen($matched) > $score) 
            {
                $content = str_replace($needle, strip_tags($needle), $content);
                $needle  = $matched;
                $score   = strlen($matched);
            }
        }

        $content = str_replace('<span class', '<spanclass', $content);
        $content = explode(' ', $content);

        $pos     = array_search(str_replace('<span class', '<spanclass', $needle), $content);

        $start   = max(0, $pos - ($length / 2));
        $summary = join(' ', array_slice($content, $start, $length));
        $summary = str_replace('<spanclass', '<span class', $summary);
 
        $summary = $this->decode($summary);
        $summary = str_replace('</span> ', '</span>', $summary);
        return $summary;
    }

    /**
     * Process links of search results.
     * 
     * @param  array    $results 
     * @access public
     * @return array
     */
    public function processLinks($results)
    {
        foreach($results as $record)
        {
            $record->params = json_decode($record->params);
            if($record->objectType == 'article') $record->url = helper::createLink('article', 'view',  "id={$record->objectID}", "category={$record->params->category}&name={$record->params->alias}");
            if($record->objectType == 'product') $record->url = helper::createLink('product', 'view',  "id={$record->objectID}", "category={$record->params->category}&name={$record->params->alias}");
            if($record->objectType == 'thread')  $record->url = helper::createLink('thread', 'view', "id={$record->objectID}");;
            if($record->objectType == 'blog')    $record->url = helper::createLink('blog', 'view',  "id={$record->objectID}", "category={$record->params->category}&name={$record->params->alias}");
            if($record->objectType == 'page')    $record->url = helper::createLink('page', 'view',  "id={$record->objectID}", "name={$record->params->alias}");
            if($record->objectType == 'book')    $record->url = helper::createLink('book', 'read', "id={$record->objectID}", "book={$record->params->book}&node={$record->params->alias}");
        }

        return $results;
    }

    /**
     * Mark keywords in content.
     * 
     * @param  string    $content 
     * @param  string    $keywords 
     * @access public
     * @return void
     */
    public function markKeywords($content, $keywords)
    {
        $words = explode(' ', trim($keywords, ' '));
        $markedWords = array();

        foreach($words as $key => $word)
        {
            if(is_numeric($words))$words[$key] = $word . ' ';
            if(!is_numeric($words))$words[$key] = $word;
            $markedWords[] = "<span class='text-danger'>" . $this->decode($word) . "</span > ";
        }

        $content = str_replace($words, $markedWords, $content . ' ');
        $content = str_replace("</span > <span class='text-danger'>", '', $content);
        $content = str_replace("</span > ", '</span>', $content);

        return $content;
    }

    /**
     * Build all search index.
     * 
     * @access public
     * @return bool
     */
    public function buildAllIndex($type, $lastID)
    {
        $limit = 100;
        $categories = $this->dao->select('id,alias')->from(TABLE_CATEGORY)->fetchPairs();

        if($type == 'article')
        {
            $articles = $this->dao->select('t1.*, t2.category as category')
                ->from(TABLE_ARTICLE)->alias('t1')
                ->leftJoin(TABLE_RELATION)->alias('t2')->on("t1.id=t2.id")
                ->where('t2.type')->in('article,blog')
                ->beginIF($lastID)->andWhere('t1.id')->gt($lastID)
                ->orderBy('t1.id')
                ->limit($limit)
                ->fetchAll('id');

            if(empty($articles))
            {
                $type   = 'product';
                $lastID = 0;
            }
            else
            {
                foreach($articles as $article) 
                {
                    $article->category = $categories[$article->category];
                    $this->save($article->type, $article);
                }

                return array('type' => $type, 'count' => count($articles), 'lastID' => max(array_keys($articles)));
            }
        }

        if($type == 'product')
        {
            $products = $this->dao->select('t1.*, t2.category as category')
                ->from(TABLE_PRODUCT)->alias('t1')
                ->leftJoin(TABLE_RELATION)->alias('t2')->on("t1.id=t2.id")
                ->where('t2.type')->eq('product')
                ->beginIF($lastID)->andWhere('t1.id')->gt($lastID)
                ->limit($limit)
                ->fetchAll('id');

            if(empty($products))
            {
                $type   = 'page';
                $lastID = 0;
            }
            else
            {
                foreach($products as $product)
                {
                    $product->category = $categories[$product->category];
                    $this->save('product', $product);
                }
                return array('type' => $type, 'count' => count($products), 'lastID' => max(array_keys($products)));
            }
        }
        
        if($type == 'page')
        {
            $pages = $this->dao->select("*")
                ->from(TABLE_ARTICLE)
                ->where('type')->eq('page')
                ->beginIF($lastID)->andWhere('id')->gt($lastID)
                ->limit($limit)
                ->fetchAll('id');

            if(empty($pages))
            {
                $type   = 'thread';
                $lastID = 0;
            }
            else
            {
                foreach($pages as $page) $this->save('page', $page);
                return array('type' => $type, 'count' => count($pages), 'lastID' => max(array_keys($pages)));
            }
        }

        if($type == 'thread')
        {
            $threads = $this->dao->select("*, 'normal' as status")
                ->from(TABLE_THREAD)
                ->beginIF($lastID)->where('id')->gt($lastID)
                ->limit($limit)
                ->fetchAll('id');

            if(empty($threads))
            {
                $type   = 'book';
                $lastID = 0;
            }
            else
            {
                foreach($threads as $thread) $this->save('thread', $thread);
                return array('type' => $type, 'count' => count($threads), 'lastID' => max(array_keys($threads)));
            }
        }

        if($type == 'book')
        {
            $books    = $this->dao->select('id,alias')->from(TABLE_BOOK)->where('type')->eq('book')->fetchPairs();
            $articles = $this->dao->select('*')->from(TABLE_BOOK)->where('type')->eq('article')->fetchAll();

            foreach($articles as $article)
            {
                $pathes = explode(',', trim($article->path, ','));
                $bookID = $pathes[0];

                $article->book = $books[$bookID];
                $this->save('book', $article);
            }
            return array('finished' => true);
        }
    }

    /**
     * Delete index of an object.
     * 
     * @param  string    $objectType 
     * @param  int       $objectID 
     * @access public
     * @return void
     */
    public function deleteIndex($objectType, $objectID)
    {
        $this->dao->delete()->from(TABLE_SEARCH_INDEX)->where('objectType')->eq($objectType)->andWhere('objectID')->eq($objectID)->exec();
        return !dao::isError();
    }
}
