<?php

class Kohana_User_Permission_Composer implements Iterator
{
    protected $permissions = array();
    protected $iterator;
    protected $entity;
    protected $i = 0;
    
    /**
     * keymaker
     * generate unique array key for binding of entity and permission
     * @param type $entity
     * @param type $path
     * @return type
     */
    protected static function keymaker($entity, $path)
    {
        return md5(
            strtr(
                ':enityIdentifier@:permissionPath',
                array(
                    ':entityIdentifier' => $entity->getIdentifier(),
                    ':permissionPath' => $path
                )
            )
        );
    }
    
    /**
     * Initiator of composer
     * Setter of 
     * @param Kohana_Tools_PermissionOwner $entity
     * @throws Kohana_Exception
     */
    public function __construct($entity) 
    {
        if ( 
            !is_object($entity) 
            || ! ($entity instanceof Kohana_Tools_PermissionOwner)
        ) {
            throw new Kohana_Exception(
                'Only permission owners can invoke and own permission composer! '
                . 'Entity :entity is not instance of '
                . 'Kohana_Tools_PermissionOwner',
                array(
                    ':entity' => var_export($entity, true)
                )
            );
        }
        
        $this->iterator = new ArrayIterator($this->permissions);
        
        $this->entity = $entity;
        
    }
    
    /**
     * Get instance object of permission by path
     * @param string $path
     */
    public function get($path)
    {
        return Arr::get(
            $this->permissions,
            self::keymaker($this->entity, $path),
            FALSE
        );        
    }
    
    /**
     * attach
     * Creates linkage between entity and permission
     * @param User_Permission $p
     */
    public function attach(User_Permission $p)
    {
        $key = self::keymaker($this->entity, $p->path);
        
        if (isset($this->permissions[$key])) {
            throw new Kohana_Exception(
                'Permission duplicate attempt! :entityType already has '
                . 'permission :permissionPath !!!',
                array(
                    ':entityType' => ($this->entity instanceof User) 
                    ? 'User' 
                    : 'Group'
                )
            );
        }
        // Database writing
        // TODO: Apply database writing
        
        $this->permissions[$key] = $p;
        
        $this->iterator = new ArrayIterator($this->permissions);
    }
    
    /**
     * detach
     * Destroy linkage between entity and permission 
     * @param User_Permission $p
     */
    public function detach(User_Permission $p) 
    {
        // Database writing
        // TODO: Apply database writing
        
        $key = self::keymaker($this->entity, $p->path);
        
        if (isset($this->permissions[$key])) {
            
            unset($this->permissions[$key]);
            
        }
        
        $this->iterator = new ArrayIterator($this->permissions);
    }
    
    /**
     * rewind
     * Delegate iteration process to secured inner array of permissions
     * @return type
     */
    public function rewind() 
    {
        return call_user_func_array(
            array(
                $this->iterator,
                __FUNCTION__
            ),
            func_get_args()
        );
    }
    
    /**
     * next
     * Delegate iteration process to secured inner array of permissions
     * @return User_Permission
     */
    public function next() 
    {
        return call_user_func_array(
            array(
                $this->iterator,
                __FUNCTION__
            ),
            func_get_args()
        );
    }
    
    /**
     * current
     * Delegate iteration process to secured inner array of permissions
     * @return User_Permission
     */
    public function current() 
    {
        return call_user_func_array(
            array(
                $this->iterator,
                __FUNCTION__
            ),
            func_get_args()
        );
    }
    
    /**
     * key
     * Delegate iteration process to secured inner array of permissions
     * Overrloading generic key that represents binding between permission and entity
     * by permission path
     * @return string
     */
    public function key() 
    {
        return call_user_func_array(
            array(
                $this->iterator,
                __FUNCTION__
            ),
            func_get_args()
        );
    }
    
    /**
     * valid
     * Delegate iteration process to secured inner array of permissions
     * @return bool
     */
    public function valid()
    {
        return call_user_func_array(
            array(
                $this->iterator,
                __FUNCTION__
            ),
            func_get_args()
        );
    }
}
