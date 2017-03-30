<?php

/**
 * Description of hueGroup
 *
 * @author George Wilkins
 */
class hueGroup {
    
    private $hueBridge;
    
    private $groupProperties = [];
    
    private $groupIdentifier;
    
    private $hueLights;
    
    function __construct(hueBridge $hueBridge, int $groupIdentifier, array $groupProperties) {

        $this -> hueBridge = $hueBridge;
        
        $this -> groupIdentifier = $groupIdentifier;
        
        $this -> groupProperties = $groupProperties;
        
        $this -> enumerateLights();
    
    }
    
    private function enumerateLights() {
        
        $connectedLights = $this -> hueBridge -> sendCommand(
                
            'GET',
                
            '/lights'

        );
        
        $this -> hueLights = [];
        
        foreach($connectedLights as $lightIdentifier => $lightProperties) {
            
            if(in_array($lightIdentifier, $this -> groupProperties['lights'])) {
                
                $this -> hueLights[] = new hueLight($this -> hueBridge, $lightIdentifier, $lightProperties);
                
            }
            
        }
        
    }

    public function getLights(string $filterName = null) {
        
        if(!empty($filterName)) {
            
            return array_filter($this -> hueLights, function($hueLight) use ($filterName) {
            
                return (strpos($hueLight -> getName(), $filterName) !== false);
                
            });
            
        }
        
        return $this -> hueLights;
        
    }
    
    public function getName() {
        
        return $this -> groupProperties['name'];
        
    }
    
}