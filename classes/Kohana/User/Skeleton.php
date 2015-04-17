<?php defined('SYSPATH') or die('No direct script access.');


interface Kohana_User_Skeleton
{
    function register();
    function suspend();
    function permissionManager();
    
    function allowed($path);
}
