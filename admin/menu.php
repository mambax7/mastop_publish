<?php
### =============================================================
### Mastop InfoDigital - Paix�o por Internet
### =============================================================
### Menu da Administra��o
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital � 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');
//$path = dirname(dirname(dirname(__DIR__)));
//global $xoopsModule, $xoopsUser;
//
//$dirname = basename(dirname(__DIR__));
//$moduleHandler = xoops_getHandler('module');
//$module = $moduleHandler->getByDirname($dirname);
//$pathIcon32 = $module->getInfo('icons32');
//$pathLanguage    = $path . $module->getInfo('dirmoduleadmin');
//
//if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
//    $fileinc = $pathLanguage . '/language/english/main.php';
//}

$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(__DIR__));
/** @var XoopsModuleHandler $moduleHandler */
$moduleHandler = xoops_getHandler('module');
$module          = $moduleHandler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;

if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}
include_once $fileinc;

// Index
$adminmenu              = array();
$i                      = 0;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';

// User
++$i;
$adminmenu[$i]['title'] = MPU_MOD_MENU_ADD;
$adminmenu[$i]['link']  = 'admin/main.php?op=novo';
$adminmenu[$i]['icon']  = $pathIcon32 . '/add.png';

// List Content
++$i;
$adminmenu[$i]['title'] = MPU_MOD_MENU_LST;
$adminmenu[$i]['link']  = 'admin/main.php?op=listar';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';

// HTML Files
++$i;
$adminmenu[$i]['title'] = MPU_MOD_MENU_LNK;
$adminmenu[$i]['link']  = 'admin/paginas.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/content.png';

// Media
++$i;
$adminmenu[$i]['title'] = MPU_MOD_MENU_MED;
$adminmenu[$i]['link']  = 'admin/media.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/marquee.png';

++$i;
$adminmenu[$i]['title'] = MPU_MOD_MENU_FIL;
$adminmenu[$i]['link']  = 'admin/files.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/folder_txt.png';

//++$i;
//$adminmenu[$i]['title'] = _MI_SYSTEM_ADMENU2;
//$adminmenu[$i]['link'] =  'admin/blocksadmin.php';
//$adminmenu[$i]["icon"] = $pathIcon32.'/export.png';

++$i;
$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
