<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of tag module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class tagModel extends model
{
    /**
     * Get tag list.
     * 
     * @param  string $tag
     * @param  string $orderBy 
     * @param  object $pager 
     * @access public
     * @return array
     */
    public function getList($tag, $orderBy, $pager)
    {
        return $this->dao->select('*')
            ->from(TABLE_TAG)
            ->beginIf($tag)->where('tag')->like("%{$tag}%")->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');
    }
    
    /**
     * Add link on tags in string.
     * 
     * @param  string    $content 
     * @access public
     * @return string
     */
    public function addLink($content)
    {
        /* Get tags order by tag length desc. */
        $tags = $this->dao->select('*')->from(TABLE_TAG)->where('link')->ne('')->orderBy('length(tag)_desc')->fetchAll('id');

        /* Mark tags need to added link. */
        foreach($tags as $tag) $content = $this->markTag($content, $tag);

        /* Replace mark with tags and links. */
        foreach($tags as $id => $tag)
        {
            $content = str_replace("{tag{$id}}", $tag->tag, $content);
            $content = str_replace("{link{$id}}", html::a($tag->link, $tag->tag, "class='tag-link'"), $content);
        }
        return $content;
    }

    /**
     * Mark tags needed to replaced.
     * 
     * @param  string    $content 
     * @param  object    $tag 
     * @access public
     * @return string
     */
    public function markTag($content, $tag)
    {
        if(strpos($content, $tag->link) !== false) return $content;

        $pos = strpos($content, $tag->tag);
        if($pos === false) return $content;

        $preContent  = substr($content, 0, $pos);
        $startNeddle = '<a'; 
        $endNeddle   = '</a>'; 

        /* If tag is not in html::a tag mark it with link{tagID}. */
        if(strpos($preContent, $startNeddle) == false) return substr_replace($content, "{link$tag->id}", $pos, strlen($tag->tag));

        /* If tag is in html::a tag mark it with tag{tagID}. */
        if((strpos($preContent, $endNeddle) == false ) or (strpos($preContent, $endNeddle) < strpos($preContent, $startNeddle)) ) 
        {
            $content = substr_replace($content, "{tag$tag->id}", $pos, strlen($tag->tag));
            return $this->markTag($content, $tag);
        }

        return substr_replace($content, "{link$tag->id}", $pos, strlen($tag->tag));
    }

    /**
     * Save tags.
     * 
     * @param  string    $tags 
     * @access public
     * @return void
     */
    public function save($tags)
    {
        $tags =  array_unique(explode(',', $tags));

        foreach($tags as $tag)
        {
            if(trim($tag) == '') continue;
            $rank  = $this->countRank($tag);
            $count = $this->dao->select('count(*) as count')->from(TABLE_TAG)->where('tag')->eq($tag)->fetch('count');

            if($count == 0)
            {
                $this->dao->insert(TABLE_TAG)->data(array('tag' => $tag, 'rank' => $rank))->exec();
            }
            else
            {
                $this->dao->update(TABLE_TAG)->set('rank')->eq($rank)->where('tag')->eq($tag)->exec();
            }
        }

        if(!dao::isError()) return true;
        return dao::getError();
    }

    /**
     * Count rank of one tag.
     * 
     * @param  string    $tag 
     * @access public
     * @return int
     */
    public function countRank($tag)
    {
        $rank = $this->dao->select('count(*) as count')->from(TABLE_ARTICLE)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetch('count');
        $rank += $this->dao->select('count(*) as count')->from(TABLE_PRODUCT)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetch('count');
        $rank += $this->dao->select('count(*) as count')->from(TABLE_CATEGORY)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetch('count');
        $rank += $this->dao->select('count(*) as count')->from(TABLE_BOOK)->where("concat(',', keywords, ',')")->like("%,{$tag},%")->fetch('count');
        return $rank;
    }
}
