<?php

use iodev\whois\Whois;


// Including autoload file if needing
require_once $_SERVER['DOCUMENT_ROOT'] . "/replace-this-by-the-lib-path/iodev/whois/autoload.php";


// Creating default instance for top-level domains: .com .net .ru .рф
$whois = Whois::create();


// Load and dump domain info

var_dump($whois->loadInfo("google.com"));
var_dump($whois->loadInfo("google.ru"));
var_dump($whois->loadInfo("php.net"));
var_dump($whois->loadInfo("speedtest.net"));
var_dump($whois->loadInfo("почта.рф"));
