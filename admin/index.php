<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project (https://xoops.org)
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject = \Xmf\Module\Admin::getInstance();
//-----------------------
// $xpPartnerHandler = xoops_getModuleHandler('partners', $xoopsModule->getVar('dirname'));

// $totalPartners = $xpPartnerHandler->getCount();
// $totalNonActivePartners = $xpPartnerHandler->getCount(new Criteria('status', 0, '='));
// $totalActivePartners = $totalPartners - $totalNonActivePartners;

// $adminObject->addInfoBox(_MD_XPARTNERS_DASHBOARD);

// $adminObject->addInfoBoxLine(_MD_XPARTNERS_DASHBOARD, "<infolabel>" ._MD_XPARTNERS_TOTALACTIVE. "</infolabel>", $totalActivePartners, 'Green');
// $adminObject->addInfoBoxLine(_MD_XPARTNERS_DASHBOARD,  "<infolabel>" ._MD_XPARTNERS_TOTALNONACTIVE. "</infolabel>", $totalNonActivePartners, 'Red');
// $adminObject->addInfoBoxLine(_MD_XPARTNERS_DASHBOARD,  "<infolabel>" ._MD_XPARTNERS_TOTALPARTNERS. "</infolabel><infotext>", $totalPartners."</infotext>");
//----------------------------

$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayIndex();

require_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
