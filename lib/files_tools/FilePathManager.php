<?php

namespace lib\files_tools;

class FilePathManager{

    # Methods
    
    public function __construct() {
        
    }
    
    /**
     * Description: Return root project path
     * @return type
     */
    public static function getRootPath(){
        return $_SERVER["DOCUMENT_ROOT"].project_root_path;
    } 
    
    /**
     * Description: Return root controlers folder path
     * Retrun string
     */
    public static function getRootControllersPath(){
        return self::getRootPath().controllers_folders;
    }
    
    /**
     * Description: Return root models folder path
     * Retrun string
     */
    public static function getRootModelsPath(){
        return self::getRootPath().models_folder;
    }
    
    /**
     * Description: Return root views folder path
     * Retrun string
     */
    public static function getRootViewsPath(){
        return self::getRootPath().views_folder;
    }
    
    /**
     * Description: Return root libraries clasess folder path
     * Retrun string
     */
    public static function getRootLibsPath(){
        return self::getRootPath().lib_class_folder;
    }
    
    /**
     * Description: Return root libraries clasess folder path
     * Retrun string
     */
    public static function getRootAssetsPath(){
        return self::getRootPath().assets_folder;
    }
    
    /**
     * Description: Return root img folder path
     * Retrun string
     */
    public static function getRootImgPath(){
        return self::getRootAssetsPath().assets_folders['img_folder'];
    }
    
    /**
     * Description: Return root css folder path
     * Retrun string
     */
    public static function getRootCssPath(){
        return self::getRootAssetsPath().assets_folders['css_folder'];
    }
    
    /**
     * Description: Return root js folder path
     * Retrun string
     */
    public static function getRootJsPath(){
        return self::getRootAssetsPath().assets_folders['js_folder'];
    }
    
    /**
     * Description: Return root tmp folder path
     * Retrun string
     */
    public static function getRootTmpPath(){
        return self::getRootAssetsPath().assets_folders['tmp_folder'];
    }
}
