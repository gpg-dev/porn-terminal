<?php
namespace PornTerminal;

error_reporting(E_ERROR | E_PARSE);

/* include */

include_once('.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

/* api */

$api = new Api();
$api->init();

/* wording */

$wording = new Wording();
$wording->init();

/* command */

$command = new Command($api, $wording);
$command->init();

/* core */

$core = new Core($api, $wording);
echo $core->run($command);