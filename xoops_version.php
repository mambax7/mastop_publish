<?php
### =============================================================
### Mastop InfoDigital - Paix�o por Internet
### =============================================================
### Arquivo para configura��o do M�dulo
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital � 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================

// Dados do M�dulo
$modversion['name']        = MPU_MOD_NOME;
$modversion['version']     = 1.5;
$modversion['author']      = 'Fernando Santos (aka topet05)';
$modversion['description'] = MPU_MOD_DESC;
$modversion['credits']     = 'Mastop InfoDigital - www.mastop.com.br';
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']    = 0; //1 indicates supported by XOOPS Dev Team, 0 means 3rd party supported
$modversion['image']       = 'assets/images/logoModule.png';
$modversion['dirname']     = basename(__DIR__);

$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16']        = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32']        = '../../Frameworks/moduleclasses/icons/32';

//about
$modversion['module_status']       = 'Beta 1';
$modversion['release_date']        = '2014/04/23';
$modversion['module_website_url']  = 'www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['author_website_url']  = 'http://xoops.org/';
$modversion['author_website_name'] = 'XOOPS';
$modversion['min_php']             = '5.5';
$modversion['min_xoops']           = '2.5.8';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = array('mysql' => '5.1');

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tabelas criadas pelo Arquivo sql (sem prefixo poha!)
$modversion['tables'][0] = MPU_MOD_TABELA1;
$modversion['tables'][1] = MPU_MOD_TABELA2;
$modversion['tables'][2] = MPU_MOD_TABELA3;
$modversion['tables'][3] = MPU_MOD_TABELA4;

// Itens da Administra��o
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Templates
$modversion['templates'][1]['file']        = MPU_MOD_TEMPLATE1;
$modversion['templates'][1]['description'] = MPU_MOD_TEMPLATE1_DESC;

// Blocos
$i                                       = 1;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO1_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO1;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO1_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO1_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO1_EDIT;
$modversion['blocks'][$i]['options']     = '0|1|Home|1|100%|170px|' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/menu/arrow.gif|FFFFFF|050200|333333|EBE8FA|1D5223|0|0|0|0|0|0|1px|solid|CCCCCC|1px|groove|000000|4px|0';
$modversion['blocks'][$i]['template']    = MPU_MOD_BLOCO1_TEMPLATE; // Nome do Arquivo .tpl que ficar� dentro da pasta templates/blocks (definir s� se o bloco for utilizar templates).
++$i;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO2_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO2;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO2_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO2_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO2_EDIT;
$modversion['blocks'][$i]['options']     = '15px|000000|/';
++$i;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO3_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO3;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO3_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO3_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO3_EDIT;
$modversion['blocks'][$i]['options']     = '10px|2200FF|mpb_30_titulo|50';
$modversion['blocks'][$i]['template']    = MPU_MOD_BLOCO3_TEMPLATE;
++$i;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO4_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO4;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO4_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO4_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO4_EDIT;
$modversion['blocks'][$i]['options']     = 'mpub_menutree|1|Home|1|FFFFFF|F2F2F2|000000|757575|3C00AB|0|0|0|0|0|0|0';
$modversion['blocks'][$i]['template']    = MPU_MOD_BLOCO4_TEMPLATE; // Nome do Arquivo .tpl que ficar� dentro da pasta templates/blocks (definir s� se o bloco for utilizar templates).
++$i;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO5_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO5;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO5_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO5_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO5_EDIT;
$modversion['blocks'][$i]['options']     = '0|1|Home|1|150px|170px|' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/menu/plus.gif|FFFFFF|050200|333333|EBE8FA|1D5223|0|0|0|0|0|0|1px|solid|CCCCCC|1px|groove|000000|4px|0';
$modversion['blocks'][$i]['template']    = MPU_MOD_BLOCO5_TEMPLATE; // Nome do Arquivo .tpl que ficar� dentro da pasta templates/blocks (definir s� se o bloco for utilizar templates).
++$i;
$modversion['blocks'][$i]['file']        = MPU_MOD_BLOCO6_FILE;
$modversion['blocks'][$i]['name']        = MPU_MOD_BLOCO6;
$modversion['blocks'][$i]['description'] = MPU_MOD_BLOCO6_DESC;
$modversion['blocks'][$i]['show_func']   = MPU_MOD_BLOCO6_SHOW;
$modversion['blocks'][$i]['edit_func']   = MPU_MOD_BLOCO6_EDIT;
$modversion['blocks'][$i]['options']     = 'mpub_menurel|100%|170px|' . XOOPS_URL . '/modules/' . MPU_MOD_DIR . '/menu/arrow.gif|FFFFFF|050200|333333|EBE8FA|1D5223|0|0|0|0|0|0|1px|solid|CCCCCC|1px|groove|000000|4px';
$modversion['blocks'][$i]['template']    = MPU_MOD_BLOCO6_TEMPLATE; // Nome do Arquivo .tpl que ficar� dentro da pasta templates/blocks (definir s� se o bloco for utilizar templates).

