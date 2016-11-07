<?php
$path = dirname(dirname(dirname(__DIR__)));
include_once $path . '/mainfile.php';
include_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';

if (file_exists('../language/' . $xoopsConfig['language'] . '/modinfo.php')) {
    include_once '../language/' . $xoopsConfig['language'] . '/modinfo.php';
} else {
    include_once '../language/portuguesebr/modinfo.php';
}

include_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_mpb_mpublish.class.php';
include_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_med_media.class.php';
include_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_fil_files.class.php';
include_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/class/mpu_cfi_contentfiles.class.php';
include_once XOOPS_ROOT_PATH . '/modules/' . MPU_MOD_DIR . '/include/funcoes.inc.php';

global $xoopsModule;

$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);

$pathIcon16      = '../' . $xoopsModule->getInfo('icons16');
$pathIcon32      = '../' . $xoopsModule->getInfo('icons32');
$pathModuleAdmin = $xoopsModule->getInfo('dirmoduleadmin');

include_once $GLOBALS['xoops']->path($pathModuleAdmin . '/moduleadmin.php');
