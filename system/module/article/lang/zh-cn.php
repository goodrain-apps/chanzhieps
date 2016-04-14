<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The article category zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->article->common      = '文章';
$lang->article->setting     = '文章设置';
$lang->article->createDraft = '保存草稿';
$lang->article->post        = '创建投稿';
$lang->article->check       = '审核投稿';
$lang->article->reject      = '驳回投稿';

$lang->article->id         = '编号';
$lang->article->category   = '类目';
$lang->article->categories = '类目';
$lang->article->title      = '标题';
$lang->article->alias      = '别名';
$lang->article->content    = '内容';
$lang->article->source     = '来源';
$lang->article->copySite   = '来源网站';
$lang->article->copyURL    = '来源URL';
$lang->article->keywords   = '关键字';
$lang->article->summary    = '摘要';
$lang->article->author     = '作者';
$lang->article->editor     = '编辑';
$lang->article->addedDate  = '发布时间';
$lang->article->editedDate = '编辑时间';
$lang->article->status     = '状态';
$lang->article->type       = '类型';
$lang->article->views      = '阅读';
$lang->article->comments   = '评论';
$lang->article->stick      = '置顶';
$lang->article->order      = '排序';
$lang->article->isLink     = '跳转';
$lang->article->link       = '链接';
$lang->article->css        = 'CSS';
$lang->article->js         = 'JS';

$lang->article->forward2Blog     = '转至博客';
$lang->article->forward2Forum    = '转至论坛';
$lang->article->selectCategories = '选择类目';
$lang->article->selectBoard      = '选择版块';
$lang->article->confirmReject    = '确认驳回这篇投稿？';

$lang->submittion= new stdclass();
$lang->submittion->common  = '投稿';
$lang->submittion->check   = '审核';
$lang->submittion->list    = '投稿列表';
$lang->submittion->publish = '发布';
$lang->submittion->reject  = '驳回';

$lang->submittion->status[0] = '';
$lang->submittion->status[1] = '<span class="label label-xsm label-primary">' . '待审核' .'</span>';
$lang->submittion->status[2] = '<span class="label label-xsm label-success">' . '通过' . '</span>';
$lang->submittion->status[3] = '驳回';

$lang->submittion->typeList = array();
$lang->submittion->typeList['article'] = '文章';
$lang->submittion->typeList['blog']    = '博客';

$lang->article->list          = '文章列表';
$lang->article->admin         = '维护文章';
$lang->article->create        = '发布文章';
$lang->article->setcss        = '设置CSS';
$lang->article->setjs         = '设置JS';
$lang->article->edit          = '编辑文章';
$lang->article->files         = '附件';
$lang->article->images        = '图片';

$lang->article->submittion    = '投稿';
$lang->article->submissionTime  = '投递时间';

$lang->article->submittionOptions = new stdclass;
$lang->article->submittionOptions->open  = '开启';
$lang->article->submittionOptions->close = '关闭';

$lang->blog->common = '博客';
$lang->blog->admin  = '维护博客';
$lang->blog->list   = '博客列表';
$lang->blog->create = '发布博客';
$lang->blog->edit   = '编辑博客';

$lang->page->common = '单页';
$lang->page->admin  = '维护单页';
$lang->page->list   = '单页列表';
$lang->page->create = '添加单页';
$lang->page->edit   = '编辑单页';

$lang->article->sourceList['original']      = '原创';
$lang->article->sourceList['copied']        = '转贴';
$lang->article->sourceList['translational'] = '翻译';
$lang->article->sourceList['article']       = '转自文章';

$lang->article->statusList['normal'] = '正常';
$lang->article->statusList['draft']  = '草稿';

$lang->article->sticks[0] = '不置顶';
$lang->article->sticks[1] = '类目置顶';
$lang->article->sticks[2] = '全局置顶';

$lang->article->successStick   = '置顶成功';
$lang->article->successUnstick = '取消置顶成功';

$lang->article->confirmDelete = '您确定删除该文章吗？';
$lang->article->categoryEmpty = '类目不能为空';

$lang->article->lblAddedDate = '<strong>添加时间：</strong> %s &nbsp;&nbsp;';
$lang->article->lblAuthor    = "<strong>作者：</strong> %s &nbsp;&nbsp;";
$lang->article->lblSource    = '<strong>来源：</strong>';
$lang->article->lblViews     = ' <strong>阅读：</strong>%s';
$lang->article->lblEditor    = '最后编辑：%s 于 %s';
$lang->article->lblComments  = '<strong>评论：</strong> %s';

$lang->article->none      = '没有了';
$lang->article->previous  = '上一篇';
$lang->article->next      = '下一篇';
$lang->article->directory = '返回目录';
$lang->article->noCssTag  = '不需要&lt;style&gt;&lt;/style&gt;标签';
$lang->article->noJsTag   = '不需要&lt;script&gt;&lt;/script&gt;标签';

$lang->article->placeholder = new stdclass();
$lang->article->placeholder->addedDate = '可以延迟到选定的时间发布。';
$lang->article->placeholder->link      = '输入链接，可以是站外链接';

$lang->article->approveMessage = '您投递的文章 <strong>《%s》</strong> 已通过审核，奖励 <strong>+%s</strong> 积分，感谢您的支持。';
$lang->article->rejectMessage  = '您投递的文章 <strong>《%s》</strong> 未通过审核，您可以编辑后再次提交审核，感谢您的支持。';

$lang->article->forwardFrom = '转发自';
