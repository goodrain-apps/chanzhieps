<?php
/**
 * The seo class, parse seo mode uri to normal mode uri.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */

/**
 * The seo class.
 *
 * @package framework
 */
class seo
{
    /**
     * Parse SEO URI for setRouteByPathInfo.
     *
     * @param uri
     * return string
     */
    public static function parseURI($uri)
    {
        global $config;
        if(!helper::inSeoMode()) return $uri;

        $categoryAlias = $config->seo->alias->category;
        $pageAlias     = $config->seo->alias->page;
        $forumAlias    = isset($config->seo->alias->forum) ? $config->seo->alias->forum : array();
        $methodAlias   = $config->seo->alias->method;

        $params = array();

        if(strpos($uri, '_') !== false) $uri = substr($uri, 0, strpos($uri, '_'));
        /* Is there a pageID variable in the url?  */
        $pageID = 0;
        if(preg_match('/\/p\d+$/', $uri, $matches))
        {
            $pageID = str_replace('/p', '', $matches[0]);    // Get pageID thus the flowing logic can use it.
            $uri    = str_replace($matches[0], '', $uri);    // Remove the pageID part from the url.
        }

        /* Split uri to items and try to get module and params from it. */
        $items  = explode('/', $uri);
        $module = $items[0];

        /* Use book instead of help. */
        if($module == 'help') $module = $items[0] = 'book';

        /* There's no '/' in uri. */
        if(strpos($uri, '/') === false)
        {
            /* Use book instead of help. */
            if($uri == 'help') $uri = 'book';

            if($pageID and $module == 'blog' and count($items) == 1) 
            {
                $params['category'] = 0;
                return seo::convertURI($module, 'index', $params, $pageID);
            }

            /* Not an alias, return directly. */
            if(empty($categoryAlias[$uri])) return $uri;

            /* The module is an alias of a category. */
            $module = $categoryAlias[$uri]->module;
            $params['category'] = $categoryAlias[$uri]->category;
            return seo::convertURI($module, 'browse', $params, $pageID);
        }

        /* Is the module an alias of a category? */
        if(isset($categoryAlias[$module]))
        {
            $category = $categoryAlias[$module]->category;      // Get the category.
            $module   = $categoryAlias[$module]->module;    // Get the module of the alias category.

            /* If the first param is number, like article/123.html, should call view method. */
            if(is_numeric($items[1])) 
            {
                $params['id'] = $items[1];
                return seo::convertURI($module, 'view', $params, $pageID);
            }
            else
            {
                if(!empty($items[1]))
                {
                    $viewparams = explode('-', $items[1]);
                    $id = end($viewparams);
                }
                if(is_numeric($id))
                {
                    $params['id'] = $id;
                    return seo::convertURI($module, 'view', $params, $pageID);
                }
            }

            $params['category'] = $category;
            return seo::convertURI($module, 'browse', $params, $pageID);
        }

        //------------- The module is an system module-------------- */
        /* Is the module an alias of a page. */
        if($module == 'page' && isset($pageAlias[$items[1]]))
        {
            $params['page'] = $items[1];
            return seo::convertURI($module, 'view', $params, $pageID);
        }

        if($module == 'page' && !isset($pageAlias[$items[1]]))
        {
            $params['page'] = $items[1];
            return seo::convertURI($module, 'view', $params, $pageID);
        }

        if($module == 'book' && count($items) > 2)
        {
            $uri      = str_replace('/' . $items[1], '', $uri );
            $items[1] = $items[2];
        }

        if($module == 'forum' && isset($pageAlias[$items[1]]))
        {
            $method = $methodAlias[$module]['browse'];
            return seo::convertURI($module, $method, $params, $pageID);
        }

        /*  If the first param is a category id, like news/c123.html. */
        if(preg_match('/^c\d+$/', $items[1]))
        {
            $params['category'] = str_replace('c', '', $items[1]);
            $method = $methodAlias[$module]['browse'];
            return seo::convertURI($module, $method, $params, $pageID);
        }

        /* The first param is an object id. */
        if(is_numeric($items[1]))
        {
            $params['id'] = $items[1];
            $method = $methodAlias[$module]['view'];
            return seo::convertURI($module, $method, $params, $pageID);
        }

        $viewparams = explode('-', $items[1]);
        if(count($viewparams) > 1)
        {
            $id = end($viewparams);
            if(is_numeric($id))
            {
                $params['id'] = $id;
                $method = $methodAlias[$module]['view'];
                return seo::convertURI($module, $method, $params, $pageID);
            }
        }
        else
        {
            /* The first param is a category alias. */
            $params['category'] = $items[1]; 
        }

        $method = isset($methodAlias[$module]['browse']) ? $methodAlias[$module]['browse'] : 'browse';

        return seo::convertURI($module, $method, $params, $pageID);
    }

