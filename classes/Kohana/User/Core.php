<?php defined('SYSPATH') or die('No direct script access.'); 

abstract class Kohana_User_Core extends Kohana_User_Observed implements 
    Kohana_Tools_Observed,
    Kohana_Tools_PermissionOwner,
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
    
    /**
     * permissions
     * Permission composer invoker
     * @return Kohana_User_Permission_Composer
     */
    public function permissions()
    {
        return new Kohana_User_Permission_Composer($this);
    }
    
    /**
     * Shortcut for User_Permission::factory()
     * @see MODPATH/usersgate/classes/Kohana/User/Permission.php
     * @param string $path
     * @return bool|int
     */
    public function allowed($path) {
        return User_Permission::factory($path, $this);
    }
}
