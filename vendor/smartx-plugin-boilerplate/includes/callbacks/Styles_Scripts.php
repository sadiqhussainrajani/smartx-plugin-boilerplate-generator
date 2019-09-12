<?php
namespace Smartx_Plugin_Boilerplate\Callbacks;

use Smartx_Plugin_Boilerplate\Helper as Helper;

/**
 * This class is used to add styles and scripts in wordpress.
 * 
 * @since 1.0
 */
class Styles_Scripts{

    /**
     * Add Styles on Frontend Website
     * 
     * @since 1.0
     */

    public function frontendStyles()
    {
        wp_enqueue_style('spb',SPB_PLUGIN_URL.'/resources/css/spb.css',array(),NULL,'all');
    }

    /**
     * Add Styles on Admin Panel
     * 
     * @since 1.0
     */

    public function BackendStyles()
    {
        wp_enqueue_style('spb-admin',SPB_PLUGIN_URL.'/resources/css/admin/spb-admin.css',array(),NULL,'all');
    }

    /**
     * Add Scripts on Frontend Website
     * 
     * @since 1.0
     */

    public function frontendScripts()
    {
        wp_enqueue_script('spb',SPB_PLUGIN_URL.'/resources/js/spb.js',array('jquery'),NULL,true);
    }

    /**
     * Add Scripts on Admin Panel
     * 
     * @since 1.0
     */

    public function BackendScripts()
    {
        wp_enqueue_script('spb-admin',SPB_PLUGIN_URL.'/resources/js/admin/spb-admin.js',array('jquery'),NULL,true);
    }
}