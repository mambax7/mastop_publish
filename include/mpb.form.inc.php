<?php
### =============================================================
### Mastop InfoDigital - Paix�o por Internet
### =============================================================
### Formul�rio de Conte�do
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital � 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================

use XoopsModules\Mastoppublish;
/** @var Mastoppublish\Helper $helper */
$helper = Mastoppublish\Helper::getInstance();

// defined('XOOPS_ROOT_PATH') || die('Restricted access');
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
$mpb_form = new \XoopsThemeForm($form['titulo'], 'mpu_mpb_form', $_SERVER['PHP_SELF'], 'post', true);
if ($mpb_10_id > 0) {
    $mpb_infos_tray = new \XoopsFormElementTray(MPU_ADM_INFO, '<br>');
    $mpb_infos_tray->addElement(new \XoopsFormLabel(MPU_ADM_BY, XoopsUser::getUnameFromId($mpu_classe->getVar('usr_10_uid'))));
    $mpb_infos_tray->addElement(new \XoopsFormLabel(MPU_ADM_DTCRIADO, date(_DATESTRING, $mpu_classe->getVar('mpb_22_criado'))));
    $mpb_infos_tray->addElement(new \XoopsFormLabel(MPU_ADM_DTATUALIZADO, date(_DATESTRING, $mpu_classe->getVar('mpb_22_atualizado'))));
    $mpb_infos_tray->addElement(new \XoopsFormLabel(MPU_ADM_VIEWS, $mpu_classe->getVar('mpb_10_contador')));
    $mpb_botao_limpacont = new \XoopsFormButton('', 'limpacont', MPU_ADM_LIMPACONT);
    $mpb_botao_limpacont->setExtra("onclick=\"document.location= '" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/index.php?op=limpacont&mpb_10_id=' . $mpb_10_id . "'\"");
    $mpb_infos_tray->addElement($mpb_botao_limpacont);
    $mpb_form->addElement($mpb_infos_tray);
}
$grupos_ids = ($mpb_10_id > 0) ? $modulepermHandler->getGroupIds('mpu_mpublish_acesso', $mpb_10_id, $xoopsModule->getVar('mid')) : $xoopsUser->getGroups();
if (!in_array(XOOPS_GROUP_ANONYMOUS, $grupos_ids) && 0 == $mpb_10_id) {
    array_push($grupos_ids, XOOPS_GROUP_ANONYMOUS);
}
$perm_grupos_select = new \XoopsFormSelectGroup(MPU_ADM_GRUPOS, 'grupos_perm', true, $grupos_ids, 5, true);
$mpb_form->addElement($perm_grupos_select);

$mpb_form->addElement(new \XoopsFormSelectUser(MPU_ADM_USR_10_UID, 'usr_10_uid', false, (('' != $mpu_classe->getVar('usr_10_uid')) ? $mpu_classe->getVar('usr_10_uid') : $xoopsUser->getVar('uid'))));