    /**
     * Convert seo mode URI to normal mode.
     * 
     * @param string $module
     * @param string $method
     * @param string $params
     * @param int $pageID
     * return string
     */
    public static function convertURI($module, $method, $param = array(), $pageID = 0)
    {
        $uri = "$module-$method";
        foreach($param as $value) $uri .= '-' . str_replace('-', '.', $value);
        if($pageID > 0) $uri .= "-$pageID";
        return $uri;
    }

    /**
     * Unify string to standard chars.
     * 
     * @param  string    $string 
     * @param  string    $to 
     * @static
     * @access public
     * @return string
     */
    public static function unify($string, $to = ',')
    {
        $labels = array('_', '、', '-', '\n', '?', '@', '&', '%', '~', '`', '+', '*', '/', '\\', '，', '。');
        $string = str_replace($labels, $to, $string);
        return preg_replace("/[{$to}]+/", $to, trim($string, $to));
    }
}

/**
 * The uri class.
 *
 * @package seo
 */
class uri
{
    /**
     * Create article browse
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createArticleBrowse($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'article/c' . array_shift($params);
        if(!empty($alias['category'])) $link = $alias['category'];

        $viewType = $viewType ? $viewType : $config->default->view;

        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create article view
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createArticleView($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'article/';
        if(!empty($alias['category'])) $link = $alias['category'] . '/';
        if(!empty($alias['name'])) $link .= $alias['name'] . '-';
        $link .= array_shift($params);

        $viewType = $viewType ? $viewType : $config->default->view;

        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create article view
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */

    public static function createProductBrowse($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'product/c' . array_shift($params);
        if(!empty($alias['category'])) $link = $alias['category'];

        $viewType = $viewType ? $viewType : $config->default->view;

        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create product view
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createProductView($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'product/';
        if(!empty($alias['category'])) $link = $alias['category'] . '/';
        if(!empty($alias['name'])) $link .= $alias['name'] . '-';
        $link .= array_shift($params);

        $viewType = $viewType ? $viewType : $config->default->view;
        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create forum board.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createForumBoard($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'forum/';
        $link .= !empty($alias['category']) ? $alias['category'] : 'c' . array_shift($params);

        $viewType = $viewType ? $viewType : $config->default->view;
        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create thread view.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createThreadView($params, $alias, $viewType = '')
    {
        global $config;
        $viewType = $viewType ? $viewType : $config->default->view;

        $link = 'thread/' . array_shift($params);

        if(isset($alias['pageID']))  $link .= '/p' . $alias['pageID'];
        $link .= '.' . $viewType;
        if(isset($alias['replyID'])) $link .= '#'  . $alias['replyID'];

        return  $config->webRoot . $link;
    }

    /**
     * Create blog index.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createBlogIndex($params, $alias, $viewType = '')
    {
        global $config;
        $viewType = $viewType ? $viewType : $config->default->view;

        $link = $config->webRoot . 'blog';
        if(isset($alias['category']) and trim($alias['category']) != '') return $link . '/' . $alias['category'] . '.' . $viewType;
        if(!empty($params)) return $link . '/c' . array_shift($params) . '.' . $viewType;
        return $link . '.' . $viewType;
    }

    /**
     * Create blog view.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createBlogView($params, $alias, $viewType = '')
    {
        global $config;

        $link = 'blog/';
        if($alias['name']) $link .= $alias['name'] . '-';
        $link .= array_shift($params);
        $viewType = $viewType ? $viewType : $config->default->view;
        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create book book.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createBookBrowse($params, $alias, $viewType = '')
    {
        global $config;
        $viewType = $viewType ? $viewType : $config->default->view;

        $link = 'book/' . $alias['book'];
        if(!isset($alias['node'])) return $config->webRoot . $link . '.' . $viewType;
        if($alias['node'])  return $config->webRoot . $link . '/' . $alias['node'] . '.' . $viewType;
        if(!$alias['node']) return $config->webRoot . $link . '/c' . array_shift($params). '.' . $viewType;
    }

    /**
     * Create book read.
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createBookRead($params, $alias, $viewType = '')
    {
        global $config;
        $viewType = $viewType ? $viewType : $config->default->view;

        $link = 'book/' . $alias['book'] . '/';
        if($alias['node']) $link .= $alias['node'] . '-';
        $link .= array_shift($params);

        return $config->webRoot . $link . '.' . $viewType;
    }

    /**
     * Create page view
     *
     * @params array    $params
     * @params array    $alias  
     * @params string   $viewType  
     * return string
     */
    public static function createPageView($params, $alias, $viewType = '')
    {
        global $config;
        $viewType = $viewType ? $viewType : $config->default->view;

        $link = 'page/' . array_shift($params);
        if($alias['name']) $link = 'page/' . $alias['name'];

        return $config->webRoot . $link . '.' . $viewType;
    }
}
