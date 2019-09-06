<?php

define('BASE_DIR', dirname(__FILE__) . "/");
include_once(BASE_DIR . 'vendor/autoload.php');

use Smartx_Plugin_Boilerplate_Generator\Generator as Generator;

$error = false;
if (isset($_POST) && !empty($_POST)) {
    if (!isset($_POST['plugin_name']) || $_POST['plugin_name'] == "") {
        $error_pluginname = 'Plugin Name is required';
        $error = true;
    } else {
        $name = $_POST['plugin_name'];
        $slug = $_POST['plugin_slug'];
        $plugin_uri = $_POST['plugin_uri'];
        $author_name = $_POST['author_name'];
        $author_uri = $_POST['author_uri'];
        $generate = new Generator($name,$slug,$plugin_uri,$author_name,$author_uri);
        $generate->generate();
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Wordpress Plugin Boilerplate Generator - Smartx</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
    </head>

    <body>
        <div class="user">
            <header class="user__header">
                <img src="images/logo.svg" alt="" />
                <h1 class="user__title">Wordpress Plugin Boilerplate Generator <br>By - Smartx</h1>
            </header>

            <form class="form" action="" method="post">
                <div class="form__group">
                    <input type="text" name="plugin_name" placeholder="Plugin Name *" class="form__input" />
                    <?php echo $error && $error_pluginname ? '<span class="error">' . $error_pluginname . '</span>' : ''; ?>
                </div>

                <div class="form__group">
                    <input type="text" name="plugin_slug" placeholder="Plugin Slug" class="form__input" />
                </div>

                <div class="form__group">
                    <input type="text" name="plugin_uri" placeholder="Plugin Url" class="form__input" />
                </div>

                <div class="form__group">
                    <input type="text" name="author_name" placeholder="Author Name" class="form__input" />
                </div>

                <div class="form__group">
                    <input type="text" name="author_uri" placeholder="Author Url" class="form__input" />
                </div>

                <input type="submit" class="btn" value="Download" />
            </form>
        </div>
    </body>
</html>