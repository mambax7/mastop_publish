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
include XOOPS_ROOT_PATH . '/header.php';
if (!defined('MPU_MOD_DIR')) {
    if (file_exists(__DIR__ . '/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
        require_once __DIR__ . '/language/' . $xoopsConfig['language'] . '/modinfo.php';
    } else {
        require_once __DIR__ . '/language/english/modinfo.php';
    }
}
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_mpb_mpublish.class.php';
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/funcoes.inc.php';
