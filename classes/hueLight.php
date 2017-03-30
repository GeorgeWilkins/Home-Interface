<?php

/**
 * Description of hueLight
 *
 * @author George Wilkins
 */
class hueLight {
    
    private $hueBridge;
    
    private $lightProperties = [];
    
    private $lightIdentifier;
    
    private $lightType;
    
    private $lightTypes = [
        
        'extended color light' => 'colour',
        
        'color Light' => 'colour',
        
        'dimmable light' => 'white',
        
        'color temperature light' => 'white'
        
    ];
    
    function __construct(hueBridge $hueBridge, int $lightIdentifier, array $lightProperties) {

        $this -> hueBridge = $hueBridge;
        
        $this -> lightIdentifier = $lightIdentifier;
        
        $this -> lightProperties = $lightProperties;
        
        $this -> lightType = $this -> lightTypes[strtolower($lightProperties['type'])];
    
    }
    
    public function setColour(hueColour $hueColour, int $transitionDuration = 0) {
        
        $this -> hueBridge -> sendCommand(
            
            'PUT',
            
            '/lights/' . $this -> lightIdentifier . '/state',
            
            [

                'on' => !$hueColour -> isBlack(),

                'xy' => $hueColour -> getXY(),
                
                'transitiontime' => $transitionDuration

            ]
                
        );
        
    }
    
    public function getUniqueIdentifier() {
        
        return $this -> lightProperties['uniqueid'];
        
    }
    
    public function getName() {
        
        return $this -> lightProperties['name'];
        
    }
    
    public function getType() {
        
        return $this -> lightType;
        
    }

}