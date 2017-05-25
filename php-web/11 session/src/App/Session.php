<?php

namespace App;

class Session implements SessionInterface
{
    // BEGIN (write your solution here)
    public function start()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } 
        return null;
    }

    public function destroy()
    {
        $this->start();
        session_destroy();
    }
    
    public function _log($var, $clear=FALSE, $path=NULL) {
        if ($var) {
            $date = '====== '.date('Y-m-d H:i:s')." =====\n";
            $result = $var;
            if (is_array($var) || is_object($var)) {
                $result = print_r($var, 1);
            }
            $result .="\n";
            if(!$path)
                $path = dirname($_SERVER['SCRIPT_FILENAME']) . '/mylog.txt';
            if($clear)
                file_put_contents($path, '');
            @error_log($date.$result, 3, $path);
            return true;
        }
        return false;
    }
    // END
}
