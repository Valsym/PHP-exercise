<?php

namespace App;

class Application implements ApplicationInterface
{
    //BEGIN (write your solution here)
    public function get($path, $func)
    {
        $this->gpath = $path;
        $this->gfunc = $func();
    }

    public function post($path, $func)
    {
        $this->ppath = $path;
        $this->pfunc = $func();
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $http = $_SERVER['REQUEST_METHOD'];
        if ($uri == $this->gpath && $http == 'GET') {
            echo $this->gfunc;
        } elseif ($uri == $this->ppath && $http == 'POST') {
            echo $this->pfunc;
        } 
    }
    // END
}
