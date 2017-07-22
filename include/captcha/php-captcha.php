<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Imagem de CAPTCHA
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
if (file_exists(dirname(dirname(dirname(dirname(__DIR__)))) . '/mainfile.php')) {
    require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/mainfile.php';
} elseif (file_exists(__DIR__ . '/../../../mainfile.php')) {
    require_once __DIR__ . '/../../../mainfile.php';
}
$xoopsLogger->activated = false;
require_once XOOPS_ROOT_PATH . '/header.php';
require_once __DIR__ . '/php-captcha.inc.php';
$aFonts      = array('fonts/font1.ttf', 'fonts/font2.ttf', 'fonts/font3.ttf');
$oPhpCaptcha = new PhpCaptcha($aFonts, 200, 50);
$oPhpCaptcha->SetBackgroundImages('captcha.jpg');
$oPhpCaptcha->SetOwnerText($xoopsConfig['sitename']);
$oPhpCaptcha->Create();
