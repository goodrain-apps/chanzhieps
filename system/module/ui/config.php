<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->ui->systemThemes = array('default.default', 'default.tartan', 'default.wide', 'default.clean', 'default.blank', 'mobile.default', 'mobile.colorful', 'mobile.blank');

$config->ui->themeSnapRoot = 'http://www.chanzhi.org/data/upload/';

$config->ui->groups = array('basic', 'navbar', 'block', 'button', 'footer');
$config->ui->require = new stdclass();
$config->ui->require->exportTheme = "name,code,author,email";

$config->ui->selectorOptions = array();

$config->ui->selectorOptions['basic']['colorset'] = array();
$config->ui->selectorOptions['basic']['colorset']['primary'] = array('type' => 'color', 'default' => '#3280FC', 'name' => 'color-primary');

$config->ui->selectorOptions['basic']['border'] = array();
$config->ui->selectorOptions['basic']['border']['radius'] = array('type' => 'size', 'default' => '3px', 'name' => 'border-radius');

$config->ui->selectorOptions['basic']['pageBackground'] = array();
$config->ui->selectorOptions['basic']['pageBackground']['backcolor']       = array('type' => 'color', 'default' => '#FFF', 'name' => 'background-color');
$config->ui->selectorOptions['basic']['pageBackground']['backgroundImage'] = array('type' => 'image', 'default' => 'none', 'name' => 'background-image');
$config->ui->selectorOptions['basic']['pageBackground']['repeat']          = array('type' => 'repeat', 'default' => 'repeat', 'name' => 'background-image-repeat');
$config->ui->selectorOptions['basic']['pageBackground']['position']        = array('type' => 'position', 'default' => '0 0', 'name' => 'background-image-position');

$config->ui->selectorOptions['basic']['pageText'] = array();
$config->ui->selectorOptions['basic']['pageText']['color']      = array('type' => 'color', 'default' => '#333', 'name' => 'text-color');
$config->ui->selectorOptions['basic']['pageText']['fontSize']   = array('type' => 'fontSize', 'default' => '13px', 'name' => 'font-size');
$config->ui->selectorOptions['basic']['pageText']['fontFamily'] = array('type' => 'fontFamily', 'default' => '"Helvetica Neue", Helvetica, Tahoma, Arial, sans-serif', 'name' => 'font-family');
$config->ui->selectorOptions['basic']['pageText']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'normal', 'name' => 'font-weight');

$config->ui->selectorOptions['basic']['aLink'] = array();
$config->ui->selectorOptions['basic']['aLink']['color']     = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'link-color');
$config->ui->selectorOptions['basic']['aLink']['underline'] = array('type' => 'underline', 'default' => 'none', 'name' => 'link-decoration');

$config->ui->selectorOptions['basic']['aVisited'] = array();
$config->ui->selectorOptions['basic']['aVisited']['color'] = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'link-visited-color');

$config->ui->selectorOptions['basic']['aHover'] = array();
$config->ui->selectorOptions['basic']['aHover']['color']     = array('type' => 'color', 'default' => '#347AEB', 'name' => 'link-hover-color');
$config->ui->selectorOptions['basic']['aHover']['underline'] = array('type' => 'underline', 'default' => 'none', 'name' => 'link-hover-decoration');

$config->ui->selectorOptions['basic']['column'] = array();
$config->ui->selectorOptions['basic']['column']['sidebarLayout'] = array('type' => 'sidebarLayout', 'default' => 'false', 'name' => 'sidebar-pull-left');
$config->ui->selectorOptions['basic']['column']['sidebarWidth']  = array('type' => 'sidebarWidth', 'default' => '25%', 'name' => 'sidebar-width');

$config->ui->selectorOptions['navbar']['layout'] = array();
$config->ui->selectorOptions['navbar']['layout']['layout'] = array('type' => 'navLayout', 'default' => 'true', 'name' => 'navbar-table-layout');

