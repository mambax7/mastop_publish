<?php
### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Manutenção Individual de Blocos e Grupos
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2007
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================
require_once __DIR__ . '/admin_header.php';
if (!is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin($xoopsModule->mid())) {
    exit(MPU_ADM_403);
}
if ($xoopsUser->isAdmin($xoopsModule->mid())) {
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    $op = 'list';
    if (isset($_POST)) {
        foreach ($_POST as $k => $v) {
            $$k = $v;
        }
    }

    if (isset($_GET['op'])) {
        if ('edit' === $_GET['op'] || 'delete' === $_GET['op'] || 'delete_ok' === $_GET['op'] || 'clone' === $_GET['op']) {
            $op  = $_GET['op'];
            $bid = \Xmf\Request::getInt('bid', 0, 'GET');
        }
    }
    function listar_blocos()
    {
        global $xoopsUser, $xoopsConfig, $xoopsModule;
        require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        if (file_exists(XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php')) {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php';
        //include_once(XOOPS_ROOT_PATH."/modules/system/language/".$xoopsConfig['language']."/admin/groups.php");
        } else {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/blocksadmin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/groups.php';
        }
        /** @var XoopsModuleHandler $moduleHandler */
        $moduleHandler     = xoops_getHandler('module');
        $memberHandler     = xoops_getHandler('member');
        $modulepermHandler = xoops_getHandler('groupperm');
        $groups            = $memberHandler->getGroups();
        $criteria          = new \CriteriaCompo(new \Criteria('hasmain', 1));
        $criteria->add(new \Criteria('isactive', 1));
        $module_list     = $moduleHandler->getList($criteria);
        $module_list[-1] = _AM_TOPPAGE;
        $module_list[0]  = _AM_ALLPAGES;
        ksort($module_list);
        echo "
        <h4 style='text-align:left;'>" . MPU_MOD_NOME . ' - ' . _AM_BADMIN . '</h4>';
        $moduleHandler = xoops_getHandler('module');
        echo "<form action='" . $_SERVER['PHP_SELF'] . "' name='blockadmin' method='post'>";
        echo $GLOBALS['xoopsSecurity']->getTokenHTML();
        echo "<table width='100%' class='outer' cellpadding='4' cellspacing='1'>
        <tr valign='middle'><th align='center'>"
             . _AM_TITLE
             . "</th><th align='center' nowrap='nowrap'>"
             . _AM_SIDE
             . '<br>'
             . _LEFT
             . '-'
             . _CENTER
             . '-'
             . _RIGHT
             . "</th><th align='center'>"
             . _AM_WEIGHT
             . "</th><th align='center'>"
             . _AM_VISIBLE
             . "</th><th align='center'>"
             . _AM_VISIBLEIN
             . "</th><th align='center'>"
             . MPU_ADM_GRUPOS
             . "</th><th align='center'>"
             . _AM_ACTION
             . '</th></tr>
        ';
        $block_arr   = \XoopsBlock::getByModule($xoopsModule->mid());
        $block_count = count($block_arr);
        $class       = 'even';
        foreach ($block_arr as $i) {
            $groups_perms = $modulepermHandler->getGroupIds('block_read', $i->getVar('bid'));
            $sql          = 'SELECT module_id FROM ' . $db->prefix('block_module_link') . ' WHERE block_id=' . $i->getVar('bid');
            $result       = $db->query($sql);
            $modules      = [];
            while (false !== ($row = $db->fetchArray($result))) {
                $modules[] = (int)$row['module_id'];
            }
            $sel0 = $sel1 = $ssel0 = $ssel1 = $ssel2 = $ssel3 = $ssel4 = $ssel5 = $ssel6 = $ssel7 = '';
            if (1 == $i->getVar('visible')) {
                $sel1 = ' checked';
            } else {
                $sel0 = ' checked';
            }
            if (XOOPS_SIDEBLOCK_LEFT == $i->getVar('side')) {
                $ssel0 = ' checked';
            } elseif (XOOPS_SIDEBLOCK_RIGHT == $i->getVar('side')) {
                $ssel1 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_LEFT == $i->getVar('side')) {
                $ssel2 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_RIGHT == $i->getVar('side')) {
                $ssel4 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_CENTER == $i->getVar('side')) {
                $ssel3 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_BOTTOMLEFT == $i->getVar('side')) {
                $ssel5 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_BOTTOMRIGHT == $i->getVar('side')) {
                $ssel6 = ' checked';
            } elseif (XOOPS_CENTERBLOCK_BOTTOM == $i->getVar('side')) {
                $ssel7 = ' checked';
            }
            if ('' == $i->getVar('title')) {
                $title = '&nbsp;';
            } else {
                $title = $i->getVar('title');
            }
            $name = $i->getVar('name');
            echo "<tr valign='top'><td class='$class' align='center'><input type='text' name='title["
                 . $i->getVar('bid')
                 . "]' value='"
                 . $title
                 . "'></td><td class='$class' align='center' nowrap='nowrap'>
                    <div align='center' >
                    <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_LEFT
                 . "'$ssel2>
                        <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_CENTER
                 . "'$ssel3>
                    <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_RIGHT
                 . "'$ssel4>
                    </div>
                    <div>
                        <span style='float:right'><input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_SIDEBLOCK_RIGHT
                 . "'$ssel1></span>
                    <div align='left'><input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_SIDEBLOCK_LEFT
                 . "'$ssel0></div>
                    </div>
                    <div align='center'>
                    <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_BOTTOMLEFT
                 . "'$ssel5>
                        <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_BOTTOM
                 . "'$ssel7>
                    <input type='radio' name='side["
                 . $i->getVar('bid')
                 . "]' value='"
                 . XOOPS_CENTERBLOCK_BOTTOMRIGHT
                 . "'$ssel6>
                    </div>
                </td><td class='$class' align='center'><input type='text' name='weight["
                 . $i->getVar('bid')
                 . "]' value='"
                 . $i->getVar('weight')
                 . "' size='5' maxlength='5'></td><td class='$class' align='center' nowrap><input type='radio' name='visible["
                 . $i->getVar('bid')
                 . "]' value='1'$sel1>"
                 . _YES
                 . "&nbsp;<input type='radio' name='visible["
                 . $i->getVar('bid')
                 . "]' value='0'$sel0>"
                 . _NO
                 . '</td>';

            echo "<td class='$class' align='center'><select size='5' name='bmodule[" . $i->getVar('bid') . "][]' id='bmodule[" . $i->getVar('bid') . "][]' multiple='multiple'>";
            foreach ($module_list as $k => $v) {
                echo "<option value='$k'" . (in_array($k, $modules) ? ' selected' : '') . ">$v</option>";
            }
            echo '</select></td>';

            echo "<td class='$class' align='center'><select size='5' name='groups[" . $i->getVar('bid') . "][]' id='groups[" . $i->getVar('bid') . "][]' multiple='multiple'>";
            foreach ($groups as $grp) {
                echo "<option value='" . $grp->getVar('groupid') . "' " . (in_array($grp->getVar('groupid'), $groups_perms) ? ' selected' : '') . '>' . $grp->getVar('name') . '</option>';
            }
            echo '</select></td>';

            echo "<td class='$class' align='center'><a href='" . XOOPS_URL . '/modules/system/admin.php?fct=blocksadmin&amp;op=edit&amp;bid=' . $i->getVar('bid') . "'>" . _EDIT . "</a> <a href='blocksadmin.php?op=clone&amp;bid=" . $i->getVar('bid') . "'>" . _CLONE . '</a>';
            if ('S' !== $i->getVar('block_type') && 'M' !== $i->getVar('block_type')) {
                echo "&nbsp;<a href='" . XOOPS_URL . '/modules/system/admin.php?fct=blocksadmin&amp;op=delete&amp;bid=' . $i->getVar('bid') . "'>" . _DELETE . '</a>';
            }
            echo "
            <input type='hidden' name='oldtitle[" . $i->getVar('bid') . "]' value='" . $i->getVar('title') . "'>
            <input type='hidden' name='oldside[" . $i->getVar('bid') . "]' value='" . $i->getVar('side') . "'>
            <input type='hidden' name='oldweight[" . $i->getVar('bid') . "]' value='" . $i->getVar('weight') . "'>
            <input type='hidden' name='oldvisible[" . $i->getVar('bid') . "]' value='" . $i->getVar('visible') . "'>
            <input type='hidden' name='bid[" . $i->getVar('bid') . "]' value='" . $i->getVar('bid') . "'>
            </td></tr>
            ";
            $class = ('even' === $class) ? 'odd' : 'even';
        }
        echo "<tr><td class='foot' align='center' colspan='7'>
        <input type='hidden' name='op' value='order'>
        " . $GLOBALS['xoopsSecurity']->getTokenHTML() . "
        <input type='submit' name='submit' value='" . _SUBMIT . "'>
        </td></tr></table>
        </form>
        <br><br>";
    }

    function clone_block($bid)
    {
        global $xoopsConfig;
        if (file_exists(XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php')) {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php';
        //include_once(XOOPS_ROOT_PATH."/modules/system/language/".$xoopsConfig['language']."/admin/groups.php");
        } else {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/blocksadmin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/groups.php';
        }
        //mpu_adm_menu();
        $myblock = new \XoopsBlock($bid);
        $db      = \XoopsDatabaseFactory::getDatabaseConnection();
        $sql     = 'SELECT module_id FROM ' . $db->prefix('block_module_link') . ' WHERE block_id=' . (int)$bid;
        $result  = $db->query($sql);
        $modules = [];
        while (false !== ($row = $db->fetchArray($result))) {
            $modules[] = (int)$row['module_id'];
        }
        $is_custom = ('C' === $myblock->getVar('block_type') || 'E' === $myblock->getVar('block_type')) ? true : false;
        $block     = [
            'title'      => $myblock->getVar('title') . ' Clone',
            'form_title' => _AM_CLONEBLOCK,
            'name'       => $myblock->getVar('name'),
            'side'       => $myblock->getVar('side'),
            'weight'     => $myblock->getVar('weight'),
            'visible'    => $myblock->getVar('visible'),
            'content'    => $myblock->getVar('content', 'N'),
            'modules'    => $modules,
            'is_custom'  => $is_custom,
            'ctype'      => $myblock->getVar('c_type'),
            'cachetime'  => $myblock->getVar('bcachetime'),
            'op'         => 'clone_ok',
            'bid'        => $myblock->getVar('bid'),
            'edit_form'  => $myblock->getOptions(),
            'template'   => $myblock->getVar('template'),
            'options'    => $myblock->getVar('options')
        ];
        echo '<a href="blocksadmin.php">' . _AM_BADMIN . '</a>&nbsp;<span style="font-weight:bold;">&raquo;&raquo;</span>&nbsp;' . _AM_CLONEBLOCK . '<br><br>';
        include __DIR__ . '/blockform.php';
        $form->display();
        xoops_cp_footer();
        exit();
    }

    function clone_block_ok($bid, $bside, $bweight, $bvisible, $bcachetime, $bmodule, $options)
    {
        global $xoopsUser, $xoopsConfig;
        if (file_exists(XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php')) {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/' . $xoopsConfig['language'] . '/admin/blocksadmin.php';
        //include_once(XOOPS_ROOT_PATH."/modules/system/language/".$xoopsConfig['language']."/admin/groups.php");
        } else {
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/blocksadmin.php';
            require_once XOOPS_ROOT_PATH . '/modules/system/language/portuguesebr/admin/groups.php';
        }
        $block = new \XoopsBlock($bid);
        $clone =& $block->xoopsClone();
        if (empty($bmodule)) {
            xoops_cp_header();
            xoops_error(sprintf(_AM_NOTSELNG, _AM_VISIBLEIN));
            xoops_cp_footer();
            exit();
        }
        $clone->setVar('side', $bside);
        $clone->setVar('weight', $bweight);
        $clone->setVar('visible', $bvisible);
        //$clone->setVar('content', $_POST['bcontent']);
        $clone->setVar('title', $_POST['btitle']);
        $clone->setVar('bcachetime', $bcachetime);
        if (isset($options) && (count($options) > 0)) {
            $options = implode('|', $options);
            $clone->setVar('options', $options);
        }
        $clone->setVar('bid', 0);
        if ('C' === $block->getVar('block_type') || 'E' === $block->getVar('block_type')) {
            $clone->setVar('block_type', 'E');
        } else {
            $clone->setVar('block_type', 'D');
        }
        $newid = $clone->store();
        if (!$newid) {
            xoops_cp_header();
            $clone->getHtmlErrors();
            xoops_cp_footer();
            exit();
        }
        if ('' != $clone->getVar('template')) {
            $tplfileHandler = xoops_getHandler('tplfile');
            $btemplate      = $tplfileHandler->find($GLOBALS['xoopsConfig']['template_set'], 'block', $bid);
            if (count($btemplate) > 0) {
                $tplclone =& $btemplate[0]->xoopsClone();
                $tplclone->setVar('tpl_id', 0);
                $tplclone->setVar('tpl_refid', $newid);
                $tplfileHandler->insert($tplclone);
            }
        }
        $db = \XoopsDatabaseFactory::getDatabaseConnection();
        foreach ($bmodule as $bmid) {
            $sql = 'INSERT INTO ' . $db->prefix('block_module_link') . ' (block_id, module_id) VALUES (' . $newid . ', ' . $bmid . ')';
            $db->query($sql);
        }
        $groups =& $xoopsUser->getGroups();
        $count  = count($groups);
        for ($i = 0; $i < $count; ++$i) {
            $sql = 'INSERT INTO ' . $db->prefix('group_permission') . ' (gperm_groupid, gperm_itemid, gperm_modid, gperm_name) VALUES (' . $groups[$i] . ', ' . $newid . ", 1, 'block_read')";
            $db->query($sql);
        }
        redirect_header('blocksadmin.php?op=listar', 1, _AM_DBUPDATED);
    }

    function setar_ordem($bid, $title, $weight, $visible, $side)
    {
        $myblock = new \XoopsBlock($bid);
        $myblock->setVar('title', $title);
        $myblock->setVar('weight', $weight);
        $myblock->setVar('visible', $visible);
        $myblock->setVar('side', $side);
        $myblock->store();
    }

    if ('list' === $op) {
        //mpu_adm_menu();
        listar_blocos();
        xoops_cp_footer();
        exit();
    }

    if ('order' === $op) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($_SERVER['PHP_SELF'], 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        foreach (array_keys($bid) as $i) {
            if ($oldtitle[$i] != $title[$i] || $oldweight[$i] != $weight[$i] || $oldvisible[$i] != $visible[$i]
                || $oldside[$i] != $side[$i]) {
                setar_ordem($bid[$i], $title[$i], $weight[$i], $visible[$i], $side[$i], $bmodule[$i]);
            }
            if (!empty($bmodule[$i]) && count($bmodule[$i]) > 0) {
                $sql = sprintf('DELETE FROM `%s` WHERE block_id = %u', $xoopsDB->prefix('block_module_link'), $bid[$i]);
                $xoopsDB->query($sql);
                if (in_array(0, $bmodule[$i])) {
                    $sql = sprintf('INSERT INTO %s (block_id, module_id) VALUES (%u, %d)', $xoopsDB->prefix('block_module_link'), $bid[$i], 0);
                    $xoopsDB->query($sql);
                } else {
                    foreach ($bmodule[$i] as $bmid) {
                        $sql = sprintf('INSERT INTO %s (block_id, module_id) VALUES (%u, %d)', $xoopsDB->prefix('block_module_link'), $bid[$i], (int)$bmid);
                        $xoopsDB->query($sql);
                    }
                }
            }
            $sql = sprintf('DELETE FROM `%s` WHERE gperm_itemid = %u', $xoopsDB->prefix('group_permission'), $bid[$i]);
            $xoopsDB->query($sql);
            if (!empty($groups[$i])) {
                foreach ($groups[$i] as $grp) {
                    $sql = sprintf("INSERT INTO %s (gperm_groupid, gperm_itemid, gperm_modid, gperm_name) VALUES (%u, %u, 1, 'block_read')", $xoopsDB->prefix('group_permission'), $grp, $bid[$i]);
                    $xoopsDB->query($sql);
                }
            }
        }
        redirect_header($_SERVER['PHP_SELF'], 1, MPU_ADM_SUCESS2);
    }
    if ('clone' === $op) {
        clone_block($bid);
    }

    if ('clone_ok' === $op) {
        clone_block_ok($bid, $bside, $bweight, $bvisible, $bcachetime, $bmodule, $options);
    }
} else {
    echo MPU_ADM_403;
}
