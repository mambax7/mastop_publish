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

include __DIR__ . '/../../mainfile.php';
if (!defined('XOOPS_ROOT_PATH') || !is_object($xoopsModule)) {
    exit();
}
require_once XOOPS_ROOT_PATH . '/language/' . $xoopsConfig['language'] . '/comment.php';
require_once XOOPS_ROOT_PATH . '/include/comment_constants.php';

/** @var Mastoppublish\Helper $helper */
$helper = Mastoppublish\Helper::getInstance();

if ('system' === $xoopsModule->getVar('dirname')) {
    $com_id = \Xmf\Request::getInt('com_id', 0, 'POST');
    if (empty($com_id)) {
        exit();
    }
    $commentHandler = xoops_getHandler('comment');
    $comment        = $commentHandler->get($com_id);
    /** @var XoopsModuleHandler $moduleHandler */
    $moduleHandler  = xoops_getHandler('module');
    $module         = $moduleHandler->get($comment->getVar('com_modid'));
    $comment_config = $module->getInfo('comments');
    $com_modid      = $module->getVar('mid');
    $redirect_page  = XOOPS_URL . '/modules/system/admin.php?fct=comments&amp;com_modid=' . $com_modid . '&amp;com_itemid';
    $moddir         = $module->getVar('dirname');
    unset($comment);
} else {
    if ($helper->getConfig('mpu_conf_captcha')) {
        require_once __DIR__ . '/include/captcha/php-captcha.inc.php';
        $captcha = (!empty($_POST['captcha_field'])) ? $_POST['captcha_field'] : 0;
        if (PhpCaptcha::Validate($captcha)) {
            $captcha_code = true;
        } else {
            $captcha_code = false;
        }
    } else {
        $captcha_code = true;
    }

    $com_id = \Xmf\Request::getInt('com_id', 0, 'POST');
    if (XOOPS_COMMENT_APPROVENONE == $helper->getConfig('com_rule')) {
        exit();
    }
    $comment_config = $xoopsModule->getInfo('comments');
    $com_modid      = $xoopsModule->getVar('mid');
    $redirect_page  = $comment_config['pageName'] . '?';
    if (isset($comment_config['extraParams']) && is_array($comment_config['extraParams'])) {
        $extra_params = '';
        foreach ($comment_config['extraParams'] as $extra_param) {
            $extra_params .= isset($_POST[$extra_param]) ? $extra_param . '=' . htmlspecialchars($_POST[$extra_param], ENT_QUOTES | ENT_HTML5) . '&amp;' : $extra_param . '=&amp;';
        }
        $redirect_page .= $extra_params;
    }
    $redirect_page .= $comment_config['itemName'];
    $comment_url   = $redirect_page;
    $moddir        = $xoopsModule->getVar('dirname');
}
$op = '';
if (!empty($_POST)) {
    if (isset($_POST['com_dopost'])) {
        $op = 'post';
    } elseif (isset($_POST['com_dopreview'])) {
        $op = 'preview';
    }
    if (isset($_POST['com_dodelete'])) {
        $op = 'delete';
    }

    $com_mode   = isset($_POST['com_mode']) ? htmlspecialchars(trim($_POST['com_mode']), ENT_QUOTES) : 'flat';
    $com_order  = \Xmf\Request::getInt('com_order', XOOPS_COMMENT_OLD1ST, 'POST');
    $com_itemid = \Xmf\Request::getInt('com_itemid', 0, 'POST');
    $com_pid    = \Xmf\Request::getInt('com_pid', 0, 'POST');
    $com_rootid = \Xmf\Request::getInt('com_rootid', 0, 'POST');
    $com_status = \Xmf\Request::getInt('com_status', 0, 'POST');
    $dosmiley   = (isset($_POST['dosmiley']) && \Xmf\Request::getInt('dosmiley', 0, 'POST') > 0) ? 1 : 0;
    $doxcode    = (isset($_POST['doxcode']) && \Xmf\Request::getInt('doxcode', 0, 'POST') > 0) ? 1 : 0;
    $dobr       = (isset($_POST['dobr']) && \Xmf\Request::getInt('dobr', 0, 'POST') > 0) ? 1 : 0;
    $dohtml     = (isset($_POST['dohtml']) && \Xmf\Request::getInt('dohtml', 0, 'POST') > 0) ? 1 : 0;
    $doimage    = (isset($_POST['doimage']) && \Xmf\Request::getInt('doimage', 0, 'POST') > 0) ? 1 : 0;
    $com_icon   = isset($_POST['com_icon']) ? trim($_POST['com_icon']) : '';
} else {
    redirect_header(XOOPS_URL, 1, _NOPERM);
}

