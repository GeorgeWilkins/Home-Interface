<?php

/**
 * Description of hueDevice
 *
 * @author George Wilkins
 */
class hueDevice {
    
    protected $devicePath;
    
    protected $dataPath = 'data/hue.ini';
    
    public function __construct($devicePath = '') {

        $this -> devicePath = $devicePath;
        
    }
    
}

class hueBridge extends hueDevice {

    private $userName;
    
    private $hueDevices = array();
    
    public function register() {
 
        // Check For User

        $userFile = fopen($this -> dataPath, 'w+');

        while(!feof($userFile)) {
            
            list($bridgePath, $userName) = explode('=', fgets($userFile));
            
            if($bridgePath == $this -> devicePath) {
                
                $this -> userName = $userName;
                
                break;
                
            }

        }

        if($this -> userName === null) {
 
            // Register New User
        
            $restRequest = new restRequest(

                'http://' . $this -> devicePath . '/api',

                array('devicetype' => 'Home Interface'),

                'POST'

            );

            $restResponse = $restRequest -> send();

            if(isset($restResponse[0]['success']['username'])) {

                $this -> userName = $restResponse[0]['success']['username'];
                
                // Store For Future Use
                
                fseek($userFile, 0, SEEK_END);
                
                fwrite($userFile, $this -> devicePath . '=' . $this -> userName . PHP_EOL);
            
            }
            
        }
        
        fclose($userFile);
        
        return ($this -> userName !== null);

    }

}

class hueLight extends hueDevice {
    
    
}

class hueSensor extends hueDevice {
    
    
}