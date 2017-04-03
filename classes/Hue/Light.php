<?php

namespace Hue;

/**
 * Description of Hue\Light
 *
 * @author George Wilkins
 */
class Light {
    
    private $bridge;
    
    private $properties = [];
    
    private $identifier;
    
    private $type;
    
    private $types = [
        
        'extended color light' => 'colour',
        
        'color Light' => 'colour',
        
        'dimmable light' => 'white',
        
        'color temperature light' => 'white'
        
    ];
    
    public function __construct(Bridge $bridge, int $identifier, array $properties) {

        $this -> bridge = $bridge;
        
        $this -> identifier = $identifier;
        
        $this -> properties = $properties;
        
        $this -> type = $this -> types[strtolower($properties['type'])];
    
    }
    
    public function setColour(Colour $colour, int $time = 0) {
        
        $this -> bridge -> sendCommand(
            
            'PUT',
            
            '/lights/' . $this -> identifier . '/state',
            
            [

                'on' => !$colour -> isBlack(),

                'xy' => $colour -> getXY(),
                
                'transitiontime' => $time

            ]
                
        );
        
    }
    
    public function getUniqueIdentifier() {
        
        return $this -> properties['uniqueid'];
        
    }
    
    public function getName() {
        
        return $this -> properties['name'];
        
    }
    
    public function getType() {
        
        return $this -> type;
        
    }

}