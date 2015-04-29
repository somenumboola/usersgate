<?php

class Kohana_User_Permission
{
    /**
     * Defines that user has partial permission (one of child permissions)
     */
    const PARTIAL_OWNERSHIP = 1;
    
    /**
     * Defines that user has exact permission or parental permission
     */
    const DIRECT_OWNERSHIP = 2;
    
    public $path = '';
    
    /**
     * factory
     * Creates instance of permission.
     * If second argument passed - attempts to immediately check if it 
     * has partial or direct (any) ownership of this permission
     * 
     * @param string $path
     * @param User $u
     * @return User_Permission
     */
    public static function factory($path, User $u = null) {
        
        $instance = new static($path);
        
        if (!is_null($u)) {
            return $instance->own($u);
        }
        
        return $instance;
    }
    
    
    public function __construct($path) {
        $this->path = $path;
        var_dump(User_Permission::explicate($path));
    }
    
    /**
     * own
     * General check method
     * Checks if current permission owned by providen user
     * In case if user does not own current permission returns FALSE
     * In case of partial ownership returns User_Permission::PARTIAL_OWNERSHIP (1)
     * In case of direct ownership returns User_Permission::DIRECT_OWNERSHIP (2)
     * 
     * @param User $u
     * @return bool|int
     */
    public function own(User $u) {
        
    }
    
    /**
     * explicate
     * 
     * Creates array of all possible parental paths that 
     * leads to current permission
     * 
     * @param string $path
     * @param string $delimiter
     * @return array
     */
    public static function explicate($path, $delimiter = '.') {
        $explication = array();
        $pieces = explode($delimiter, $path);
        
        while ($level = array_shift($pieces)) {
            $explication[] = ($explication) ? end($explication) . $delimiter . $level : $level;
        }
        
        return $explication;
    }
}
