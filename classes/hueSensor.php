<?php

/**
 * Description of hueSensor
 *
 * @author George Wilkins
 */
class hueSensor {
    
    private $hueBridge;
    
    private $sensorProperties = [];
    
    private $sensorIdentifier;
    
    private $sensorType;
    
    private $sensorTypes = [
        
        'daylight' => 'daylight',
        
        'zlltemperature' => 'temperature',
        
        'zllpresence' => 'presence',
        
        'zlllightlevel' => 'light',
        
        'clipgenericstatus' => 'generic',
        
        'clipgenericflag' => 'generic'
        
    ];
    
    public function __construct(hueBridge $hueBridge, int $sensorIdentifier, array $sensorProperties) {

        $this -> hueBridge = $hueBridge;
        
        $this -> sensorIdentifier = $sensorIdentifier;
        
        $this -> sensorProperties = $sensorProperties;
        
        $this -> sensorType = $this -> sensorTypes[strtolower($sensorProperties['type'])];
    
    }

}