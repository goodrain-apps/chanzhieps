<?php
/**
 * The helper class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * The helper class, contains the tool functions.
 *
 * @package framework
 */
class helper
{
    /**
     * Set the member's value of one object.
     * <code>
     * <?php
     * $lang->db->user = 'wwccss';
     * helper::setMember('lang', 'db.user', 'chunsheng.wang');
     * ?>
     * </code>
     * @param string    $objName    the var name of the object.
     * @param string    $key        the key of the member, can be parent.child.
     * @param mixed     $value      the value to be set.
     * @static
     * @access public
     * @return bool
     */
    static public function setMember($objName, $key, $value)
    {
        global $$objName;
        if(!is_object($$objName) or empty($key)) return false;
        $key   = str_replace('.', '->', $key);
        $value = serialize($value);
        $code  = ("\$${objName}->{$key}=unserialize(<<<EOT\n$value\nEOT\n);");
        eval($code);
        return true;
    }

    /**
     * Create a link to a module's method.
     * 
     * This method also mapped in control class to call conveniently.
     * <code>
     * <?php
     * helper::createLink('hello', 'index', 'var1=value1&var2=value2');
     * helper::createLink('hello', 'index', array('var1' => 'value1', 'var2' => 'value2');
     * ?>
     * </code>
     * @param string       $moduleName     module name
     * @param string       $methodName     method name
     * @param string|array $vars           the params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2) or key1=value1&key2=value2
     * @param string|array $alias          the alias  params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2) or key1=value1&key2=value2
     * @param string       $viewType       the view type
     * @static
     * @access public
     * @return string the link string.
     */
    static public function createLink($moduleName, $methodName = 'index', $vars = '', $alias = array(), $viewType = '')
    {
        global $app, $config;
        $requestType = $config->requestType;
        if(defined('FIX_PATH_INFO2') and FIX_PATH_INFO2) 
        {
            $config->requestType = 'PATH_INFO2';
        }

        $clientLang = $app->getClientLang();
        $lang       = $config->langCode;

        /* Set viewType is mhtml if visit with mobile.*/
        if(!$viewType and RUN_MODE == 'front' and helper::getDevice() == 'mobile' and $methodName != 'oauthCallback') $viewType = 'mhtml';

        /* Set vars and alias. */
        if(!is_array($vars)) parse_str($vars, $vars);
        if(!is_array($alias)) parse_str($alias, $alias);
        foreach($alias as $key => $value) $alias[$key] = urlencode($value);

        /* Seo modules return directly. */
        if(helper::inSeoMode() and method_exists('uri', 'create' . $moduleName . $methodName))
        {
            if($config->requestType == 'PATH_INFO2') $config->webRoot = $_SERVER['SCRIPT_NAME'] . '/';
            $link = call_user_func_array('uri::create' . $moduleName . $methodName, array('param'=> $vars, 'alias'=>$alias, 'viewType'=>$viewType));

            /* Add client lang. */
            if($lang and $link) $link = $config->webRoot .  $lang . '/' . substr($link, strlen($config->webRoot));

            if($config->requestType == 'PATH_INFO2') $config->webRoot = getWebRoot();
            $config->requestType = $requestType;
            if($link) return $link;
        }
        
        /* Set the view type. */
        if(empty($viewType)) $viewType = $app->getViewType();
        if($config->requestType == 'PATH_INFO')  $link = $config->webRoot;
        if($config->requestType == 'PATH_INFO2') $link = $_SERVER['SCRIPT_NAME'] . '/';
        if($config->requestType == 'GET') $link = $_SERVER['SCRIPT_NAME'];
        if($config->requestType != 'GET' and $lang) $link .= "$lang/";

        /* Common method. */
        if(helper::inSeoMode())
        {
            /* If the method equal the default method defined in the config file and the vars is empty, convert the link. */
            if($methodName == $config->default->method and empty($vars))
            {
                /* If the module also equal the default module, change index-index to index.html. */
                if($moduleName == $config->default->module)
                {
                    $link .= 'index.' . $viewType;
                }
                elseif($viewType == $app->getViewType())
                {
                    $link .= $moduleName . '/';
                }
                else
                {
                    $link .= $moduleName . '.' . $viewType;
                }
            }
            else
            {
                $link .= "$moduleName{$config->requestFix}$methodName";
                foreach($vars as $value) $link .= "{$config->requestFix}$value";
                $link .= '.' . $viewType;
            }
        }
        else
        {
            $link .= "?{$config->moduleVar}=$moduleName&{$config->methodVar}=$methodName";
            if($viewType != 'html') $link .= "&{$config->viewVar}=" . $viewType;
            foreach($vars as $key => $value) $link .= "&$key=$value";
            if($lang and RUN_MODE != 'admin') $link .= "&l=$lang";
        }
        $config->requestType = $requestType;
        return $link;
    }

