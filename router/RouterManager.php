<?php

/**
 * Description of routerManager
 *
 * @author mkl
 */

namespace router;

use lib\security_tools\SecurityTools;

class RouterManager {
    # Porperties
    private $security_tools;
    private $requests_controllers = [
        '/' => 'index'
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
        
        return $this->requests_controllers[$request];
    }
}