$mpb_exibir_tray = new \XoopsFormElementTray(MPU_ADM_MPB_10_IDPAI, '&nbsp;&nbsp;&nbsp;');
$exibir_select   = new \XoopsFormSelect('', 'mpb_10_idpai', $mpu_classe->getVar('mpb_10_idpai'));
$exibir_select->addOptionArray($mpu_classe->geraMenuSelect());
$mpb_exibir_tray->addElement($exibir_select);
$mpb_exibir_tray->addElement(new \XoopsFormText(MPU_ADM_MPB_10_ORDEM, 'mpb_10_ordem', 5, 6, $mpu_classe->getVar('mpb_10_ordem')));
$mpb_form->addElement($mpb_exibir_tray);
$mpb_form->addElement(new \XoopsFormText(MPU_ADM_MPB_30_MENU, 'mpb_30_menu', 50, 50, $mpu_classe->getVar('mpb_30_menu')), true);
$mpb_tray_titulo_semlink = new \XoopsFormElementTray(MPU_ADM_MPB_30_TITULO);
$mpb_titulo              = new \XoopsFormText('', 'mpb_30_titulo', 50, 100, $mpu_classe->getVar('mpb_30_titulo'));
$mpb_tray_titulo_semlink->addElement($mpb_titulo);
$mpb_semlink = new \XoopsFormCheckBox('', 'mpb_12_semlink', $mpu_classe->getVar('mpb_12_semlink'));
$mpb_semlink->setExtra("id='mpb_12_semlink1' onclick='if (this.checked) { document.getElementById(\"mpb_external1\").checked=false; document.getElementById(\"mpb_pagina1\").checked=false; document.getElementById(\"mpb_frame1\").checked=false; document.getElementById(\"mpb_external_span\").style.display=\"none\"; document.getElementById(\"mpb_35_conteudo_span\").style.display=\"none\"; document.getElementById(\"mpb_pagina_span\").style.display=\"none\"; document.getElementById(\"mpb_30_arquivo_span\").style.display=\"none\"; } else { document.getElementById(\"mpb_35_conteudo_span\").style.display=\"\";"
                       . ($helper->getConfig('mpu_conf_wysiwyg') ? 'tinyMCE.execCommand("mceResetDesignMode");' : '')
                       . "}'");
$mpb_semlink->addOption(1, MPU_ADM_MPB_12_SEMLINK);
$mpb_tray_titulo_semlink->addElement($mpb_semlink);

$mpb_external_check = new \XoopsFormCheckBox('', 'mpb_external', (('ext:' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 1 : 0));
$mpb_external_check->setExtra("id='mpb_external1' onclick='if (this.checked) { document.getElementById(\"mpb_pagina1\").checked=false; document.getElementById(\"mpb_12_semlink1\").checked=false; document.getElementById(\"mpb_frame1\").checked=false; document.getElementById(\"mpb_external_span\").style.display=\"\"; document.getElementById(\"mpb_30_arquivo_span\").style.display=\"none\"; document.getElementById(\"mpb_pagina_span\").style.display=\"none\"; document.getElementById(\"mpb_35_conteudo_span\").style.display=\"none\";} else {document.getElementById(\"mpb_external_span\").style.display=\"none\";document.getElementById(\"mpb_35_conteudo_span\").style.display=\"\";"
                              . ($helper->getConfig('mpu_conf_wysiwyg') ? 'tinyMCE.execCommand("mceResetDesignMode");' : '')
                              . "}'");
$mpb_external_check->addOption(1, MPU_ADM_MPB_EXTERNAL);
$mpb_tray_titulo_semlink->addElement($mpb_external_check);

$mpb_frame_check = new \XoopsFormCheckBox('', 'mpb_frame', (('http' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 1 : 0));
$mpb_frame_check->setExtra("id='mpb_frame1' onclick='if (this.checked) { document.getElementById(\"mpb_external1\").checked=false; document.getElementById(\"mpb_pagina1\").checked=false; document.getElementById(\"mpb_12_semlink1\").checked=false; document.getElementById(\"mpb_external_span\").style.display=\"none\"; document.getElementById(\"mpb_30_arquivo_span\").style.display=\"\"; document.getElementById(\"mpb_pagina_span\").style.display=\"none\"; document.getElementById(\"mpb_35_conteudo_span\").style.display=\"none\";} else {document.getElementById(\"mpb_30_arquivo_span\").style.display=\"none\";document.getElementById(\"mpb_35_conteudo_span\").style.display=\"\";"
                           . ($helper->getConfig('mpu_conf_wysiwyg') ? 'tinyMCE.execCommand("mceResetDesignMode");' : '')
                           . "}'");
$mpb_frame_check->addOption(1, MPU_ADM_MPB_FRAME);
$mpb_tray_titulo_semlink->addElement($mpb_frame_check);
$mpb_pagina = new \XoopsFormCheckBox('', 'mpb_pagina', (('' != $mpu_classe->getVar('mpb_30_arquivo') && 'http' !== substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)
                                                        && 'ext:' != substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 1 : 0));
$mpb_pagina->setExtra("id='mpb_pagina1' onclick='if (this.checked) { document.getElementById(\"mpb_external1\").checked=false; document.getElementById(\"mpb_frame1\").checked=false; document.getElementById(\"mpb_12_semlink1\").checked=false; document.getElementById(\"mpb_external_span\").style.display=\"none\"; document.getElementById(\"mpb_35_conteudo_span\").style.display=\"none\";document.getElementById(\"mpb_30_arquivo_span\").style.display=\"none\";document.getElementById(\"mpb_pagina_span\").style.display=\"\";} else { document.getElementById(\"mpb_35_conteudo_span\").style.display=\"\";document.getElementById(\"mpb_pagina_span\").style.display=\"none\";"
                      . ($helper->getConfig('mpu_conf_wysiwyg') ? 'tinyMCE.execCommand("mceResetDesignMode");' : '')
                      . "}'");
$mpb_pagina->addOption(1, MPU_ADM_MPB_FROMFILE);
$mpb_tray_titulo_semlink->addElement($mpb_pagina);

$mpb_form->addElement($mpb_tray_titulo_semlink);
$mpb_tray_conteudo = new \XoopsFormElementTray(MPU_ADM_MPB_35_CONTEUDO, '');
$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', "<span id='mpb_35_conteudo_span' " . (('' != $mpu_classe->getVar('mpb_30_arquivo')
                                                                                             || 1 == $mpu_classe->getVar('mpb_12_semlink')) ? 'style="display:none"' : '') . '>'));
