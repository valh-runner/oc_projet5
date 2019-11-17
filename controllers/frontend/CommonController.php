<?php
class CommonController extends Controller
{
    public function error404()
    {
        $this->set('httpHeader', '404'); //set header 404 in response
    }
    
    public function accessDenied()
    {
        
    }
}
