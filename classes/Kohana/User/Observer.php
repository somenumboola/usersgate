<?php defined('SYSPATH') or die('No direct script access.');

interface Kohana_User_Observer extends Kohana_Tools_Observer, Kohana_User_Skeleton {
    
    function offsetSet($name, $newval, $oldval);
    function offsetUnset($name, $oldval);
    
    function __toString();
}
