<?php
namespace Smartx_Plugin_Boilerplate_Generator;

use Smartx_Plugin_Boilerplate\Helper as Helper;

class Generator{

    private $plugin_name = '';
    private $plugin_slug = '';
    private $default_plugin_uri = 'https://github.com/sadiqhussainrajani/smartx-plugin-boilerplate';
    private $plugin_uri = '';
    private $default_author_name = 'Sadiq Hussain Rajani';
    private $author_name = '';
    private $default_author_uri = 'https://github.com/sadiqhussainrajani/';
    private $author_uri = '';
    private $source = 'vendor/smartx-plugin-boilerplate';
    private $source_name = 'smartx-plugin-boilerplate';

    function __construct($name,$slug = "",$plugin_uri="",$author_name="",$author_uri="")
    {
        $this->plugin_name = $name;
        $this->plugin_slug = $slug != "" ? Helper::getSlug($slug) : Helper::getSlug($name);
        $this->plugin_uri = $plugin_uri != "" ? $plugin_uri : $this->default_plugin_uri;
        $this->author_name = $author_name != "" ? $author_name : $this->default_author_name;
        $this->author_uri = $author_uri != "" ? $author_uri : $this->default_author_uri;
    }

    public function generate()
    {
        $source = $this->source;
        $destination = BASE_DIR.$this->plugin_slug;
        $this->recurse_copy($source, $destination);

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($this->plugin_slug . '.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($destination, 1),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $key => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($destination) + 1);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        // or however you get the path
        $yourfile = $destination . '.zip';

        $file_name = basename($yourfile);

        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($yourfile));

        readfile($yourfile);
        unlink($yourfile);
        $this->delete_directory($destination);
        exit;
    }

    public function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file)) {
                    unlink($dirname . "/" . $file);
                }else{
                    $this->delete_directory($dirname . '/' . $file);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    protected function recurse_copy($source, $destination,$first = true)
    {
        $dir = opendir($source);
        @mkdir($destination);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($source . '/' . $file)) {
                    if ($file != ".git") {
                        $this->recurse_copy($source . '/' . $file, $destination . '/' . $file,false);
                    }
                } else {
                    if ($file != "README.md") {
                        $file_copy = str_replace($this->source_name, $this->plugin_slug, $file);
                        $file_copy = str_replace(str_replace('_','',Helper::getPrefix($this->source_name)), str_replace('_','',Helper::getPrefix($this->plugin_slug)), $file_copy);
                        copy($source . '/' . $file, $destination . '/' . $file_copy);
                        
                        //Human Friendly Name
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getHumanFriendly($this->source_name), Helper::getHumanFriendly($this->plugin_name), file_get_contents($destination . '/' . $file_copy)));
                        //Slug
                        @file_put_contents($destination . '/' . $file_copy, str_replace($this->source_name, $this->plugin_slug, file_get_contents($destination . '/' . $file_copy)));
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getSlug($this->source_name, false), Helper::getSlug($this->plugin_name, false), file_get_contents($destination . '/' . $file_copy)));
                        //class names
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getClassName($this->source_name), Helper::getClassName($this->plugin_name), file_get_contents($destination . '/' . $file_copy)));
                        //Snake Cases - Plugin Name
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getSnakeCase($this->source_name), Helper::getSnakeCase($this->plugin_name), file_get_contents($destination . '/' . $file_copy)));
                        //Change Prefix
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getPrefix($this->source_name), Helper::getPrefix($this->plugin_name), file_get_contents($destination . '/' . $file_copy))); //Lowercase
                        @file_put_contents($destination . '/' . $file_copy, str_replace(Helper::getPrefix($this->source_name,true), Helper::getPrefix($this->plugin_name,true), file_get_contents($destination . '/' . $file_copy))); //Uppercase
                        @file_put_contents($destination . '/' . $file_copy, str_replace(str_replace('_','',Helper::getPrefix($this->source_name)), str_replace('_','',Helper::getPrefix($this->plugin_name)), file_get_contents($destination . '/' . $file_copy))); //Lowercase
                        @file_put_contents($destination . '/' . $file_copy, str_replace(str_replace('_','',Helper::getPrefix($this->source_name,true)), str_replace('_','',Helper::getPrefix($this->plugin_name,true)), file_get_contents($destination . '/' . $file_copy))); //Uppercase
                    }
                }
            }
        }
        
        $plugin_main_file = $destination . '/' . $this->plugin_slug . '.php';
        if ($first){
            @file_put_contents($plugin_main_file, preg_replace('/( * Plugin URI: (.*?)$)/m',' Plugin URI:        '.$this->plugin_uri,file_get_contents($plugin_main_file)));
            @file_put_contents($plugin_main_file, preg_replace('/( * Author URI: (.*?)$)/m',' Author URI:        '.$this->author_uri,file_get_contents($plugin_main_file)));
            @file_put_contents($plugin_main_file, preg_replace('/( * Author: (.*?)$)/m',' Author:            '.$this->author_name,file_get_contents($plugin_main_file)));
        }

        closedir($dir);
    }
}