<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_User_Observed extends ArrayObject
{
    protected $_observers = array();

    public function attach(Kohana_User_Observer $ob)
    {
        $this->_observers["{$ob}"] = $ob;
        
        return $this;
    }
    
    public function detach(Kohana_User_Observer $ob)
    {
        unset($this->_observers["{$ob}"]);
        
        return $this;
    }
    
    public function notify($method, array $arguments = array())
    {
        
        foreach ($this->_observers as $observer) {
            if (method_exists($observer, $method)) {
                call_user_func_array(array($observer, $method), $arguments);
            }
        }
        
        return $this;
    }
    //put your code here
}