$config->ui->selectorOptions['navbar']['navbar'] = array();
$config->ui->selectorOptions['navbar']['navbar']['backcolor']       = array('type' => 'color', 'default' => '#f1f1f1', 'name' => 'navbar-backcolor');
$config->ui->selectorOptions['navbar']['navbar']['backgroundImage'] = array('type' => 'image', 'default' => 'none', 'name' => 'navbar-background-image');
$config->ui->selectorOptions['navbar']['navbar']['repeat']          = array('type' => 'repeat', 'default' => 'repeat', 'name' => 'navbar-background-image-repeat');
$config->ui->selectorOptions['navbar']['navbar']['position']        = array('type' => 'position', 'default' => '0 0', 'name' => 'navbar-background-image-position');
$config->ui->selectorOptions['navbar']['navbar']['border']          = array('type' => 'border', 'default' => 'solid', 'name' => 'navbar-border-style');
$config->ui->selectorOptions['navbar']['navbar']['borderColor']     = array('type' => 'color', 'default' => '#D5D5D5', 'name' => 'navbar-border-color');
$config->ui->selectorOptions['navbar']['navbar']['borderWidth']     = array('type' => 'size', 'default' => '1px', 'name' => 'navbar-border-width');
$config->ui->selectorOptions['navbar']['navbar']['radius']          = array('type' => 'size',  'default' => '4px', 'name' => 'navbar-border-radius');

$config->ui->selectorOptions['navbar']['panel'] = array();
$config->ui->selectorOptions['navbar']['panel']['backcolor']   = array('type' => 'color', 'default' => '#FFF', 'name' => 'navbar-panel-backcolor');
$config->ui->selectorOptions['navbar']['panel']['border']      = array('type' => 'border', 'default' => 'solid', 'name' => 'navbar-panel-border-style');
$config->ui->selectorOptions['navbar']['panel']['borderColor'] = array('type' => 'color', 'default' => '#DDD', 'name' => 'navbar-panel-border-color');
$config->ui->selectorOptions['navbar']['panel']['borderWidth'] = array('type' => 'size', 'default' => '1px', 'name' => 'navbar-panel-border-width');
$config->ui->selectorOptions['navbar']['panel']['radius']      = array('type' => 'size',  'default' => '3px', 'name' => 'navbar-paenl-border-radius');

$config->ui->selectorOptions['navbar']['menuNormal'] = array();
$config->ui->selectorOptions['navbar']['menuNormal']['color']      = array('type' => 'color',  'default' => '#555', 'name' => 'navbar-menu-color');
$config->ui->selectorOptions['navbar']['menuNormal']['fontSize']   = array('type' => 'fontSize',  'default' => '14px', 'name' => 'navbar-menu-font-size');
$config->ui->selectorOptions['navbar']['menuNormal']['fontFamily'] = array('type' => 'fontFamily',  'default' => 'inherit', 'name' => 'navbar-menu-font-family');
$config->ui->selectorOptions['navbar']['menuNormal']['fontWeight'] = array('type' => 'fontWeight',  'default' => 'bold', 'name' => 'navbar-menu-font-weight');

$config->ui->selectorOptions['navbar']['menuHover'] = array();
$config->ui->selectorOptions['navbar']['menuHover']['color']     = array('type' => 'color',  'default' => '#000', 'name' => 'navbar-menu-color-hover');
$config->ui->selectorOptions['navbar']['menuHover']['backcolor'] = array('type' => 'color',  'default' => '#FEFEFE', 'name' => 'navbar-menu-backcolor-hover');

$config->ui->selectorOptions['navbar']['menuActive'] = array();
$config->ui->selectorOptions['navbar']['menuActive']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-menu-color-active');
$config->ui->selectorOptions['navbar']['menuActive']['backcolor'] = array('type' => 'color',  'default' => '#FFF', 'name' => 'navbar-menu-backcolor-active');

$config->ui->selectorOptions['navbar']['submenuNormal'] = array();
$config->ui->selectorOptions['navbar']['submenuNormal']['color'] = array('type' => 'color',  'default' => '#333', 'name' => 'navbar-submenu-color');

$config->ui->selectorOptions['navbar']['submenuHover'] = array();
$config->ui->selectorOptions['navbar']['submenuHover']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-submenu-color-hover');
$config->ui->selectorOptions['navbar']['submenuHover']['backcolor'] = array('type' => 'color',  'default' => '#E5E5E5', 'name' => 'navbar-submenu-backcolor-hover');

