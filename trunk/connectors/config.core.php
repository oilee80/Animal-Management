<?php
/*
 *	This is JUST for the testing and should NOT be packaged
*/
//define('MODX_CORE_PATH', '/home/surgicar/core/');
define('MODX_CORE_PATH', dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/core/');
header('MODX_CORE_PATH: '.MODX_CORE_PATH);
define('MODX_CONFIG_KEY', 'config');
?>