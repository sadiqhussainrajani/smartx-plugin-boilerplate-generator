<?php
namespace Smartx_Plugin_Boilerplate;

/**
 * This class is used to load all dependencies like action hooks, filter hooks and shortcodes.
 * 
 * @since 1.0
 */
class Loader{

    private $actions;
    private $filters;
    private $shortcodes;

    /**
     * Class Constructor
     * 
     * @since 1.0
     */
    function __construct()
    {
        $this->actions = array();
        $this->filters = array();
        $this->shortcodes = array();
    }

    /**
     * Add Action Hooks
     * 
     * @since 1.0
     */
    public function addAction( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

    /**
     * Add Filter Hooks
     * 
     * @since 1.0
     */
    public function addFilter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

    /**
     * Add Shortcodes
     * 
     * @since 1.0
     */
    public function addShortcode( $shortcode, $component, $callback )
    {
        $this->shortcodes[$shortcode] = array('component'=>$component,'callback'=>$callback);
    }

    /**
     * Add Method For Action and Filter Hooks
     * 
     * @since 1.0
     */
    private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);
		return $hooks;
	}

    /**
     * Add all hooks and Shortcodes into wordpress
     * 
     * @since 1.0
     */
    public function run()
    {
        foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

        foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

        foreach ( $this->shortcodes as $shortcode => $hook ) {
            add_shortcode( $shortcode, array( $hook['component'], $hook['callback'] ) );
        }
    }
}