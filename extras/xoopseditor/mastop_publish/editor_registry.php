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
 * @copyright    {@link https://xoops.org/ XOOPS Project}
 * @license      {@link http://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package
 * @since
 * @author       XOOPS Development Team, phppp (D.J.)
 */

$current_path = __FILE__;
if (DIRECTORY_SEPARATOR !== '/') {
    $current_path = str_replace(strpos($current_path, "\\\\", 2) ? "\\\\" : DIRECTORY_SEPARATOR, '/', $current_path);
}
$root_path = dirname($current_path);

return $config = array(
    'name'  => 'mastop_publish',
    'class' => 'XoopsFormMPublishTextArea',
    'file'  => $root_path . '/formmpublishtextarea.php',
    'title' => 'mastop_publish',
    'order' => 5
);