switch ($op) {

    case 'delete':
        include XOOPS_ROOT_PATH . '/include/comment_delete.php';
        break;
    case 'preview':
        $myts      = \MyTextSanitizer::getInstance();
        $doimage   = 1;
        $com_title = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['com_title']));
        if (0 != $dohtml) {
            if (is_object($xoopsUser)) {
                if (!$xoopsUser->isAdmin($com_modid)) {
                    $syspermHandler = xoops_getHandler('groupperm');
                    if (!$syspermHandler->checkRight('system_admin', XOOPS_SYSTEM_COMMENT, $xoopsUser->getGroups())) {
                        $dohtml = 0;
                    }
                }
            } else {
                $dohtml = 0;
            }
        }
        $p_comment = $myts->previewTarea($_POST['com_text'], $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
        $noname    = isset($noname) ? $noname : 0;
        $com_text  = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['com_text']));
        if ('system' !== $xoopsModule->getVar('dirname')) {
            include XOOPS_ROOT_PATH . '/header.php';
            themecenterposts($com_title, $p_comment);
            include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
            include XOOPS_ROOT_PATH . '/footer.php';
        } else {
            xoops_cp_header();
            themecenterposts($com_title, $p_comment);
            include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
            xoops_cp_footer();
        }
        break;
    case 'post':
    default:
        if (!$captcha_code) {
            $myts      = \MyTextSanitizer::getInstance();
            $doimage   = 1;
            $com_title = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['com_title']));
            if (0 != $dohtml) {
                if (is_object($xoopsUser)) {
                    if (!$xoopsUser->isAdmin($com_modid)) {
                        $syspermHandler = xoops_getHandler('groupperm');
                        if (!$syspermHandler->checkRight('system_admin', XOOPS_SYSTEM_COMMENT, $xoopsUser->getGroups())) {
                            $dohtml = 0;
                        }
                    }
                } else {
                    $dohtml = 0;
                }
            }
            $p_comment = $myts->previewTarea($_POST['com_text'], $dohtml, $dosmiley, $doxcode, $doimage, $dobr);
            $noname    = isset($noname) ? $noname : 0;
            $com_text  = $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['com_text']));
            if ('system' !== $xoopsModule->getVar('dirname')) {
                include XOOPS_ROOT_PATH . '/header.php';
                xoops_error(MPU_MOD_CAPTCHA_ERROR);
                include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
                include XOOPS_ROOT_PATH . '/footer.php';
            } else {
                xoops_cp_header();
                xoops_error(MPU_MOD_CAPTCHA_ERROR);
                include XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_form.php';
                xoops_cp_footer();
            }
            break;
        }

        $doimage          = 1;
        $commentHandler   = xoops_getHandler('comment');
        $add_userpost     = false;
        $call_approvefunc = false;
        $call_updatefunc  = false;
        // RMV-NOTIFY - this can be set to 'comment' or 'comment_submit'
        $notify_event = false;
        if (!empty($com_id)) {
            $comment     =& $commentHandler->get($com_id);
            $accesserror = false;
            if (is_object($xoopsUser)) {
                $syspermHandler = xoops_getHandler('groupperm');
                if ($xoopsUser->isAdmin($com_modid)
                    || $syspermHandler->checkRight('system_admin', XOOPS_SYSTEM_COMMENT, $xoopsUser->getGroups())) {
                    if (!empty($com_status) && XOOPS_COMMENT_PENDING != $com_status) {
                        $old_com_status = $comment->getVar('com_status');
                        $comment->setVar('com_status', $com_status);
                        // if changing status from pending state, increment user post
                        if (XOOPS_COMMENT_PENDING == $old_com_status) {
                            $add_userpost = true;
                            if (XOOPS_COMMENT_ACTIVE == $com_status) {
                                $call_updatefunc  = true;
                                $call_approvefunc = true;
                                // RMV-NOTIFY
                                $notify_event = 'comment';
                            }
                        } elseif (XOOPS_COMMENT_HIDDEN == $old_com_status && XOOPS_COMMENT_ACTIVE == $com_status) {
                            $call_updatefunc = true;
                        // Comments can not be directly posted hidden,
                            // no need to send notification here
                        } elseif (XOOPS_COMMENT_ACTIVE == $old_com_status && XOOPS_COMMENT_HIDDEN == $com_status) {
                            $call_updatefunc = true;
                        }
                    }
                } else {
                    $dohtml = 0;
                    if ($comment->getVar('com_uid') != $xoopsUser->getVar('uid')) {
                        $accesserror = true;
                    }
                }
            } else {
                $dohtml      = 0;
                $accesserror = true;
            }
            if (false != $accesserror) {
                redirect_header($redirect_page . '=' . $com_itemid . '&amp;com_id=' . $com_id . '&amp;com_mode=' . $com_mode . '&amp;com_order=' . $com_order, 1, _NOPERM);
            }
        } else {
            $comment = $commentHandler->create();
            $comment->setVar('com_created', time());
            $comment->setVar('com_pid', $com_pid);
            $comment->setVar('com_itemid', $com_itemid);
            $comment->setVar('com_rootid', $com_rootid);
            $comment->setVar('com_ip', xoops_getenv('REMOTE_ADDR'));
            if (is_object($xoopsUser)) {
                $syspermHandler = xoops_getHandler('groupperm');
                if ($xoopsUser->isAdmin($com_modid)
                    || $syspermHandler->checkRight('system_admin', XOOPS_SYSTEM_COMMENT, $xoopsUser->getGroups())) {
                    $comment->setVar('com_status', XOOPS_COMMENT_ACTIVE);
                    $add_userpost     = true;
                    $call_approvefunc = true;
                    $call_updatefunc  = true;
                    // RMV-NOTIFY
                    $notify_event = 'comment';
                } else {
                    $dohtml = 0;
                    switch ($helper->getConfig('com_rule')) {
                        case XOOPS_COMMENT_APPROVEALL:
                        case XOOPS_COMMENT_APPROVEUSER:
                            $comment->setVar('com_status', XOOPS_COMMENT_ACTIVE);
                            $add_userpost     = true;
                            $call_approvefunc = true;
                            $call_updatefunc  = true;
                            // RMV-NOTIFY
                            $notify_event = 'comment';
                            break;
                        case XOOPS_COMMENT_APPROVEADMIN:
                        default:
                            $comment->setVar('com_status', XOOPS_COMMENT_PENDING);
                            $notify_event = 'comment_submit';
                            break;
                    }
                }
                if (!empty($helper->getConfig('com_anonpost')) && !empty($noname)) {
                    $uid = 0;
                } else {
                    $uid = $xoopsUser->getVar('uid');
                }
            } else {
                $dohtml = 0;
                $uid    = 0;
                if (1 != $helper->getConfig('com_anonpost')) {
                    redirect_header($redirect_page . '=' . $com_itemid . '&amp;com_id=' . $com_id . '&amp;com_mode=' . $com_mode . '&amp;com_order=' . $com_order, 1, _NOPERM);
                }
            }
            if (0 == $uid) {
                switch ($helper->getConfig('com_rule')) {
                    case XOOPS_COMMENT_APPROVEALL:
                        $comment->setVar('com_status', XOOPS_COMMENT_ACTIVE);
                        $add_userpost     = true;
                        $call_approvefunc = true;
                        $call_updatefunc  = true;
                        // RMV-NOTIFY
                        $notify_event = 'comment';
                        break;
                    case XOOPS_COMMENT_APPROVEADMIN:
                    case XOOPS_COMMENT_APPROVEUSER:
                    default:
                        $comment->setVar('com_status', XOOPS_COMMENT_PENDING);
                        // RMV-NOTIFY
                        $notify_event = 'comment_submit';
                        break;
                }
            }
            $comment->setVar('com_uid', $uid);
        }
        $com_title = xoops_trim($_POST['com_title']);
        $com_title = ('' == $com_title) ? _NOTITLE : $com_title;
        $comment->setVar('com_title', $com_title);
        $comment->setVar('com_text', $_POST['com_text']);
        $comment->setVar('dohtml', $dohtml);
        $comment->setVar('dosmiley', $dosmiley);
        $comment->setVar('doxcode', $doxcode);
        $comment->setVar('doimage', $doimage);
        $comment->setVar('dobr', $dobr);
        $comment->setVar('com_icon', $com_icon);
        $comment->setVar('com_modified', time());
        $comment->setVar('com_modid', $com_modid);
        if (isset($extra_params)) {
            $comment->setVar('com_exparams', $extra_params);
        }
        if (false != $commentHandler->insert($comment)) {
            $newcid = $comment->getVar('com_id');

            // set own id as root id if this is a top comment
            if (0 == $com_rootid) {
                $com_rootid = $newcid;
                if (!$commentHandler->updateByField($comment, 'com_rootid', $com_rootid)) {
                    $commentHandler->delete($comment);
                    include XOOPS_ROOT_PATH . '/header.php';
                    xoops_error();
                    include XOOPS_ROOT_PATH . '/footer.php';
                }
            }

            // call custom approve function if any
            if (false != $call_approvefunc && isset($comment_config['callback']['approve'])
                && '' != trim($comment_config['callback']['approve'])) {
                $skip = false;
                if (!function_exists($comment_config['callback']['approve'])) {
                    if (isset($comment_config['callbackFile'])) {
                        $callbackfile = trim($comment_config['callbackFile']);
                        if ('' != $callbackfile
                            && file_exists(XOOPS_ROOT_PATH . '/modules/' . $moddir . '/' . $callbackfile)) {
                            require_once XOOPS_ROOT_PATH . '/modules/' . $moddir . '/' . $callbackfile;
                        }
                        if (!function_exists($comment_config['callback']['approve'])) {
                            $skip = true;
                        }
                    } else {
                        $skip = true;
                    }
                }
                if (!$skip) {
                    $comment_config['callback']['approve']($comment);
                }
            }

            // call custom update function if any
            if (false != $call_updatefunc && isset($comment_config['callback']['update'])
                && '' != trim($comment_config['callback']['update'])) {
                $skip = false;
                if (!function_exists($comment_config['callback']['update'])) {
                    if (isset($comment_config['callbackFile'])) {
                        $callbackfile = trim($comment_config['callbackFile']);
                        if ('' != $callbackfile
                            && file_exists(XOOPS_ROOT_PATH . '/modules/' . $moddir . '/' . $callbackfile)) {
                            require_once XOOPS_ROOT_PATH . '/modules/' . $moddir . '/' . $callbackfile;
                        }
                        if (!function_exists($comment_config['callback']['update'])) {
                            $skip = true;
                        }
                    } else {
                        $skip = true;
                    }
                }
                if (!$skip) {
                    $criteria = new \CriteriaCompo(new \Criteria('com_modid', $com_modid));
                    $criteria->add(new \Criteria('com_itemid', $com_itemid));
                    $criteria->add(new \Criteria('com_status', XOOPS_COMMENT_ACTIVE));
                    $comment_count = $commentHandler->getCount($criteria);
                    $func          = $comment_config['callback']['update'];
                    call_user_func_array($func, [$com_itemid, $comment_count, $comment->getVar('com_id')]);
                }
            }

            // increment user post if needed
            $uid = $comment->getVar('com_uid');
            if ($uid > 0 && false !== $add_userpost) {
                $memberHandler = xoops_getHandler('member');
                $poster        = $memberHandler->getUser($uid);
                if (is_object($poster)) {
                    $memberHandler->updateUserByField($poster, 'posts', $poster->getVar('posts') + 1);
                }
            }

            // RMV-NOTIFY
            // trigger notification event if necessary
            if ($notify_event) {
                $not_modid = $com_modid;
                require_once XOOPS_ROOT_PATH . '/include/notification_functions.php';
                $not_catinfo  =& notificationCommentCategoryInfo($not_modid);
                $not_category = $not_catinfo['name'];
                $not_itemid   = $com_itemid;
                $not_event    = $notify_event;
                // Build an ABSOLUTE URL to view the comment.  Make sure we
                // point to a viewable page (i.e. not the system administration
                // module).
                $comment_tags = [];
                if ('system' === $xoopsModule->getVar('dirname')) {
                    /** @var XoopsModuleHandler $moduleHandler */
                    $moduleHandler = xoops_getHandler('module');
                    $not_module    = $moduleHandler->get($not_modid);
                } else {
                    $not_module =& $xoopsModule;
                }
                if (!isset($comment_url)) {
                    $com_config  =& $not_module->getInfo('comments');
                    $comment_url = $com_config['pageName'] . '?';
                    if (isset($com_config['extraParams']) && is_array($com_config['extraParams'])) {
                        $extra_params = '';
                        foreach ($com_config['extraParams'] as $extra_param) {
                            $extra_params .= isset($_POST[$extra_param]) ? $extra_param . '=' . htmlspecialchars($_POST[$extra_param], ENT_QUOTES | ENT_HTML5) . '&amp;' : $extra_param . '=&amp;';
                            //$extra_params .= isset($_GET[$extra_param]) ? $extra_param.'='.$_GET[$extra_param].'&amp;' : $extra_param.'=&amp;';
                        }
                        $comment_url .= $extra_params;
                    }
                    $comment_url .= $com_config['itemName'];
                }
                $comment_tags['X_COMMENT_URL'] = XOOPS_URL . '/modules/' . $not_module->getVar('dirname') . '/' . $comment_url . '=' . $com_itemid . '&amp;com_id=' . $newcid . '&amp;com_rootid=' . $com_rootid . '&amp;com_mode=' . $com_mode . '&amp;com_order=' . $com_order . '#comment' . $newcid;
                $notificationHandler           = xoops_getHandler('notification');
                $notificationHandler->triggerEvent($not_category, $not_itemid, $not_event, $comment_tags, false, $not_modid);
            }

            if (!isset($comment_post_results)) {

                // if the comment is active, redirect to posted comment
                if (XOOPS_COMMENT_ACTIVE == $comment->getVar('com_status')) {
                    redirect_header($redirect_page . '=' . $com_itemid . '&amp;com_id=' . $newcid . '&amp;com_rootid=' . $com_rootid . '&amp;com_mode=' . $com_mode . '&amp;com_order=' . $com_order . '#comment' . $newcid, 2, _CM_THANKSPOST);
                } else {
                    // not active, so redirect to top comment page
                    redirect_header($redirect_page . '=' . $com_itemid . '&amp;com_mode=' . $com_mode . '&amp;com_order=' . $com_order . '#comment' . $newcid, 2, _CM_THANKSPOST);
                }
            }
        } else {
            if (!isset($purge_comment_post_results)) {
                include XOOPS_ROOT_PATH . '/header.php';
                xoops_error($comment->getHtmlErrors());
                include XOOPS_ROOT_PATH . '/footer.php';
            } else {
                $comment_post_results = $comment->getErrors();
            }
        }
        break;
}
