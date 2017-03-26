<?php

/**
 * Description of hueBridge
 *
 * @author George Wilkins
 */
class hueBridge {
    
    private $hueUser;
    
    public $networkAddress;
    
    public $dataPath = '../data/hue.json';
    
    function __construct(string $networkAddress = '127.0.0.1') {

        $this -> networkAddress = $networkAddress;

        $this -> hueUser = new hueUser($this);
        
        $hueLights = $this -> enumerateLights();
        
        $hueGroups = $this -> enumerateGroups();
        
        $hueSensors = $this -> enumerateSensors();
        
        print_r($hueSensors);
    
    }
    
    public function enumerateLights() {
        
        $restRequest = new restRequest(

            'http://' . $this -> networkAddress . '/api/' .
                        $this -> hueUser -> userIdentifier . '/lights',

            [],

            'GET'

        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse['error'])) {

            new hueError($restResponse['error']);

        } else {

            /*
             * 
             * CREATE LIGHT OBJECTS ARRAY (INDEXED BY ID)?
             * 
             */
            
            return $restResponse;

        }
        
    }

    public function enumerateGroups() {
        
        $restRequest = new restRequest(

            'http://' . $this -> networkAddress . '/api/' .
                        $this -> hueUser -> userIdentifier . '/groups',

            [],

            'GET'

        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse['error'])) {

            new hueError($restResponse['error']);

        } else {

            /*
             * 
             * CREATE GROUP OBJECTS ARRAY (INDEXED BY ID)?
             * 
             */
            
            return $restResponse;

        }
        
    }
    
    public function enumerateSensors() {
        
        $restRequest = new restRequest(

            'http://' . $this -> networkAddress . '/api/' .
                        $this -> hueUser -> userIdentifier . '/sensors',

            [],

            'GET'

        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse['error'])) {

            new hueError($restResponse['error']);

        } else {

            /*
             * 
             * CREATE SENSOR OBJECTS ARRAY (INDEXED BY ID)?
             * 
             */
            
            return $restResponse;

        }
        
    }
    
}