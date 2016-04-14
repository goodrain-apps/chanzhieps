<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The common simplified chinese file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.zentao.net
 */
/* Common sign setting. */
$lang->colon      = '：';
$lang->prev       = '‹';
$lang->next       = '›';
$lang->equal      = '=';
$lang->laquo      = '&laquo;';
$lang->raquo      = '&raquo;';
$lang->minus      = ' - ';
$lang->dollarSign = '￥';
$lang->divider    = "<span class='divider'>{$lang->raquo}</span> ";
$lang->back2Top   = '返<br/>回<br/>頂<br/>部';
$lang->cancel     = '取消';

/*Language shorthand*/
$lang->cn = '簡';
$lang->tw = '繁';
$lang->en = 'EN';

$lang->toBeAdded = '待添加';

$lang->about  = '關於';
$lang->thanks = '致謝';

/* Lang items for xirang. */
$lang->chanzhiEPS     = '蟬知企業門戶系統';
$lang->chanzhiEPSx    = '蟬知';
$lang->agreement      = "已閲讀並同意<a href='http://zpl.pub/page/zplv12.html' target='_blank'>《Z PUBLIC LICENSE授權協議1.2》</a>。<span class='text-danger'>未經許可，不得去除、隱藏或遮掩蟬知系統的任何標誌及連結。</span>";
$lang->poweredBy      = "<a href='http://www.chanzhi.org/?v=%s' target='_blank' title='%s'>%s</a>";
$lang->poweredByAdmin = "<span id='poweredBy'>由 <a href='http://www.chanzhi.org/?v=%s' target='_blank' title='%s'>蟬知企業門戶系統 %s</a> 強力驅動！</span>";
$lang->newVersion     = "提示：蟬知系統已于 <span id='releaseDate'></span> 發佈 <span id='version'></span>版本。<a href='' target='_blank' id='upgradeLink'>馬上下載</a>";

/* Global lang items. */
$lang->home             = '首頁';
$lang->welcome          = '歡迎您，<strong>%s</strong>！';
$lang->messages         = "<strong><i class='icon-comment-alt'></i> %s</strong>";
$lang->todayIs          = '今天是%s，';
$lang->aboutUs          = '關於我們';
$lang->link             = '友情連結';
$lang->frontHome        = '前台';
$lang->forumHome        = '論壇';
$lang->bookHome         = '手冊';
$lang->dashboard        = '用戶中心';
$lang->visualEdit       = '可視化編輯';
$lang->editMode         = '編輯模式';
$lang->register         = '註冊';
$lang->logout           = '退出';
$lang->login            = '登錄';
$lang->account          = '帳號';
$lang->password         = '密碼';
$lang->changePassword   = '修改密碼';
$lang->setEmail         = "郵箱設置";
$lang->securityQuestion = '密保問題';
$lang->forgotPassword   = '忘記密碼?';
$lang->currentPos       = '當前位置';
$lang->categoryMenu     = '分類導航';
$lang->wechatTip        = '微信訂閲';
$lang->qrcodeTip        = '移動訪問';
$lang->language         = '語言';

/* Global action items. */
$lang->reset          = '重置';
$lang->edit           = '編輯';
$lang->copy           = '複製';
$lang->hide           = '隱藏';
$lang->delete         = '刪除';
$lang->close          = '關閉';
$lang->save           = '保存';
$lang->confirm        = '確認';
$lang->addToBlacklist = '加黑';
$lang->edit           = '編輯';
$lang->send           = '發送';
$lang->preview        = '預覽';
$lang->goback         = '返回';
$lang->more           = '更多';
$lang->actions        = '操作';
$lang->feature        = '未來';
$lang->year           = '年';
$lang->selectAll      = '全選';
$lang->selectReverse  = '反選';
$lang->loading        = '稍候...';
$lang->saveSuccess    = '保存成功';
$lang->setSuccess     = '設置成功';
$lang->createSuccess  = '創建成功';
$lang->sendSuccess    = '發送成功';
$lang->deleteSuccess  = '刪除成功';
$lang->fail           = '失敗';
$lang->noResultsMatch = '沒有匹配的選項';
$lang->alias          = '搜索引擎優化使用，可使用英文或數字';
$lang->keywordsHolder = '多個關鍵字中間用逗號隔開';

