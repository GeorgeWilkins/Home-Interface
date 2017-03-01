<?php

/**
 * Description of hueService
 *
 * @author George Wilkins
 */
class hueService {
    
    private $hueBridge;
    
    public function __construct($bridgePath = '127.0.0.1') {
        
        $this -> hueBridge = new hueBridge($bridgePath);
        
        if($this -> hueBridge -> register()) {
            
            // Party Time
            
        } else {
            
            // No Disco For You
            
        }
    
    }

}