$config->ui->selectorOptions['navbar']['submenuActive'] = array();
$config->ui->selectorOptions['navbar']['submenuActive']['color']     = array('type' => 'color',  'default' => '#151515', 'name' => 'navbar-submenu-color-active');
$config->ui->selectorOptions['navbar']['submenuActive']['backcolor'] = array('type' => 'color',  'default' => '#E5E5E5', 'name' => 'navbar-submenu-backcolor-active');

$config->ui->selectorOptions['block']['border'] = array();
$config->ui->selectorOptions['block']['border']['border']  = array('type' => 'border', 'default' => 'solid', 'name' => 'block-border-style');
$config->ui->selectorOptions['block']['border']['color']  = array('type' => 'color', 'default' => '#DDD', 'name' => 'block-border-color');
$config->ui->selectorOptions['block']['border']['width']  = array('type' => 'size', 'default' => '1px', 'name' => 'block-border-width');
$config->ui->selectorOptions['block']['border']['radius'] = array('type' => 'size',  'default' => '3px', 'name' => 'block-border-radius');

$config->ui->selectorOptions['block']['heading'] = array();
$config->ui->selectorOptions['block']['heading']['backcolor']  = array('type' => 'color', 'default' => '#F5F5F5', 'name' => 'block-heading-backcolor');
$config->ui->selectorOptions['block']['heading']['color']      = array('type' => 'color', 'default' => '#333', 'name' => 'block-heading-color');
$config->ui->selectorOptions['block']['heading']['fontSize']   = array('type' => 'fontSize', 'default' => 'inherit', 'name' => 'block-heading-font-size');
$config->ui->selectorOptions['block']['heading']['fontWeight'] = array('type' => 'fontWeight', 'default' => 'inherit', 'name' => 'block-heading-font-weight');

$config->ui->selectorOptions['block']['body'] = array();
$config->ui->selectorOptions['block']['body']['backcolor'] = array('type' => 'color', 'default' => '#FFF', 'name' => 'block-body-backcolor');
$config->ui->selectorOptions['block']['body']['color']     = array('type' => 'color', 'default' => '#333', 'name' => 'block-body-color');
$config->ui->selectorOptions['block']['body']['linkColor'] = array('type' => 'color', 'default' => '#0D3D88', 'name' => 'block-body-link-color');

$config->ui->selectorOptions['button']['colorset'] = array();
$config->ui->selectorOptions['button']['colorset']['default'] = array('type' => 'color', 'default' => '#F2F2F2', 'name' => 'button-color-default');
$config->ui->selectorOptions['button']['colorset']['primary'] = array('type' => 'color', 'default' => '#3280FC', 'name' => 'button-color-primary');
$config->ui->selectorOptions['button']['colorset']['info']    = array('type' => 'color', 'default' => '#39B3D7', 'name' => 'button-color-info');
$config->ui->selectorOptions['button']['colorset']['success'] = array('type' => 'color', 'default' => '#229F24', 'name' => 'button-color-success');
$config->ui->selectorOptions['button']['colorset']['warning'] = array('type' => 'color', 'default' => '#E48600', 'name' => 'button-color-warning');
$config->ui->selectorOptions['button']['colorset']['danger']  = array('type' => 'color', 'default' => '#D2322D', 'name' => 'button-color-danger');

$config->ui->selectorOptions['button']['border'] = array();
$config->ui->selectorOptions['button']['border']['border'] = array('type' => 'border', 'default' => 'solid', 'name' => 'button-border-style');
$config->ui->selectorOptions['button']['border']['width']  = array('type' => 'size', 'default' => '1px', 'name' => 'button-border-width');
$config->ui->selectorOptions['button']['border']['radius'] = array('type' => 'size',  'default' => '3px', 'name' => 'button-border-radius');

$config->ui->selectorOptions['button']['text'] = array();
$config->ui->selectorOptions['button']['text']['fontWeight']  = array('type' => 'fontWeight', 'default' => 'normal', 'name' => 'button-font-weight');

$config->ui->selectorOptions['footer']['border'] = array();
$config->ui->selectorOptions['footer']['border']['border'] = array('type' => 'border', 'default' => 'solid', 'name' => 'footer-border-style');
$config->ui->selectorOptions['footer']['border']['color']  = array('type' => 'color', 'default' => '#ddd', 'name' => 'footer-border-color');

