<?php
header('Access-Control-Allow-Origin: *');

// Main AlQuran autoloader
require realpath(__DIR__) . '/../../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/** App settings **/
$config['displayErrorDetails'] = false;

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$container['logger'] = function($c) {
    $logStamp = time();
    // Create the logger
    $logger = new Logger('CDN');
    // Now add some handlers
    $logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
    return $logger;
};

$container['audioPath'] = function($c) {
    return realpath(__DIR__ . '/../../storage/quran/audio/');
};
$container['imagesPath'] = function($c) {
    return realpath(__DIR__ . '/../../storage/quran/images/');
};

/**
 * Finds and returns the first bitrate audio file available.
 */

$app->get('/audio/ayah/{edition}/{number}/low', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $file64 = $this->audioPath . '/64/' . $edition . '/' . $number . '.mp3';
    $file32 = $this->audioPath . '/32/' . $edition . '/' . $number . '.mp3';
    $file40 = $this->audioPath . '/40/' . $edition . '/' . $number . '.mp3';
    $file48 = $this->audioPath . '/48/' . $edition . '/' . $number . '.mp3';
    $file96 = $this->audioPath . '/96/' . $edition . '/' . $number . '.mp3';
    $file128 = $this->audioPath . '/128/' . $edition . '/' . $number . '.mp3';
    $file196 = $this->audioPath . '/192/' . $edition . '/' . $number . '.mp3';
    if (file_exists($file32)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file32));

        readfile($file32);
    } else if (file_exists($file40)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file40));

        readfile($file40);
    } else if (file_exists($file48)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file48));

        readfile($file48);
    } else if (file_exists($file64)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file64));

        readfile($file64); 
    } else if (file_exists($file96)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file96));

        readfile($file96);
    } else if (file_exists($file128)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file128));

        readfile($file128);
    } else if (file_exists($file196)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file196));

        readfile($file196);
    } else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }
    return $response; 
});


$app->get('/audio/ayah/{edition}/{number}/high', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $file64 = $this->audioPath . '/64/' . $edition . '/' . $number . '.mp3';
    $file32 = $this->audioPath . '/32/' . $edition . '/' . $number . '.mp3';
    $file40 = $this->audioPath . '/40/' . $edition . '/' . $number . '.mp3';
    $file48 = $this->audioPath . '/48/' . $edition . '/' . $number . '.mp3';
    $file96 = $this->audioPath . '/96/' . $edition . '/' . $number . '.mp3';
    $file128 = $this->audioPath . '/128/' . $edition . '/' . $number . '.mp3';
    $file196 = $this->audioPath . '/192/' . $edition . '/' . $number . '.mp3';
    if (file_exists($file196)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file196));

        readfile($file196);
    } else if (file_exists($file128)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file128));

        readfile($file128);
    } else if (file_exists($file96)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file96));

        readfile($file96);
    } else if (file_exists($file64)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file64));

        readfile($file64); 
    } else if (file_exists($file48)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file48));

        readfile($file48);
    } else if (file_exists($file40)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file40));

        readfile($file40);
    } else if (file_exists($file32)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file32));

        readfile($file32);
    } else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }
    return $response; 
});


$app->get('/audio/ayah/{edition}/{number}', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $file64 = $this->audioPath . '/64/' . $edition . '/' . $number . '.mp3';
    $file32 = $this->audioPath . '/32/' . $edition . '/' . $number . '.mp3';
    $file40 = $this->audioPath . '/40/' . $edition . '/' . $number . '.mp3';
    $file48 = $this->audioPath . '/48/' . $edition . '/' . $number . '.mp3';
    $file96 = $this->audioPath . '/96/' . $edition . '/' . $number . '.mp3';
    $file128 = $this->audioPath . '/128/' . $edition . '/' . $number . '.mp3';
    $file196 = $this->audioPath . '/192/' . $edition . '/' . $number . '.mp3';
    if (file_exists($file64)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file64));

        readfile($file64); 
    } else if (file_exists($file96)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file96));

        readfile($file96);
    } else if (file_exists($file128)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file128));

        readfile($file128);
    } else if (file_exists($file48)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file48));

        readfile($file48);
    } else if (file_exists($file40)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file40));

        readfile($file40);
    } else if (file_exists($file32)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file32));

        readfile($file32);
    } else if (file_exists($file196)) {  
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
            ->withHeader('Content-Type', 'audio/mp3')
            ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file196));

        readfile($file196);
    } else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }
    return $response; 
});

$app->get('/image/{surah}/{ayah}', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: image ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $surah = $request->getAttribute('surah');
    $ayah = $request->getAttribute('ayah');
    $file = $this->imagesPath . '/' . $surah . '_' . $ayah . '.png';
    if (file_exists($file)) {
    $response = $response->withHeader('Content-Description', 'PNG File Transfer')
        ->withHeader('Content-Type', 'image/png')
        ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
        ->withHeader('Cache-Control', 'must-revalidate')
        ->withHeader('Pragma', 'public')
        ->withHeader('Content-Length', filesize($file));
    
        readfile($file); 
    } else {
        $response = $response->withStatus(404)->getBody()->write('Not found');

    }
    return $response; 
});

$app->run();