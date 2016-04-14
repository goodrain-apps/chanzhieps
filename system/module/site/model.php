<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class siteModel extends model
{
    /**
     * Set the site user visiting.
     *
     * @access public
     * @return void
     */
    public function setSite()
    {
        if(!isset($this->config->site))                $this->config->site                = new stdclass();
        if(!isset($this->config->site->name))          $this->config->site->name          = $this->lang->chanzhiEPS;
        if(!isset($this->config->site->keywords))      $this->config->site->keywords      = '';
        if(!isset($this->config->site->indexKeywords)) $this->config->site->indexKeywords = '';
        if(!isset($this->config->site->slogan))        $this->config->site->slogan        = '';
        if(!isset($this->config->site->copyright))     $this->config->site->copyright     = '';
        if(!isset($this->config->site->icpSN))         $this->config->site->icpSN         = '';
        if(!isset($this->config->site->meta))          $this->config->site->meta          = '';
        if(!isset($this->config->site->desc))          $this->config->site->desc          = '';
        if(!isset($this->config->site->theme))         $this->config->site->theme         = 'default';
        if(!isset($this->config->site->lang))          $this->config->site->lang          = 'zh-cn';
        if(!isset($this->config->site->menu))          $this->config->site->menu          = json_encode(array());

        if(!isset($this->config->company))             $this->config->company             = new stdclass();
        if(!isset($this->config->company->name))       $this->config->company->name       = '';
        if(!isset($this->config->company->desc))       $this->config->company->desc       = '';
        if(!isset($this->config->company->content))    $this->config->company->content    = '';
        if(!isset($this->config->company->contact))    $this->config->company->contact    = json_encode(array());

        if(!isset($this->config->product))             $this->config->product             = new stdclass();
    }
}
