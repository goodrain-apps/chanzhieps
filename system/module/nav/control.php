<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of nav module of XiRangEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     nav
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class nav extends control
{
    /**
     * Nav admin function
     *
     * @param string   $top
     * @access public
     * @return void
     */
    public function admin($type = '')
    {   
        if($type == '' and $this->config->site->type == 'portal') $type = $this->device . '_top';
        if($type == '' and $this->config->site->type == 'blog')   $type = $this->device . '_blog';

        foreach($this->lang->nav->system as $module => $name)
        {
            if(!commonModel::isAvailable($module)) unset($this->lang->nav->system->$module);
        }

        if($_POST)
        {
            $navs = $this->post->nav;
            foreach($navs as $key => $nav)
            {
                $navs[$key] = $this->nav->organizeNav($nav);
            }

            if(isset($navs[2]))
            {
                $navs[2] = $this->nav->group($navs[2]);
                if(isset($navs[3])) $navs[3] = $this->nav->group($navs[3]);

                foreach($navs[2] as &$navList)
                {
                    foreach($navList as &$nav)
                        $nav['children'] = isset($navs[3][$nav['key']]) ?  $navs[3][$nav['key']] : array();
                }
            }

            foreach($navs[1] as &$nav)
            {
                $nav['children'] = isset($navs[2][$nav['key']]) ?  $navs[2][$nav['key']] : array();
            }

            $settings =  array($type => helper::jsonEncode($navs[1]));
            $result   = $this->loadModel('setting')->setItems('system.common.nav', $settings);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->failed));
        }

        $this->view->title        = $this->lang->nav->setNav;
        $this->view->navs         = $this->nav->getNavs($type);
        $this->view->type         = $type;
        $this->view->types        = $this->lang->nav->types; 
        $this->view->articleTree  = $this->loadModel('tree')->getOptionMenu('article');

        $this->display();
    }
}
