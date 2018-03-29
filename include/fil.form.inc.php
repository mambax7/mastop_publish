<?php
### =============================================================
### Mastop InfoDigital - Paix�o por Internet
### =============================================================
### Formul�rio de Envio de M�dias
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
$fil_form = new \XoopsThemeForm($form['titulo'], 'mpu_fil_form', $_SERVER['PHP_SELF'], 'post', true);
$fil_form->setExtra('enctype="multipart/form-data"');
$fil_form->addElement(new \XoopsFormText(MPU_ADM_FIL_30_NOME, 'fil_30_nome', 50, 50, $fil_classe->getVar('fil_30_nome')), true);
$fil_arquivo  = new \XoopsFormFile('', 'fil_30_arquivo', $helper->getConfig('mpu_max_filesize') * 1024);
$arquivo_tray = new \XoopsFormElementTray(MPU_ADM_FIL_30_ARQUIVO, '&nbsp;');
$arquivo_tray->addElement($fil_arquivo);
$fil_form->addElement($arquivo_tray);
$fil_form->addElement(new \XoopsFormRadioYN(MPU_ADM_FIL_12_EXIBIR, 'fil_12_exibir', $fil_classe->getVar('fil_12_exibir')));
$fil_form->addElement(new \XoopsFormHidden('fil_10_id', $fil_classe->getVar('fil_10_id')));
$fil_form->addElement(new \XoopsFormHidden('op', $form['op']));
$fil_botoes_tray  = new \XoopsFormElementTray('', '&nbsp;&nbsp;');
$fil_botao_cancel = new \XoopsFormButton('', 'cancelar', _CANCEL);
$fil_botoes_tray->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$fil_botao_cancel->setExtra("onclick=\"document.location= '" . XOOPS_URL . '/modules/' . MPU_MOD_DIR . "/admin/files.php'\"");
$fil_botoes_tray->addElement($fil_botao_cancel);
$fil_form->addElement($fil_botoes_tray);
