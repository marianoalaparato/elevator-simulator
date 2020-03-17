<?php

use lib\mysqli_tools\MySQLiTablesManager;
use lib\security_tools\SecurityTools;

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
    public $simulator_speed = 5;
    public $elevator_speed_configs = [
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
        
            if(false === $this->security_tools->checkIsType($elevator, 'array', true)){
                $elevators[$i] = false;
            }else{
                $elevators[$i] = $elevator;
            }
        }
        
        return $elevators;
    }
    
    /**
     * Description: Genereta a complete day of work and return data metrics when finish
     * @param: array $secuences
     * @param: array $elevators
     * @return: bool or array
     */
    public function generateWorkDay($secuences, $elevators){
        if(false === $this->security_tools->checkIsType($secuences, 'array', true)){
            return false;
        }
        if(false === $this->security_tools->checkIsType($elevators, 'array', true)){
            return false;
        }
        
        
        # Total work time individual secuence
        echo '-----------------------------------------------------------</br>';
        $works_times = array();
        foreach ($secuences as $s_data) {
            # Total secuence work time
            $format = '%h:%i:%s'; # (%i = minutes) (%h = hours) (%a = days)
            $time1 = date_create($s_data['start_time']);
            $time2 = date_create($s_data['end_time']);

            $diference = date_diff($time1, $time2);
            $works_times[] = $diference->format($format);
            
            echo "---New secuence---</br>";
            echo "Start: ".$s_data['start_time']."</br>";
            echo "End: ".$s_data['end_time']."</br>"; 
            echo "Total work day time individual secuence in hours: ".$diference->format($format)."</br>";
        }
        
        # Total work time of day find the max value of global works times and pass to seconds
        $total_work_day = max($works_times);
        echo '-----------------------------------------------------------</br>';
        echo "Max total work day time in global secuences in hours: ".$total_work_day.'</br>';
        $values = explode(':', $total_work_day);
        $total_seconds_work_day = 0;
        for($i = 0; $i < count($values); $i++){
            if($i == 0){
                $total_seconds_work_day += ($values[0] * 60) * 60;
            }
            if($i == 1){
                $total_seconds_work_day += $values[1] * 60;
            }
        }
        echo "Max total work day time in global secuences in seconds: ".$total_seconds_work_day.'</br>';
        echo '-----------------------------------------------------------</br>';
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
        
        # Basic data
        $this->report_name = $report_data['report_name'];
        $this->trains = $report_data['work_time'];
        $this->total_elevators = $report_data['num_elevators'];
        
        # Get work day secuences
        $secuences = $this->ts_table_manager->getAllDataSet();
        unset($secuences['num_rows']);
        
        # Get elevators
        $elevators = $this->generateElevators();
        
        # Generate work day
        $this->generateWorkDay($secuences, $elevators);
        
    }
}

