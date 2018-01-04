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

use XoopsModules\Mastoppublish;

require_once __DIR__ . '/../class/Helper.php';
//require_once __DIR__ . '/../include/common.php';
$helper = Mastoppublish\Helper::getInstance();

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

$adminmenu[] = [
    'title' => _MI_MPU_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png',
];

// User
$adminmenu[] = [
    'title' => MPU_MOD_MENU_ADD,
    'link'  => 'admin/main.php?op=novo',
    'icon'  => $pathIcon32 . '/add.png',
];

// List Content
$adminmenu[] = [
    'title' => MPU_MOD_MENU_LST,
    'link'  => 'admin/main.php?op=listar',
    'icon'  => $pathIcon32 . '/manage.png',
];
// HTML Files

$adminmenu[] = [
    'title' => MPU_MOD_MENU_LNK,
    'link'  => 'admin/paginas.php',
    'icon'  => $pathIcon32 . '/content.png',
];

// Media
$adminmenu[] = [
    'title' => MPU_MOD_MENU_MED,
    'link'  => 'admin/media.php',
    'icon'  => $pathIcon32 . '/marquee.png',
];

$adminmenu[] = [
    'title' => MPU_MOD_MENU_FIL,
    'link'  => 'admin/files.php',
    'icon'  => $pathIcon32 . '/folder_txt.png',
];

//$adminmenu[] = [
//'title' =>  _MI_SYSTEM_ADMENU2,
//'link' =>   'admin/blocksadmin.php',
//$adminmenu[$i]["icon"] = $pathIcon32.'/export.png';
//];

$adminmenu[] = [
    'title' => _MI_MPU_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png',
];
