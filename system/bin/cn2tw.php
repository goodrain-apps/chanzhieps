#!/usr/bin/env php
<?php
$langType = 'zh-tw';
if(empty($langType)) die('lang') . "\n";
foreach(glob('../module/*') as $moduleName)
{
    $moduleLangPath  = realpath($moduleName) . '/lang/';
    $defaultLangFile = $moduleLangPath . 'zh-cn.php';
    $targetLangFile  = $moduleLangPath . $langType . '.php';

    $extModuleLangPath = realpath($moduleName) . '/ext/*/lang/zh-cn/*.php';
    foreach(glob($extModuleLangPath) as $extLangFile)
    {
        convExtToTW($extLangFile);
    }

    $extModuleLangPath = realpath($moduleName) . '/ext/lang/zh-cn/*.php';
    foreach(glob($extModuleLangPath) as $extLangFile)
    {
        convExtToTW($extLangFile);
    }
    if(!file_exists($defaultLangFile)) continue;

    convToTW($defaultLangFile, $targetLangFile);
}

foreach(glob('../../www/template/default/lang/*') as $moduleName)
{
    $moduleLangPath  = realpath($moduleName) . '/';
    $defaultLangFile = $moduleLangPath . 'zh-cn.php';
    $targetLangFile  = $moduleLangPath . $langType . '.php';

    if(!file_exists($defaultLangFile)) continue;

    convToTW($defaultLangFile, $targetLangFile);
}

foreach(glob('../../www/template/mobile/lang/*') as $moduleName)
{
    $moduleLangPath  = realpath($moduleName) . '/';
    $defaultLangFile = $moduleLangPath . 'zh-cn.php';
    $targetLangFile  = $moduleLangPath . $langType . '.php';

    if(!file_exists($defaultLangFile)) continue;

    convToTW($defaultLangFile, $targetLangFile);
}

function convToTW($defaultLangFile, $targetLangFile)
{
    $langDesc = 'zh-tw';
    system("cconv -f utf-8 -t UTF8-TW $defaultLangFile > $targetLangFile");
    $defaultLang = file_get_contents($targetLangFile);
    $targetLang  = str_replace('zh-cn', $langDesc, $defaultLang);
    file_put_contents($targetLangFile, $targetLang);
}

function convExtToTW($extLangFile)
{
    $parentPath = dirname(dirname($extLangFile));
    $fileName   = basename($extLangFile);
    $extTargetLangPath = $parentPath . '/zh-tw';
    if(!is_dir($extTargetLangPath)) mkdir($extTargetLangPath);
    convToTW($extLangFile, $extTargetLangPath . '/' . $fileName);
}
?>
