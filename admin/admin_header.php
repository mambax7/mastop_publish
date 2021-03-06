<?php

use XoopsModules\Mastoppublish;

$path = dirname(dirname(dirname(__DIR__)));
//require_once $path . '/mainfile.php';
//require_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';
$moduleDirName = basename(dirname(__DIR__));
//if (file_exists('../language/' . $xoopsConfig['language'] . '/modinfo.php')) {
//    require_once __DIR__ . '/../language/' . $xoopsConfig['language'] . '/modinfo.php';
//} else {
//    require_once __DIR__ . '/../language/portuguesebr/modinfo.php';
//}

// require_once __DIR__ . '/../class/Utility.php';
//require_once __DIR__ . '/../include/common.php';

$helper = Mastoppublish\Helper::getInstance();
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('main');

require_once XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/include/funcoes.inc.php';

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new \XoopsTpl();
}
