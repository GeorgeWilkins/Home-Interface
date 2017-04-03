<?php

namespace Hue;

/**
 * Description of Hue\User
 *
 * @author George Wilkins
 */
class User {

    public $bridge;
    
    public $identifier;
    
    public function __construct(Bridge $bridge, string $identifier = null) {

        $this -> bridge = $bridge;
        
        $this -> identifier = $identifier;

        if(empty($this -> identifier)) {

            $this -> loadUser();
            
        }

        if(empty($this -> identifier)) {
            
            $this -> registerUser();
            
        }
        
    }
    
    private function loadUser() {

        $data = json_decode(file_get_contents($this -> bridge -> configuration), true);

        if(isset($data['users'][$this -> bridge -> address])) {
            
            $this -> identifier = $data['users'][$this -> bridge -> address];
            
        }
        
        return $this -> identifier;

    }
    
    public function registerUser() {

        $request = new restRequest(

            'http://' . $this -> bridge -> address . '/api',

            [
                
                'devicetype' => 'Home Interface'
                
            ],

            'POST'

        );

        $response = $request -> send();

        if(isset($response[0]['success']['username'])) {

            $this -> identifier = $response[0]['success']['username'];

            // Store For Future Use
            
            $data = json_decode($this -> bridge -> configuration, true);
            
            $data['users'][$this -> bridge -> address] = $this -> identifier;
            
            file_put_contents($this -> bridge -> configuration, json_encode($data));

        } else {
            
            if(isset($response[0]['error'])) {
                
                new Error($response[0]['error']);
                
            } else {
                
                
                
            }
            
        }
  
        return $this -> identifier;

    }
    
}