$lang->setOkFile = <<<EOT
<h5>請按照下面的步驟操作以確認您的管理員身份。</h5>
<p>創建 %s 檔案。</p>
EOT;

$lang->color       = '顏色';
$lang->colorTip    = '十六進制顏色值';
$lang->colorPlates = '333333|000000|CA1407|45872B|148D00|F25D03|2286D2|D92958|A63268|04BFAD|D1270A|FF9400|299182|63731A|3D4DBE|7382D9|754FB9|F2E205|B1C502|364245|C05036|8A342A|E0DDA2|B3D465|EEEEEE|FFD0E5|D0FFFD|FFFF84|F4E6AE|E5E5E5|F1F1F1|FFFFFF';

$lang->score = new stdclass();
$lang->score->common = '積分';

/* Items for javascript. */
$lang->js = new stdclass();
$lang->js->confirmDelete    = '您確定要執行刪除操作嗎？';
$lang->js->deleteing        = '刪除中';
$lang->js->doing            = '處理中';
$lang->js->loading          = '加載中';
$lang->js->updating         = '更新中...';
$lang->js->timeout          = '網絡超時,請重試';
$lang->js->errorThrown      = '<h4>執行出錯：</h4>';
$lang->js->continueShopping = '繼續購物';
$lang->js->required         = '必填';
$lang->js->back             = '返回';
$lang->js->continue         = '繼續';

/* Contact fields*/
$lang->company = new stdclass();
$lang->company->contactUs = '聯繫我們';
$lang->company->contacts  = '聯繫人';
$lang->company->address   = '地址';
$lang->company->phone     = '電話';
$lang->company->email     = 'Email';
$lang->company->fax       = '傳真';
$lang->company->qq        = 'QQ';
$lang->company->skype     = 'Skype';
$lang->company->weibo     = '微博';
$lang->company->weixin    = '微信';
$lang->company->wangwang  = '旺旺';
$lang->company->site      = '網址';

/* Sitemap settings. */
$lang->sitemap = new stdclass();
$lang->sitemap->common = '站點地圖';

/* The primary navbar */
$lang->groups = new stdclass();
$lang->groups->home     = array('title' => '首頁', 'link' => 'admin|index|',               'icon' => 'home');
$lang->groups->content  = array('title' => '內容', 'link' => 'article|admin|type=article', 'icon' => 'edit');
$lang->groups->shop     = array('title' => '商城', 'link' => 'order|admin|',               'icon' => 'shopping-cart');
$lang->groups->user     = array('title' => '會員', 'link' => 'user|admin|',                'icon' => 'group');
$lang->groups->promote  = array('title' => '推廣', 'link' => 'stat|traffic|',              'icon' => 'volume-up');
$lang->groups->design   = array('title' => '設計', 'link' => 'ui|settemplate|',            'icon' => 'paint-brush');
$lang->groups->open     = array('title' => '平台', 'link' => 'package|browse|',            'icon' => 'cloud');
$lang->groups->setting  = array('title' => '設置', 'link' => 'site|setbasic|',             'icon' => 'cog');

/* The main menus. */
$lang->menu = new stdclass();
$lang->menu->admin    = '首頁|admin|index|';
$lang->menu->article  = '文章|article|admin|type=article';
$lang->menu->blog     = '博客|article|admin|type=blog';
$lang->menu->book     = '手冊|book|admin|';
$lang->menu->page     = '單頁|article|admin|type=page';

$lang->menu->product      = '產品|product|admin|';
$lang->menu->order        = '訂單|order|admin|';
$lang->menu->express      = '快遞|tree|browse|type=express';
$lang->menu->orderSetting = '設置|product|setting|';

