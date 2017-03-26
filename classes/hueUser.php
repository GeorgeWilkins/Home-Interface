<?php

/**
 * Description of hueUser
 *
 * @author George Wilkins
 */
class hueUser {

    public $hueBridge;
    
    public $userIdentifier;
    
    public function __construct(hueBridge $hueBridge, string $userIdentifier = null) {

        $this -> hueBridge = $hueBridge;
        
        $this -> userIdentifier = $userIdentifier;

        if(empty($this -> userIdentifier)) {

            $this -> loadUser();
            
        }

        if(empty($this -> userIdentifier)) {
            
            $this -> registerUser();
            
        }
        
    }
    
    private function loadUser() {

        $hueData = json_decode(file_get_contents($this -> hueBridge -> dataPath), true);

        if(isset($hueData['users'][$this -> hueBridge -> networkAddress])) {
            
            $this -> userIdentifier = $hueData['users'][$this -> hueBridge -> networkAddress];
            
        }
        
        return $this -> userIdentifier;

    }
    
    public function registerUser() {

        $restRequest = new restRequest(

            'http://' . $this -> hueBridge -> networkAddress . '/api',

            [
                
                'devicetype' => 'Home Interface'
                
            ],

            'POST'

        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse[0]['success']['username'])) {

            $this -> userIdentifier = $restResponse[0]['success']['username'];

            // Store For Future Use
            
            $hueData = json_decode($this -> hueBridge -> dataPath, true);
            
            $hueData['users'][$this -> hueBridge -> networkAddress] = $this -> userIdentifier;
            
            file_put_contents($this -> hueBridge -> dataPath, json_encode($hueData));

        } else {
            
            if(isset($restResponse[0]['error'])) {
                
                new hueError($restResponse[0]['error']);
                
            } else {
                
                
                
            }
            
        }
  
        return $this -> userIdentifier;

    }
    
}
