<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Página Principal do Módulo
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================

use XoopsModules\Mastoppublish;
/** @var Mastoppublish\Helper $helper */
$helper = Mastoppublish\Helper::getInstance();

include __DIR__ . '/../../mainfile.php';
$GLOBALS['xoopsOption']['template_main'] = 'mpu_index.tpl';
require_once __DIR__ . '/header.php';
$tac = \Xmf\Request::getInt('tac', 0, 'GET');
$tac = is_int($tac) ? $tac : str_replace('_', ' ', $tac);
if (!$tac) {
    if ($helper->getConfig('mpu_conf_home_id')) {
        $mpu_classe = new Publish($helper->getConfig('mpu_conf_home_id'));
    } else {
        $mpu_classe = new Publish();
        $mpu_classe->loadLast();
    }
} else {
    $mpu_classe = new Publish(urldecode($tac));
}
if (!$mpu_classe->getVar('mpb_10_id')) {
    redirect_header(XOOPS_URL, 2, MPU_MAI_404);
} else {
    $groups       = (!empty($xoopsUser) && is_object($xoopsUser)) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
    $grouppermHandler = xoops_getHandler('groupperm');
    if (!$grouppermHandler->checkRight('mpu_mpublish_acesso', $mpu_classe->getVar('mpb_10_id'), $groups, $xoopsModule->getVar('mid'))) {
        redirect_header(XOOPS_URL, 3, _NOPERM);
    }
    if ($helper->getConfig('mpu_conf_navigation')) {
        $xoopsTpl->assign('navigation', $mpu_classe->geraNavigation());
    } else {
        $xoopsTpl->assign('navigation', '');
    }
    if ('' != $mpu_classe->getVar('mpb_30_arquivo')
        && 'http://' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 7)) {
        $content = '<iframe src ="' . $mpu_classe->getVar('mpb_30_arquivo') . '" width="' . $helper->getConfig('mpu_conf_iframe_width') . '" height="' . $helper->getConfig('mpu_conf_iframe_height') . '" scrolling="auto" frameborder="0"></iframe>';
        $xoopsTpl->assign('content', $content);
    } elseif ('' != $mpu_classe->getVar('mpb_30_arquivo') && '' == $mpu_classe->getVar('mpb_35_conteudo')) {
        $pageContent = MPU_HTML_PATH . '/' . $mpu_classe->getVar('mpb_30_arquivo');
        if (file_exists($pageContent)) {
            ob_start();
            if ('php' === substr(strtolower($mpu_classe->getVar('mpb_30_arquivo')), -3)) {
                include $pageContent;
            } else {
                readfile($pageContent);
            }
            $content = ob_get_contents();
            ob_end_clean();
            if ('txt' === substr(strtolower($mpu_classe->getVar('mpb_30_arquivo')), -3)) {
                $content = nl2br($content);
            }
            $content = prepareContent($content);
            $xoopsTpl->assign('content', $content);
        }
    } else {
        $mpb_35_conteudo = prepareContent($mpu_classe->getVar('mpb_35_conteudo', 'n'));
        $xoopsTpl->assign('content', $mpb_35_conteudo);
    }
    $xoopsTpl->assign('comentarios', $mpu_classe->getVar('mpb_12_comentarios'));
    if (1 == $mpu_classe->getVar('mpb_12_recomendar')) {
        $xoopsTpl->assign('recomendar', "<a href='" . $mpu_classe->pegaLink('recommend.php') . "' title='" . MPU_MAI_RECOMMEND . "'><img src='" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . "/assets/images/recomendar.jpg' alt='" . MPU_MAI_RECOMMEND . "'></a> ");
    } else {
        $xoopsTpl->assign('recomendar', '');
    }
    if (1 == $mpu_classe->getVar('mpb_12_imprimir')) {
        $xoopsTpl->assign('imprimir', "<a href='" . $mpu_classe->pegaLink('print.php') . "' target='_blank'  title='" . MPU_MAI_PRINT . "'><img src='" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . "/assets/images/imprimir.jpg' alt='" . MPU_MAI_PRINT . "'></a>");
    } else {
        $xoopsTpl->assign('imprimir', '');
    }
    if (!empty($xoopsUser) && $xoopsUser->isAdmin()) {
        $xoopsTpl->assign('infos', MPU_MAI_INFOPG);
        $xoopsTpl->assign('autor', MPU_MAI_AUTOR . ' <b>' . XoopsUser::getUnameFromId($mpu_classe->getVar('usr_10_uid')) . '</b>');
        $xoopsTpl->assign('criado', MPU_MAI_CRIADO . ' <b>' . date(_SHORTDATESTRING, $mpu_classe->getVar('mpb_22_criado')) . '</b>');
        $xoopsTpl->assign('atualizado', MPU_MAI_ATUALIZADO . ' <b>' . date(_SHORTDATESTRING, $mpu_classe->getVar('mpb_22_atualizado')) . '</b>');
        $xoopsTpl->assign('contador', sprintf(MPU_MAI_CONTADOR, $mpu_classe->getVar('mpb_10_contador')));
        $xoopsTpl->assign('zerar_cont', '<input style="font-size: 11px; border:2px solid #9C9C9C; background-color: #FFFFFF" name="limpacont" id="limpacont" value="'
                                        . MPU_MAI_ZCONTADOR
                                        . '" onclick="document.location= \''
                                        . XOOPS_URL
                                        . '/modules/'
                                        . MPU_MOD_DIR
                                        . '/admin/index.php?op=limpacont&mpb_10_id='
                                        . $mpu_classe->getVar('mpb_10_id')
                                        . '\'" type="button">');
        $xoopsTpl->assign('editar_pagina', '<input style="font-size: 11px; border:2px solid #9C9C9C; background-color: #FFFFFF" name="editcont" id="editcont" value="'
                                           . MPU_MAI_EDITPAGE
                                           . '" onclick="document.location= \''
                                           . XOOPS_URL
                                           . '/modules/'
                                           . MPU_MOD_DIR
                                           . '/admin/index.php?op=listar_editar&mpb_10_id='
                                           . $mpu_classe->getVar('mpb_10_id')
                                           . '\'" type="button">');
        $xoopsTpl->assign('tools_image', "<a href='javascript:void(0)' title='"
                                         . MPU_MAI_INFOPG
                                         . "' onclick='document.getElementById(\"admin_page\").style.display=(document.getElementById(\"admin_page\").style.display)? \"\" : \"none\"'><img src='"
                                         . XOOPS_URL
                                         . '/modules/'
                                         . MPU_MOD_DIR
                                         . "/assets/images/tools.jpg' alt='"
                                         . MPU_MAI_INFOPG
                                         . "'></a>");
        $xoopsTpl->assign('mpu_isauthor', 1);
    } elseif (!empty($xoopsUser) && $xoopsUser->getVar('uid') == $mpu_classe->getVar('usr_10_uid')
              && (1 == $helper->getConfig('mpu_conf_canedit') || 1 == $helper->getConfig('mpu_conf_cancreate'))) {
        $xoopsTpl->assign('infos', MPU_MAI_INFOPG);
        $xoopsTpl->assign('autor', MPU_MAI_AUTOR . ' <b>' . XoopsUser::getUnameFromId($mpu_classe->getVar('usr_10_uid')) . '</b>');
        $xoopsTpl->assign('criado', MPU_MAI_CRIADO . ' <b>' . date(_SHORTDATESTRING, $mpu_classe->getVar('mpb_22_criado')) . '</b>');
        $xoopsTpl->assign('atualizado', MPU_MAI_ATUALIZADO . ' <b>' . date(_SHORTDATESTRING, $mpu_classe->getVar('mpb_22_atualizado')) . '</b>');
        $xoopsTpl->assign('contador', sprintf(MPU_MAI_CONTADOR, $mpu_classe->getVar('mpb_10_contador')));
        $xoopsTpl->assign('zerar_cont', '<input style="font-size: 11px; border:2px solid #9C9C9C; background-color: #FFFFFF" name="limpacont" id="limpacont" value="'
                                        . MPU_MAI_ZCONTADOR
                                        . '" onclick="document.location= \''
                                        . XOOPS_URL
                                        . '/modules/'
                                        . MPU_MOD_DIR
                                        . '/author.php?op=limpacont&mpb_10_id='
                                        . $mpu_classe->getVar('mpb_10_id')
                                        . '\'" type="button">');
        $xoopsTpl->assign('editar_pagina', ($helper->getConfig('mpu_conf_canedit') ? '<input style="font-size: 11px; border:2px solid #9C9C9C; background-color: #FFFFFF" name="editcont" id="editcont" value="'
                                                                                     . MPU_MAI_EDITPAGE
                                                                                     . '" onclick="document.location= \''
                                                                                     . XOOPS_URL
                                                                                     . '/modules/'
                                                                                     . MPU_MOD_DIR
                                                                                     . '/author.php?op=editar&mpb_10_id='
                                                                                     . $mpu_classe->getVar('mpb_10_id')
                                                                                     . '\'" type="button"><br><br>' : '')
                                           . '<input style="font-size: 11px; border:2px solid #FF0000; background-color: #FFFFFF" name="mycont" id="mycont" value="'
                                           . MPU_MAI_MYPAGES
                                           . '" onclick="document.location= \''
                                           . XOOPS_URL
                                           . '/modules/'
                                           . MPU_MOD_DIR
                                           . '/author.php?op=listar\'" type="button"> '
                                           . ($helper->getConfig('mpu_conf_cancreate') ? ' <input style="font-size: 11px; border:2px solid #FF0000; background-color: #FFFFFF" name="newcont" id="newcont" value="'
                                                                                         . MPU_MAI_NEWPAGE
                                                                                         . '" onclick="document.location= \''
                                                                                         . XOOPS_URL
                                                                                         . '/modules/'
                                                                                         . MPU_MOD_DIR
                                                                                         . '/author.php?op=novo&mpb_10_id='
                                                                                         . $mpu_classe->getVar('mpb_10_id')
                                                                                         . '\'" type="button">' : '')
                                           . ($helper->getConfig('mpu_conf_candelete') ? ' <input style="font-size: 11px; border:2px solid #FF0000; background-color: #FFFFFF" name="delcont" id="delcont" value="'
                                                                                         . _DELETE
                                                                                         . '" onclick="document.location= \''
                                                                                         . XOOPS_URL
                                                                                         . '/modules/'
                                                                                         . MPU_MOD_DIR
                                                                                         . '/author.php?op=deletar&mpb_10_id='
                                                                                         . $mpu_classe->getVar('mpb_10_id')
                                                                                         . '\'" type="button">' : ''));
        $xoopsTpl->assign('tools_image', "<a href='javascript:void(0)' title='"
                                         . MPU_MAI_INFOPG
                                         . "' onclick='document.getElementById(\"admin_page\").style.display=(document.getElementById(\"admin_page\").style.display)? \"\" : \"none\"'><img src='"
                                         . XOOPS_URL
                                         . '/modules/'
                                         . MPU_MOD_DIR
                                         . "/assets/images/tools.jpg' alt='"
                                         . MPU_MAI_INFOPG
                                         . "'></a>");
        $xoopsTpl->assign('mpu_isauthor', 1);
    } else {
        $xoopsTpl->assign('mpu_isauthor', 0);
    }
    if ($helper->getConfig('mpu_conf_related') && 0 != $mpu_classe->getVar('mpb_10_idpai')) {
        $rel_crit = new \CriteriaCompo(new \Criteria('mpb_10_idpai', $mpu_classe->getVar('mpb_10_idpai')));
        $rel_crit->add(new \Criteria('mpb_10_id', $mpu_classe->getVar('mpb_10_id'), '<>'));
        $rel_crit->add(new \Criteria('mpb_12_semlink', 0));
        $rel_crit2 = new \CriteriaCompo(new \Criteria('mpb_11_visivel', 2));
        $rel_crit2->add(new \Criteria('mpb_11_visivel', 3), 'OR');
        $rel_crit->add($rel_crit2);
        $rel_crit->setSort('mpb_10_ordem');
        $all_related = $mpu_classe->PegaTudo($rel_crit);
        if ($all_related) {
            foreach ($all_related as $v) {
                $relateds           = [];
                $relateds['titulo'] = $v->getVar('mpb_30_titulo');
                $relateds['link']   = $v->pegaLink();
                $xoopsTpl->append('relpages', $relateds);
            }
            $xoopsTpl->assign('relateds', 1);
            $xoopsTpl->assign('related_label', MPU_MAI_RELATED);
        } else {
            $xoopsTpl->assign('related', 0);
        }
    } else {
        $xoopsTpl->assign('related', 0);
    }
    $xoopsTpl->assign('xoops_pagetitle', $mpu_classe->getVar('mpb_30_titulo'));
    $xoopsTpl->assign('mpb_30_titulo', $mpu_classe->getVar('mpb_30_titulo'));
    $xoopsTpl->assign('mpversion', round($xoopsModule->getVar('version') / 100, 2));
    $mpu_classe->updateCount();
}
require_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/comment_view.php';
require_once XOOPS_ROOT_PATH . '/footer.php';