if (!$helper->getConfig('mpu_conf_wysiwyg')) {
    $mpb_tray_conteudo->addElement(new \XoopsFormDhtmlTextArea('', 'mpb_35_conteudo', $mpu_classe->getVar('mpb_35_conteudo')));
} else {
    $mpb_wysiwyg_url = XOOPS_URL . $helper->getConfig('mpu_conf_wysiwyg_path');
    if ($helper->getConfig('mpu_conf_gzip')) {
        echo '
        <!-- TinyMCE -->
<script language="javascript" type="text/javascript" src="'
             . $mpb_wysiwyg_url
             . '/tiny_mce_gzip.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE_GZ.init({
    plugins : "'
             . $helper->getConfig('mpu_conf_wysiwyg_plugins')
             . '",
        themes : "advanced",
        languages : "'
             . $helper->getConfig('mpu_conf_wysiwyg_lang')
             . '",
        disk_cache : true,
        debug : false
});
</script>
<script language="javascript" type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        language : "'
             . $helper->getConfig('mpu_conf_wysiwyg_lang')
             . '",
        editor_selector : "mpu_wysiwyg",
        disk_cache : true,
        debug : false,
        plugins : "'
             . $helper->getConfig('mpu_conf_wysiwyg_plugins')
             . '",
        theme_advanced_buttons1_add_before : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt1b')
             . '",
        theme_advanced_buttons1_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt1')
             . '",
        theme_advanced_buttons2_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt2')
             . '",
        theme_advanced_buttons2_add_before: "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt2b')
             . '",
        theme_advanced_buttons3_add_before : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt3b')
             . '",
        theme_advanced_buttons3_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt3')
             . '",
        theme_advanced_buttons4 : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt4')
             . '",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_path_location : "bottom",
        content_css : "'
             . XOOPS_THEME_URL
             . '/'
             . $GLOBALS['xoopsConfig']['theme_set']
             . '/style.css",
        plugin_insertdate_dateFormat : "'
             . $helper->getConfig('mpu_conf_wysiwyg_frmtdata')
             . '",
        plugin_insertdate_timeFormat : "'
             . $helper->getConfig('mpu_conf_wysiwyg_frmthora')
             . '",
        extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[align<bottom?left?middle?right?top|class|frameborder|height|id|longdesc|marginheight|marginwidth|name|scrolling<auto?no?yes|src|style|title|width]",
        external_link_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_files_list.js.php",
        external_image_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_image_list.js.php",
        media_external_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_media_list.js.php",
        file_browser_callback : "mpu_chama_browser",
        theme_advanced_resize_horizontal : true,
        theme_advanced_resizing : true,
        nonbreaking_force_tab : true,
        apply_source_formatting : true,
        plugin_keyword_list : "'
             . MPU_ADM_BANNER
             . '={banner};'
             . MPU_ADM_SITENAME
             . '={sitename};'
             . MPU_ADM_SLOGAN
             . '={slogan};'
             . MPU_ADM_ADMINMAIL
             . '={adminmail};'
             . MPU_ADM_SITEURL
             . '={xoops_url};'
             . MPU_ADM_UID
             . '={uid};'
             . MPU_ADM_USERNAME
             . '={name};'
             . MPU_ADM_USERLOGIN
             . '={uname};'
             . MPU_ADM_UEMAIL
             . '={email};'
             . MPU_ADM_USERURL
             . '={url};'
             . MPU_ADM_USERPOSTS
             . '={posts};",
        ';
        if ($helper->getConfig('mpu_conf_wysiwyg_bkg')) {
            echo '
        convert_urls : false,
        setupcontent_callback : "fundoPadrao"
       });
       function fundoPadrao(editor_id, body)
       {
        body.style.backgroundImage="none";
        body.style.backgroundColor="#FFFFFF";
        body.style.textAlign="left";
        body.style.color="#000000";
        }';
        } else {
            echo '
        convert_urls : false
       });';
        }
        echo '
        function trocaEditor(id)
        {
        var elm = document.getElementById(id);
        if (tinyMCE.getInstanceById(id) == null)
        tinyMCE.execCommand("mceAddControl", false, id);
        else
        tinyMCE.execCommand("mceRemoveControl", false, id);
        }
        function mpu_chama_browser(field_name, url, type, win)
        {
            if (type == "image") {
                tinyMCE.addToLang("",{
                    browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
                    browser_gimg_title : "' . _IMGMANAGER . '",
                    browser_ger_imagens : "' . MPU_ADM_BROWSER_GER_IMG . '",
                    browser_nova_imagem : "' . MPU_ADM_BROWSER_NIMG . '",
                    browser_nova_cat : "' . MPU_ADM_BROWSER_NCAT . '"
                });
                tinyMCE.openWindow({
                    file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_image.php",
                    width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
                    height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
                    close_previous : "no"
                }, {
                    win: win,
                    campo: field_name,
                    url : url,
                    inline : "yes",
                    resizable : "yes",
                    editor_id: "mpb_35_conteudo"
                });
            } elseif (type == "media") {
                tinyMCE.addToLang("",{
                    browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
                    browser_ger_medias : "' . MPU_ADM_BROWSER_GER_MED . '",
                    browser_media_title : "' . MPU_ADM_BROWSER_MED_TITULO . '",
                    browser_nova_media : "' . MPU_ADM_NMEDIA . '"
                });
                tinyMCE.openWindow({
                    file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_media.php",
                    width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
                    height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
                    close_previous : "no"
                }, {
                    win: win,
                    campo: field_name,
                    url : url,
                    inline : "yes",
                    resizable : "yes",
                    editor_id: "mpb_35_conteudo"
                });
            } elseif (type == "file") {
                tinyMCE.addToLang("",{
                    browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
                    browser_ger_files : "' . MPU_ADM_BROWSER_GER_FIL . '",
                    browser_file_title : "' . MPU_ADM_BROWSER_FIL_TITULO . '",
                    browser_novo_file : "' . MPU_ADM_NFILE . '"
                });
                tinyMCE.openWindow({
                    file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_files.php",
                    width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
                    height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
                    close_previous : "no"
                }, {
                    win: win,
                    campo: field_name,
                    url : url,
                    inline : "yes",
                    resizable : "yes",
                    editor_id: "mpb_35_conteudo"
                });
            }

            return false;
        }