$lang->menu->user         = '會員|user|admin|';
$lang->menu->message      = '留言|message|admin|type=message';
$lang->menu->comment      = '評論|message|admin|type=comment';
$lang->menu->reply        = '回覆|message|admin|type=reply';
$lang->menu->forum        = '論壇|forum|admin|';
$lang->menu->thread       = '主題|forum|admin|';
$lang->menu->forumreply   = '回帖|reply|admin|';
$lang->menu->submittion   = '投稿|article|admin|type=submittion&tab=user';
$lang->menu->wechat       = '微信|wechat|message|mode=replied&replied=0';

$lang->menu->stat  = '統計|stat|traffic|';
$lang->menu->tag   = '關鍵詞|tag|admin|';
$lang->menu->links = '友情連結|links|admin|';

$lang->menu->ui       = '界面|ui|settemplate|';
$lang->menu->logo     = '標誌|ui|setlogo|';
$lang->menu->nav      = '導航|nav|admin|';
$lang->menu->block    = '區塊|block|admin|';
$lang->menu->slide    = '幻燈片|slide|admin|';
$lang->menu->others   = "設置|ui|others|";
$lang->menu->visual   = "可視化|visual|index|";

$lang->menu->site     = '站點|site|setbasic|';
$lang->menu->security = '安全|site|setsecurity|';

$lang->menu->package    = '插件|package|browse|';
$lang->menu->themestore = '主題市場|ui|themestore|';

/* Menu groups setting. */
$lang->menuGroups = new stdclass();
$lang->menuGroups->mail    = 'site';
$lang->menuGroups->wechat  = 'site';
$lang->menuGroups->group   = 'security';
$lang->menuGroups->tree    = 'article';
$lang->menuGroups->search  = 'site';
$lang->menuGroups->company = 'site';
$lang->menuGroups->score   = 'site';

/* Menu of article module. */
$lang->article = new stdclass();
$lang->article->menu = new stdclass();
$lang->article->menu->browse       = '文章列表|article|admin|';

/* Menu of blog module. */
$lang->blog = new stdclass();
$lang->blog->menu = new stdclass();
$lang->blog->menu->browse       = '博客列表|article|admin|type=blog';

/* Menu of page module. */
$lang->page = new stdclass();
$lang->page->menu = new stdclass();
$lang->page->menu->browse = array('link' => '單頁列表|article|admin|type=page', 'alias' => 'create, edit');

$lang->express = new stdclass();

/* Menu of product module. */
$lang->product = new stdclass();
$lang->product->menu = new stdclass();
$lang->product->menu->browse = array('link' => '所有產品|product|admin|', 'alias' => 'create, edit');

/* Menu of UI module. */
$lang->ui = new stdclass();

/* Menu of theme. */
$lang->theme = new stdclass();
$lang->theme->menu = new stdclass();
$lang->theme->menu->theme   = '主題|ui|settemplate|';
$lang->theme->menu->layout  = array('link' => '佈局|block|pages|', 'alias' => 'setregion');
$lang->theme->menu->custom  = '外觀|ui|customtheme|';
$lang->theme->menu->code    = '代碼|ui|setcode|';
$lang->theme->menu->source  = '素材|file|browsesource|';

/* Menu of user module. */
$lang->user = new stdclass();
$lang->user->menu = new stdclass();
$lang->user->menu->all    = '全部會員|user|admin|';
$lang->user->menu->sina   = '微博會員|user|admin|provider=sina';
$lang->user->menu->wechat = '微信會員|user|admin|provider=wechat';
$lang->user->menu->qq     = 'QQ會員|user|admin|provider=qq';

$lang->message = new stdclass();

/* Menu of forum module. */
$lang->forum = new stdclass();
$lang->forum->menu = new stdclass();
$lang->forum->menu->browse  = '主題列表|forum|admin|';
$lang->forum->menu->reply   = '回帖列表|reply|admin|';
$lang->forum->menu->tree    = '版塊管理|tree|browse|type=forum';
$lang->forum->menu->update  = '更新數據|forum|update|';
$lang->forum->menu->setting = '論壇設置|forum|setting|';