// Menu
$modversion['hasMain'] = 1;

// Busca
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/busca.inc.php';
$modversion['search']['func'] = MPU_MOD_BUSCA_FUNC;

// Coment�rios
$modversion['hasComments']          = 1;
$modversion['comments']['pageName'] = 'index.php';
$modversion['comments']['itemName'] = 'tac';
// Fun��es de retorno para coment�rios
//$modversion['comments']['callback']['approve'] = ''; // Nome da fun��o que ser� executada toda vez que um coment�rio for aprovado. O �nico par�metro passado � o objeto do Coment�rio que foi aprovado. �til para notificar o usu�rio sobre a aprova��o de seu coment�rio.
//$modversion['comments']['callback']['update'] = ''; // Nome da fun��o que ser� executada toda vez que o n�mero de coment�rios ativos for alterado. 2 Par�metros: ID do item e Total de coment�rios ativos. �til para atualizar o n�mero de coment�rios de determinado registro.
//$modversion['comments']['callbackFile'] = ''; // Path (a partir da pasta do m�dulo) para o arquivo .php que cont�m as fun��es de retorno para os coment�rios.

// Configura��es (Para as prefer�ncias do m�dulo)

$i                                       = 1;
$modversion['config'][$i]['name']        = 'mpu_conf_home_id';
$modversion['config'][$i]['title']       = 'MPU_MOD_HOME_ID';
$modversion['config'][$i]['description'] = 'MPU_MOD_HOME_ID_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg'; // Nome do �ndice para reconhecer o valor espec�fico da configura��o. Ex.: Se for definido 'teste', ser� chamado como $xoopsModuleConfig['teste']
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_DESC';
$modversion['config'][$i]['formtype']    = 'yesno'; // Tipo de elemento usado no formul�rio de prefer�ncias. Pode ser 'yesno', 'select', 'select_multi', 'group', 'group_multi', 'textbox', 'textarea', 'user', 'user_multi', 'timezone', 'password', 'color', 'hidden' ou 'language'.
$modversion['config'][$i]['valuetype']   = 'int'; // Valor esperado para o elemento no formul�rio. Pode ser 'int', 'float', 'text' ou 'array'. Para configura��es que tenham o formtype como xx_multi, o valuetype � sempre array.
$modversion['config'][$i]['default']     = 1; // Valor padr�o da configura��o. formtype como 'yesno' devem sempre receber 0 (zero) ou 1.
//$modversion['config'][$i]['options'] = array(); // Op��es para formtype tipo 'select' ou 'select_multi', deve ser um array (Ex.: array('5' => 5, '10' => 10, '15' => 15). Pode ser usado Constante de Tradu��o aqui.
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bkg';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BKG';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BKG_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_path';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_PATH';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_PATH_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '/modules/' . MPU_MOD_DIR . '/editor/tinymce/jscripts/tiny_mce';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_plugins';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_PLUGINS';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_PLUGINS_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'inlinepopups,style,layer,table,save,advhr,advimage,advlink,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,youtube,keyword,xhtmlxtras';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_lang';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_LANG';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_LANG_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = ($xoopsConfig['language'] == 'portuguesebr') ? 'pt_br' : 'en';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt1b';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT1B';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT1B_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt1';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT1';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT1_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'fontselect,fontsizeselect';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt2b';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT2B';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT2B_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'cut,copy,paste,pastetext,pasteword,separator,search,replace,separator';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt2';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT2';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT2_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'separator,insertdate,inserttime,preview,separator,forecolor,backcolor,advsearchreplace';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt3b';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT3B';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT3B_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'tablecontrols,separator';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt3';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT3';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT3_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'advhr,separator,print,separator,ltr,rtl,separator,fullscreen';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_bt4';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_BT4';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_BT4_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking,separator,keyword,media,youtube';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_frmtdata';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_FRMTDATA';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_FRMTDATA_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%d/%m/%Y';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_wysiwyg_frmthora';
$modversion['config'][$i]['title']       = 'MPU_MOD_WYSIWYG_FRMTHORA';
$modversion['config'][$i]['description'] = 'MPU_MOD_WYSIWYG_FRMTHORA_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '%H:%M:%S';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_gzip';
$modversion['config'][$i]['title']       = 'MPU_MOD_GZIP';
$modversion['config'][$i]['description'] = 'MPU_MOD_GZIP_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;

