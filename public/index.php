<?php

    // Utilities

    require '../classes/restRequest.php';

    // Philips HUE
    
    require '../classes/hueUser.php';
    require '../classes/hueBridge.php';

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
     
    EDIT 19/03/2017: Due to router change, local DNS is no longer available and
     * I'm back to using IPv4
    
    */

    $hueBridge = new hueBridge('192.168.1.50');

    