/* Menu of site module. */
$lang->site = new stdclass();
$lang->site->menu = new stdclass();
$lang->site->menu->basic    = '站點設置|site|setbasic|';
$lang->site->menu->cdn      = 'CDN設置|site|setcdn|';
$lang->site->menu->company  = '公司信息|company|setbasic|';
$lang->site->menu->contact  = '聯繫方式|company|setcontact|';
$lang->site->menu->oauth    = '開放登錄|site|setoauth|';
$lang->site->menu->mail     = array('link' => '發信設置|mail|admin|', 'alias' => 'detect,edit,save,test');
$lang->site->menu->wechat   = array('link' => '微信設置|wechat|admin|', 'alias' => 'create, edit, adminresponse');
$lang->site->menu->search   = '全文檢索|search|buildindex|';
$lang->site->menu->score    = '積分規則|score|setcounts|';

/* Menu of security module. */
$lang->security = new stdclass();
$lang->security->menu = new stdclass();
$lang->security->menu->basic     = '基本設置|site|setsecurity|';
$lang->security->menu->filter    = '過濾設置|site|setfilter|';
$lang->security->menu->blacklist = '黑名單管理|guarder|setblacklist|';
$lang->security->menu->whitelist = '白名單管理|guarder|setwhitelist|';
$lang->security->menu->sensitive = '敏感詞設置|site|setsensitive|';
$lang->security->menu->captcha   = '驗證碼設置|guarder|setcaptcha|';
$lang->security->menu->upload    = '附件上傳|site|setupload|';
$lang->security->menu->admin     = '管理員|user|admin|admin=1';
$lang->security->menu->group     = array('link' => '分組權限|group|browse|', 'alias' => 'managepriv,managemember');
$lang->security->menu->log       = '登錄日誌|user|adminlog|';

/* Menu of company module. */
$lang->company->menu = $lang->site->menu;

/* Menu of score module. */
$lang->score->menu = $lang->site->menu;

$lang->cart    = new stdclass();
$lang->order   = new stdclass();
$lang->address = new stdclass();

/* Menu of tree module. */
$lang->tree = new stdclass();
$lang->tree->menu = $lang->article->menu;

/* Menu of mail module. */
$lang->mail = new stdclass();
$lang->mail->menu = $lang->site->menu;

/* Menu of reply module. */
$lang->reply = new stdclass();
$lang->reply->menu = $lang->forum->menu;

/* Menu of wechat module. */
$lang->wechat = new stdclass();
$lang->wechat->menu = $lang->site->menu;

/* Menu of search module. */
$lang->search = new stdclass();
$lang->search->menu   = $lang->site->menu;
$lang->search->common = '搜索';

/* Menu of group module. */
$lang->group = new stdclass();
$lang->group->menu = $lang->security->menu;

/* Menu of package module. */
$lang->package = new stdclass();

/* Menu of stat module. */
$lang->stat = new stdclass();
$lang->stat->menu = new stdclass();
$lang->stat->menu->traffic  = '流量概況|stat|traffic|';
$lang->stat->menu->from     = '來源分類|stat|from|';
$lang->stat->menu->domains  = array('link' => '來路域名|stat|domainlist|', 'alias' => 'domaintrend,domainpage');
$lang->stat->menu->search   = '搜索引擎|stat|search|';
$lang->stat->menu->keywords = '關鍵詞|stat|keywords|';
$lang->stat->menu->client   = '用戶終端|stat|client|type=browser';
$lang->stat->menu->page     = '點擊排行|stat|page|';
$lang->stat->menu->setStat  = '設置|stat|setting|';

