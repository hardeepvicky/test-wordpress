<?php
namespace EasyTable;

if ( !session_id() ) {
    session_start();
}

class Session
{
    public $group;
    
    public function __construct($group_key)
    {
        $this->group = $group_key;
    }
    
    public function write($key, $val)
    {
        $_SESSION[$this->group][$key] = $val;
    }
    
    public function clear($key)
    {
        unset($_SESSION[$this->group][$key]);
    }
    
    public function clearGroup()
    {
        unset($_SESSION[$this->group]);
    }
    
    public function read($key = null)
    {
        if ($key)
        {
            return isset($_SESSION[$this->group][$key]) ? $_SESSION[$this->group][$key] : false;
        }
        else
        {
            return $_SESSION[$this->group];
        }
    }
    
    public function has($key)
    {
        return isset($_SESSION[$this->group][$key]) ? true : false;
    }
    
    public function hasFlash($key)
    {
        return $this->has("flash." . $key);
    }
    
    public function writeFlash($key, $val)
    {
        $this->write("flash." . $key, $val);
    }
    
    public function readFlash($key)
    {
        $key = "flash." . $key;
        
        $msg = $this->read($key);
        
        $this->clear($key);
        
        return $msg;
    }
}