</script>
<!-- /TinyMCE -->
        ';
    } else {
        echo '
<!-- TinyMCE -->
<script language="javascript" type="text/javascript" src="'
             . $mpb_wysiwyg_url
             . '/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    language : "'
             . $helper->getConfig('mpu_conf_wysiwyg_lang')
             . '",
    editor_selector : "mpu_wysiwyg",
    disk_cache : true,
    debug : false,
    plugins : "'
             . $helper->getConfig('mpu_conf_wysiwyg_plugins')
             . '",
    theme_advanced_buttons1_add_before : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt1b')
             . '",
    theme_advanced_buttons1_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt1')
             . '",
    theme_advanced_buttons2_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt2')
             . '",
    theme_advanced_buttons2_add_before: "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt2b')
             . '",
    theme_advanced_buttons3_add_before : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt3b')
             . '",
    theme_advanced_buttons3_add : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt3')
             . '",
    theme_advanced_buttons4 : "'
             . $helper->getConfig('mpu_conf_wysiwyg_bt4')
             . '",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_path_location : "bottom",
    content_css : "'
             . XOOPS_THEME_URL
             . '/'
             . $GLOBALS['xoopsConfig']['theme_set']
             . '/style.css",
    plugin_insertdate_dateFormat : "'
             . $helper->getConfig('mpu_conf_wysiwyg_frmtdata')
             . '",
    plugin_insertdate_timeFormat : "'
             . $helper->getConfig('mpu_conf_wysiwyg_frmthora')
             . '",
    extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],iframe[align<bottom?left?middle?right?top|class|frameborder|height|id|longdesc|marginheight|marginwidth|name|scrolling<auto?no?yes|src|style|title|width]",
    external_link_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_link_list.js",
    external_image_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_image_list.js.php",
    media_external_list_url : "'
             . XOOPS_URL
             . '/modules/'
             . MPU_MOD_DIR
             . '/include/mpu_media_list.js",
    file_browser_callback : "mpu_chama_browser",
    theme_advanced_resize_horizontal : true,
    theme_advanced_resizing : true,
    nonbreaking_force_tab : true,
    apply_source_formatting : true,
    plugin_keyword_list : "'
             . MPU_ADM_BANNER
             . '={banner};'
             . MPU_ADM_SITENAME
             . '={sitename};'
             . MPU_ADM_SLOGAN
             . '={slogan};'
             . MPU_ADM_ADMINMAIL
             . '={adminmail};'
             . MPU_ADM_SITEURL
             . '={xoops_url};'
             . MPU_ADM_UID
             . '={uid};'
             . MPU_ADM_USERNAME
             . '={name};'
             . MPU_ADM_USERLOGIN
             . '={uname};'
             . MPU_ADM_UEMAIL
             . '={email};'
             . MPU_ADM_USERURL
             . '={url};'
             . MPU_ADM_USERPOSTS
             . '={posts};",
        ';
        if ($helper->getConfig('mpu_conf_wysiwyg_bkg')) {
            echo '
        convert_urls : false,
        setupcontent_callback : "fundoPadrao"
       });
       function fundoPadrao(editor_id, body)
       {
        body.style.backgroundImage="none";
        body.style.backgroundColor="#FFFFFF";
        body.style.textAlign="left";
        body.style.color="#000000";
        }';
        } else {
            echo '
        convert_urls : false
       });';
        }
        echo '
        function trocaEditor(id)
        {
        var elm = document.getElementById(id);
        if (tinyMCE.getInstanceById(id) == null)
        tinyMCE.execCommand("mceAddControl", false, id);
        else
        tinyMCE.execCommand("mceRemoveControl", false, id);
        }
