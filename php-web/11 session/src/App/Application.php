<?php

namespace App;

class Application
{
    private $handlers = [];

    public function get($route, $handler)
    {
        $this->append('GET', $route, $handler);
    }

    public function delete($route, $handler)
    {
        $this->append('DELETE', $route, $handler);
    }

    public function post($route, $handler)
    {
        $this->append('POST', $route, $handler);
    }

    private function append($method, $route, $handler)
    {
        $updatedRoute = $route;
        if (preg_match_all('/:([^\/]+)/', $route, $matches)) {
            $updatedRoute = array_reduce($matches[1], function ($acc, $value) {
                $group = "(?P<$value>[\w-]+)";
                return str_replace(":{$value}", $group, $acc);
            }, $route);
        }
        $this->handlers[] = [$updatedRoute, $method, $handler];
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

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists('_method', $_POST)) {
            $method = strtoupper($_POST['_method']);
        } else {
            $method = $_SERVER['REQUEST_METHOD'];
        }
        foreach ($this->handlers as $item) {
            list($route, $handlerMethod, $handler) = $item;
            $preparedRoute = str_replace('/', '\/', $route);
            $matches = [];
            if ($method == $handlerMethod && preg_match("/^$preparedRoute$/i", $uri, $matches)) {
                error_log(json_encode([$method, $route]));
                $attributes = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                $meta = [
                    'method' => $method,
                    'uri' => $uri,
                    'headers' => getallheaders()
                ];

                $response = $handler($meta, array_merge($_GET, $_POST), $attributes, $_COOKIE);
                http_response_code($response->getStatusCode());
                foreach ($response->getHeaderLines() as $header) {
                    header($header);
                }

                // BEGIN (write your solution here)
                $cart = $response->getCookies();
                $log ="\nlog=\n";
                foreach ($cart as $key => $val) {
                    setcookie($key, $val);
                    $log .= "\$key=$key \$val=$val";
                }
    _log($cart, true, "/usr/src/app/src/App/my-errors2.log");
    _log($log, false, "/usr/src/app/src/App/my-errors2.log");
    _log($_COOKIE, false, "/usr/src/app/src/App/my-errors2.log");

                // END

                echo $response->getBody();
                return;
            }
        }
    }
}
