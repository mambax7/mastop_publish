<?php namespace XoopsModules\Mastoppublish;

use Xmf\Request;
use XoopsModules\Mastoppublish;
use XoopsModules\Mastoppublish\Common;

/**
 * Class Utility
 */
class Utility
{
    use Common\VersionChecks; //checkVerXoops, checkVerPhp Traits

    use Common\ServerStats; // getServerStats Trait

    use Common\FilesManagement; // Files Management Trait

    //--------------- Custom module methods -----------------------------
}