/* The error messages. */
$lang->error = new stdclass();
$lang->error->length       = array('<strong>%s</strong>長度錯誤，應當為<strong>%s</strong>', '<strong>%s</strong>長度應當不超過<strong>%s</strong>，且不小於<strong>%s</strong>。');
$lang->error->reg          = '<strong>%s</strong>不符合格式，應當為:<strong>%s</strong>。';
$lang->error->unique       = '<strong>%s</strong>已經有<strong>%s</strong>這條記錄了。';
$lang->error->notempty     = '<strong>%s</strong>不能為空。';
$lang->error->equal        = '<strong>%s</strong>必須為<strong>%s</strong>。';
$lang->error->gt           = "<strong>%s</strong>應當大於<strong>%s</strong>。";
$lang->error->ge           = "<strong>%s</strong>應當不小於<strong>%s</strong>。";
$lang->error->lt           = "<strong>%s</strong>應當小於<strong>%s</strong>。";
$lang->error->le           = "<strong>%s</strong>應當不大於<strong>%s</strong>。";
$lang->error->in           = '<strong>%s</strong>必須為<strong>%s</strong>。';
$lang->error->int          = array('<strong>%s</strong>應當是數字。', '<strong>%s</strong>最小值為%s',  '<strong>%s</strong>應當介於<strong>%s-%s</strong>之間。');
$lang->error->float        = '<strong>%s</strong>應當是數字，可以是小數。';
$lang->error->email        = '<strong>%s</strong>應當為合法的EMAIL。';
$lang->error->phone        = '<strong>%s</strong>應當為合法的電話號碼。';
$lang->error->mobile       = '<strong>%s</strong>應當為合法的手機號碼。';
$lang->error->URL          = '<strong>%s</strong>應當為合法的URL。';
$lang->error->date         = '<strong>%s</strong>應當為合法的日期。';
$lang->error->account      = '<strong>%s</strong>應當為字母和數字的組合，至少三位';
$lang->error->passwordsame = '兩次密碼應當相等。';
$lang->error->passwordrule = '密碼應該符合規則，長度至少為六位。';
$lang->error->captcha      = '請輸入正確的驗證碼。';
$lang->error->noWritable   = '%s 可能不可寫，請修改權限！';
$lang->error->fingerprint  = '身份認證過期，請重試！';
$lang->error->token        = '必須為英文或數字，長度為3-32字元！';
$lang->error->sensitive    = '內容中不能存在敏感詞!';
$lang->error->noRepeat     = '主題或內容已存在，禁止重複';

/* The pager items. */
$lang->pager = new stdclass();
$lang->pager->noRecord     = "暫時沒有記錄";
$lang->pager->digest       = "共 <strong>%s</strong> 條記錄，%s <strong>%s/%s</strong> &nbsp; ";
$lang->pager->recPerPage   = "每頁 <strong>%s</strong> 條";
$lang->pager->first        = "<i class='icon-step-backward' title='首頁'></i>";
$lang->pager->pre          = "<i class='icon-play icon-rotate-180' title='上一頁'></i>";
$lang->pager->next         = "<i class='icon-play' title='下一頁'></i>";
$lang->pager->last         = "<i class='icon-step-forward' title='末頁'></i>";
$lang->pager->locate       = "GO!";
$lang->pager->previousPage = "上一頁";
$lang->pager->nextPage     = "下一頁";
$lang->pager->summery      = "第 <strong>%s-%s</strong> 項，共 <strong>%s</strong> 項";

$lang->date = new stdclass();
$lang->date->minute = '分鐘';
$lang->date->day    = '天';

/* The datetime settings. */
define('DT_DATETIME1',  'Y-m-d H:i:s');
define('DT_DATETIME2',  'y-m-d H:i');
define('DT_MONTHTIME1', 'n/d H:i');
define('DT_MONTHTIME2', 'n月d日 H:i');
define('DT_DATE1',     'Y年m月d日');
define('DT_DATE2',     'Ymd');
define('DT_DATE3',     'Y年m月d日');
define('DT_DATE4',     'Y-m-d');
define('DT_TIME1',     'H:i:s');
define('DT_TIME2',     'H:i');

/* Keywords for chanzhi. */
$lang->k  = '蟬知門戶，開源免費的企業建站系統!;';
$lang->k .= '蟬知門戶，開源免費的cms!;';
$lang->k .= '蟬知門戶，免費建站首選！;';
$lang->k .= '蟬知門戶，企業網站建設專家！;';
$lang->k .= '蟬知門戶，開源php企業建站系統！;';
$lang->k .= '蟬知門戶，微網站專家！;';
$lang->k .= '蟬知門戶，微網站首選！;';
$lang->k .= '蟬知門戶，微信營銷首選！';
