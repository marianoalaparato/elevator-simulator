<?php

use lib\mysqli_tools\MySQLiTablesManager;
use lib\security_tools\SecurityTools;

/**
 * Description of indexModel
 *
 * @author mkl
 */
class IndexModel {
    
    # Properties
    private $ebd_db_table = 'elevators_basic_data';
    private $edb_table_manager;
    private $ts_db_table = 'travels_secuences';
    private $ts_table_manager;
    private $security_tools;
    
    public $report_name;
    public $trains;
    public $total_elevators = 3;
    public $building_h = 600; # px 
    public $total_floors = 4;
    public $persons_media_weight = 80;
    public $global_time = 39600;
    public $speed_configs = [
        'slow'=>5,
        'medium'=>2.5,
        'fast'=>1.25
    ];
    
    # Methods
    
    public function __construct(){
        $this->ebd_table_manager = new MySQLiTablesManager($this->ebd_db_table);
        $this->ts_table_manager = new MySQLiTablesManager($this->ts_db_table);
        $this->security_tools = new SecurityTools();
    }
    
    
    /**
     * Description: Generates a rand number of persons to take elevator
     * @param: string $elevator_id 
     * return: array
     */
    public function generateBots($elevator_id){
        
    }
    
    /**
     * Description: Generate new travel for an elevator
     * @param type $elevator_id
     * @return array
     */
    public function generateElevatorTravel($elevator_id){
        
    }
    
    /**
     * Description: Generate new elevators
     * @return bool or array
     */
    public function generateElevators(){
        $returned_cols = $this->ebd_table_manager->getTableColsNames();
        
        $elevators = array();
        for($i = 0; $i < $this->total_elevators; $i++){
            $elevator = $this->ebd_table_manager->getDataSetFor(['id'=>$i], $returned_cols);
        
            if(false === $this->security_tools->checkIsType($elevator, 'array')){
                $elevators[$i] = false;
            }else{
                $elevators[$i] = $elevator;
            }
        }
        
        return $elevators;
    }
    
    /**
     * Description: Start the process for generate a report
     * @param: array $report_data
     * @return: bool or html link to download generated report
     */
    public function generateReport($report_data){
        if(false === $this->security_tools->checkIsType($report_data, 'array')){
            return false;
        }
        
        $this->report_name = $report_data['report_name'];
        $this->trains = $report_data['work_time'];
        $this->total_elevators = $report_data['num_elevators'];
        
        $elevators = $this->generateElevators();
        
        $secuences = $this->ts_table_manager->getAllDataSet();
        
        #var_dump($elevators[0]);
        var_dump($secuences);
        
        
        
    }
}
