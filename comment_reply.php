<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Formulário de Resposta de Comentários
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
include __DIR__ . '/../../mainfile.php';
if (!defined('XOOPS_ROOT_PATH') || !is_object($xoopsModule)) {
    exit();
}
require_once XOOPS_ROOT_PATH . '/language/' . $xoopsConfig['language'] . '/comment.php';
$com_id   = \Xmf\Request::getInt('com_id', 0, 'GET');
$com_mode = isset($_GET['com_mode']) ? htmlspecialchars(trim($_GET['com_mode']), ENT_QUOTES) : '';
if ('' == $com_mode) {
    if (is_object($xoopsUser)) {
        $com_mode = $xoopsUser->getVar('umode');
    } else {
        $com_mode = $xoopsConfig['com_mode'];
    }
}
if (!\Xmf\Request::hasVar('com_order')) {
    if (is_object($xoopsUser)) {
        $com_order = $xoopsUser->getVar('uorder');
    } else {
        $com_order = $xoopsConfig['com_order'];
    }
} else {
    $com_order = \Xmf\Request::getInt('com_order', 0, 'GET');
}
$commentHandler = xoops_getHandler('comment');
$comment        = $commentHandler->get($com_id);
$r_name         = XoopsUser::getUnameFromId($comment->getVar('com_uid'));
$r_text         = _CM_POSTER . ': <b>' . $r_name . '</b>&nbsp;&nbsp;' . _CM_POSTED . ': <b>' . formatTimestamp($comment->getVar('com_created')) . '</b><br><br>' . $comment->getVar('com_text');
$com_title      = $comment->getVar('com_title', 'E');
if (!preg_match('/^(Re|' . _CM_RE . '):/i', $com_title)) {
    $com_title = _CM_RE . ': ' . xoops_substr($com_title, 0, 56);
}
$com_pid    = $com_id;
$com_text   = '';
$com_id     = 0;
$dosmiley   = 1;
$dohtml     = 0;
$doxcode    = 1;
$dobr       = 1;
$doimage    = 1;
$com_icon   = '';
$com_rootid = $comment->getVar('com_rootid');
$com_itemid = $comment->getVar('com_itemid');
include XOOPS_ROOT_PATH . '/header.php';
themecenterposts($comment->getVar('com_title'), $r_text);
include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
include XOOPS_ROOT_PATH . '/footer.php';
