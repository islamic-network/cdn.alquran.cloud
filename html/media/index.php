<?php
header('Access-Control-Allow-Origin: *');

// Main AlQuran autoloader
require realpath(__DIR__) . '/../../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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

$container['urlExists'] = function($c) {
    return function($url) {
        $headers = get_headers($url);

        return stripos($headers[0], "200") ? true : false;
    };
};

$container['s3url'] = getenv("S3_BASE_URL");

$container['s3'] = function($c) {
    $s3 = [
        'ar.ahmedajamy' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.alafasy' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.hudhaify' => [
            'low' => '32',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.husary' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.husarymujawwad' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.mahermuaiqly' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.minshawi' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
        'ar.muhammadayyoub' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
        'ar.muhammadjibreel' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
        'ar.shaatree' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'fr.leclerc' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
        'zh.chinese' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
        'ar.abdulbasitmurattal' => [
            'low' => '64',
            'medium' => '64',
            'high' => '192',
        ],
        'ar.abdullahbasfar' => [
            'low' => '32',
            'medium' => '64',
            'high' => '192',
        ],
        'ar.abdurrahmaansudais' => [
            'low' => '64',
            'medium' => '64',
            'high' => '192',
        ],
        'ar.hanirifai' => [
            'low' => '64',
            'medium' => '64',
            'high' => '192',
        ],
        'en.walk' => [
            'low' => '192',
            'medium' => '192',
            'high' => '192',
        ],
        'ar.ibrahimakhbar' => [
            'low' => '32',
            'medium' => '32',
            'high' => '32',
        ],
        'fa.hedayatfarfooladvand' => [
            'low' => '40',
            'medium' => '40',
            'high' => '40',
        ],
        'ar.parhizgar' => [
            'low' => '48',
            'medium' => '48',
            'high' => '48',
        ],
        'ar.abdulsamad' => [
            'low' => '64',
            'medium' => '64',
            'high' => '64',
        ],
        'ar.aymanswoaid' => [
            'low' => '64',
            'medium' => '64',
            'high' => '64',
        ],
        'ar.hanirifai' => [
            'low' => '64',
            'medium' => '64',
            'high' => '192',
        ],
        'ar.mahermuaiqly' => [
            'low' => '64',
            'medium' => '64',
            'high' => '128',
        ],
        'ar.minshawimujawwad' => [
            'low' => '64',
            'medium' => '64',
            'high' => '64',
        ],
        'ar.saoodshuraym' => [
            'low' => '64',
            'medium' => '64',
            'high' => '64',
        ],
        'ur.khan' => [
            'low' => '64',
            'medium' => '64',
            'high' => '64',
        ],
         'ru.kuliev-audio' => [
            'low' => '128',
            'medium' => '128',
            'high' => '128',
        ],
    ];

    return $s3;

};

/**
 * Finds and returns the first bitrate audio file available.
 */

$app->get('/audio/ayah/{edition}/{number}/low', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $url = $this->s3url . "audio/" . $this->s3[$edition]['low'] . "/" . $edition . "/" . $number . ".mp3";
    //return $response->withStatus(301)->withHeader('Location', $url);
    if (($this->urlExists)($url)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
                             ->withHeader('Content-Type', 'audio/mp3')
                             ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
                             ->withHeader('Cache-Control', 'must-revalidate')
                             ->withHeader('Pragma', 'public');
        readfile($url);
    }
    else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }

    return $response;
});


$app->get('/audio/ayah/{edition}/{number}/high', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $url = $this->s3url . "audio/" . $this->s3[$edition]['high'] . "/" . $edition . "/" . $number . ".mp3";
    //return $response->withStatus(301)->withHeader('Location', $url);
    if (($this->urlExists)($url)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
                             ->withHeader('Content-Type', 'audio/mp3')
                             ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
                             ->withHeader('Cache-Control', 'must-revalidate')
                             ->withHeader('Pragma', 'public');
        readfile($url);
    }
    else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }

    return $response;
});


$app->get('/audio/ayah/{edition}/{number}', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: audio ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');
    $url = $this->s3url . "audio/" . $this->s3[$edition]['medium'] . "/" . $edition . "/" . $number . ".mp3";
    //return $response->withStatus(301)->withHeader('Location', $url);
    if (($this->urlExists)($url)) {
        $response = $response->withHeader('Content-Description', 'Audio File Transfer')
                             ->withHeader('Content-Type', 'audio/mp3')
                             ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
                             ->withHeader('Cache-Control', 'must-revalidate')
                             ->withHeader('Pragma', 'public');
        readfile($url);
    }
    else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }

    return $response;
});


$app->get('/audio/ayah/{edition}/{number}/medium', function (Request $request, Response $response) {
    $number = $request->getAttribute('number');
    $edition = $request->getAttribute('edition');

    return $response->withStatus(301)->withHeader('Location', '/media/audio/ayah/' . $edition . '/' . $number); 
});

$app->get('/image/{surah}/{ayah}', function (Request $request, Response $response) {
    $this->logger->addInfo('cdn ::: image ::: ' . time(), ['server' => $_SERVER, 'request' => $_REQUEST]);
    $surah = $request->getAttribute('surah');
    $ayah = $request->getAttribute('ayah');
    $url = $this->s3url . 'images/' . $surah . '_' . $ayah . '.png';
    //return $response->withStatus(301)->withHeader('Location', $url);
    if (($this->urlExists)($url)) {
        $response = $response->withHeader('Content-Description', 'PNG File Transfer')
                             ->withHeader('Content-Type', 'image/png')
                             ->withHeader('Expires', gmdate ("D, d M Y H:i:s", time() + 31104000) . " GMT")
                             ->withHeader('Cache-Control', 'must-revalidate')
                             ->withHeader('Pragma', 'public');
        readfile($url);
    }
    else {
        $response = $response->withStatus(404)->getBody()->write('Not found');
    }

    return $response;
});

/** Can be expensive, so do not run in pipeline
$app->get('/audio/test', function (Request $request, Response $response) {
    $number = 3;
    $status = 200;
    $success = [];
    $failure = [];
    $success['status'] = 200;
    $failure['status'] = 404;
    foreach ($this->s3 as $name => $edition) {
        foreach ($edition as $quality => $bitrate) {
            $url = $this->s3url . "audio/" . $bitrate . "/" . $name . "/" . $number . ".mp3";
            $exists = ($this->urlExists)($url);
            if ($exists) {
                $success[] = ['edition' => $name, 'quality' => $quality, 'exists' => $exists, 'url' => $url];
            } else {
                $status = 404;
                $failure[] = ['edition' => $name, 'quality' => $quality, 'exists' => $exists, 'url' => $url];
            }
        }
    }

    if ($status === 200) {
        return $response->withJson($success, $status);
    } else { 
        return $response->withJson($failure, $status);
    }

});
 */

$app->run();
