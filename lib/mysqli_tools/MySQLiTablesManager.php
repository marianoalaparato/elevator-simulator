<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lib\mysqli_tools;

use lib\mysqli_tools\MySQLiConn;

/**
 * Description of MySQLiTablesManager
 *
 * @author mkl
 */
class MySQLiTablesManager extends MySQLiConn{
    
    # Propoerties
    public $table_name;
    public $table_cols_names;
    
    # Methods
    public function __construct($table_name) {
        parent::__construct();
        $this->table_name = $table_name;
        $sql_query = "SELECT * FROM ".$this->table_name." LIMIT 1";
        $res = $this->executeSQL($sql_query);
        if($res === false){
            throw new \Exception('Problems with table connections');
        }
        $cols_data = $res->fetch_fields();
        foreach ($cols_data as $col_data) {
            $this->table_cols_names[] = $col_data->name;
        }
    }
    
    /**
     * Description: Return array with col_names
     * @return array
     */
    public function getTableColsNames(){
        return $this->table_cols_names;
    }
    
    /**
     * Description: Return array with col_names as a keys and empy values
     * @return array
     */
    public function newDataSet(){
        $new_dataset = array();
        foreach ($this->table_cols_names as $col_name) {
            $new_dataset[$col_name] = ''; 
        }
        return $new_dataset;
    }
    
    /**
     * Description: Get data_set (file in data base table) where specific key have specific value
     * @param: array $data_where_find
     * @param: array $data_cols_returned
     * @return: array or bool
     */
    public function getDataSetFor($cols_where_find, $cols_returned){
        # Prepare and execute query
        $sql_query = "SELECT ";
        
        $count = 0;
        foreach ($cols_returned as $col_name) {
            if($count > 0){
                $sql_query .= ", ";
            }
            $sql_query .= "`$col_name` ";
            $count ++;
        }
        
        $sql_query .= "FROM `$this->table_name` WHERE ";
        
        $count = 0;
        foreach ($cols_where_find as $col_name => $value) {
            if($count > 0){
                $sql_query .= "AND ";
            }
            #$clear_value = $this->scapeString($value);
            $sql_query .= "`$col_name` = '$value' ";
            $count ++;
        }
        
        #echo $sql_query."</br>";
        $res = $this->executeSQL($sql_query);
        
        # Process response
        if(false === $this->getNumRowsAffected($res) > 0){
            return false;
        }
        
        while($row = $res->fetch_assoc()){
            foreach ($cols_returned as $col_name) {
                $response[$col_name] = $row[$col_name]; 
            }
        }
        $response['num_rows'] = $this->getNumRowsAffected($res);
        
        return $response;
        
    }
    
    /**
     * Description: Return all data in table
     * @return: bool or array
     */
    public function getAllDataSet(){
        $sql_query = "SELECT * FROM `$this->table_name`";
        $res = $this->executeSQL($sql_query);
        
        # Process response
        if(false === $this->getNumRowsAffected($res) > 0){
            return false;
        }
        
        $response = array();
        $response['num_rows'] = $this->getNumRowsAffected($res);
        
        while($row = $res->fetch_assoc()){
            for($i=0; $i < $response['num_rows']; $i++){
                foreach ($this->table_cols_names as $col_name) {
                    $response[$i][$col_name] = $row[$col_name]; 
                }
            }
        }
        
        return $response;
    }

}
