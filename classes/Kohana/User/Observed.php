<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_User_Observed extends ArrayObject
{
    protected $_observers = array();
    
    public function __construct()
    {
        $config = Kohana::$config
            ->load('users')
            ->get('observers', array());
        $className = Arr::get($config, 'name', '');
        foreach (Arr::get($config, 'active', array()) as $observerName) {
            
            if ( 
                class_exists(
                    $class = strtr(
                        $className,
                        array(
                            ':class' => $observerName
                        )
                    )
                )
            ) {
                $this->attach(new $class());
            }
            
        }
        
        parent::__construct(array(), ArrayObject::STD_PROP_LIST);
        
    }
    
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
    
    public function offsetSet($index, $value)
    {
        $oldValue = $this->offsetExists($index) ? $this[$index] : null;
        
        parent::offsetSet($index, $value);
        
        $this->notify(
            __FUNCTION__, 
            array(
                $index,
                $value,
                $oldValue
            )
        );
    }
    
    public function offsetUnset($index)
    {
        $oldValue = $this->offsetExists($index) ? $this[$index] : null;
        
        parent::offsetUnset($index);
        
        $this->notify(
            __FUNCTION__, 
            array(
                $index,
                $oldValue
            )
        );
    }
    
    public function exchangeArray($input)
    {
        throw new Kohana_Exception(
            "Direct call of :method forbidden!", 
            array(
                ':method' => __METHOD__
            )
        );
    }
}
