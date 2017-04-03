<?php

namespace Rest;

/**
 * Description of Rest\Request
 *
 * @author George Wilkins
 */
class Request {
    
    private $path;
    
    private $payload;
    
    private $method;
    
    public function __construct(string $path = '', array $payload = [], string $method = 'POST') {
        
        $this -> path = $path;
        
        $this -> payload = $payload;
        
        $this -> method = $method;
        
    }
    
    public function send() {
        
        $payload = json_encode($this -> payload);
        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this -> path);
        
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this -> method);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            
            'Content-Type: application/json',
            
            'Content-Length: ' . strlen($payload)
        
        ]);

        $response = curl_exec($curl);

        if( curl_errno($curl) ) {
            
            $response = [
                
                'error' => curl_error($curl)
            
            ];
            
        }
        
        curl_close($curl);
        
        return json_decode($response, true);
        
    }
    
}
