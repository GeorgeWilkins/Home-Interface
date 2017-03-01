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
        
        $this -> hueBridge -> register();
    
    }

}
