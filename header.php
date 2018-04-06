<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Header do Módulo
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
use XoopsModules\Mastoppublish;

include XOOPS_ROOT_PATH . '/header.php';
if (!defined('MPU_MOD_DIR')) {

    /** @var Mastoppublish\Helper $helper */
    $helper = Mastoppublish\Helper::getInstance();
    $helper->loadLanguage('modinfo');
}
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/Publish.class.php';
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/funcoes.inc.php';
