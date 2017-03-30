<?php

/**
 * Description of hueColour
 *
 * @author George Wilkins
 */
class hueColour {
    
    private $red;
    
    private $green;
    
    private $blue;
    
    private $x;
    
    private $y;
    
    public function __construct(int $red = 0, int $green = 0, int $blue = 0) {
        
        $this -> red = min(255, max(0, $red));
        
        $this -> green = min(255, max(0, $green));
        
        $this -> blue = min(255, max(0, $blue));

        $this -> getXY();
        
    }
    
    public function getXY() {

        if(is_null($this -> x) or is_null($this -> y)) {

            // Normalise To Decimal (0-255 > 0.0-1.0)

            $normalisedValues = [

                'r' => ($this -> red / 255),

                'g' => ($this -> green / 255),

                'b' => ($this -> blue / 255)

            ];

            // Apply Gamma Corrections

            $adjustedValues = [

                'r' => ($normalisedValues['r'] > 0.04045) ? pow(($normalisedValues['r'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalisedValues['r'] / 12.92),

                'g' => ($normalisedValues['g'] > 0.04045) ? pow(($normalisedValues['g'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalisedValues['g'] / 12.92),

                'b' => ($normalisedValues['b'] > 0.04045) ? pow(($normalisedValues['b'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalisedValues['b'] / 12.92)

            ];

            // Convert To XYZ Colour Space

            $calculatedCoordinates = [

                'x' => ($adjustedValues['r'] * 0.649926 + $adjustedValues['g'] * 0.103455 + $adjustedValues['b'] * 0.197109),

                'y' => ($adjustedValues['r'] * 0.234327 + $adjustedValues['g'] * 0.743075 + $adjustedValues['b'] * 0.022598),

                'z' => ($adjustedValues['r'] * 0.0000000 + $adjustedValues['g'] * 0.053077 + $adjustedValues['b'] * 1.035763)

            ];

            $this -> x = $calculatedCoordinates['x'] / ($calculatedCoordinates['x'] + $calculatedCoordinates['y'] + $calculatedCoordinates['z']);

            $this -> y = $calculatedCoordinates['y'] / ($calculatedCoordinates['x'] + $calculatedCoordinates['y'] + $calculatedCoordinates['z']);
        
        }

        return [
            
            'x' => $this -> x,
            
            'y' => $this -> y
            
        ];
        
    }
    
    public function isBlack() {
        
        return false;//(($this -> red === 0) and ($this -> green === 0) and ($this -> blue === 0));
        
    }

}