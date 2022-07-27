<?php


date_default_timezone_set('America/Panama');
setlocale(LC_ALL, 'es_PA.UTF-8');


define('APP_NAME', 'NyaKode Framework');
define('APP_VERSION', '');
define('APP_AUTHOR', 'Nyakode');

define('APP_ENV', $_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1' ? 'dev' : 'prod');
define('APP_DEBUG', APP_ENV == 'dev' ? true : false);
define('APP_HTTP', APP_ENV  == 'dev' ? 'http://' : 'https://');
define('APP_CIPHER', 'AES-256-CBC');


define('APP_SESSION_NAME', strtoupper(str_replace(' ', '', APP_NAME)));
define('APP_SECRET_KEY', sha1(md5('1q2w3e4r5t6y7u8i9o')));
define('APP_DEFAULT_PASS', '123456789');


const DATABASE = [
    'driver' => '',
    'hostname' => '',
    'port' => '',
    'username' => '',
    'password' => '',
    'database' => '',
    '' => ''
];

ini_set('display_errors', APP_DEBUG ? 1 : 0);
ini_set('display_startup_errors', APP_DEBUG ? 1 : 0);

if(isset($_GET['url'])){
   define('APP_URL', APP_HTTP . $_SERVER['HTTP_HOST'] . str_replace($_GET['url'], '', $_SERVER['REQUEST_URI']));
} else {
   define('APP_URL', APP_HTTP . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}

define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', dirname(__DIR__, 1). DS);

define('APP', APP_ROOT . 'app' . DS);
define('CONTROLLERS', APP . ' controllers' . DS);
define('LIBS', APP . 'libs' . DS);
define('MIDDLEWARES', APP . 'middlewares' . DS);
define('MODELS', APP . 'models' . DS);
define('ROUTERS', APP . 'routes' . DS);
define('VIEWS', APP . 'views' . DS);

define('BIN', APP_ROOT . 'bin' . DS);
define('ORM', BIN . 'orm' . DS);
define('ROUTES', BIN . 'routes' . DS);

define('CONFIG', APP_ROOT . 'config' . DS);
define('PUBLICS', APP_ROOT . 'public' . DS);
define('ASSETS', PUBLICS . 'assets' . DS);
define('PAGES', PUBLICS . 'pages' . DS);
define('INCLUDES', PUBLICS . 'includes' . DS);

define('TMP', APP_ROOT . 'tmp' . DS);
define('CACHE', TMP . 'cache' . DS);
define('LOG', TMP . 'log' . DS);

ini_set('log_errors', 1);
ini_set('error_log', LOG . 'app.errors.log');

if(!session_start()){
   session_start();
   $_SESSION[APP_SESSION_NAME] = [];
}