    /**
     * Import a file instend of include or requie.
     * 
     * @param string    $file   the file to be imported.
     * @static
     * @access public
     * @return bool
     */
    static public function import($file)
    {
        static $includedFiles = array();
        if(!isset($includedFiles[$file]))
        {
            $return = include $file;
            if(!$return) return false;
            $includedFiles[$file] = true;
            return true;
        }
        return true;
    }

    /**
     * Set the model file of one module. If there's an extension file, merge it with the main model file.
     * 
     * @param   string $moduleName the module name
     * @static
     * @access  public
     * @return  string the model file
     */
    static public function setModelFile($moduleName)
    {
        global $app;

        /* Set the main model file and extension and hook pathes and files. */
        $mainModelFile = $app->getModulePath($moduleName) . 'model.php';
        $modelExtPaths = $app->getModuleExtPath($moduleName, 'model');

        $hookFiles = array();
        $extFiles  = array();
        foreach($modelExtPaths as $modelExtPath)
        {
            $hookFiles = array_merge($hookFiles, helper::ls($modelExtPath . 'hook/', '.php'));
            $extFiles  = array_merge($extFiles, helper::ls($modelExtPath, '.php'));
        }

        /* If no extension file, return the main file directly. */
        if(empty($extFiles) and empty($hookFiles)) return $mainModelFile;

        /* Else, judge whether needed update or not .*/
        $mergedModelDir  = $app->getTmpRoot() . 'model' . DS . $app->siteCode{0} . DS . $app->siteCode . DS;
        $mergedModelFile = $mergedModelDir . $app->siteCode . '.' . $moduleName . '.php';
        $needUpdate      = false;
        $lastTime        = file_exists($mergedModelFile) ? filemtime($mergedModelFile) : 0;
        if(!is_dir($mergedModelDir)) mkdir($mergedModelDir, 0755, true);

        while(!$needUpdate)
        {
            foreach($extFiles  as $extFile) if(filemtime($extFile)  > $lastTime) break 2;
            foreach($hookFiles as $hookFile) if(filemtime($hookFile) > $lastTime) break 2;

            if(filemtime($mainModelFile) > $lastTime) break;

            return $mergedModelFile;
        }

        /* Update the cache file. */
        $modelClass       = $moduleName . 'Model';
        $extModelClass    = 'ext' . $modelClass;
        $extTmpModelClass = 'tmpExt' . $modelClass;
        $modelLines       = "<?php\n";
        $modelLines      .= "helper::import('$mainModelFile');\n";
        $modelLines      .= "class $extTmpModelClass extends $modelClass \n{\n";

        /* Cycle all the extension files. */
        foreach($extFiles as $extFile)
        {
            $extLines = self::removeTagsOfPHP($extFile);
            $modelLines .= $extLines . "\n";
        }
        /* Create the merged model file. */
        $replaceMark = '//**//';    // This mark is for replacing code using.
        $modelLines .= "$replaceMark\n}";

        /* Unset conflic function for model. */
        preg_match_all('/.* function\s+(\w+)\s*\(.*\)[^\{]*\{/Ui', $modelLines, $functions);
        $functions = $functions[1];
        $conflics  = array_count_values($functions);
        foreach($conflics as $functionName => $count)
        {
            if($count <= 1) unset($conflics[$functionName]);
        }
        if($conflics)
        {
            $modelLines = explode("\n", $modelLines);
            $startDel   = false;
            foreach($modelLines as $line => $code)
            {
                if($startDel and preg_match('/.* function\s+(\w+)\s*\(.*\)/Ui', $code)) $startDel = false;
                if($startDel)
                {
                    unset($modelLines[$line]);
                }
                else
                {
                    foreach($conflics as $functionName => $count)
                    {
                        if($count <= 1) continue;
                        if(preg_match('/.* function\s+' . $functionName . '\s*\(.*\)/Ui', $code)) 
                        {
                            $conflics[$functionName] = $count - 1;
                            $startDel = true;
                            unset($modelLines[$line]);
                        }
                    }
                }
            }

            $modelLines = join("\n", $modelLines);
        }

        $tmpMergedModelFile = $mergedModelDir . 'tmp.' . $app->siteCode . '.' . $moduleName . '.php';
        if(!@file_put_contents($tmpMergedModelFile, $modelLines))
        {
            die("ERROR: $tmpMergedModelFile not writable, please make sure the " . dirname($tmpMergedModelFile) . ' directory exists and writable');
        }
        if(!class_exists($extTmpModelClass)) include $tmpMergedModelFile;

        /* Get hook codes need to merge. */
        $hookCodes = array();
        foreach($hookFiles as $hookFile)
        {
            $fileName = baseName($hookFile);
            list($method) = explode('.', $fileName);
            $hookCodes[$method][] = self::removeTagsOfPHP($hookFile);
        }

        /* Cycle the hook methods and merge hook codes. */
        $hookedMethods    = array_keys($hookCodes);
        $mainModelCodes   = file($mainModelFile);
        $mergedModelCodes = file($tmpMergedModelFile);
        foreach($hookedMethods as $method)
        {
            /* Reflection the hooked method to get it's defined position. */
            $methodRelfection = new reflectionMethod($extTmpModelClass, $method);
            $definedFile = $methodRelfection->getFileName();
            $startLine   = $methodRelfection->getStartLine() . ' ';
            $endLine     = $methodRelfection->getEndLine() . ' ';

            /* Merge hook codes. */
            $oldCodes = $definedFile == $tmpMergedModelFile ? $mergedModelCodes : $mainModelCodes;
            $oldCodes = join("", array_slice($oldCodes, $startLine - 1, $endLine - $startLine + 1));
            $openBrace = strpos($oldCodes, '{');
            $newCodes = substr($oldCodes, 0, $openBrace + 1) . "\n" . join("\n", $hookCodes[$method]) . substr($oldCodes, $openBrace + 1);

            /* Replace it. */
            if($definedFile == $tmpMergedModelFile)
            {
                $modelLines = str_replace($oldCodes, $newCodes, $modelLines);
            }
            else
            {
                $modelLines = str_replace($replaceMark, $newCodes . "\n$replaceMark", $modelLines);
            }
        }
        unlink($tmpMergedModelFile);
        
        /* Save it. */
        $modelLines = str_replace($extTmpModelClass, $extModelClass, $modelLines);
        file_put_contents($mergedModelFile, $modelLines);

        return $mergedModelFile;
    }

