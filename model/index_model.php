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
    private $used_db_table = 'elevators_secuence_data';
    private $mysql_table_manager;
    private $security_tools;
    
    public $total_floors = 4; 
    public $floor_H = 2.5;
    public $persons_media_weight = 80; # Kg
    #
    # Methods
    
    public function __construct(){
        $this->mysql_table_manager = new MySQLiTablesManager($this->used_db_table);
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
     * Description: Generate new elevator
     * @param type $elevator_id
     * @return boolean
     */
    public function generatElevator($elevator_id){
        $returned_cols = $this->mysql_table_manager->getTableColsNames();
        $elevator = $this->mysql_table_manager->getDataSetFor(['id'=>$elevator_id], $returned_tables);
        
        if(false === $this->security_tools->checkIsType($elevator, 'object')){
            return false;
        }
        return $elevator;
    }
}
