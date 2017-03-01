<?php

/**
 * Description of Interface
 *
 * @author George Wilkins
 */
class userInterface {
    
    public function __construct() {
        
    }
    
    public function drawMenu() {
        
        $menuItems = array(
            'showLighting' => 'Lighting',
            'showOther' => 'Other'
        );
        
        print('<ul>');
        
        foreach($menuItems as $actionName => $menuItem) {
            
            print('<li><a href="?action=' . $actionName . '">' . $menuItem . '</a></li>');
            
        }
        
        print('</ul>');
        
    }
    
}
