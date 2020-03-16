<?php

require_once 'lib/Autoloader.php';

use router\RouterManager;
use lib\files_tools\FilePathManager;
use lib\files_tools\FileUrlManager;


$request_manager = new RouterManager();
$request = $request_manager->getRequestController($_SERVER['REQUEST_URI']);

$controller_file_path = FilePathManager::getRootControllersPath();

$js_url_path = FileUrlManager::getRootJsPath();
$css_url_path = FileUrlManager::getRootCssPath();

?>
<html>
    <head>
        <title>Elavator Simulator</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" content="text/html; charset=UTF-8" />
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!--Jquery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <link type="text/css" rel="stylesheet" href="<?php echo $css_url_path.$request.'.css' ?>" />
        <script src="<?php echo $js_url_path.$request.'.js'; ?>"></script>
    </head>
    <body>
        <?php
            if(false === $request){
                require FilePathManager::getRootViewsPath().'page_not_found.php';
                $new_failed_request = new PageNotFound();
                $new_failed_request->getRenderPageNotFound();
            }else{
                require $controller_file_path.$request.'_controller.php';
            }
        ?>
    </body>
</html>