    /**
     * Remove tags of PHP 
     * 
     * @param  string    $fileName 
     * @static
     * @access public
     * @return string
     */
    static public function removeTagsOfPHP($fileName)
    {
        $code = trim(file_get_contents($fileName));
        if(strpos($code, '<?php') === 0)     $code = ltrim($code, '<?php');
        if(strrpos($code, '?>')   !== false) $code = rtrim($code, '?>');
        return trim($code);
    }

    /**
     * Create the in('a', 'b') string.
     * 
     * @param   string|array $ids   the id lists, can be a array or a string with ids joined with comma.
     * @static
     * @access  public
     * @return  string  the string like IN('a', 'b').
     */
    static public function dbIN($ids)
    {
        if(is_array($ids)) 
        {
            if(!function_exists('get_magic_quotes_gpc') or !get_magic_quotes_gpc())
            {
                foreach ($ids as $key=>$value)  $ids[$key] = addslashes($value); 
            }
            return "IN ('" . join("','", $ids) . "')";
        }

        if(!function_exists('get_magic_quotes_gpc') or !get_magic_quotes_gpc()) $ids = addslashes($ids);
        return "IN ('" . str_replace(',', "','", str_replace(' ', '', $ids)) . "')";
    }

    /**
     * Create safe base64 encoded string for the framework.
     * 
     * @param   string  $string   the string to encode.
     * @static
     * @access  public
     * @return  string  encoded string.
     */
    static public function safe64Encode($string)
    {
        return strtr(base64_encode($string), '/', '.');
    }

