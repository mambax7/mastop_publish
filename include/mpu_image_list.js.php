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
$xoopsLogger->activated = false;
$ret = '';
if (!is_object($xoopsUser)) {
    $group = [XOOPS_GROUP_ANONYMOUS];
} else {
    $group =& $xoopsUser->getGroups();
}
$imgcatHandler = xoops_getHandler('imagecategory');
$catlist = $imgcatHandler->getList($group, 'imgcat_read', 1);
$catcount = count($catlist);
if ($catcount > 0) {
    foreach ($catlist as $c_id => $c_name) {
        $ret          .= '["--- ' . $c_name . ' ---", ""],';
        $imageHandler = xoops_getHandler('image');
        $criteria     = new CriteriaCompo(new Criteria('imgcat_id', $c_id));
        $criteria->add(new Criteria('image_display', 1));
        $total = $imageHandler->getCount($criteria);
        if ($total > 0) {
            $imgcat    =& $imgcatHandler->get($c_id);
            $storetype = $imgcat->getVar('imgcat_storetype');
            if ('db' == $storetype) {
                $images = $imageHandler->getObjects($criteria, false, true);
            } else {
                $images = $imageHandler->getObjects($criteria, false, false);
            }
            $imgcount = count($images);
            for ($i = 0; $i < $imgcount; ++$i) {
                if ('db' == $storetype) {
                    $ret .= '["' . $images[$i]->getVar('image_nicename') . '", "' . XOOPS_URL . '/image.php?id=' . $images[$i]->getVar('image_id') . '"],';
                } else {
                    $ret .= '["' . $images[$i]->getVar('image_nicename') . '", "' . XOOPS_UPLOAD_URL . '/' . $images[$i]->getVar('image_name') . '"],';
                }
            }
        }
    }
    $ret = substr($ret, 0, -1);
}
?>
var tinyMCEImageList = new Array(
    <?=$ret;?>
);
