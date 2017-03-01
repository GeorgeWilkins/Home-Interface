<?php

    require 'classes/hueService.php';
    require 'classes/hueDevice.php';
    
    require 'classes/restRequest.php';

//    $userRouter = new userRouter();
    
//    $userRouter  -> performAction();
    
    $hueService = new hueService('hue.downstairs.local');

    