    /**
     * Decode the string encoded by safe64Encode.
     * 
     * @param   string  $string   the string to decode
     * @static
     * @access  public
     * @return  string  decoded string.
     */
    static public function safe64Decode($string)
    {
        return base64_decode(strtr($string, '.', '/'));
    }

    /**
     * Json encode and addslashe if magic_quotes_gpc is on. 
     * 
     * @param   mixed  $data   the object to encode
     * @static
     * @access  public
     * @return  string  decoded string.
     */
    static public function jsonEncode($data)
    {
        return (version_compare(phpversion(), '5.4', '<') and function_exists('get_magic_quotes_gpc') and get_magic_quotes_gpc()) ? addslashes(json_encode($data)) : json_encode($data);
    }

    /**
     *  Compute the diff days of two date.
     * 
     * @param   date  $date1   the first date.
     * @param   date  $date2   the sencode date.
     * @access  public
     * @return  int  the diff of the two days.
     */
    static public function diffDate($date1, $date2)
    {
        return round((strtotime($date1) - strtotime($date2)) / 86400, 0);
    }

    /**
     *  Get now time use the DT_DATETIME1 constant defined in the lang file.
     * 
     * @access  public
     * @return  datetime  now
     */
    static public function now()
    {
        return date(DT_DATETIME1);
    }

    /**
     *  Get today according to the  DT_DATE1 constant defined in the lang file.
     * 
     * @access  public
     * @return  date  today
     */
    static public function today()
    {
        return date(DT_DATE1);
    }

    /**
     *  Judge a date is zero or not.
     * 
     * @access  public
     * @return  bool
     */
    static public function isZeroDate($date)
    {
        return substr($date, 0, 4) == '0000';
    }

    /**
     *  Get files match the pattern under one directory.
     * 
     * @access  public
     * @return  array   the files match the pattern
     */
    static public function ls($dir, $pattern = '')
    {
        $files = array();
        $dir = realpath($dir);
        if(is_dir($dir)) $files = glob($dir . DIRECTORY_SEPARATOR . '*' . $pattern);
        if($files) return $files;
        return array();
    }

    /**
     * Change directory.
     * 
     * @param  string $path 
     * @static
     * @access public
     * @return void
     */
    static function cd($path = '')
    {
        static $cwd = '';
        if($path)
        {
            $cwd = getcwd();
            chdir($path);
        }
        else
        {
            chdir($cwd);
        }
    }

    /**
     * Remove UTF8 Bom 
     * 
     * @param  string    $string
     * @access public
     * @return string
     */
    public static function removeUTF8Bom($string)
    {
        if(substr($string, 0, 3) == pack('CCC', 239, 187, 191)) return substr($string, 3); 
        return $string;
    }

