<?php

namespace router;

use lib\security_tools\SecurityTools;

class RouterManager {
    # Porperties
    private $security_tools;
    private $requests_controllers = [
        '/' => 'index',# Use domain name or IP in browser url request and projec files is on root server
        '/folder_name/' => 'index' # Use domain name or IP in browser url request and project files is on a subfolder of server 
    ];
    
    # Methods
    
    public function __construct() {
        $this->security_tools = new SecurityTools();
    }
    
    /**
     * Description: Return the controller file name that is linked in $requests_controllers propertie 
     * @param string $request
     * @return bool or string
     */
    public function getRequestController($request){
        if(false === $this->security_tools->checkIsType($request, 'string',true)){
            return false;
        }
        
        if(false === isset($this->requests_controllers[$request])){
            return false;
        }
        
        return $this->requests_controllers[$request];
    }
}



