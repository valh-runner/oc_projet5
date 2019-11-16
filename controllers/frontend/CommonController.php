<?php
class CommonController extends Controller
{
    public function error404()
    {
        echo header('HTTP/1.1 404 Not Found'); //set header 404 in response
    }
    
    public function accessDenied()
    {
        
    }
}
