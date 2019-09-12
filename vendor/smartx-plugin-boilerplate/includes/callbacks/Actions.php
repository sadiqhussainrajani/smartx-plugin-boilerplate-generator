<?php
namespace Smartx_Plugin_Boilerplate\Callbacks;

use Smartx_Plugin_Boilerplate\Helper as Helper;

/**
 * This class is used to add callbacks of a action hooks.
 * 
 * @since 1.0
 */
class Actions{

    /**
     * Run on plugins_loaded hook to load languages files
     * 
     * @since 1.0
     */
    public function loadPluginTextDomain()
    {
        load_plugin_textdomain( SPB_PLUGIN_NAME , false, SPB_PLUGIN_PATH . '/languages' );
    }
    
}