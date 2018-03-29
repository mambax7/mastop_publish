<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Novo Comentário
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================

use XoopsModules\Mastoppublish;
/** @var Mastoppublish\Helper $helper */
$helper = Mastoppublish\Helper::getInstance();

include __DIR__ . '/../../mainfile.php';
require_once __DIR__ . '/header.php';
if (!defined('XOOPS_ROOT_PATH') || !is_object($xoopsModule)) {
    exit();
}
require_once XOOPS_ROOT_PATH . '/include/comment_constants.php';
if ('system' !== $xoopsModule->getVar('dirname') && XOOPS_COMMENT_APPROVENONE == $helper->getConfig('com_rule')) {
    exit();
}
require_once XOOPS_ROOT_PATH . '/language/' . $xoopsConfig['language'] . '/comment.php';
include XOOPS_ROOT_PATH . '/header.php';
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_mpb_mpublish.class.php';
$com_itemid     = isset($_GET['com_itemid']) ? (int)$_GET['com_itemid'] : 0;
$mpu_classe     = new mpu_mpb_mpublish($com_itemid);
$com_replytitle = $mpu_classe->getVar('mpb_30_titulo');
if (isset($com_replytitle)) {
    if (isset($com_replytext)) {
        themecenterposts($com_replytitle, $com_replytext);
    }
    $myts      = \MyTextSanitizer::getInstance();
    $com_title = $myts->htmlSpecialChars($com_replytitle);
    if (!preg_match('/^(Re|' . _CM_RE . '):/i', $com_title)) {
        $com_title = _CM_RE . ': ' . xoops_substr($com_title, 0, 56);
    }
} else {
    $com_title = '';
}
$com_mode = isset($_GET['com_mode']) ? htmlspecialchars(trim($_GET['com_mode']), ENT_QUOTES) : '';
if ('' == $com_mode) {
    if (is_object($xoopsUser)) {
        $com_mode = $xoopsUser->getVar('umode');
    } else {
        $com_mode = $xoopsConfig['com_mode'];
    }
}

if (!isset($_GET['com_order'])) {
    if (is_object($xoopsUser)) {
        $com_order = $xoopsUser->getVar('uorder');
    } else {
        $com_order = $xoopsConfig['com_order'];
    }
} else {
    $com_order = (int)$_GET['com_order'];
}
$com_id     = 0;
$noname     = 0;
$dosmiley   = 1;
$dohtml     = 0;
$dobr       = 1;
$doxcode    = 1;
$com_icon   = '';
$com_pid    = 0;
$com_rootid = 0;
$com_text   = '';
if ($helper->getConfig('mpu_conf_captcha')) {
    require_once __DIR__ . '/include/captcha/php-captcha.inc.php';
    if (isset($_SESSION[CAPTCHA_SESSION_ID])) {
        unset($_SESSION[CAPTCHA_SESSION_ID]);
    }
}
include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
include XOOPS_ROOT_PATH . '/footer.php';
