<?php

/**
 * Description of restRequest
 *
 * @author George Wilkins
 */
class restRequest {
    
    private $requestPath;
    
    private $requestPayload;
    
    private $requestMethod;
    
    public function __construct($requestPath = '', $requestPayload = array(), $requestMethod = 'POST') {
        
        $this -> requestPath = $requestPath;
        
        $this -> requestPayload = $requestPayload;
        
        $this -> requestMethod = $requestMethod;
        
    }
    
    public function send() {
        
        $curlRequest = curl_init();

        curl_setopt($curlRequest, CURLOPT_URL, $this -> requestPath);
        
        curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, $this -> requestMethod);
        
        curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);
        
        $encodedPayload = json_encode($this -> requestPayload);

        curl_setopt($curlRequest, CURLOPT_POSTFIELDS, $encodedPayload);
        
        curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array(
            
            'Content-Type: application/json',
            
            'Content-Length: ' . strlen($encodedPayload))
        
        );

        $requestResponse = curl_exec($curlRequest);
        
        if( curl_errno($curlRequest) ) {
            
            $requestResponse = curl_error($curlRequest);
            
        }
        
        curl_close($curlRequest);
        
        return json_decode($requestResponse, true);
        
    }
    
}
