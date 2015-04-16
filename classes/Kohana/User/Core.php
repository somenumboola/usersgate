<?php defined('SYSPATH') or die('No direct script access.'); 

abstract class Kohana_User_Core extends Kohana_User_Observed implements 
    Kohana_Tools_Observed, 
    Kohana_User_Skeleton
{

    public function register()
    {
        // Code
        $this->notify(__FUNCTION__);
    }
    
    public function suspend()
    {
        // Code
        $this->notify(__FUNCTION__);
    }
    
    public function permissionManager()
    {
        
    }
}
