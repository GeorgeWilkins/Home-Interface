<?php

/**
 * Description of Router
 *
 * @author George Wilkins
 */
class userRouter {
    
    public function __construct() {
        
    }
    
    public function performAction() {
        
        $userInterface = new userInterface();
            
        $userInterface -> drawMenu();
        
    }
    
}
