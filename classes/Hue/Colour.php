<?php

namespace Hue;

/**
 * Description of Hue\Colour
 *
 * @author George Wilkins
 */
class Colour {
    
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

            $normalised = [

                'r' => ($this -> red / 255),

                'g' => ($this -> green / 255),

                'b' => ($this -> blue / 255)

            ];

            // Apply Gamma Corrections

            $adjusted = [

                'r' => ($normalised['r'] > 0.04045) ? pow(($normalised['r'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalised['r'] / 12.92),

                'g' => ($normalised['g'] > 0.04045) ? pow(($normalised['g'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalised['g'] / 12.92),

                'b' => ($normalised['b'] > 0.04045) ? pow(($normalised['b'] + 0.055) / (1.0 + 0.055), 2.4) : ($normalised['b'] / 12.92)

            ];

            // Convert To XYZ Colour Space

            $calculated = [

                'x' => ($adjusted['r'] * 0.649926 + $adjusted['g'] * 0.103455 + $adjusted['b'] * 0.197109),

                'y' => ($adjusted['r'] * 0.234327 + $adjusted['g'] * 0.743075 + $adjusted['b'] * 0.022598),

                'z' => ($adjusted['r'] * 0.0000000 + $adjusted['g'] * 0.053077 + $adjusted['b'] * 1.035763)

            ];

            $this -> x = $calculated['x'] / ($calculated['x'] + $calculated['y'] + $calculated['z']);

            $this -> y = $calculated['y'] / ($calculated['x'] + $calculated['y'] + $calculated['z']);
        
        }

        return [
            
            'x' => $this -> x,
            
            'y' => $this -> y
            
        ];
        
    }
    
    public function isBlack() {
        
        return (($this -> red === 0) and ($this -> green === 0) and ($this -> blue === 0));
        
    }

}