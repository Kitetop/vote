<?php
namespace App;
use App\Kernel\App;
date_default_timezone_set('Asia/Shanghai');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
include __DIR__ . '/../vendor/autoload.php';
App::single()->run();
