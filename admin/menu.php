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

$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}


$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
//$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');

// Index
$adminmenu              = [];
$i                      = 0;
'title' =>  _AM_MODULEADMIN_HOME,
'link' =>  'admin/index.php',
'icon' =>  $pathIcon32 . '/home.png',

// User
++$i;
'title' =>  MPU_MOD_MENU_ADD,
'link' => novo',
'icon' =>  $pathIcon32 . '/add.png',

// List Content
++$i;
'title' =>  MPU_MOD_MENU_LST,
'link' => listar',
'icon' =>  $pathIcon32 . '/manage.png',

// HTML Files
++$i;
'title' =>  MPU_MOD_MENU_LNK,
'link' =>  'admin/paginas.php',
'icon' =>  $pathIcon32 . '/content.png',

// Media
++$i;
'title' =>  MPU_MOD_MENU_MED,
'link' =>  'admin/media.php',
'icon' =>  $pathIcon32 . '/marquee.png',

++$i;
'title' =>  MPU_MOD_MENU_FIL,
'link' =>  'admin/files.php',
'icon' =>  $pathIcon32 . '/folder_txt.png',

//++$i;
//'title' =>  _MI_SYSTEM_ADMENU2,
//'link' =>   'admin/blocksadmin.php',
//$adminmenu[$i]["icon"] = $pathIcon32.'/export.png';

++$i;
'title' =>  _AM_MODULEADMIN_ABOUT,
'link' =>  'admin/about.php',
'icon' =>  $pathIcon32 . '/about.png',
