<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use lib\files_tools\FilePathManager;
use lib\files_tools\FileUrlManager;
use lib\security_tools\SecurityTools;


require FilePathManager::getRootModelsPath().'index_model.php';

# Model
$_POST = json_decode(file_get_contents('php://input'), true);
if(isset($_POST['new_config'])){
     # Ajax call definition {'speed_movement': '', 'maxium_weight': '', media_person_weight: ''};
}

if(isset($_POST['get_report'])){
    # Ajax call definition {'report_name': '', 'trains': ''};
}

# View
# Show login_page after model, for make login action with ajax
require FilePathManager::getRootViewsPath().'index_view.php';