function mpu_chama_browser(field_name, url, type, win)
{
    if (type == "image") {
        tinyMCE.addToLang("",{
            browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
            browser_gimg_title : "' . _IMGMANAGER . '",
            browser_ger_imagens : "' . MPU_ADM_BROWSER_GER_IMG . '",
            browser_nova_imagem : "' . MPU_ADM_BROWSER_NIMG . '",
            browser_nova_cat : "' . MPU_ADM_BROWSER_NCAT . '"
        });
        tinyMCE.openWindow({
            file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_image.php",
            width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
            height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
            close_previous : "no"
        }, {
            win: win,
            campo: field_name,
            url : url,
            inline : "yes",
            resizable : "yes",
            editor_id: "mpb_35_conteudo"
        });
    } elseif (type == "media") {
        tinyMCE.addToLang("",{
            browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
            browser_ger_medias : "' . MPU_ADM_BROWSER_GER_MED . '",
            browser_media_title : "' . MPU_ADM_BROWSER_MED_TITULO . '",
            browser_nova_media : "' . MPU_ADM_NMEDIA . '"
        });
        tinyMCE.openWindow({
            file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_media.php",
            width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
            height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
            close_previous : "no"
        }, {
            win: win,
            campo: field_name,
            url : url,
            inline : "yes",
            resizable : "yes",
            editor_id: "mpb_35_conteudo"
        });
    } elseif (type == "file") {
        tinyMCE.addToLang("",{
            browser_procurar : "' . MPU_ADM_BROWSER_TITULO . '",
            browser_ger_files : "' . MPU_ADM_BROWSER_GER_FIL . '",
            browser_file_title : "' . MPU_ADM_BROWSER_FIL_TITULO . '",
            browser_novo_file : "' . MPU_ADM_NFILE . '"
        });
        tinyMCE.openWindow({
            file : "' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/admin/browser_files.php",
            width : 550 + tinyMCE.getLang("lang_media_delta_width", 0),
            height : 380 + tinyMCE.getLang("lang_media_delta_height", 0),
            close_previous : "no"
        }, {
            win: win,
            campo: field_name,
            url : url,
            inline : "yes",
            resizable : "yes",
            editor_id: "mpb_35_conteudo"
        });
    }

    return false;
}
</script>
<!-- /TinyMCE -->';
    }
    $textarea = new \XoopsFormTextArea('', 'mpb_35_conteudo', $mpu_classe->getVar('mpb_35_conteudo', 'n'), 30);
    $textarea->setExtra("style='width: 100%' class='mpu_wysiwyg'");
    $mpb_tray_conteudo->addElement($textarea);
    $mpb_tray_conteudo->addElement(new \XoopsFormLabel(
        "<a href='javascript:trocaEditor(\"mpb_35_conteudo\")' style='float:right; padding:3px; color:#000000; background-color:#F0F0EE; border: 1px solid #CCCCCC; border-top:0px; margin-top:-1px'>" . MPU_ADM_TOGGLE_EDITOR . '</a>',
                                                      $mpu_classe->PegaSmileys()
    ));
}
$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', "</span><span id='mpb_30_arquivo_span' " . (('http' !== substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 'style="display:none"' : '') . '>'));
$mpb_tray_conteudo->addElement(new \XoopsFormText(MPU_ADM_MPB_FRAME_URL, 'mpb_30_arquivo_frame', 30, 255, (('http' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? $mpu_classe->getVar('mpb_30_arquivo') : '')));
$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', '</span>'));

$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', "</span><span id='mpb_external_span' " . (('ext:' !== substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 'style="display:none"' : '') . '>'));
$mpb_tray_conteudo->addElement(new \XoopsFormText(MPU_ADM_MPB_EXTERNAL_URL, 'mpb_30_arquivo_external', 30, 255, (('ext:' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? substr($mpu_classe->getVar('mpb_30_arquivo'), 4) : 'http://')));
$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', '</span>'));

$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', "<span id='mpb_pagina_span' " . (('' == $mpu_classe->getVar('mpb_30_arquivo')
                                                                                        || 'http' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)
                                                                                        || 'ext:' === substr($mpu_classe->getVar('mpb_30_arquivo'), 0, 4)) ? 'style="display:none"' : '') . '>'));