$config->ui->selectorOptions['footer']['background'] = array();
$config->ui->selectorOptions['footer']['background']['backcolor'] = array('type' => 'color', 'default' => '#f7f7f7', 'name' => 'footer-backcolor');

/* Default theme setting */
$config->ui->themes['default']['default'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['default']['basic']['border']);
unset($config->ui->themes['default']['default']['basic']['colorset']);

/* Blue theme setting */
$config->ui->themes['default']['blue'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['blue']['basic']['border']);
unset($config->ui->themes['default']['blue']['basic']['colorset']);
unset($config->ui->themes['default']['blue']['navbar']);
$config->ui->themes['default']['blue']['block']['heading']['backcolor']['default'] = '#145BCC';
$config->ui->themes['default']['blue']['block']['heading']['color']['default'] = '#FFF';

/* Brightdark theme setting */
$config->ui->themes['default']['brightdark'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['brightdark']['basic']['aVisited']);
unset($config->ui->themes['default']['brightdark']['basic']['border']);
unset($config->ui->themes['default']['brightdark']['basic']['colorset']);
unset($config->ui->themes['default']['brightdark']['navbar']);
unset($config->ui->themes['default']['brightdark']['button']);
unset($config->ui->themes['default']['brightdark']['block']);
$config->ui->themes['default']['brightdark']['basic']['pageBackground']['backcolor']['default'] = '#2E353F';
$config->ui->themes['default']['brightdark']['basic']['pageText']['color']['default'] = '#2E353F';
$config->ui->themes['default']['brightdark']['basic']['aLink']['color']['default'] = '#3D4DBE';
$config->ui->themes['default']['brightdark']['basic']['aHover']['color']['default'] = '#3D4DBE';
$config->ui->themes['default']['brightdark']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['default']['brightdark']['footer']['background']['backcolor']['default'] = '#ECF0F5';

/* Flat theme setting */
$config->ui->themes['default']['flat'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['flat']['basic']['aVisited']);
unset($config->ui->themes['default']['flat']['basic']['border']);
unset($config->ui->themes['default']['flat']['basic']['colorset']);
unset($config->ui->themes['default']['flat']['navbar']);
unset($config->ui->themes['default']['flat']['button']);
unset($config->ui->themes['default']['flat']['block']);
$config->ui->themes['default']['flat']['basic']['pageText']['color']['default'] = '#34495E';
$config->ui->themes['default']['flat']['basic']['aLink']['color']['default'] = '#16A085';
$config->ui->themes['default']['flat']['basic']['aHover']['color']['default'] = '#1ABC9C';
$config->ui->themes['default']['flat']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['default']['flat']['footer']['background']['backcolor']['default'] = '#EDEFF1';

/* Tartan theme setting */
$config->ui->themes['default']['tartan'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['tartan']['basic']['aVisited']);
unset($config->ui->themes['default']['tartan']['basic']['border']);
unset($config->ui->themes['default']['tartan']['basic']['colorset']);
unset($config->ui->themes['default']['tartan']['navbar']);
unset($config->ui->themes['default']['tartan']['button']);
unset($config->ui->themes['default']['tartan']['block']);
$config->ui->themes['default']['tartan']['basic']['pageBackground']['backgroundImage']['default'] = 'inherit';
$config->ui->themes['default']['tartan']['basic']['pageBackground']['backcolor']['default'] = '#5F7A64';
$config->ui->themes['default']['tartan']['basic']['pageText']['color']['default'] = '#6F6658';
$config->ui->themes['default']['tartan']['basic']['aLink']['color']['default'] = '#254952';
$config->ui->themes['default']['tartan']['basic']['aHover']['color']['default'] = '#35636E';
$config->ui->themes['default']['tartan']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['default']['tartan']['footer']['background']['backcolor']['default'] = '#F5F0CC';

