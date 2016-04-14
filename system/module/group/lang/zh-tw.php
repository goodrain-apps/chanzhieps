<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The group module zh-tw file of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: zh-tw.php 4719 2013-05-03 02:20:28Z chencongzhi520@gmail.com $
 * @link        http://www.ranzhico.com
 */
$lang->group->common             = '分組權限';
$lang->group->allGroups          = '所有權限';
$lang->group->browse             = '瀏覽分組';
$lang->group->create             = '新增分組';
$lang->group->edit               = '編輯分組';
$lang->group->copy               = '複製分組';
$lang->group->delete             = '刪除分組';
$lang->group->managePriv         = '權限';
$lang->group->managePrivByGroup  = '權限維護';
$lang->group->managePrivByModule = '按模組分配權限';
$lang->group->byModuleTips       = '<span class="tips">（可以按住shift或者control鍵進行多選）</span>';
$lang->group->manageMember       = '成員';
$lang->group->linkMember         = '關聯用戶';
$lang->group->unlinkMember       = '移除用戶';
$lang->group->confirmDelete      = '您確定刪除該用戶分組嗎？';
$lang->group->successSaved       = '成功保存';
$lang->group->errorNotSaved      = '沒有保存，請確認選擇了權限數據。';

$lang->group->id       = '編號';
$lang->group->name     = '分組名稱';
$lang->group->desc     = '分組描述';
$lang->group->users    = '用戶列表';
$lang->group->module   = '模組';
$lang->group->method   = '功能';
$lang->group->priv     = '權限';
$lang->group->option   = '選項';
$lang->group->inside   = '組內用戶';
$lang->group->outside  = '組外用戶';
$lang->group->other    = '其他模組';
$lang->group->all      = '所有權限';
$lang->group->extent   = '權限範圍';
$lang->group->havePriv = '已授權';
$lang->group->noPriv   = '未授權';

$lang->group->selectAll = '全選';
$lang->group->manageAll = '可瀏覽所有客戶和訂單';

$lang->group->copyOptions['copyPriv'] = '複製權限';
$lang->group->copyOptions['copyUser'] = '複製用戶';

include (dirname(__FILE__) . '/resource.php');