    /**
     * Get siteCode from domain.
     * @param  string $domain
     * @return string $siteCode
     **/ 
    public static function getSiteCode($domain)
    {
        global $config;

        if(strpos($domain, ':') !== false) $domain = substr($domain, 0, strpos($domain, ':')); // Remove port from domain.
        $domain = strtolower($domain);

        if(isset($config->siteCode[$domain])) return $config->siteCode[$domain];

        if($domain == 'localhost') return $domain;
        if(!preg_match('/^([a-z0-9\-_]+\.)+[a-z0-9\-]+$/', $domain)) die('domain denied');

        $domain  = str_replace('-', '_', $domain);    // Replace '-' by '_'.
        $items   = explode('.', $domain);
        $postfix = str_replace($items[0] . '.', '', $domain);
        if(isset($config->chanzhi->node->domain) and $postfix == $config->chanzhi->node->domain) return $items[0];
        if(strpos($config->domainPostfix, "|$postfix|") !== false) return $items[0];

        $postfix = str_replace($items[0] . '.' . $items[1] . '.', '', $domain);
        if(strpos($config->domainPostfix, "|$postfix|") !== false) return $items[1];

        return $siteCode = $domain;
    }

    /**
     * Enhanced substr version: support multibyte languages like Chinese.
     *
     * @param string $string
     * @param int $length 
     * @param string $append 
     * @return string 
     **/
    public static function substr($string, $length, $append = '')
    {
        if (strlen($string) <= $length ) $append = '';
        if(function_exists('mb_substr')) return mb_substr($string, 0, $length, 'utf-8') . $append;

        preg_match_all("/./su", $string, $data);
        return join("", array_slice($data[0],  0, $length)) . $append;
    }

    /**
     * Check in seo mode or not.
     *
     * return bool
     */
    public static function inSeoMode()
    {
        global $config;
        return ($config->seoMode and ($config->requestType != 'GET'));
    }

    /**
     * Check is ajax request 
     * 
     * @access public
     * @return void
     */
    public static function isAjaxRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    /**
     * Header 301 Moved Permanently.
     * 
     * @param  string    $locate 
     * @access public
     * @return void
     */
    public static function header301($locate)
    {
        header('HTTP/1.1 301 Moved Permanently');
        die(header('Location:' . $locate));
    }

