<?php

namespace Hue;

/**
 * Description of Hue\Bridge
 *
 * @author George Wilkins
 */
class Bridge {
    
    private $user;
    
    private $groups;
    
    private $sensors;
    
    public $address;
    
    public $configuration;
    
    public function __construct(string $address = '127.0.0.1', string $configuration = '../data/hue.json') {

        $this -> address = $address;
        
        $this -> configuration = $configuration;

        $this -> user = new User($this);
        
        $this -> enumerateGroups();
        
        $this -> enumerateSensors();

    }
    
    public function sendCommand(string $method, string $path, array $parameters = []) {
    
        $request = new \Rest\Request(

            'http://' . $this -> address . '/api/' .
                        $this -> user -> identifier . $path,

            $parameters,

            $method

        );

        $response = $request -> send();

        if(isset($response['error'])) {

            new Error($response['error']);

        } else {

            return $response;

        }
        
    }
    
    private function enumerateGroups() {
        
        $groups = $this -> sendCommand(
                
            'GET',
            
            '/groups'

        );
        
        $this -> groups = [];
        
        foreach($groups as $identifier => $properties) {
            
            $this -> groups[] = new Group($this, $identifier, $properties);
            
        }
        
    }
    
    private function enumerateSensors() {
        
        $sensors = $this -> sendCommand(
                
            'GET',
            
            '/sensors'

        );
        
        $this -> sensors = [];
        
        foreach($sensors as $identifier => $properties) {
            
            $this -> sensors[] = new Sensor($this, $identifier, $properties);
            
        }
        
    }
    
    public function getGroups(string $filter = null) {
        
        if(!empty($filter)) {
            
            return array_filter($this -> groups, function($group) use ($filter) {
            
                return (strpos($group -> getName(), $filter) !== false);
                
            });
            
        }
        
        return $this -> groups;
        
    }

}