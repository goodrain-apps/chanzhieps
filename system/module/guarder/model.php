<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of guarder module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     guarder
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class guarderModel extends model
{
    /**
     * Check something is evil or not.
     * 
     * @param  string $content 
     * @access public
     * @return bool
     */
    public function isEvil($content = '')
    {
        if(strpos($content, 'http://') !== false) return true;

        $linkCount = preg_match_all('/(?<=href=)([^\>]*)(?=\>)/ ', $content, $out);
        if($linkCount > 5) die();
        if($linkCount > 1) return true;

        if(preg_match('/\[url=.*\].*\[\/url\]/U', $content)) die();

        if($this->app->getClientLang() == 'zh-cn' or $this->app->getClientLang() == 'zh-tw')
        {
            if(!preg_match('/[\x{4e00}-\x{9fa5}]/u', $content)) return true;
        }

        return false;
    }

    /**
     * Create guarder for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Comment()
    {
        $guarder = $this->createCaptcha();
        $input   = helper::createRandomStr(8, $skip='A-Z'); 

        $this->session->set('captchaInput', $input);
        shuffle($this->config->guarder->captchaTags);
        $htmlTag = current($this->config->guarder->captchaTags);
        list($leftTag, $rightTag) = explode('|', $htmlTag);
        $equal = empty($this->config->guarder->captchas) ? "</td><td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td><td>" : '';

        return <<<EOT
<label for='captcha' class='col-sm-1 control-label'>{$this->lang->guarder->captcha}</label>
<div class='col-sm-11 required'>
  <table class='captcha'>
      <tr class='text-middle'>
        <td class='text-lg w-110px'>{$leftTag}{$guarder}{$rightTag}
        {$equal}
        <input type='text' name='{$input}' id='{$input}' class='w-100px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/></td>
      </tr>
  </table>
</div>
EOT;
    }

    /**
     * Create guarder for comment.
     * 
     * @access public
     * @return string
     */
    public function create4Reply()
    {
        $guarder = $this->createCaptcha();     
        $input   = helper::createRandomStr(8, $skip='A-Z'); 
        $this->session->set('captchaInput', $input);
        shuffle($this->config->guarder->captchaTags);
        $htmlTag = current($this->config->guarder->captchaTags);
        list($leftTag, $rightTag) = explode('|', $htmlTag);
        $equal = empty($this->config->guarder->captchas) ? "</td><td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td><td>" : '';

        return <<<EOT
<table class='captcha'>
  <tr class='text-middle'>
    <td class='w-80px text-center'><label for='captcha'>{$this->lang->guarder->captcha}</label></td>
    <td class='text-lg'>{$leftTag}{$guarder}{$rightTag}
    {$equal} 
      <input type='text'  name="{$input}" id='{$input}' class='w-100px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/>
    </td>
  </tr>
</table>
EOT;
    }

    /**
     * Create guarder for thread.
     * 
     * @access public
     * @return string
     */
    public function create4Thread()
    {
        $guarder = $this->createCaptcha();
        $input   = helper::createRandomStr(8, $skip='A-Z'); 
        $this->session->set('captchaInput', $input);
        shuffle($this->config->guarder->captchaTags);
        $htmlTag = current($this->config->guarder->captchaTags);
        list($leftTag, $rightTag) = explode('|', $htmlTag);
        $equal = empty($this->config->guarder->captchas) ? "</td><td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td><td>" : '';

        return <<<EOT
<label for='captcha' class='col-md-1 col-sm-2 control-label'>{$this->lang->guarder->captcha}</label>
<div class='col-md-7 col-sm-8 col-xs-11 required'>
  <table class='captcha'>
      <tr class='text-middle'>
        <td class='text-lg w-110px'>{$leftTag}{$guarder}{$rightTag}
        {$equal}
        <input type='text'  name='{$input}' id='{$input}' class='w-100px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/></td>
      </tr>
  </table>
</div>
EOT;
    }

    /**
     * Create guarder for message reply.
     * 
     * @access public
     * @return string
     */
    public function create4MessageReply()
    {
        $guarder = $this->createCaptcha();
        $input   = helper::createRandomStr(8, $skip='A-Z'); 
        $this->session->set('captchaInput', $input);
        shuffle($this->config->guarder->captchaTags);
        $htmlTag = current($this->config->guarder->captchaTags);
        list($leftTag, $rightTag) = explode('|', $htmlTag);
        $equal = empty($this->config->guarder->captchas) ? "</td><td class='text-lg text-center w-40px'> {$this->lang->guarder->equal} </td><td>" : '';

        return <<<EOT
<th>{$this->lang->guarder->captcha}</th>
<td>
  <table class='captcha'>
    <tr class='text-middle'>
      <td class='text-lg w-110px'>{$leftTag}{$guarder}{$rightTag}
      {$equal}
      <input type='text'  name='{$input}' id='{$input}' class='w-100px inline-block form-control text-center' placeholder='{$this->lang->guarder->placeholder}'/></td>
    </tr>
  </table>
</td>
EOT;
    }

    /**
     * Create guarder.
     * 
     * @access public
     * @return object.
     */
    public function createCaptcha()
    {
        $captchas = isset($this->config->guarder->captchas) ? $this->config->guarder->captchas : array();
        if(!empty($captchas))
        {
            $captcha = zget($captchas, array_rand($captchas, 1));
            $this->session->set('captcha', $captcha->answer);
            return $captcha->question;
        }
            
        /* Get random two numbers and random operator. */
        $operators      = array_keys($this->lang->guarder->operators);
        $firstRand      = mt_rand(0, 10);
        $secondRand     = mt_rand(0, 10);
        $randomOperator = $operators[array_rand($operators)];

        /* Compute the result and save it to session. */
        $expression = "\$captcha = $firstRand $randomOperator $secondRand;";
        eval($expression);
        $this->session->set('captcha', $captcha);

        /* Return the guarder data. */
        $captcha = $this->lang->guarder->numbers[$firstRand] . ' '. $this->lang->guarder->operators[$randomOperator] . ' ' . $this->lang->guarder->numbers[$secondRand];

        return $captcha;
    }

    /**
     * check a request in blacklist.
     * 
     * @access public
     * @return bool
     */
    public function inList()
    {
        if($this->config->site->filterFunction != 'open') return false;
        $ip      = $this->server->remote_addr;
        $account = $this->app->user->account;

        $blackList = $this->dao->select('*')->from(TABLE_BLACKLIST)
            ->where('identity')->in("{$ip},{$account}")
            ->andWhere('type')->in('ip,account')
            ->andWhere('expiredDate', true)->ge(helper::now())
            ->orWhere('expiredDate')->eq('000-00-00 00:00:00')
            ->markRight(1)
            ->fetchAll();

        if(!empty($blackList)) return true;
        return false;
    }
    
    /**
     * Check whether content matched keywords in blacklist.
     * 
     * @param  string    $content 
     * @access public
     * @return bool
     */
    public function matchList($content)
    {
        if($this->config->site->filterFunction != 'open') return false;
        if(!is_string($content))
        {
            $content = (array) $content;
            $content = join(',', $content);
        }

        $blacklist = $this->dao->select('*')->from(TABLE_BLACKLIST)->where('type')->eq('keywords')->fetchAll();
        foreach($blacklist as $item)
        {
            if(strpos($content, $item->identity) !== false) return true; 
        }
        return false;
    }

    /**
     * Save operation log.
     * 
     * @param  string    $type 
     * @param  string    $action 
     * @access public
     * @return void
     */
    public function logOperation($type = 'ip', $action, $identity = '')
    {
        if($this->config->site->filterFunction != 'open') return true;
        if($identity == '')
        {
            if($type == 'ip')      $identity = $this->server->remote_addr;
            if($type == 'account') $identity = $this->app->user->account;
        }
        if($identity == 'guest') return true;

        $whitelist = isset($this->config->guarder->whitelist->$type) ? $this->config->guarder->whitelist->$type : '';
        if(strpos(",$whitelist,", ",$identity,") !== false) return true;

        $records = $this->dao->setAutolang(false)
            ->select('times')->from(TABLE_BLACKLIST)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->fetch('times');
        $records = (int) $records + 1;

        $this->dao->delete()->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->andWhere('createdTime')->lt(date('Y-m-d'))
            ->exec();

        $dayLimit = $this->config->guarder->limits->{$type}->day->$action;
        $dayCount = (int)$this->dao->select('sum(count) as count')->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->fetch('count');

        if(($dayCount + 1) >= $dayLimit)
        {
            $this->punish($type, $identity, $action, $this->config->guarder->punishment->$type->day->$action, $records); 
            return true;
        }

        $interval = $this->config->guarder->interval->{$type}->$action;
        $limit    = $this->config->guarder->limits->{$type}->interval->$action;
        $last     = date('Y-m-d H:i:s', time() - (60 * $interval));

        $log = $this->dao->select('*')->from(TABLE_OPERATIONLOG)
            ->where('type')->eq($type)
            ->andWhere('identity')->eq($identity)
            ->andWhere('operation')->eq($action)
            ->andWhere('createdTime')->ge($last)
            ->fetch();

        if(!empty($log))
        {
            $log->count ++;
            if($log->count >= $limit)
            {
                $this->punish($type, $identity, $action, $this->config->guarder->punishment->{$type}->interval->$action, $records);
            }
            $this->dao->replace(TABLE_OPERATIONLOG)->data($log)->exec();
        }
        else
        {
            $operation = new stdclass();
            $operation->type         = $type;
            $operation->count        = 1;
            $operation->operation    = $action;
            $operation->identity     = $identity;
            $operation->createdTime  = date('Y-m-d H:i:s');

            $this->dao->insert(TABLE_OPERATIONLOG)->data($operation)->exec();
        }
        return true;
    }

    /**
     * Punish a ip or account to blacklist.
     * 
     * @param  string    $type 
     * @param  string    $identity 
     * @param  string    $reason 
     * @param  string    $expired
     * @param  int       $times
     * @access public
     * @return bool 
     */
    public function punish($type, $identity, $reason, $expired, $times = 1)
    {
       $blacklist = new stdclass(); 
       $blacklist->type     = $type;
       $blacklist->identity = $identity;
       $blacklist->reason   = $reason;
       $blacklist->times    = $times;
       $blacklist->lang     = 'all';
       if(!empty($expired)) $blacklist->expiredDate = date('Y-m-d H:i:s', $expired * 60 * $times + time());

       $this->dao->replace(TABLE_BLACKLIST)->data($blacklist)
           ->batchCheck($this->config->guarder->require->addblacklist, 'notempty')
           ->exec();

       return !dao::isError();
    }
    
    /**
     * Check whether is repeat.
     * 
     * @param  string    $content 
     * @param  string $title 
     * @access public
     * @return bool
     */
    public function checkRepeat($content, $title = '')
    {
        if($this->config->site->filterFunction != 'open') return false;
        if(empty($title)) $title = $content;
        $repeat = $this->dao->select('id')->from(TABLE_THREAD)->where('title')->eq($title)->orWhere('content')->eq($content)->fetch();
        if(empty($repeat)) $repeat = $this->dao->select('id')->from(TABLE_MESSAGE)->where('content')->eq($content)->fetch();
        if(empty($repeat)) $repeat = $this->dao->select('id')->from(TABLE_REPLY)->where('content')->eq($content)->fetch();

        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());
        return !empty($repeat);
    }

    /**
     * set captcha 
     * 
     * @access public
     * @return bool 
     */
    public function setCaptcha()
    {
        $data = fixer::input('post')->get();
        $captchas = array();
        
        foreach($data->question as $key => $question)
        {
            if(!empty($question) and !empty($data->answer[$key]))
            {
                $captchas[] = array('question' => $question, 'answer' => $data->answer[$key]);
            }
        }
        $captchas = json_encode($captchas);

        $result = $this->loadModel('setting')->setItem('system.common.guarder.captchas', $captchas, $this->app->getClientLang());
        
        return $result;
    }

    /**
     * Verify.
     *
     * @param  string $importantValidate
     * @access public
     * @return bool
     */
    public function verify($importantValidate = '')
    {
        if($importantValidate == '') $importantValidate = $this->config->site->importantValidate;
        if(!$importantValidate) return true;

        $importantValidate = explode(',', $importantValidate);
        if(empty($importantValidate)) return true;;

        if($this->session->verify == 'pass') return true;

        if(in_array('okFile', $importantValidate))
        {
            $okFile = $this->loadModel('common')->verifyAdmin();
            if($okFile['result'] == 'success') return true;
        }

        return false;
    }

    /**
     * Get security question.
     *
     * @param  string $account
     * @access public
     * @return void
     */
    public function getSecurityQuestion($account)
    {
        $question = $this->dao->select('security')->from(TABLE_USER)->where('account')->eq($account)->fetch('security');
        return json_decode($question);
    }
}
