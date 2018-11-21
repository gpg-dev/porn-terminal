<?php
namespace PornTerminal;

use function error_reporting;
use function getenv;

error_reporting(getenv('DEBUG') ? E_DEPRECATED | E_WARNING | E_ERROR | E_PARSE : 0);

/* include */

include_once('.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
