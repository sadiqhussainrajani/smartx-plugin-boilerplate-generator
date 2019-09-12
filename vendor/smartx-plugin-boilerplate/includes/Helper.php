<?php

namespace Smartx_Plugin_Boilerplate;

/**
 * This class is a helper class to create helper functions for plugin.
 * 
 * @since 1.0
 */
class Helper
{

    /**
     * Creates an url friendly slug like "book-name"
     *
     * @since 1.0
     */
    public static function getSlug($name)
    {

        // Name to lower case.
        $name = strtolower($name);
        // Replace spaces with hyphen.
        $name = str_replace(" ", "-", $name);
        // Replace underscore with hyphen.
        $name = str_replace("_", "-", $name);

        return $name;
    }

    /**
     * Creates sanke case like "book_name"
     *
     * @since 1.0
     */
    public static function getSnakeCase($name)
    {

        // Name to lower case.
        $name = strtolower($name);
        // Replace spaces with underscores.
        $name = str_replace(" ", "_", $name);
        // Replace dashes with underscores.
        $name = str_replace("-", "_", $name);

        return $name;
    }

    /**
     * Returns the friendly plural name like "Books"
     *
     * @since 1.0
     */
    public static function getPlural($name)
    {

        // Return the plural name. Add 's' to the end.
        return self::getHumanFriendly($name) . 's';
    }

    /**
     * Get human friendly name like "Book Name"
     * 
     * @since 1.0
     */
    public static function getHumanFriendly($name)
    {

        // Return human friendly name.
        return ucwords(strtolower(str_replace("-", " ", str_replace("_", " ", $name))));
    }

    /**
     * Returns the class friendly name like "Book_Name".
     *
     * @since 1.0
     */
    public static function getClassName($name)
    {

        // Return the name of Class in Studly_Caps
        return str_replace('-', '_', str_replace(' ', '_', self::getHumanFriendly($name)));
    }

    /**
     * Returns the prefix like "bn_".
     *
     * @since 1.0
     */
    public static function getPrefix($name, $upper = false)
    {

        // Return the name of Class in Studly_Caps
        $arr = explode(' ', str_replace('_', ' ', str_replace('-', ' ', $name)));
        $string = '';
        foreach ($arr as $key => $value) {
            $string .= $value[0];
        }
        $string .= '_';

        if ($upper) {
            $string = strtoupper($string);
        }

        return $string;
    }
}