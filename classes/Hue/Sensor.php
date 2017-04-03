<?php

namespace Hue;

/**
 * Description of Hue\Sensor
 *
 * @author George Wilkins
 */
class Sensor {
    
    private $bridge;
    
    private $properties = [];
    
    private $identifier;
    
    private $type;
    
    private $types = [
        
        'daylight' => 'daylight',
        
        'zlltemperature' => 'temperature',
        
        'zllpresence' => 'presence',
        
        'zlllightlevel' => 'light',
        
        'clipgenericstatus' => 'generic',
        
        'clipgenericflag' => 'generic'
        
    ];
    
    public function __construct(Bridge $bridge, int $identifier, array $properties) {

        $this -> bridge = $bridge;
        
        $this -> identifier = $identifier;
        
        $this -> properties = $properties;
        
        $this -> type = $this -> types[strtolower($properties['type'])];
    
    }

}