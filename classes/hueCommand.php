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