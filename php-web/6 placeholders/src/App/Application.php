<?php

private function append($method, $route, $handler)
{
	// BEGIN (write your solution here)
	$r = explode('/', $route);
	$res = [];
	foreach ($r as $rr) {
		if (false === ($pos = strpos($rr, ':'))) {
			//...
		} elseif ($pos == 0) {
			$rr = '(?P<' . substr($rr, 1) . '>[\w-]+)';
		}
		$res[] = $rr;
	}
	$updatedRoute = implode('/', $res);
	// END

	$this->handlers[] = [$updatedRoute, $method, $handler];
}

//Решение учителя:

// BEGIN
        $updatedRoute = $route;
        if (preg_match_all('/:([^\/]+)/', $route, $matches)) {
            $updatedRoute = array_reduce($matches[1], function ($acc, $value) {
                $group = "(?P<$value>[\w-]+)";
                return str_replace(":{$value}", $group, $acc);
            }, $route);
        }
        // END
	

