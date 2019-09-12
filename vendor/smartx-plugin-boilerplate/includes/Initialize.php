<?php
namespace Smartx_Plugin_Boilerplate;

use Smartx_Plugin_Boilerplate\Loader as Loader;
use Smartx_Plugin_Boilerplate\Helper as Helper;

use Smartx_Plugin_Boilerplate\Callbacks\Actions as Action_Callback;
use Smartx_Plugin_Boilerplate\Callbacks\Filters as Filter_Callback;
use Smartx_Plugin_Boilerplate\Callbacks\Ajax as Ajax_Callback;
use Smartx_Plugin_Boilerplate\Callbacks\Shortcodes as Shortcode_Callback;
use Smartx_Plugin_Boilerplate\Callbacks\Styles_Scripts as Styles_Scripts;

/**
 * This class is used to add all dependencies like action hooks, filter hooks and shortcodes.
 * 
 * @since 1.0
 */
class Initialize
{
    /**
     * Class Constructor
     * 
     * @since 1.0
     */
    function __construct()
    {
        $this->loader = new Loader();
        $this->addActions();
        $this->addAjaxActions();
        $this->addFilters();
        $this->addShortcodes();
        $this->addStylesScripts();
    }

    /**
     * Add Action Hooks by passing it to loader class
     * 
     * @since 1.0
     */
    public function addActions()
    {
        $class = new Action_Callback();
        $this->loader->addAction('plugins_loaded',$class,'loadPluginTextDomain');
    }

    /**
     * Add Ajax Action Hooks by passing it to loader class
     * 
     * @since 1.0
     */
    public function addAjaxActions()
    {
        $class = new Ajax_Callback();
        //$this->loader->addAction('ajax',$class,'callbackFunction');
    }

    /**
     * Add Filter Hooks by passing it to loader class
     * 
     * @since 1.0
     */
    public function addFilters()
    {
        $class = new Filter_Callback();
        //$this->loader->addFilter('filter',$class,'callbackFunction');
    }

    /**
     * Add Shortcodes by passing it to loader class
     * 
     * @since 1.0
     */
    public function addShortcodes()
    {
        $class = new Shortcode_Callback();
        //$this->loader->addShortcode('shortcode',$class,'callbackFunction');
    }

    /**
     * Add Styles and scripts in wordpress
     * 
     * @since 1.0
     */
    public function addStylesScripts()
    {
        $class = new Styles_Scripts();
        
        $this->loader->addAction('wp_enqueue_scripts',$class,'frontendStyles');
        $this->loader->addAction('wp_enqueue_scripts',$class,'frontendScripts');

        $this->loader->addAction('admin_enqueue_scripts',$class,'backendStyles');
        $this->loader->addAction('admin_enqueue_scripts',$class,'backendScripts');
    }

    /**
     * Run the loader to run all dependencies
     * 
     * @since 1.0
     */
    public function run()
    {
        $this->loader->run();
    }
    
}