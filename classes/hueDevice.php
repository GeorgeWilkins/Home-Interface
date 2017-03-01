<?php

/**
 * Description of hueDevice
 *
 * @author George Wilkins
 */
class hueDevice {
    
    protected $devicePath;
    
    public function __construct($devicePath = '') {

        $this -> devicePath = $devicePath;
        
    }
    
}

class hueBridge extends hueDevice {

    private $userName;
    
    private $hueDevices = array();
    
    public function register() {
 
        // Register User
        
        $restRequest = new restRequest(
            
            'http://' . $this -> devicePath . '/api',
            
            array('devicetype' => 'Home Interface'),
                
            'POST'
            
        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse[0]['error']['description'])) {
            
            echo 'Error: ' . $restResponse[0]['error']['description'];
            
            exit;
            
        }
        
        if(!isset($restResponse[0]['success']['username'])) {
            
            echo 'Error: Bridge did not respond with username';
            
            exit;
            
        }
        
        $this -> userName = $restResponse[0]['success']['username'];
echo $this -> userName; exit;

        // Find Devices
        
        $restRequest = new restRequest(
            
            'http://' . $this -> devicePath . '/api/' . $this -> userName . '/lights',
            
            array(),
                
            'GET'
                
        );

        $restResponse = $restRequest -> send();
        
        foreach($restResponse as $lightIdentifier => $lightProperties) {
            
            echo $lightIdentifier;
            
        }
        
        

    }

}

class hueLight extends hueDevice {
    
    
}

class hueSensor extends hueDevice {
    
    
}