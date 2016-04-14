<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class uiModel extends model
{
    /**
     * Get templates available.
     *
     * @access public
     * @return void
     */
    public function getTemplates()
    {
        $device = helper::getDevice();

        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            if(!is_dir($folder)) continue;

            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $docFile      = $folder . DS . '_doc' . DS . $this->app->getClientLang() . '.yaml';
            if(!is_file($docFile)) continue;

            $config = Spyc::YAMLLoadString(file_get_contents($docFile));
            if(empty($config)) continue;

            if(isset($config['device']) and strpos($config['device'], ",{$device},") === false) continue;;
            $templates[$templateName] = $config;

            if(!isset($templates[$templateName]['themes']))
            {
                $templates[$templateName]['themes'] = array('default' => 'default');

                $themePath = $this->app->getWwwRoot() . 'template' . DS . $templateName . '/theme/default';
                if(!is_dir($themePath)) mkdir($themePath, 0777, true);
            }
        }

        $importedThemes = $this->dao->select('*')->from(TABLE_PACKAGE)->where('type')->eq('theme')->fetchGroup('templateCompatible');
        foreach($importedThemes as $template => $themes)
        {
            foreach($themes as $theme)
            {
                if(!isset($templates[$template])) continue;
                $templates[$template]['themes'][$theme->code] = $theme->name;
            }
        }
        return $templates;
    }

    /**
     * Get themes by template.
     *
     * @param  string    $template
     * @access public
     * @return array
     */
    public function getThemesByTemplate($template)
    {
        $templates = $this->getTemplates();
        $template  = zget($templates, $template);
        return isset($template['themes']) ? $template['themes'] : array();
    }

    /**
     * Get installed themes in db.
     *
     * @access public
     * @return array
     */
    public function getInstalledThemes()
    {
        return $this->dao->select('*')->from(TABLE_PACKAGE)->where('type')->eq('theme')->fetchGroup('templateCompatible', 'code');
    }

    /**
     * Get template option menu.
     *
     * @access public
     * @return void
     */
    public function getTemplateOptions()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . '_doc' . DS . $this->app->getClientLang() . '.yaml'));
            $templates[$templateName] = $config['name'];
        }

        return $templates;
    }

    /**
     * Set UI option with file.
     *
     * @param  int    $type
     * @param  int    $htmlTagName
     * @access public
     * @return void
     */
    public function setOptionWithFile($section, $htmlTagName, $allowedFileType = 'jpg,jpeg,png,gif,bmp')
    {
        if(empty($_FILES)) return array('result' => false, 'message' => $this->lang->ui->noSelectedFile);

        $fileType = substr($_FILES[$htmlTagName]['name'], strrpos($_FILES[$htmlTagName]['name'], '.') + 1);
        if(strpos($allowedFileType, $fileType) === false) return array('result' => false, 'message' => sprintf($this->lang->ui->notAlloweFileType, $allowedFileType));

        $fileModel = $this->loadModel('file');

        if(!$this->file->checkSavePath()) return array('result' => false, 'message' => $this->lang->file->errorUnwritable);

        /* Delete old files. */
        if($section != 'logo')
        {
            $clientLang = $this->app->getClientLang();
            $oldFiles = $this->dao->select('id')->from(TABLE_FILE)->where('objectType')->eq($section)->andWhere('lang')->eq($clientLang)->fetchAll('id');
            foreach($oldFiles as $file) $fileModel->delete($file->id);
            if(dao::isError()) return array('result' => false, 'message' => dao::getError());
        }
        
        /* Upload new logo. */
        $uploadResult = $fileModel->saveUpload('', '', '', $htmlTagName);
        if(!$uploadResult) return array('result' => false, 'message' => $this->lang->fail);

        $fileIdList = array_keys($uploadResult);
        $file       = $fileModel->getById($fileIdList[0]);

        /* Save new data. */
        $setting  = new stdclass();
        $setting->fileID    = $file->id;
        $setting->pathname  = $file->pathname;
        $setting->webPath   = $file->webPath;
        $setting->addedBy   = $file->addedBy;
        $setting->addedDate = $file->addedDate;

        if($section == 'logo')
        {
            $device = helper::getDevice();
            $template = $this->config->template->{$device}->name;
            $theme    = $this->post->theme == 'all' ? 'all' : $this->config->template->{$device}->theme;
            $logo = isset($this->config->site->logo) ? json_decode($this->config->site->logo, true) : array();
            if(!isset($logo[$template])) $logo[$template] = array();
            $logo[$template]['themes'][$theme] = $setting;

            $result = $this->loadModel('setting')->setItems('system.common.site', array($section => helper::jsonEncode($logo)));
        }
        else
        {
            $result = $this->loadModel('setting')->setItems('system.common.site', array($section => helper::jsonEncode($setting)));
        }
        if($result) return array('result' => true);

        return array('result' => false, 'message' => $this->lang->fail);
    }

    /**
     * Get custom params.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return array
     */
    public function getCustomParams($template, $theme)
    {
        $userSetting = $setting = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();
        $userSetting = !empty($userSetting[$template][$theme]) ? $userSetting[$template][$theme] : array();
        $params = array();

        foreach($this->config->ui->selectorOptions as $groupName => $group)
        {
            foreach($group as $name => $style)
            {
                foreach($style as $attr => $setting)
                {
                    $params[$setting['name']] = empty($userSetting[$setting['name']]) ? $setting['default'] : $userSetting[$setting['name']];
                }
            }
        }
        return $params;
    }

    /**
     * Create customer css.
     *
     * @param  string    $template
     * @param  string    $theme
     * @param  array     $params
     * @access public
     * @return void
     */
    public function createCustomerCss($template, $theme, $params = null)
    {
        $lessc   = $this->app->loadClass('lessc');
        $cssFile = sprintf($this->config->site->ui->customCssFile, $template, $theme);

        if(!empty($params)) $params = (array) $params;
        if(empty($params))  $params = $this->getCustomParams($template, $theme);
        $extraCss = isset($params['css']) ? $params['css'] : '';
        if(isset($params['css'])) unset($params['css']);

        $savePath = dirname($cssFile);
        if(!is_dir($savePath)) mkdir($savePath, 0777, true);
        $lessTemplateDir = $this->app->getWwwRoot() . 'theme' . DS . $template . DS . $theme . DS;

        foreach($this->config->ui->themes[$template][$theme] as $section => $selector)
        {
            foreach($selector as $attr => $settings)
            {
                foreach($settings as $setting) if(isset($params[$setting['name']]) and empty($params[$setting['name']])) $params[$setting['name']] = $setting['default'];
            }
        }

        /* Format old fontfamily names. */
        $fontsList = array_flip($this->lang->ui->theme->fontList);
        foreach($params as $item => $value)
        {
            $value = str_replace(array('&gt;', '&quot;'), array('>', '"'), $value);
            if(empty($value)) $params[$item] = 0;
            if(isset($fontsList[$value])) $params[$item] = $fontsList[$value];
        }

        unset($params['background-image-position']);
        unset($params['navbar-background-image-position']);
        unset($params['css']);
        unset($params['js']);

        $lessc->setFormatter("compressed");
        $lessc->setVariables($params);

        $css = '/* Theme for teamplate:' . $template . ' - theme:' . $theme . '. (' . date("Y-m-d H:i:s") . ') */' . "\r\n";
        $lessTemplate = $lessTemplateDir . 'style.less';
        if(file_exists($lessTemplate))
        {
            $css .= $lessc->compileFile($lessTemplate);
        }
        else if(file_exists($lessTemplateDir . 'style.css'))
        {
            $css .= file_get_contents($lessTemplateDir . 'style.css');
        }
        $customLessFile = $lessTemplateDir . 'custom.less';
        if(file_exists($customLessFile))
        {
            $css .= $lessc->compileFile($customLessFile);
        }
        else if(file_exists($lessTemplateDir . 'custom.css'))
        {
            $css .= file_get_contents($lessTemplateDir . 'custom.css');
        }

        if(!empty($extraCss))
        {
            $css .= "\r\n\r\n" . '/* User custom extra style for teamplate:' . $template . ' - theme:' . $theme . ' */' . "\r\n";
            $extraCss = str_replace(array('&gt;', '&quot;'), array('>', '"'), $extraCss);
            $css .= $lessc->compile($extraCss);
        }

        if(!empty($lessc->errors)) return array('result' => 'fail', 'message' => $lessc->errors);
        file_put_contents($cssFile, $css);

        return array('result' => 'success', 'css' => $css);
    }

    /**
     * Lessc css with params.
     * 
     * @param  array    $params 
     * @param  string   $css 
     * @access public
     * @return string
     */
    public function compileCSS($params, $css)
    {
        $lessc = $this->app->loadClass('lessc');

        $lessc->setFormatter("compressed");
        $lessc->setVariables($params);

        try
        {
            $compiledCSS = $lessc->compile($css);
        }
        catch(Exception $error) 
        {
            return $css;
        }

        return $compiledCSS;
    }

    /**
     * Create html of color plates list.
     *
     * @param string       $plates
     * return string
     */
    public function createColorPlates($plates = '')
    {
        if(empty($plates))
        {
            $plates = $this->lang->colorPlates;
        }

        $colorPlates = '';
        foreach (explode('|', $plates) as $value)
        {
            $colorPlates .= "<div class='color color-tile' data='#{$value}' data-toggle='tooltip' title='{$value}'><i class='icon-ok'></i></div>";
        }
        return $colorPlates;
    }

    /**
     * Print form control.
     *
     * @param  string    $id
     * @param  string    $label
     * @param  array     $params
     * @param  mix       $value
     * @access public
     * @return string
     */
    public function printFormControl($label, $params, $value = false)
    {
        $methodName = 'print' . $params['type'] . 'Control';
        call_user_func_array(array($this, $methodName), array('id' => $params['name'], 'label' => $label, 'params' => $params, 'value' => $value));
    }

    /**
     * Print color control.
     *
     * @param  string    $id
     * @param  string    $label
     * @param  array     $params
     * @param  mix       $value
     * @access public
     * @return string
     */
    public function printColorControl($id, $label, $params, $value = false)
    {
        $originDefault = $params['default'];
        $default = ($value === false or empty($value)) ? $originDefault : $value;
        $placeholder = $default;
        if($placeholder === 'transparent') $placeholder = $this->lang->ui->transparent;

        $html = "<div class='colorplate theme-control' data-id='{$id}'>\n";
        $html .= "<div class='input-group color active input-group-color' data='{$default}'>\n";
        $html .= "<span class='input-group-btn'>\n";
        $html .= "<button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>\n";
        $html .= "{$this->lang->ui->$label} <span class='caret'></span>\n</button>\n";
        $html .= "<div class='dropdown-menu colors'>" . $this->createColorPlates() . "</div>\n</span>\n";
        $html .= "<input id='{$id}' name='{$id}' type='text' value='{$value}' data-origin-default='{$originDefault}' data-default='{$default}' placeholder='{$placeholder}' class='form-control input-color text-latin' data-toggle='tooltip' title='{$this->lang->ui->theme->colorTip}'>\n";
        $html .= "</div>\n</div>\n";
        echo $html;
    }

    /**
     * Print size control
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printSizeControl($id, $label, $params, $value = false)
    {
        $this->printTextbox($id, $value, $this->lang->ui->$label, '', $params['default'], '', '', $this->lang->ui->theme->sizeTip);
    }

     /**
     * Print image control
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printImageControl($id, $label, $params, $value = '')
    {
        $placeholder = $params['default'];
        $default =  $placeholder;
        if(empty($placeholder) or $placeholder == 'none')
        {
            $placeholder = $this->lang->ui->none;
            $default     = 'none';
        }
        if($default == 'inherit')
        {
            $placeholder = $this->lang->ui->theme->default;
        }

        $selectImageLabel = html::a(helper::createLink('file', 'selectimage', "callback=&id={$id}"), $this->lang->ui->selectSourceImage, "id='selectSource' data-toggle='modal'");
        $this->printTextbox($id, $value, $this->lang->ui->$label, $selectImageLabel, $placeholder, '', "data-default='{$default}' data-type='image'", $this->lang->ui->theme->backImageTip);
    }

    /**
     * Print image repeat contorl
     * @param  string  $id
     * @param  string  $label
     * @param  array   $params
     * @param  mix     $value
     * @return void
     */
    public function printRepeatControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->imageRepeatList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    public function printPositionControl($id, $label, $params, $value = '0% 0%')
    {
        $values = explode(' ', $value);
        $defaultValues = explode(' ', $params['default']);
        $defaultValue1 = count($defaultValues) > 0 ? $defaultValues[0] : '0';
        $defaultValue2 = count($defaultValues) > 1 ? $defaultValues[1] : '0';
        $value1 = count($values) > 0 ? $values[0] : $defaultValue1;
        $value2 = count($values) > 1 ? $values[1] : $defaultValue2;

        $this->printTextboxCouple($this->lang->ui->$label, $id, $id . '-x', $value1, 'X', $id . '-y', $value2, 'Y', '', $defaultValue1, $defaultValue2);
    }

    /**
     * Print border control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printBorderControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->borderStyleList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print border control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printUnderlineControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->underlineList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print nav layout
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printNavLayoutControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->navbarLayoutList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font size control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontSizeControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontSizeList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font family control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontFamilyControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print font weight control
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printFontWeightControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->fontWeightList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print sidebar layout
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printSidebarLayoutControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->sidebarPullLeftList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print sidebar width
     * @param  string $id
     * @param  string $label
     * @param  array  $params
     * @param  string $value
     * @return void
     */
    public function printSidebarWidthControl($id, $label, $params, $value = '')
    {
        $this->printSelectList($this->lang->ui->theme->sidebarWidthList, $id, $value, $this->lang->ui->$label, '', '', '', $params['default']);
    }

    /**
     * Print html of textbox with label.
     *
     * @param string       $name
     * @param string       $value
     * @param string       $startLabel
     * @param string       $endLabel
     * @param mix          $placeholder
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string
     */
    public function printTextbox($name, $value, $startLabel = '', $endLabel = '', $placeholder = false, $class = '', $alias = '', $tooltip = '')
    {
        if($placeholder === false)
        {
            $placeholder = $value;
        }

        $html = "<div class='input-group input-group-textbox theme-control' data-id='{$name}'>\n";
        if(!empty($startLabel))
        {
            $html .= "<span class='input-group-addon'>{$startLabel}</span>\n";
        }

        $html .= "<input id='{$name}' name='{$name}' type='text' value='{$value}' placeholder='{$placeholder}' class='form-control input-color text-latin {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }
        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of select with input group
     *
     * @param string       $list
     * @param string       $name
     * @param string       $startLabel
     * @param string       $value
     * @param string       $label
     * @param string       $class
     * @param string       $alias
     * @param string       $tooltip
     * return string
     */
    public function printSelectList($list, $name, $value = '', $label = '', $class = '', $alias = '', $tooltip = '', $default = '')
    {
        $html = "<div class='input-group input-group-select theme-control' data-id='{$name}'>\n";
        if(!empty($label))
        {
            $html .= "<span class='input-group-addon'>{$label}</span>\n";
        }

        if(empty($value))
        {
            $value = $default;
        }

        $html .= html::select($name, $list, $value, "data-default='{$default}' class='form-control {$class}' {$alias}" . (empty($tooltip) ? "" : " title='{$tooltip}' data-toggle='tooltip'")) . "\n";

        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Print html of inputgroup with two textbox cell
     *
     * @param string       $labelStart
     * @param string       $name
     * @param string       $name1
     * @param string       $value1
     * @param string       $label1
     * @param string       $name2
     * @param string       $value2
     * @param string       $label2
     * @param string       $labelEnd
     * @param mix          $placeholder1
     * @param mix          $placeholder2
     * @param string       $tooltip1
     * @param string       $tooltip2
     * @param string       $alias1
     * @param string       $alias2
     * return string
     */
    public function printTextboxCouple($labelStart, $name, $name1, $value1, $label1, $name2, $value2, $label2, $labelEnd, $placeholder1 = false, $placeholder2 = false, $tooltip1 = '', $tooltip2 = '', $alias1 = '', $alias2 = '')
    {
        if($placeholder1 === false)
        {
            $placeholder1 = $value1;
        }
        if($placeholder2 === false)
        {
            $placeholder2 = $value2;
        }

        $html = "<div class='input-group input-group-textbox-couple theme-control' data-id='{$name}'>\n";
        if(!empty($labelStart))
        {
            $html .= "<span class='input-group-addon'>{$labelStart}</span>\n";
        }

        if(!empty($label1))
        {
            $html .= "<span class='input-group-addon" . (empty($labelStart) ? '' : " fix-border") . "'>{$label1}</span>\n";
        }

        $html .= "<input id='{$name1}' data-sid='{$name}-1' data-target='{$name}' name='{$name1}' type='text' value='{$value1}' placeholder='{$placeholder1}' class='form-control input-color text-latin' {$alias1}" . (empty($tooltip1) ? "" : " title='{$tooltip1}' data-toggle='tooltip'") . ">";

        if(!empty($label2))
        {
            $html .= "<span class='input-group-addon fix-border'>{$label2}</span>\n";
        }
        else
        {
            $html .= "<span class='input-group-addon fix-border fix-padding'></span>\n";
        }

        $html .= "<input id='{$name2}' data-sid='{$name}-2' data-target='{$name}' name='{$name2}' type='text' value='{$value2}' placeholder='{$placeholder2}' class='form-control input-color text-latin' {$alias2}" . (empty($tooltip2) ? "" : " title='{$tooltip2}' data-toggle='tooltip'") . ">\n";

        if(!empty($endLabel))
        {
            $html .= "<span class='input-group-addon'>{$endLabel}</span>\n";
        }

        $html .= "<input type='hidden' id='{$name}' name='$name' value='{$value1} {$value2}'>";
        $html .= "</div>\n";
        echo $html;
    }

    /**
     * Check export params.
     *
     * @access public
     * @return bool
     */
    public function checkExportParams()
    {
        $this->lang->exportlang = $this->lang->ui->template;
        $this->dao->insert('exportlang')->data($_POST)->batchCheck($this->config->ui->require->exportTheme, 'notempty');
        return !dao::isError();
    }

    /**
     * Export theme.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return void
     */
    public function exportTheme($template, $theme, $code)
    {
        $themeInfo  = fixer::input('post')
            ->add('type', 'theme')
            ->add('templateCompatible', $this->post->template)
            ->get();

        $yaml  = $this->app->loadClass('spyc')->dump($themeInfo);
        file_put_contents($this->directories->exportDocPath . $this->app->getClientLang() . '.yaml', $yaml);

        $this->clearSources();
        $this->exportDB($template, $theme);
        if(dao::isError()) return false;

        $exportedFile = $this->exportFiles($template, $theme, $code);
        return $exportedFile;
    }

    /**
     * Init export paths.
     *
     * @param  string    $template
     * @param  string    $theme
     * @param  string    $code
     * @access public
     * @return bool
     */
    public function initExportPath($template, $theme, $code)
    {
        $this->directories = new stdclass();
        $this->directories->exportPath       = $this->app->getTmpRoot() . 'theme' . DS . $template . DS . $code . DS;
        $this->directories->exportDocPath    = $this->directories->exportPath . 'doc' . DS;
        $this->directories->exportDbPath     = $this->directories->exportPath . 'db' . DS;
        $this->directories->exportCssPath    = $this->directories->exportPath . 'www' . DS . 'data' . DS . 'css' . DS;
        $this->directories->exportLessPath   = $this->directories->exportPath . 'www' . DS . 'theme' . DS . $template . DS . $code . DS;
        $this->directories->exportSourcePath = $this->directories->exportPath . 'www' . DS . 'data' . DS . 'source' . DS . $template . DS . $code . DS;
        $this->directories->exportSlidePath  = $this->directories->exportPath . 'www' . DS . 'data' . DS . 'slidestmp' . DS;
        $this->directories->exportConfigPath = $this->directories->exportPath . 'system' . DS . 'module' . DS . 'ui' . DS . 'ext' . DS . 'config' . DS;

        $this->directories->encryptPath       = $this->directories->exportPath . 'encrypt' . DS;
        $this->directories->encryptDocPath    = $this->directories->encryptPath . 'doc' . DS;
        $this->directories->encryptDbPath     = $this->directories->encryptPath . 'db'  . DS;
        $this->directories->encryptCssPath    = $this->directories->encryptPath . 'www' . DS . 'data' . DS . 'css' . DS;
        $this->directories->encryptLessPath   = $this->directories->encryptPath . 'www' . DS . 'theme' . DS . $template . DS . $code . DS;
        $this->directories->encryptSourcePath = $this->directories->encryptPath . 'www' . DS . 'data' . DS . 'source' . DS . $template . DS . $code . DS;
        $this->directories->encryptSlidePath  = $this->directories->encryptPath . 'www' . DS . 'data' . DS . 'slidestmp' . DS;
        $this->directories->encryptConfigPath = $this->directories->encryptPath . 'system' . DS . 'module' . DS . 'ui' . DS . 'ext' . DS . 'config' . DS;

        if(is_dir($this->directories->exportPath)) $this->app->loadClass('zfile')->removeDir($this->directories->exportPath);
        foreach($this->directories as $path)
        {
            if(!is_dir($path)) mkdir($path, 0777, true);
        }

        foreach($this->directories as $path)
        {
            if(!is_dir($path)) return false;
        }

        return true;
    }

    /**
     * Get used slidegroups.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return void
     */
    public function getUsedSlideGroups($template)
    {
        $slideBlocks = $this->dao->select('*')->from(TABLE_BLOCK)->where('type')->eq('slide')->andWhere('template')->eq($template)->fetchAll();
        $groups = array();

        foreach($slideBlocks as $block)
        {
            $slide = json_decode($block->content);
            if(isset($slide->group) and $slide->group) $groups[] = $slide->group;
        }

        return array_unique($groups);
    }

    /**
     * Export theme sqls.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return bool
     */
    public function exportDB($template, $theme)
    {
        $lang        = $this->app->getClientLang();
        $zdb         = $this->app->loadClass('zdb');
        $dbFile      = $this->directories->exportDbPath  . 'install.sql';
        $encryptFile = $this->directories->encryptDbPath . 'install.sql';
        $plan        = zget($this->config->layout, "{$template}_{$theme}");

        $tables = array(TABLE_BLOCK, TABLE_LAYOUT, TABLE_FILE, TABLE_CONFIG);

        $groups = $this->getUsedSlideGroups($template, $theme);
        $groups = join(",", $groups);
        if(!empty($groups))
        {
            $tables[] = TABLE_SLIDE;
            $tables[] = TABLE_CATEGORY;
        }

        $condations = array();
        $condations[TABLE_BLOCK]    = "where template='{$template}' and lang in ('all', '{$lang}')";
        $condations[TABLE_LAYOUT]   = "where template='{$template}' and plan = '{$plan}' and lang in ('all', '{$lang}')";
        $condations[TABLE_CONFIG]   = "where owner = 'system' and module = 'common' and section='template' and `key` = 'custom'";
        $condations[TABLE_CATEGORY] = "where type = 'slide'";
        $condations[TABLE_SLIDE]    = "where `group` in ({$groups})";
        $condations[TABLE_FILE]     = "where (objectType = 'source' and objectID = '{$template}_{$theme}') or objectType = 'slide'";

        $fields = array();
        $fields[TABLE_BLOCK]    = "id as originID,`template`,`type`,`title`,`content`, 'lang' as lang";
        $fields[TABLE_LAYOUT]   = "*, 'plan' as plan, 'lang' as lang";
        $fields[TABLE_CONFIG]   = "owner, module, section, `key`, `value`, 'lang' as lang";
        $fields[TABLE_SLIDE]    = "title,`group`,titleColor,mainLink,backgroundType,backgroundColor,height,image,label,buttonClass,buttonUrl,buttonTarget,summary, 'lang' as lang,`order`";
        $fields[TABLE_CATEGORY] = "id as alias, name, lang, 'tmpSlide' as type, 'lang' as lang";
        $fields[TABLE_FILE]     = "pathname,title,extension,size,width,height,objectType,addedDate,public,extra, 'IMPORTED' as addedBy,'all' as lang,'{$template}_THEME_CODEFIX' as objectID";

        $replaces = array();
        $replaces[TABLE_BLOCK]    = true;
        $replaces[TABLE_LAYOUT]   = true;
        $replaces[TABLE_CONFIG]   = true;
        $replaces[TABLE_SLIDE]    = false;
        $replaces[TABLE_CATEGORY] = false;
        $replaces[TABLE_FILE]     = false;

        $zdb->dump($encryptFile, $tables, $fields, 'data', $condations, true);

        /* Dump whole css and js data. */
        $condations[TABLE_CONFIG] = "where owner = 'system' and module = 'common' and (`key` = 'custom' or (section in('css','js') and `key` like '{$template}_{$theme}%') )";
        $zdb->dump($dbFile, $tables, $fields, 'data', $condations, true);
       
        $this->fixSqlFile($template, $theme, $encryptFile);
        $this->fixSqlFile($template, $theme, $dbFile);
        return true;
    }

    /**
     * Replace themeCode.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @access public
     * @return bool
     */
    public function fixSqlFile($template, $theme, $file)
    {
        $sqls = file_get_contents($file);

        $sqls = str_replace(TABLE_BLOCK,    "eps_block",  $sqls);
        $sqls = str_replace(TABLE_LAYOUT,   "eps_layout", $sqls);
        $sqls = str_replace(TABLE_SLIDE,    "eps_slide",  $sqls);
        $sqls = str_replace(TABLE_CONFIG,   "eps_config", $sqls);
        $sqls = str_replace(TABLE_CATEGORY, "eps_category", $sqls);
        $sqls = str_replace(TABLE_FILE,     "eps_file", $sqls);
        $sqls = str_replace("source/{$template}/{$theme}/", "source/{$template}/THEME_CODEFIX/", $sqls);
        $sqls = str_replace("\/{$template}\/{$theme}\/", "/THEME_CODEFIX/", $sqls);
        $sqls = str_replace("\"$theme\"", "\"THEME_CODEFIX\"", $sqls);
        $sqls = str_replace("source/{$template}/{$theme}/", "source/{$template}/THEME_CODEFIX/", $sqls);
        $sqls = str_replace("data\/source\/{$template}\/{$theme}\/", "data\/source\/{$template}\/THEME_CODEFIX\/", $sqls);
        $sqls = str_replace("data\\\/source\\\/{$template}\\\/{$theme}\\\/", "data\\\/source\\\/{$template}\\\/THEME_CODEFIX\\\/", $sqls);
        $sqls = str_replace("{$template}_{$theme}_", "{$template}_THEME_CODEFIX_", $sqls);

        $sqls .= "INSERT INTO `eps_config` (owner,module,section,`key`,value,lang) select owner,module,section,`key`,value, 'zh-cn' as lang from `eps_config` where section in ('css', 'js') and lang = 'lang';\n";
        $sqls .= "INSERT INTO `eps_config` (owner,module,section,`key`,value,lang) select owner,module,section,`key`,value, 'zh-tw' as lang from `eps_config` where section in ('css', 'js') and lang = 'lang';\n";
        $sqls .= "INSERT INTO `eps_config` (owner,module,section,`key`,value,lang) select owner,module,section,`key`,value, 'en' as lang from `eps_config` where section in ('css', 'js') and lang = 'lang';\n";
 
        return file_put_contents($file, $sqls);
    }

    /**
     * Clear sources not exists.
     * 
     * @access public
     * @return void
     */
    public function clearSources()
    {
        $files = $this->dao->select('*')
            ->from(TABLE_FILE)
            ->where('objectType')->in('slide,source')
            ->fetchAll();
        $filesToRemove = array();
        foreach($files as $file)
        {
            $realPath = $this->app->getDataRoot() . $file->pathname;
            if(!file_exists($realPath)) $filesToRemove[] = $file->id;
        }
        $this->dao->delete()->from(TABLE_FILE)->where('id')->in($filesToRemove)->exec();
        return !dao::isError();
    }

    /**
     * Export files.
     *
     * @param  string    $template
     * @param  string    $theme
     * @param  string    $code
     * @access public
     * @return string
     */
    public function exportFiles($template, $theme, $code)
    {
        /* Export config file. */
        if(isset($this->config->ui->themes[$template][$theme]))
        {
            $configCode = "<?php\n";
            $configCode .= '$config->ui->themes["' . $template . '"]["' . $code . '"] = ';
            $configCode .= "\n";
            $configCode .= var_export($this->config->ui->themes[$template][$theme], true);
            $configCode .= ";";
            file_put_contents($this->directories->exportConfigPath . "$code.php", $configCode);
        }

        $zfile = $this->app->loadClass('zfile');

        /* Copy customed css file. */
        $customCssFile = $this->directories->exportCssPath . "{$template}_{$code}.css";
        $originCssFile = sprintf($this->config->site->ui->customCssFile, $template, $theme);
        copy($originCssFile, $customCssFile);

        /* Copy less file. */
        $lessFile = $this->app->getWwwRoot() . 'theme' . DS . $template . DS . $theme . DS . 'style.less';
        if(file_exists($lessFile)) copy($lessFile, $this->directories->exportLessPath . 'style.less');

        /* Copy source files. */
        $sourcePath = $this->app->getWwwRoot() . 'data' . DS . 'source' . DS . $template . DS . $theme;
        if(is_dir($sourcePath)) $zfile->copyDir($sourcePath, $this->directories->exportSourcePath);

        /* Copy slide files. */
        $groups = $this->getUsedSlideGroups($template, $theme);
        $slidePath = $this->app->getWwwRoot() . 'data' . DS . 'slides';
        $usedSlides = array();
        foreach($groups as $group) $usedSlides[] = glob($slidePath . DS . "{$group}_*.*");
        foreach($usedSlides as $slides)
        {
            foreach($slides as $slide) copy($slide, str_replace($slidePath . DS, $this->directories->exportSlidePath, $slide));
        }

        /* Upload preview picture. */
        if($_FILES)
        {
            $tmpName  = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            move_uploaded_file($tmpName, $this->directories->exportLessPath . 'preview.png');
        }
        else
        {
            $previewImage = $this->app->getWwwRoot() . 'theme' . DS . $template . DS . $theme . DS . 'preview.png';
            copy($previewImage, $this->directories->exportLessPath . 'preview.png');
        }

        /* Export encrypt files. */
        $this->exportEncrypt($template, $theme, $code);

        /* Zip theme files. */
        $this->app->loadClass('pclzip', true);
        $zipFile = dirname($this->directories->exportPath) . DS . $code . '.zip';
        if(file_exists($zipFile)) unlink($zipFile);
        $archive = new PclZip($zipFile);
        $list    = $archive->create($this->directories->exportPath, PCLZIP_OPT_REMOVE_PATH, dirname($this->directories->exportPath));

        if(empty($list)) $this->app->loadClass('zfile')->removeDir(dirname($this->directories->exportPath));
        return $zipFile;
    }

    /**
     * Export encrypt files.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $code 
     * @access public
     * @return bool
     */
    public function exportEncrypt($template, $theme, $code)
    {
        $this->createHookFile($template, $theme, $code);

        $encryptFiles = array();
        /* Save encrypt sources. */
        $sourceList = glob($this->directories->exportSourcePath . '*');
        foreach($sourceList as $file)
        {
            $fileInfo = pathinfo($file);
            if($fileInfo['extension'] == 'php') continue;
            $target   = $this->directories->encryptSourcePath . $fileInfo['filename'] . '.php'; 

            $encryptFiles[$fileInfo['basename']] = $fileInfo['filename'] . '.php';
            $this->save2php($file, $target);
        }

        /* Save slides to php sources. */
        $slideList =  glob($this->directories->exportSlidePath . '*');
        foreach($slideList as $file)
        {
            $fileInfo = pathinfo($file);
            if($fileInfo['extension'] == 'php') continue;
            $encryptFiles[$fileInfo['basename']] = $fileInfo['filename'] . '.php';
            $target   = $this->directories->encryptSlidePath . $fileInfo['filename'] . '.php'; 
            $this->save2php($file, $target);
        }

        /* Create encrypt sql file. */
        $sql = file_get_contents($this->directories->encryptDbPath . 'install.sql');
        foreach($encryptFiles as $file => $encrypt)
        {
            $sql = str_replace('/' . $file, '/' . $encrypt, $sql);
        }
        file_put_contents($this->directories->encryptDbPath . 'install.sql', $sql);

        /* Copy doc, config, less files. */
        $zfile = $this->app->loadClass('zfile');
        $zfile->copyDir($this->directories->exportDocPath,    $this->directories->encryptDocPath);
        $zfile->copyDir($this->directories->exportLessPath,   $this->directories->encryptLessPath);
        $zfile->copyDir($this->directories->exportConfigPath, $this->directories->encryptConfigPath);
        
        return true;
    }

    /**
     * Save sources to php file.
     * 
     * @param  string    $file 
     * @param  string    $target 
     * @access public
     * @return bool
     */
    public function save2php($file, $target)
    {
        $contentType = getFileMimeType($file);
        if(!$contentType) return false;
        $content     = var_export(file_get_contents($file), true);
        $phpCodes    = <<<EOT
<?php\n
header('Content-type: $contentType');\n
echo $content;\n
exit;
EOT;
       return file_put_contents($target, $phpCodes);
    }

    /**
     * Create hook file.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  string    $code 
     * @access public
     * @return bool
     */
    public function createHookFile($template, $theme, $code)
    {
        $hookFile = $this->directories->encryptLessPath . helper::createRandomStr(6, $skip = '0-9A-Z') . ".php";

        $params = $this->getCustomParams($template, $theme);
        $params = var_export($params, true);
        $params = str_replace("{$template}/{$theme}/", "{$template}/_THEME_CODEFIX_/", $params);
        $params = str_replace("{$template}_{$theme}_", "{$template}__THEME_CODEFIX__", $params);
       
        foreach($this->config->css as $item => $value) $value = str_replace("{$template}/{$theme}/", "{$template}/_THEME_CODEFIX_/", $value);
        foreach($this->config->js  as $item => $value) $value = str_replace("{$template}/{$theme}/", "{$template}/_THEME_CODEFIX_/", $value);

        $cssCodes = serialize($this->config->css);
        $jsCodes  = serialize($this->config->js);
        $cssCode  = var_export($cssCodes, true);
        $jsCodes  = var_export($jsCodes, true);
        $code = "<?php
if(!function_exists('get_THEME_CODEFIX_CSS'))
{
    function get_THEME_CODEFIX_CSS()
    {
        \$css = unserialize($cssCode);
        return \$css;
    }
}
if(!function_exists('get_THEME_CODEFIX_JS'))
{
    function get_THEME_CODEFIX_JS()
    {
        \$js = unserialize($jsCodes);
        return \$js;
    }
}
if(!function_exists('get_THEME_CODEFIX_params'))
{
    function get_THEME_CODEFIX_params()
    {
        return $params;
    }
}
";
        return file_put_contents($hookFile, $code);
    }

    /**
     * Delete a theme.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return void
     */
    public function deleteTheme($template, $theme)
    {
        $this->dao->setAutoLang(false)->delete()->from(TABLE_PACKAGE)->where('templateCompatible')->eq($template)->andWhere('code')->eq($theme)->exec();
        if(dao::isError()) return false;

        $this->dao->setAutoLang(false)->delete()->from(TABLE_LAYOUT)->where('template')->eq($template)->andWhere('theme')->eq($theme)->exec();
        if(dao::isError()) return false;

        $themeDirs = array();
        $themeDirs[] = $this->app->getWwwRoot() . DS . 'data' . DS . 'source' . DS . $template . DS . $theme;
        $themeDirs[] = $this->app->getWwwRoot() . DS . 'data' . DS . 'css' . DS . $template . DS . $theme;
        $themeDirs[] = $this->app->getWwwRoot() . DS . 'template' . DS . $template . DS . 'theme' . DS . $theme;

        $zfile = $this->app->loadClass('zfile');
        foreach($themeDirs as $dir) $zfile->removeDir($dir);
        return true;
    }

    /**
     * Remove template data.
     *
     * @param  string    $template
     * @access public
     * @return bool
     */
    public function removeTemplateData($template)
    {
        $this->dao->delete()->setAutoLang(false)->from(TABLE_PACKAGE)->where('type')->eq('template')->andwhere('code')->eq($template)->exec();
        if(dao::isError()) return false;
        $this->dao->delete()->setAutoLang(false)->from(TABLE_BLOCK)->where('template')->eq($template)->exec();
        if(dao::isError()) return false;
        $this->dao->delete()->setAutoLang(false)->from(TABLE_LAYOUT)->where('template')->eq($template)->exec();
        if(dao::isError()) return false;
        return true;
    }

    /**
     * Remove template files.
     *
     * @param  string    $template
     * @access public
     * @return bool|array
     */
    public function removeTemplateFiles($template)
    {
        $templatePath = $this->app->getWwwRoot() . 'template' . DS . $template;
        $customPath   = $this->app->getWwwRoot() . 'data' . DS . 'css' . DS . $template;
        $sourcePath   = $this->app->getWwwRoot() . 'data' . DS . 'source' . DS . $template;

        $zfile = $this->app->loadClass('zfile');
        $faildPaths = array();
        if(is_dir($templatePath) and !$zfile->removeDir($templatePath)) $faildPaths[] = $templatePath;
        if(is_dir($customPath) and !$zfile->removeDir($customPath)) $faildPaths[] = $customPath;
        if(is_dir($sourcePath) and !$zfile->removeDir($sourcePath)) $faildPaths[] = $sourcePath;
        return empty($faildPaths) ? true : $faildPaths;
    }
    
    /**
     * Clear tmp data imported.
     * 
     * @access public
     * @return bool
     */
    public function clearTmpData()
    {
        $tables = array(TABLE_BLOCK, TABLE_LAYOUT, TABLE_FILE, TABLE_CONFIG);
        foreach($tables as $table) $this->dao->setAutoLang(false)->delete()->from($table)->where('lang')->eq('lang')->exec();
        return !dao::isError();
    }
}
