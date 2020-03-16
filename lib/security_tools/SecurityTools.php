<?php

namespace lib\security_tools;

class SecurityTools {
    # Properties
    
    # Methods
    
    public function __construct() {
    }
    
    /**
     * Description: Verify the type of variable
     * @param: string $data. The variable value for check
     * @param: string $type. The type of a variable to found
     * @param: bool. If we pass true, this methods checks for strings and arrays, variable type and:
     *      string empty = false
     *      array > 0
     * @return: bool
     */
    public static function checkIsType($data, $type, $last_check = false){
        # Check inputs
        if((null === $data)&&(null === $type)){
            return false;
        }
        
        # Check variable type
        if(gettype($data) != $type){
            return false;
        }
        
        # Last check for strings and arrays
        if(true === $last_check){
            # Strings
            if($type == 'string'){
                if(empty($data)){
                    return false;
                }
            }
            
            # Arrays
            if($type == 'array'){
                if(count($data) == 0){
                    return false;
                }
            }
        }
        
        # Return true if all checks are ok
        return true;
    }
    
}
