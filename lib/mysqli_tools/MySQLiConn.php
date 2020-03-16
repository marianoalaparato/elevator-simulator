<?php

/**
 * Description of MySQLiConn
 *
 * @author mkl
 */

namespace lib\mysqli_tools;

use mysqli;
use lib\security_tools\SecurityTools;

class MySQLiConn {
    
    # Properties
    protected $connection;
    protected $server = 'localhost';
    protected $usr_name = 'root';
    protected $psswd = 'root';
    protected $db_name = 'elevators_simulator';
    protected $security_tools;
    
    # Methods
    
    /**
     * Description: Establish a connection with data base
     * @return mysqli objt or Exception
     */
    public function __construct(){
       $this->connection = new mysqli($this->server, $this->usr_name, $this->psswd, $this->db_name);
       if($this->connection->connect_error){
           #var_dump($this->connection->connect_error); # For developers
           throw new \Exception('Problems with database connections');
       }
       $this->connection->query("SET NAMES 'utf8'");
       $this->security_tools = new SecurityTools();
    }
    
    /**
     * Description: Close established connection with data base
     * @return bool
     */
    public function closeConnection(){
        if(false === $this->security_tools->checkIsType($this->connection, 'object')){
            return false;
        }
        
        mysqli_close($this->connection);
        unset($this->connection);
        return true;
    }
    
    /**
     * Description: Prevent strings errors when operate with strings values
     * @param: string. The string to scape
     * @return: string or bool
     */
    protected function scapeString($string){
        if(false === $this->security_tools->checkIsType($string, 'string', true)){
            return false;
        }
        
        return $this->connection->real_escape_string($string);
    }
    
    /**
     * Description: Get the the rows affecteds on a table in a operation
     * @return: int or bool
     */
    protected function getNumRowsAffected($sql_res) {
        if(false === $this->security_tools->checkIsType($sql_res, 'object')){
            return false;
        }
        
        return $sql_res->num_rows;
    }
    
    /**
     * Description: Get the last id inserted on a table
     * @return int
     */
    protected function getLastIdInserted(){
        return $this->connection->insert_id;
    }
    
    /**
     * Description: Execute sql command
     * @return: mysql objt or bool
     */
    protected function executeSQL($sql_query){
        if(false === $this->security_tools->checkIsType($sql_query, 'string', true)){
            return false;
        }
        return $this->connection->query($sql_query);
    }

}
