<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Arquivo que gera a lista de imagens para exibir no Option
### List do TinyMCE
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
require_once __DIR__ . '/../../../mainfile.php';
require_once __DIR__ . '../admin/admin_header.php';
$xoopsLogger->activated = false;
$ret = '';
if (!is_object($xoopsUser) || !$xoopsUserIsAdmin) {
    die('Oops!');
}
$criterio = new \CriteriaCompo(new \Criteria('fil_12_exibir', 1));
$criterio->setSort('fil_30_nome');
$fil_classe = new FilFiles();
$files = $fil_classe->PegaTudo($criterio);
if ($fil_classe->total > 0) {
    foreach ($files as $fil) {
        $ext = ('.' === substr($fil->getVar('fil_30_arquivo'), -4, 1)) ? substr($fil->getVar('fil_30_arquivo'), -4) : substr($fil->getVar('fil_30_arquivo'), -5);
        $ret .= '["' . $fil->getVar('fil_30_nome') . '  (' . $ext . ')", "' . MPU_FILES_URL . '/' . $fil->getVar('fil_30_arquivo') . '"],';
    }
    $ret = substr($ret, 0, -1);
}
?>
var tinyMCELinkList = new Array(
    <?=$ret;?>
);
