<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_User_Permission_Query
{
    protected $__levels = array();
    
    public function __get($name) 
    {
        $this->__levels[] = $name;
        return $this;
    }
    
    public function __set($name, $value)
    {
        if (
            is_null($name)
            && ($value instanceof Kohana_Tools_PermissionOwner)
        ) {
            $value
                ->permissions()
                ->attach(
                    User_Permission::factory(
                        $this->render()
                    )
                );
        }
    }
    
    public function render() {
        return implode('.', $this->__levels);
    }

    public function __toString()
    {
        return $this->render();
    }
    
}
