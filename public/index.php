<?php

    // Load Classes
    
    spl_autoload_register(function ($class) {
        
        include '../classes/' . $class . '.php';
        
    });
    
    // Initialise Services
    
    $bridge = new Hue\Bridge('192.168.1.50');

    // List Debugging Information
    
    foreach($bridge -> getGroups() as $group) {
        
        echo $group -> getName() . "\n";
        
        foreach($group -> getLights() as $light) {
            
            echo $light -> getUniqueIdentifier() . ' (' . $light -> getName() . ' / ' . $light -> getType() . ')' . "\n";
            
        }
        
        echo "\n";
        
    }
    
    print_r(getrusage());