<?php

/**
 * Description of hueCommand
 *
 * @author George Wilkins
 */
interface hueCommand {
    
    public function send(array $payload);
    
}

class hueSetLight implements hueCommand {
    
    public function send(array $payload) {
        

        
    }
    
}

class hueGetLights implements hueCommand {
    
    public function send(array $payload) {
        

        
    }

    /*
        
        $restRequest = new restRequest(
            
            'http://' . $this -> devicePath . '/api/' . $this -> userName . '/lights',
            
            array(),
                
            'GET'
                
        );

        $restResponse = $restRequest -> send();
        
        foreach($restResponse as $lightIdentifier => $lightProperties) {
            
            echo $lightIdentifier;
            
        }
    */
    
}
