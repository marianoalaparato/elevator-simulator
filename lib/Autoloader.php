<?php

# If you want to make a separete folder of project, inside a subfolder of root path, change this line to 'folder_path/'
const project_root_path = '/';
const controllers_folders = 'controller/';
const models_folder = 'model/';
const views_folder = 'view/';
const lib_class_folder = 'lib/';
const assets_folder = 'assets/';
const assets_folders = [
    'img_folder' => 'img/',
    'css_folder' => 'css/',
    'js_folder' => 'js/',
    'tmp_folder' => 'tmp/'
];

function autoloader($tool){
    # Replace backslashes
    $tool = str_replace('\\', '/', $tool);
    
    require $_SERVER['DOCUMENT_ROOT'].project_root_path.$tool.'.php';
}

spl_autoload_register('autoloader');

