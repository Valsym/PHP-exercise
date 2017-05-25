<?php			
			
namespace App;			
			
use function App\response;			
use function App\Renderer\render;			
			
require_once '/composer/vendor/autoload.php';			
			
$opt = array(			
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,			
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,			
);			
			
$newCar = [			
    'pictures' => [],			
    'model' => ''			
];			
			
$pdo = new \PDO('sqlite:/var/tmp/db.sqlite', null, null, $opt);			
$repository = new CarRepository($pdo);			
			
$app = new Application();			
			
$app->get('/', function () use ($repository) {			
    $cars = $repository->all();			
    return response(render('index', ['cars' => $cars]));			
});			
			
$app->get('/cars/new', function ($meta, $params, $attributes) use ($newCar) {			
    return response(render('cars/new', ['car' => $newCar, 'errors' => []]));			
});			
			
$app->post('/cars', function ($meta, $params, $attributes) use ($repository) {			
    $car = $params['car'];			
    $pictures = [];			
    $errors = [];			
			
    if (!$car['model']) {			
        $errors['model'] = "Model can't be blank";			
    }			
			
    // BEGIN (write your solution here)			
    if (array_key_exists('car', $_FILES)) {			
        //error_log(print_r($_FILES, true));			
        error_log(print_r($_FILES, true), 3, "/usr/src/app/src/App/my-errors.log");			
    	$key = 'pictures';		
    	$errorCodes = $_FILES['car']['error'][$key];		
    	$i = 0;		
    	foreach ($errorCodes as $errorCode) {		
        	if ($errorCode !== UPLOAD_ERR_NO_FILE) { // файла нет		
        	   if ($errorCode !== UPLOAD_ERR_OK) { // не был загружен		
        		    $errors['pictures'] = Theory\FileUpload\codeToMessage($errorCode);	
        	   } else {		
            		$tmpFileName = $_FILES["car"]["tmp_name"][$key][$i++];	
            		$name = basename($tmpFileName);	
            		$newName = __DIR__ . DIRECTORY_SEPARATOR . 'images' .	
            		    DIRECTORY_SEPARATOR . $name;	
            		if (!move_uploaded_file($tmpFileName, $newName)) {	
            		    $errors['pictures'] = 'Something was wrong';	
            		} else {	
            		    //$car['pictures'] = $name;	
            		    $pictures[] = ['name' => $name];	
            		}	
        	   }		
        	}		
    	} // foreach		
    }			
    // END			
			
    if (empty($errors)) {			
        $repository->insert($car, $pictures);			
        return response()->redirect('/');			
    } else {			
        return response(render('cars/new', ['car' => $car, 'errors' => $errors]))			
            ->withStatus(422);			
    }			
});			
			
$app->run();			
