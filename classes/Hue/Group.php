<?php

namespace Hue;

/**
 * Description of Hue\Group
 *
 * @author George Wilkins
 */
class Group {
    
    private $bridge;
    
    private $properties = [];
    
    private $identifier;
    
    private $lights;
    
    public function __construct(Bridge $bridge, int $identifier, array $properties) {

        $this -> bridge = $bridge;
        
        $this -> identifier = $identifier;
        
        $this -> properties = $properties;
        
        $this -> enumerateLights();
    
    }
    
    private function enumerateLights() {
        
        $lights = $this -> bridge -> sendCommand(
                
            'GET',
                
            '/lights'

        );
        
        $this -> lights = [];
        
        foreach($lights as $identifier => $properties) {
            
            if(in_array($identifier, $this -> properties['lights'])) {
                
                $this -> lights[] = new Light($this -> bridge, $identifier, $properties);
                
            }
            
        }
        
    }

    public function getLights(string $filter = null) {
        
        if(!empty($filter)) {
            
            return array_filter($this -> lights, function($light) use ($filter) {
            
                return (strpos($light -> getName(), $filter) !== false);
                
            });
            
        }
        
        return $this -> lights;
        
    }
    
    public function getName() {
        
        return $this -> properties['name'];
        
    }
    
}