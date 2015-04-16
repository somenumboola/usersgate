<?php defined('SYSPATH') or die('No direct script access.');

interface Kohana_Tools_Observed
{
    function attach(Kohana_User_Observer $ob);
    function detach(Kohana_User_Observer $ob);
    function notify($method, array $arguments = array());
}
