<?php

class JsonController extends Controller {
    
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
            
            echo json_encode((array) get_object_vars($controller));
        });
    }
    

}
