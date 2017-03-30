<?php

/**
 * Description of hueBridge
 *
 * @author George Wilkins
 */
class hueBridge {
    
    private $hueUser;
    
    private $hueGroups;
    
    public $networkAddress;
    
    public $dataPath = '../data/hue.json';
    
    function __construct(string $networkAddress = '127.0.0.1') {

        $this -> networkAddress = $networkAddress;

        $this -> hueUser = new hueUser($this);
        
        $this -> enumerateGroups();
        
        $this -> enumerateSensors();

    }
    
    public function sendCommand(string $requestMethod, string $commandPath, array $extraParameters = []) {
    
        $restRequest = new restRequest(

            'http://' . $this -> networkAddress . '/api/' .
                        $this -> hueUser -> userIdentifier . $commandPath,

            $extraParameters,

            $requestMethod

        );

        $restResponse = $restRequest -> send();

        if(isset($restResponse['error'])) {

            new hueError($restResponse['error']);

        } else {

            return $restResponse;

        }
        
    }
    
    private function enumerateGroups() {
        
        $connectedGroups = $this -> sendCommand(
                
            'GET',
            
            '/groups'

        );
        
        $this -> hueGroups = [];
        
        foreach($connectedGroups as $groupIdentifier => $groupProperties) {
            
            $this -> hueGroups[] = new hueGroup($this, $groupIdentifier, $groupProperties);
            
        }
        
    }
    
    private function enumerateSensors() {
        
        $connectedSensors = $this -> sendCommand(
                
            'GET',
            
            '/sensors'

        );
        
        $this -> hueSensors = [];
        
        foreach($connectedSensors as $sensorIdentifier => $sensorProperties) {
            
            $this -> hueSensors[] = new hueSensor($this, $sensorIdentifier, $sensorProperties);
            
        }
        
    }
    
    public function getGroups(string $filterName = null) {
        
        if(!empty($filterName)) {
            
            return array_filter($this -> hueGroups, function($hueGroup) use ($filterName) {
            
                return (strpos($hueGroup -> getName(), $filterName) !== false);
                
            });
            
        }
        
        return $this -> hueGroups;
        
    }

}