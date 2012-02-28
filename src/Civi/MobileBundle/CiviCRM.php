<?php

namespace Civi\MobileBundle;

class CiviCRM {
    function __construct( $settingsPath ) {
        // set error_reporting to prevent S2 errors
        error_reporting( 3 );

        if ( ! file_exists( $settingsPath ) ) {
            echo "civicrm.settings.php file does not exist here: $settingsPath. Please fix!<p>";
            exit( );
        }

        require_once $settingsPath;
        require_once 'CRM/Core/Config.php';

        $config = \CRM_Core_Config::singleton( );
    }
}
