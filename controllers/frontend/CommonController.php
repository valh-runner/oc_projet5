<?php
/**
 * Common functionalities
 */
class CommonController extends Controller
{
	/**
	 * Error 404 landing action
	 */
    public function error404()
    {
        $this->set('httpHeader', '404'); //set header 404 in response
    }
    
	/**
	 * Access denied landing action
	 */
    public function accessDenied()
    {
    }
}
