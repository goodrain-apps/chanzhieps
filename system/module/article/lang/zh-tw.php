<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The article category zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->article->common      = '文章';
$lang->article->setting     = '文章設置';
$lang->article->createDraft = '保存草稿';
$lang->article->post        = '創建投稿';
$lang->article->check       = '審核投稿';
$lang->article->reject      = '駁回投稿';

$lang->article->id         = '編號';
$lang->article->category   = '類目';
$lang->article->categories = '類目';
$lang->article->title      = '標題';
$lang->article->alias      = '別名';
$lang->article->content    = '內容';
$lang->article->source     = '來源';
$lang->article->copySite   = '來源網站';
$lang->article->copyURL    = '來源URL';
$lang->article->keywords   = '關鍵字';
$lang->article->summary    = '摘要';
$lang->article->author     = '作者';
$lang->article->editor     = '編輯';
$lang->article->addedDate  = '發佈時間';
$lang->article->editedDate = '編輯時間';
$lang->article->status     = '狀態';
$lang->article->type       = '類型';
$lang->article->views      = '閲讀';
$lang->article->comments   = '評論';
$lang->article->stick      = '置頂';
$lang->article->order      = '排序';
$lang->article->isLink     = '跳轉';
$lang->article->link       = '連結';
$lang->article->css        = 'CSS';
$lang->article->js         = 'JS';

$lang->article->forward2Blog     = '轉至博客';
$lang->article->forward2Forum    = '轉至論壇';
$lang->article->selectCategories = '選擇類目';
$lang->article->selectBoard      = '選擇版塊';
$lang->article->confirmReject    = '確認駁回這篇投稿？';

$lang->submittion= new stdclass();
$lang->submittion->common  = '投稿';
$lang->submittion->check   = '審核';
$lang->submittion->list    = '投稿列表';
$lang->submittion->publish = '發佈';
$lang->submittion->reject  = '駁回';

$lang->submittion->status[0] = '';
$lang->submittion->status[1] = '<span class="label label-xsm label-primary">' . '待審核' .'</span>';
$lang->submittion->status[2] = '<span class="label label-xsm label-success">' . '通過' . '</span>';
$lang->submittion->status[3] = '駁回';

$lang->submittion->typeList = array();
$lang->submittion->typeList['article'] = '文章';
$lang->submittion->typeList['blog']    = '博客';

$lang->article->list          = '文章列表';
$lang->article->admin         = '維護文章';
$lang->article->create        = '發佈文章';
$lang->article->setcss        = '設置CSS';
$lang->article->setjs         = '設置JS';
$lang->article->edit          = '編輯文章';
$lang->article->files         = '附件';
$lang->article->images        = '圖片';

$lang->article->submittion    = '投稿';
$lang->article->submissionTime  = '投遞時間';

$lang->article->submittionOptions = new stdclass;
$lang->article->submittionOptions->open  = '開啟';
$lang->article->submittionOptions->close = '關閉';

$lang->blog->common = '博客';
$lang->blog->admin  = '維護博客';
$lang->blog->list   = '博客列表';
$lang->blog->create = '發佈博客';
$lang->blog->edit   = '編輯博客';

$lang->page->common = '單頁';
$lang->page->admin  = '維護單頁';
$lang->page->list   = '單頁列表';
$lang->page->create = '添加單頁';
$lang->page->edit   = '編輯單頁';

$lang->article->sourceList['original']      = '原創';
$lang->article->sourceList['copied']        = '轉貼';
$lang->article->sourceList['translational'] = '翻譯';
$lang->article->sourceList['article']       = '轉自文章';

$lang->article->statusList['normal'] = '正常';
$lang->article->statusList['draft']  = '草稿';

$lang->article->sticks[0] = '不置頂';
$lang->article->sticks[1] = '類目置頂';
$lang->article->sticks[2] = '全局置頂';

$lang->article->successStick   = '置頂成功';
$lang->article->successUnstick = '取消置頂成功';

$lang->article->confirmDelete = '您確定刪除該文章嗎？';
$lang->article->categoryEmpty = '類目不能為空';

$lang->article->lblAddedDate = '<strong>添加時間：</strong> %s &nbsp;&nbsp;';
$lang->article->lblAuthor    = "<strong>作者：</strong> %s &nbsp;&nbsp;";
$lang->article->lblSource    = '<strong>來源：</strong>';
$lang->article->lblViews     = ' <strong>閲讀：</strong>%s';
$lang->article->lblEditor    = '最後編輯：%s 于 %s';
$lang->article->lblComments  = '<strong>評論：</strong> %s';

$lang->article->none      = '沒有了';
$lang->article->previous  = '上一篇';
$lang->article->next      = '下一篇';
$lang->article->directory = '返回目錄';
$lang->article->noCssTag  = '不需要&lt;style&gt;&lt;/style&gt;標籤';
$lang->article->noJsTag   = '不需要&lt;script&gt;&lt;/script&gt;標籤';

$lang->article->placeholder = new stdclass();
$lang->article->placeholder->addedDate = '可以延遲到選定的時間發佈。';
$lang->article->placeholder->link      = '輸入連結，可以是站外連結';

$lang->article->approveMessage = '您投遞的文章 <strong>《%s》</strong> 已通過審核，獎勵 <strong>+%s</strong> 積分，感謝您的支持。';
$lang->article->rejectMessage  = '您投遞的文章 <strong>《%s》</strong> 未通過審核，您可以編輯後再次提交審核，感謝您的支持。';

$lang->article->forwardFrom = '轉發自';
