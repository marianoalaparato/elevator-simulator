<?php

# Copy this line in all of controllers files
$project_root_path = '/';

require_once $_SERVER['DOCUMENT_ROOT'].$project_root_path.'lib/Autoloader.php';

use lib\files_tools\FilePathManager;
use lib\files_tools\FileUrlManager;
use lib\security_tools\SecurityTools;


# Model
require FilePathManager::getRootModelsPath().'index_model.php';
$model = new IndexModel();

$total_elevators = $model->total_elevators;
$building_h = $model->building_h;
$total_floors = $model->total_floors;
$floors_h = $building_h / $total_floors;

# View
require FilePathManager::getRootViewsPath().'index_view.php';
$view = new IndexView();

if(isset($_POST['change_f_e'])){
    $changes = json_decode($_POST['change_f_e'], true);
    
    $total_floors = $changes['floors'];
    if(false === SecurityTools::checkIsType($total_floors, 'string', true)){
        $total_floors = $model->total_floors;
    }
    
    $total_elevators = $changes['elevators'];
    if(false === SecurityTools::checkIsType($total_elevators, 'string', true)){
        $total_elevators = $model->total_elevators;
    }
    
    $view->getRenderElevators($building_h, $total_floors, $floors_h, $total_elevators);
    exit;
}

if(isset($_POST['generate_report'])){
    $report_data = json_decode($_POST['generate_report'], true);
    $report = $model->generateReport($report_data);
    exit;
}
$view->getRenderElevators($building_h, $total_floors, $floors_h, $total_elevators);
$view->getRenderPrompt();
$view->getRenderControls();