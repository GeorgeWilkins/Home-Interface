<?php

    // Utilities

    require '../classes/restRequest.php';

    // Philips HUE
    
    require '../classes/hueUser.php';
    require '../classes/hueColour.php';
    require '../classes/hueBridge.php';
    require '../classes/hueGroup.php';
    require '../classes/hueLight.php';
    require '../classes/hueSensor.php';

    
    
    // Initialise Services
    
    $hueBridge = new hueBridge('192.168.1.50');

    // List Debugging Information
    
    foreach($hueBridge -> getGroups() as $hueGroup) {
        
        echo $hueGroup -> getName() . "\n";
        
        foreach($hueGroup -> getLights() as $hueLight) {
            
            echo $hueLight -> getUniqueIdentifier() . ' (' . $hueLight -> getName() . ' / ' . $hueLight -> getType() . ')' . "\n";
            
        }
        
        echo "\n";
        
    }
    
    print_r(getrusage());