<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Core
 *
 * @author admin
 */
class Kohana_User_Core extends Kohana_User_Observed implements 
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
        // Code
        $this->notify(__FUNCTION__);
    }
}
