<?php			
			
namespace App;

use function App\response;
use function App\Renderer\render;

require_once '/composer/vendor/autoload.php';

$app = new Application();

$goods = ['milk', 'salt', 'beef', 'chiken', 'butter'];

$app->get('/', function ($meta, $params, $attributes, $cookies) use ($goods) {
    return response(render('index', ['goods' => $goods]));
});

// BEGIN (write your solution here)
$app->get('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    if (isset($cookies['cart'])) {
        $cart = json_decode($cookies['cart'], true);
    } else { 
        $cart = [];
    }
    return response(render('/cart', ['goods' => $cart]));
});

$app->post('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    if (isset($cookies['cart'])) {
        $goodadds = false;
        $cart = json_decode($cookies['cart'], true);
        foreach ($cart as $good => $count) {
            if ($good === $params['good']) {
                $cart[$good] = $count + 1;
                $goodadds = true;
            }
        }
        if (!$goodadds) {
            $cart[$params['good']] = 1;
        }
    } else {
        $cart[$params['good']] = 1;
    }
    //setcookie('cart', json_encode($cart), time() + 600);
    $log = "json_encode(\$cart)=".json_encode($cart).
        "\n \$params['good']=".$params['good'];
    _log($log, true, "/usr/src/app/src/App/my-errors2.log");
    _log($_COOKIE, false, "/usr/src/app/src/App/my-errors2.log");
    _log($cookies, false, "/usr/src/app/src/App/my-errors2.log");
    return response()->redirect('/cart')->withCookie('cart', json_encode($cart));
});

$app->delete('/cart', function ($meta, $params, $attributes, $cookies) use ($goods) {
    $id = $params['good'];
    $sumgoods = 0;
    $debug = '';
    $cart='';
    if (isset($cookies['cart'])) {
        $cart = json_decode($cookies['cart'], true);
        foreach ($cart as $good => $count) {
            $debug .= " ".$good."[".$sumgoods."] ";
            if ($id == $sumgoods) {
                unset($cart[$good]);
                $sumgoods == 0 ? : $sumgoods--;
            }
            $sumgoods++;
        }
    }
    // if ($sumgoods <= 0) {
    //     setcookie('cart', '', time() - 10000);
    // } else {
    //     setcookie('cart', json_encode($cart), time() + 600);
    // }
    $log = "json_encode(\$cart)=".json_encode($cart).
        "\n Удаляем -> \$params['good']=".$params['good']." \$debug=$debug".
        "  \$sumgoods=$sumgoods";
    _log($log, true, "/usr/src/app/src/App/my-errors.log");
    _log($params, false, "/usr/src/app/src/App/my-errors.log");
    _log($cookies, false, "/usr/src/app/src/App/my-errors.log");
    return response()->redirect('/cart')->withCookie('cart', json_encode($cart));
});

function _log($var, $clear=FALSE, $path=NULL) {
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

$app->run();
