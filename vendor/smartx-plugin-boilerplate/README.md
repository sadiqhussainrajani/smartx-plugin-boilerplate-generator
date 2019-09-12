# Smartx Wordpress Plugin Boilerplate
This is an OOP based WordPress plugin boilerplate with namespaces &amp; composer auto load classes

## Constants
**SPB_PLUGIN_PATH**     -> Used to get path of the plugin directory

**SPB_PLUGIN_URL**      -> Used to get url of the plugin directory

**SPB_PREFIX**          -> Used to print prefix of the plugin (Recommended for PostTypes, Post Metas, Database Tables etc) spb_

**SPB_PLUGIN_NAME**     -> Used to print name of the plugin to use as key - smartx_plugin_boilerplate

**SPB_PLUGIN_TITLE**    -> Used to print title of the plugin ( Human Friendly Version of a name ) - Smartx Plugin Boilerplate

**SPB_TEXT_DOMAIN**     -> Used to get Text Domain of a plugin for used in language translations - smartx-plugin-boilerplate

**SPB_AJAX_URL**        -> Used to get ajax url in wordpress - site_url/wp-admin/admin-ajax.php


## Add Action Hooks
In ***includes/Initialize.php*** you can find ***addActions()*** method. use `$this->loader->addAction('your_action',$class,'yourCallbackMethod');` to load your action and create action callback method in ***includes/callbacks/Actions.php***

## Add Ajax Action Hooks
In ***includes/Initialize.php*** you can find ***addAjaxActions()*** method. use `$this->loader->addAction('your_wp_action',$class,'yourCallbackMethod');` to load your ajax action and create ajax action callback method in ***includes/callbacks/Ajax.php***

## Add Filter Hooks
In ***includes/Initialize.php*** you can find ***addFilters()*** method. use `$this->loader->addFilter('your_filter',$class,'yourCallbackMethod');` to load your filter and create filter callback method in ***includes/callbacks/Filters.php***

## Add Shortcodes
In ***includes/Initialize.php*** you can find ***addShortcodes()*** method. use `$this->loader->addShortcode('your_shortcode',$class,'yourCallbackMethod');` to load your shortcode and create shortcode callback method in ***includes/callbacks/Shortcodes.php***

## Add Styles
In ***includes/callbacks/Styles_Scripts.php*** you can find ***frontendStyles()*** method to add stylesheet on frontend and ***backendStyles()*** method to add stylesheet on backend.

## Add Scripts
In ***includes/callbacks/Styles_Scripts.php*** you can find ***frontendScripts()*** method to add script on frontend and ***backendScripts()*** method to add script on backend.