$modversion['config'][$i]['name']        = 'mpu_conf_mimetypes';
$modversion['config'][$i]['title']       = 'MPU_MOD_MIMETYPES';
$modversion['config'][$i]['description'] = 'MPU_MOD_MIMETYPES_DESC';
$modversion['config'][$i]['formtype']    = 'select_multi';
$modversion['config'][$i]['valuetype']   = 'array';
$modversion['config'][$i]['options']     = include XOOPS_ROOT_PATH . '/include/mimetypes.inc.php';
ksort($modversion['config'][$i]['options']);
reset($modversion['config'][$i]['options']);
$modversion['config'][$i]['default'] = array(
    'application/x-gtar',
    'application/x-tar',
    'application/x-gzip',
    'application/msword',
    'application/pdf',
    'application/vnd.ms-excel',
    'application/vnd.ms-excel',
    'application/vnd.ms-powerpoint',
    'application/zip'
);
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_contentmimes';
$modversion['config'][$i]['title']       = 'MPU_MOD_CONTENTMIMES';
$modversion['config'][$i]['description'] = 'MPU_MOD_CONTENTMIMES_DESC';
$modversion['config'][$i]['formtype']    = 'select_multi';
$modversion['config'][$i]['valuetype']   = 'array';
$modversion['config'][$i]['options']     = array(
    'html' => 'text/html',
    'txt'  => 'text/plain',
    'php'  => 'application/x-httpd-php',
    'js'   => 'application/x-javascript'
);
$modversion['config'][$i]['default']     = array(
    'text/html',
    'text/plain',
    'application/x-httpd-php',
    'application/x-javascript'
);
++$i;
$modversion['config'][$i]['name']        = 'mpu_max_filesize';
$modversion['config'][$i]['title']       = 'MPU_MOD_MAXFILESIZE';
$modversion['config'][$i]['description'] = 'MPU_MOD_MAXFILESIZE_DESC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = (int)get_cfg_var('upload_max_filesize') * 1024;
++$i;
$modversion['config'][$i]['name']        = 'mpu_mmax_filesize';
$modversion['config'][$i]['title']       = 'MPU_MOD_MMAXFILESIZE';
$modversion['config'][$i]['description'] = 'MPU_MOD_MMAXFILESIZE_DESC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = (int)get_cfg_var('upload_max_filesize') * 1024;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_nomes_id';
$modversion['config'][$i]['title']       = 'MPU_MOD_NOMES_ID';
$modversion['config'][$i]['description'] = 'MPU_MOD_NOMES_ID_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_iframe_width';
$modversion['config'][$i]['title']       = 'MPU_MOD_IFRAME_WIDTH';
$modversion['config'][$i]['description'] = 'MPU_MOD_IFRAME_WIDTH_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '100%';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_iframe_height';
$modversion['config'][$i]['title']       = 'MPU_MOD_IFRAME_HEIGHT';
$modversion['config'][$i]['description'] = 'MPU_MOD_IFRAME_HEIGHT_DESC';
$modversion['config'][$i]['formtype']    = 'texbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = '500';
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_navigation';
$modversion['config'][$i]['title']       = 'MPU_MOD_NAVIGATION';
$modversion['config'][$i]['description'] = 'MPU_MOD_NAVIGATION_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_related';
$modversion['config'][$i]['title']       = 'MPU_MOD_RELATED';
$modversion['config'][$i]['description'] = 'MPU_MOD_RELATED_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_captcha';
$modversion['config'][$i]['title']       = 'MPU_MOD_CAPTCHA';
$modversion['config'][$i]['description'] = 'MPU_MOD_CAPTCHA_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = function_exists('imagecreate') ? 1 : 0;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_canedit';
$modversion['config'][$i]['title']       = 'MPU_MOD_CANEDIT';
$modversion['config'][$i]['description'] = 'MPU_MOD_CANEDIT_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_cancreate';
$modversion['config'][$i]['title']       = 'MPU_MOD_CANCREATE';
$modversion['config'][$i]['description'] = 'MPU_MOD_CANCREATE_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
++$i;
$modversion['config'][$i]['name']        = 'mpu_conf_candelete';
$modversion['config'][$i]['title']       = 'MPU_MOD_CANDELETE';
$modversion['config'][$i]['description'] = 'MPU_MOD_CANDELETE_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
