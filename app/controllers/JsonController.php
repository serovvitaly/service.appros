<?php

class JsonController extends Controller {
    
    public $jsonp = true;
    
    public function __construct()
    {
        $controller = $this;
        
        $this->beforeFilter(function()
        {
            //
        });
        
        $this->afterFilter(function() use ($controller)
        {
            header('Content-Type: application/json; charset=utf-8');
            
            $output = json_encode((array) get_object_vars($controller));
            
            echo $controller->jsonp ? Input::get('callback') . '(' . $output . ');' : $output;
        });
    }
    

}