/* Clean theme setting */
$config->ui->themes['default']['clean'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['clean']['basic']['pageBackground']['backcolor']);
unset($config->ui->themes['default']['clean']['basic']['pageText']);
unset($config->ui->themes['default']['clean']['basic']['border']);
unset($config->ui->themes['default']['clean']['basic']['aLink']);
unset($config->ui->themes['default']['clean']['basic']['aVisited']);
unset($config->ui->themes['default']['clean']['basic']['aHover']);
unset($config->ui->themes['default']['clean']['navbar']);
unset($config->ui->themes['default']['clean']['button']);
unset($config->ui->themes['default']['clean']['block']);
unset($config->ui->themes['default']['clean']['footer']);
$config->ui->themes['default']['clean']['basic']['colorset']['primary']['default'] = '#254952';
$config->ui->themes['default']['clean']['basic']['pageBackground']['backgroundImage']['default'] = 'inherit';

/* Simple theme */
$config->ui->themes['default']['simple'] = $config->ui->themes['default']['clean'];
$config->ui->themes['default']['simple']['basic']['colorset']['primary']['default'] = '#3280FC';

/* Tree theme setting */
$config->ui->themes['default']['tree'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['tree']['basic']['aVisited']);
unset($config->ui->themes['default']['tree']['basic']['border']);
unset($config->ui->themes['default']['tree']['basic']['colorset']);
unset($config->ui->themes['default']['tree']['navbar']);
unset($config->ui->themes['default']['tree']['button']);
unset($config->ui->themes['default']['tree']['block']);
$config->ui->themes['default']['tree']['basic']['pageText']['color']['default'] = '#5F7A64';
$config->ui->themes['default']['tree']['basic']['aLink']['color']['default'] = '#6E2E16';
$config->ui->themes['default']['tree']['basic']['aHover']['color']['default'] = '#6E2E16';
$config->ui->themes['default']['tree']['footer']['border']['border']['default'] = 'none';
$config->ui->themes['default']['tree']['footer']['background']['backcolor']['default'] = '#F5F0CC';

/* Wide theme setting */
$config->ui->themes['default']['wide'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['wide']['basic']['pageBackground']);
unset($config->ui->themes['default']['wide']['basic']['border']);
unset($config->ui->themes['default']['wide']['basic']['aLink']);
unset($config->ui->themes['default']['wide']['basic']['aVisited']);
unset($config->ui->themes['default']['wide']['basic']['aHover']);
unset($config->ui->themes['default']['wide']['navbar']);
unset($config->ui->themes['default']['wide']['button']);
unset($config->ui->themes['default']['wide']['block']);
unset($config->ui->themes['default']['wide']['footer']);
$config->ui->themes['default']['wide']['basic']['colorset']['primary']['default'] = '#E91B23';

/* Colorful theme setting */
$config->ui->themes['default']['colorful'] = $config->ui->selectorOptions;
unset($config->ui->themes['default']['colorful']['basic']['pageBackground']['repeat']);
unset($config->ui->themes['default']['colorful']['basic']['pageBackground']['position']);
unset($config->ui->themes['default']['colorful']['basic']['aLink']);
unset($config->ui->themes['default']['colorful']['basic']['aVisited']);
unset($config->ui->themes['default']['colorful']['basic']['aHover']);
unset($config->ui->themes['default']['colorful']['navbar']);
unset($config->ui->themes['default']['colorful']['button']);
unset($config->ui->themes['default']['colorful']['block']);
$config->ui->themes['default']['colorful']['basic']['colorset']['primary']['default'] = '#D1270A';

/* Default theme of mobile template */
$config->ui->themes['mobile']['default'] = $config->ui->selectorOptions;
unset($config->ui->themes['mobile']['default']['basic']['pageBackground']);
unset($config->ui->themes['mobile']['default']['basic']['border']);
unset($config->ui->themes['mobile']['default']['basic']['aLink']);
unset($config->ui->themes['mobile']['default']['basic']['aVisited']);
unset($config->ui->themes['mobile']['default']['basic']['aHover']);
unset($config->ui->themes['mobile']['default']['basic']['column']);
unset($config->ui->themes['mobile']['default']['basic']['pageText']);
unset($config->ui->themes['mobile']['default']['navbar']);
unset($config->ui->themes['mobile']['default']['button']);
unset($config->ui->themes['mobile']['default']['block']);
unset($config->ui->themes['mobile']['default']['footer']);
$config->ui->themes['mobile']['default']['basic']['colorset']['primary']['default'] = '#3280FC';

/* Colorful theme of mobile template */
$config->ui->themes['mobile']['colorful'] = $config->ui->themes['mobile']['default'];
