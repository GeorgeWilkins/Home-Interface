<?php

    require 'classes/hueService.php';
    require 'classes/hueDevice.php';
    
    require 'classes/restRequest.php';

//    $userRouter = new userRouter();
    
//    $userRouter  -> performAction();
    
    /* 
    
    Various devices on my local network have been assigned human-readable addresses
    to make development simpler (local DNS handled by my router).
    
    In this case the HUE bridge is hue.downstairs.local, while an outdoor camera
    might be camera.garden.local, for example.
    
    Indivudual HUE devices (such as light bulbs) are not addressable in this manner,
    as they communicate with the HUE bridge device rather than my local network
    directly (they're not actually Wifi devices, instead using the Zigbee Light
    Link mesh network).
    
    */
    
    $hueService = new hueService('hue.downstairs.local');

    