$paginas_select = new \XoopsFormSelect(MPU_ADM_SELECIONE, 'pagina', $mpu_classe->getVar('mpb_30_arquivo'));
$paginas_select->addOptionArray($cfi_classe->listaPaginas());
$mpb_tray_conteudo->addElement($paginas_select);
$mpb_tray_conteudo->addElement(new \XoopsFormLabel('', "<a href='" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . "/admin/paginas.php?op=contentfiles_adicionar'>" . _ADD . '</a></span>'));

$mpb_form->addElement($mpb_tray_conteudo);
$mpb_opcoes_tray    = new \XoopsFormElementTray(_OPTIONS, '<br>');
$mpb_visivel_select = new \XoopsFormSelect(MPU_ADM_MPB_11_VISIVEL, 'mpb_11_visivel', $mpu_classe->getVar('mpb_11_visivel'));
$mpb_visivel_select->addOptionArray([
                                        1 => MPU_ADM_MPB_11_VISIVEL_1,
                                        3 => MPU_ADM_MPB_11_VISIVEL_3,
                                        2 => MPU_ADM_MPB_11_VISIVEL_2,
                                        4 => MPU_ADM_MPB_11_VISIVEL_4
                                    ]);
$mpb_opcoes_tray->addElement($mpb_visivel_select);
$mpb_abrir_select = new \XoopsFormSelect(MPU_ADM_MPB_11_ABRIR, 'mpb_11_abrir', $mpu_classe->getVar('mpb_11_abrir'));
$mpb_abrir_select->addOptionArray([0 => MPU_ADM_MPB_11_ABRIR_0, 1 => MPU_ADM_MPB_11_ABRIR_1]);
$mpb_opcoes_tray->addElement($mpb_abrir_select);
$mpb_comentarios = new \XoopsFormCheckBox('', 'mpb_12_comentarios', $mpu_classe->getVar('mpb_12_comentarios'));
$mpb_comentarios->addOption(1, MPU_ADM_MPB_12_COMENTARIOS);
$mpb_opcoes_tray->addElement($mpb_comentarios);
$mpb_exibesub = new \XoopsFormCheckBox('', 'mpb_12_exibesub', $mpu_classe->getVar('mpb_12_exibesub'));
$mpb_exibesub->addOption(1, MPU_ADM_MPB_12_EXIBESUB);
$mpb_opcoes_tray->addElement($mpb_exibesub);
$mpb_recomendar = new \XoopsFormCheckBox('', 'mpb_12_recomendar', $mpu_classe->getVar('mpb_12_recomendar'));
$mpb_recomendar->addOption(1, MPU_ADM_MPB_12_RECOMENDAR);
$mpb_opcoes_tray->addElement($mpb_recomendar);
$mpb_imprimir = new \XoopsFormCheckBox('', 'mpb_12_imprimir', $mpu_classe->getVar('mpb_12_imprimir'));
$mpb_imprimir->addOption(1, MPU_ADM_MPB_12_IMPRIMIR);
$mpb_opcoes_tray->addElement($mpb_imprimir);

$mpb_form->addElement($mpb_opcoes_tray);

$mpb_form->addElement(new \XoopsFormHidden('mpb_10_id', $mpb_10_id));
$mpb_form->addElement(new \XoopsFormHidden('op', $form['op']));
$mpb_botoes_tray  = new \XoopsFormElementTray('', '&nbsp;&nbsp;');
$mpb_botao_cancel = new \XoopsFormButton('', 'cancelar', _CANCEL);
$mpb_botoes_tray->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$mpb_botao_cancel->setExtra("onclick=\"document.location= '" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . "/admin/index.php'\"");
$mpb_botoes_tray->addElement($mpb_botao_cancel);
$mpb_form->addElement($mpb_botoes_tray);