    /**
     * Get browser.
     * 
     * @access public
     * @return string
     */
    public static function getBrowser()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER["HTTP_USER_AGENT"];
        if(strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) 
        {
            return "ie";
        }
        else if(strpos($agent, 'Firefox') !== false)
        {
            return "firefox";
        }
        else if(strpos($agent, 'Chrome') !== false)
        {
            return "chrome";
        }
        else if(strpos($agent, 'Opera') !== false)
        {
            return 'opera';
        }
        else if((strpos($agent, 'Chrome') == false) && strpos($agent, 'Safari') !== false)
        {
            return 'safari';
        }
        else
        {
            return 'unknown';
        }
    }

    /**
     * Get browser version. 
     * 
     * @access public
     * @return string
     */
    public static function getBrowserVersion()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER['HTTP_USER_AGENT'];   
        if(preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if((strpos($agent,'Chrome') == false) && preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
        {
            return $regs[1];
        }
        else if(preg_match('/rv:(\d+)\..*/i', $agent, $regs))
        {
            return $regs[1];
        }
        else
        {
            return 'unknow';
        }
    }

    /**
     * Get client os from agent info. 
     * 
     * @static
     * @access public
     * @return string
     */
    public static function getOS()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $osList = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($osList as $regex => $value)
        { 
            if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) return $value; 
        }   

        return 'unknown';
    }

    /**
     * Get remote ip. 
     * 
     * @access public
     * @return string
     */
    public static function getRemoteIp()
    {
        $ip = '';
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else if(!empty($_SERVER["REMOTE_ADDR"]))
        {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        if(strpos($ip, ',') !== false)
        {
            $ipList = explode(',', $ip);
            $ip = $ipList[0];
        }

        return $ip;
    }

    /**
     * check ip is in network.  
     * 
     * @param  string $ip 
     * @param  string $network 
     * @access public
     * @return void
     */
    public static function checkIpScope($ip, $network)
    {
        if(strpos($network, '/') === false) return $ip == $network;

        $ip = (double) (sprintf("%u", ip2long($ip)));
        $s  = explode('/', $network);
        $networkStart = (double) (sprintf("%u", ip2long($s[0])));
        $networkLen = pow(2, 32 - $s[1]);
        $networkEnd = $networkStart + $networkLen - 1;

        if ($ip >= $networkStart && $ip <= $networkEnd)
        {
            return true;
        }
        return false;
    }

    /**
     * Check ip avaliable.  
     * 
     * @param  string $ip 
     * @access public
     * @return bool
     */
    public static function checkIP($ip)
    {
        $ip = trim($ip);
        if(strpos($ip, '/') !== false)
        {
            $s = explode('/', $ip);
            preg_match('/^(((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)(\.((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)){3})$/', $s[0], $matches);
            if(!empty($matches) and $s[1] > 0 and $s[1] < 36) return true;
        }
        else
        {
            preg_match('/^(((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)(\.((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)){3})$/', $ip, $matches);
            if(!empty($matches)) return true;
        }
        return false;
    }

    /**
     * Create random string. 
     * 
     * @param  int    $length 
     * @param  string $skip A-Z|a-z|0-9
     * @static
     * @access public
     * @return void
     */
    public static function createRandomStr($length, $skip = '')
    {
        $str  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $skip = str_replace('A-Z', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', $skip);
        $skip = str_replace('a-z', 'abcdefghijklmnopqrstuvwxyz', $skip);
        $skip = str_replace('0-9', '0123456789', $skip);
        for($i = 0; $i < strlen($skip); $i++)
        {
            $str = str_replace($skip[$i], '', $str);
        }

        $strlen = strlen($str);
        while($length > strlen($str)) $str .= $str;

        $str = str_shuffle($str); 
        return substr($str,0,$length); 
    }

    /**
     * Get device.
     * 
     * @access public
     * @return void
     */
    public static function getDevice()
    {
        global $app, $config;

        $viewType = $app->getViewType();
        if($viewType == 'mhtml') return 'mobile';

        if(RUN_MODE == 'admin')
        {
            if($app->session->device) return $app->session->device;
            return 'desktop';
        }
        elseif(RUN_MODE == 'front')
        {
            if(isset($_COOKIE['visualDevice'])) return $_COOKIE['visualDevice'];

            /* Detect mobile. */
            $mobile = $app->loadClass('mobile');
            if($mobile->isMobile())
            {
                if(!isset($config->template->mobile)) return 'desktop';
                if(isset($config->site->mobileTemplate) and $config->site->mobileTemplate == 'close') return 'desktop';
                return 'mobile';
            }
        }
        return 'desktop';
    }
}

/**
 *  The short alias of helper::createLink() method. 
 *
 * @param  string        $methodName  the method name
 * @param  string|array  $vars        the params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2)
 * @param  string|array  $alias       the params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2)
 * @param  string        $viewType    
 * @return string the link string.
 */
function inLink($methodName = 'index', $vars = '', $alias = '', $viewType = '')
{
    global $app;
    return helper::createLink($app->getModuleName(), $methodName, $vars, $alias, $viewType);
}

/**
 *  Static cycle a array 
 *
 * @param array  $items     the array to be cycled.
 * @return mixed
 */
function cycle($items)
{
    static $i = 0;
    if(!is_array($items)) $items = explode(',', $items);
    if(!isset($items[$i])) $i = 0;
    return $items[$i++];
}

/**
 * Get current microtime.
 * 
 * @access protected
 * @return float current time.
 */
function getTime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

/**
 * dump a var.
 * 
 * @param mixed $var 
 * @access public
 * @return void
 */
function a($var)
{
    echo "<xmp class='a-left'>";
    print_r($var);
    echo "</xmp>";
}

/**
 * Judge the server ip is local or not.
 * 
 * @access public
 * @return void
 */
function isLocalIP()
{
    $serverIP = $_SERVER['SERVER_ADDR'];
    if($serverIP == '127.0.0.1') return true;
    return !filter_var($serverIP, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
}

/**
 * Key for chanzhi.
 * 
 * @access public
 * @return string
 */
function k()
{
    global $config, $lang;

    $siteCode = $config->site->code;
    $codeLen  = strlen($siteCode);
    $keywords = explode(';', $lang->k);
    $count    = count($keywords);

    $sum = 0;
    for($i = 0; $i < $codeLen; $i++) $sum += ord($siteCode{$i});

    $key = $sum % $count;
    return $keywords[$key];
}

/**
 * Get web root. 
 * 
 * @param  bool     $full 
 * @access public
 * @return string
 */
function getWebRoot($full = false)
{
    $path = $_SERVER['SCRIPT_NAME'];
    if(RUN_MODE == 'shell')
    {
        $url  = parse_url($_SERVER['argv'][1]);
        $path = empty($url['path']) ? '/' : rtrim($url['path'], '/');
        $path = empty($path) ? '/' : $path;
    }

    if($full)
    {
        $http = (isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS']) != 'off') ? 'https://' : 'http://';
        return $http . $_SERVER['HTTP_HOST'] . substr($path, 0, (strrpos($path, '/') + 1));
    }

    return substr($path, 0, (strrpos($path, '/') + 1));
}

/**
 * Get home root.
 * 
 * @param  string $langCode 
 * @access public
 * @return string
 */
function getHomeRoot($langCode = '')
{
    global $config;

    $langCode = $langCode == '' ? $config->langCode : $langCode;
    $defaultLang = isset($config->site->defaultLang) ?  $config->site->defaultLang : $config->default->lang;
    if($langCode == $config->langsShortcuts[$defaultLang]) return $config->webRoot;
    $homeRoot = $config->webRoot;

    if($langCode and $config->requestType == 'PATH_INFO') $homeRoot = $config->webRoot . $langCode; 
    if($langCode and $config->requestType == 'PATH_INFO2') $homeRoot = $config->webRoot . 'index.php/' . "$langCode";
    if($langCode and $config->requestType == 'GET') $homeRoot = $config->webRoot . 'index.php?l=' . "$langCode";
    if($config->requestType != 'GET') $homeRoot = rtrim($homeRoot, '/') . '/';
    return $homeRoot;
}

/**
 * Check admin entry. 
 * 
 * @access public
 * @return string
 */
function checkAdminEntry()
{
    if(strpos($_SERVER['PHP_SELF'], '/admin.php') === false) return true; 

    $path  = dirname($_SERVER['SCRIPT_FILENAME']);
    $files = scandir($path);
    $defaultFiles = array('admin.php', 'index.php', 'install.php', 'loader.php', 'upgrade.php');
    foreach($files as $file)
    {
        if(strpos($file, '.php') !== false and !in_array($file, $defaultFiles))
        {
            $contents = file_get_contents($path . '/' . $file);
            if(strpos($contents, "'RUN_MODE', 'admin'") && strpos($_SERVER['PHP_SELF'], '/admin.php') !== false) die(header("location: " . getWebRoot()));
        }
    }
}

/**
 * Get admin entry.
 * 
 * @access public
 * @return string
 */
function getAdminEntry()
{
    $path  = dirname($_SERVER['SCRIPT_FILENAME']);
    $files = scandir($path);
    $defaultFiles = array('admin.php', 'index.php', 'install.php', 'loader.php', 'upgrade.php');
    foreach($files as $file)
    {
        if(strpos($file, '.php') !== false and !in_array($file, $defaultFiles))
        {
            $contents = file_get_contents($path . '/' . $file);

            if(strpos($contents, "'RUN_MODE', 'admin'") !== false) return $file;
        }
    }
    return 'admin.php';
}

/**
 * Format time.
 * 
 * @param  int    $time 
 * @param  string $format 
 * @access public
 * @return void
 */
function formatTime($time, $format = '')
{
    $time = str_replace('0000-00-00', '', $time);
    $time = str_replace('00:00:00', '', $time);
    if($format) return date($format, strtotime($time));
    return trim($time);
}

/**
 * Check curl ssl enabled.
 * 
 * @access public
 * @return void
 */
function checkCurlSSL()
{
    $version = curl_version();
    return ($version['features'] & CURL_VERSION_SSL);
}

/**
 * When the $var has the $key, return it, esle result one default value.
 * 
 * @param  array|object    $var 
 * @param  string|int      $key 
 * @param  mixed           $valueWhenNone     value when the key not exits.
 * @param  mixed           $valueWhenExists   value when the key exits.
 * @access public
 * @return void
 */
function zget($var, $key, $valueWhenNone = false, $valueWhenExists = false)
{
    $var = (array)$var;
    if(isset($var[$key]))
    {
        if($valueWhenExists !== false) return $valueWhenExists;
        return $var[$key];
    }
    if($valueWhenNone !== false) return $valueWhenNone;
    return $key;
}

/**
 * Header lcoation 301. 
 * 
 * @param  string    $url 
 * @access public
 * @return void
 */
function header301($url)
{
    header('HTTP/1.1 301 Moved Permanently');
    die(header('Location:' . $url));
}

/**
 * Process evil params.
 * 
 * @param  string    $value 
 * @access public
 * @return void
 */
function processEvil($value)
{
    if(strpos(htmlspecialchars_decode($value), '<?') !== false)
    {
        $value       = (string) $value;
        $evils       = array('eval', 'exec', 'passthru', 'proc_open', 'shell_exec', 'system', '$$', 'include', 'require', 'assert');
        $gibbedEvils = array('e v a l', 'e x e c', ' p a s s t h r u', ' p r o c _ o p e n', 's h e l l _ e x e c', 's y s t e m', '$ $', 'i n c l u d e', 'r e q u i r e', 'a s s e r t');
        return str_ireplace($evils, $gibbedEvils, $value);
    }
    return $value;
}

/**
 * Process array evils.
 * 
 * @param  array    $params 
 * @access public
 * @return array
 */
function processArrayEvils($params)
{
    $params = (array) $params;
    foreach($params as $item => $values)
    {
        if(!is_array($values))
        {
            $params[$item] = processEvil($values);
            if(processEvil($item) != $item) unset($params[$item]);
        }
        else
        {
            foreach($values as $key => $value)
            {
                if(is_array($value)) continue;
                $params[$item][$key] = processEvil($value);
                if(processEvil($key) != $key) unset($params[$item][$key]);
            }
        }
    }
    return $params;
}

/**
 * Get host URL.
 * 
 * @access public
 * @return bool
 */
function getHostURL()
{
    return ((isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS']) != 'off') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
}

/**
 * Check current request is GET.
 * 
 * @access public
 * @return void
 */
function isGetUrl()
{
    $webRoot = getWebRoot();
    if(strpos($_SERVER['REQUEST_URI'], "{$webRoot}?") === 0) return true;
    if(strpos($_SERVER['REQUEST_URI'], "{$webRoot}index.php?") === 0) return true;
    if(strpos($_SERVER['REQUEST_URI'], "{$webRoot}index.php/?") === 0) return true;
    return false;
}

/**
 * Get file mime type.
 * 
 * @param  int    $file 
 * @access public
 * @return void
 */
function getFileMimeType($file)
{
    if(function_exists('mime_content_type')) return mime_content_type($file);
    if(function_exists('finfo_open'))
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        return finfo_file($finfo, $file); 
    }
    return false;
}
