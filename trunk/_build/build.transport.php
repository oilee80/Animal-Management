<?php
/**
 * Main package build script
 *
 * @category  Noahs ARC Animal Management
 * @package   Noahs ARC Animal Management
 * @subpackage Build
 * @author    L. Bradley (www.new-it.co.uk)
 * @license    GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link       none
 */
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

require_once dirname(__FILE__) . '/build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
//$modx->setDebug(false);
$modx->setDebug(true);
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);

echo '<pre>'; $modx->setLogTarget('ECHO');
error_reporting(E_ALL); ini_set('display_errors', true);

$name = $packageName;
$version = '0.0.1';
$release = 'alpha';

$modx->loadClass('transport.modPackageBuilder', '', false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage($name, $version, $release);
$builder->registerNamespace($name, false, true, '{core_path}components/'.$name.'/');
$base = dirname(dirname(__FILE__)) . '/';
$sources= array (
    'root' => $base,
    'assets' => $base . 'assets/components/'.$name.'/',
    'docs' => $base . 'assets/components/'.$name.'/docs/',
    'core' => $base . 'core/components/'.$name.'/',
    'lexicon' => $base . 'core/components/'.$name.'/lexicon/',
    'model' => $base . 'core/components/'.$name.'/model/',
    'templates' => $base . 'core/components/'.$name.'/templates/',
    'build' => $base . '_build/',
    'data' => $base . '_build/data/',
    'resolvers' => $base . '_build/resolvers/',
    'source_core' => $base . 'core/components/'.$name,
    'source_assets' => $base . 'assets/components/'.$name,
    'source_connectors' => $base.'connectors/'.$name,
    'source_processors' => $base.'processors/'.$name
);
unset($base);

$vehicles = array();

/* ACTIONS */
$menu = require_once $sources['data'].'actions.data.php';
if (!$menu) $modx->log(xPDO::LOG_LEVEL_FATAL,'Menu not found!');
$attr = array(
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => ('text'),
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Action' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('namespace', 'controller'),
        ),
    ),
);

$vehicle = $builder->createVehicle($menu, $attr);
$vehicles[] = $vehicle;

/* SETTINGS */
require_once $sources['data'].'settings.data.php';

/*$attr = array(
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => 'key');
	
foreach ($settings as $setting ) {
	
	$vehicle = $builder->createVehicle($setting, $attr);
	$vehicles[] = $vehicle;
}*/

/* CATEGORY */
$attr = array(
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => false,
    xPDOTransport::UNIQUE_KEY => 'category');
	
$vehicle = $builder->createVehicle($category, $attr);
$vehicles[] = $vehicle;

/* CONTEXT */
/*$attr = array(
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => false,
    xPDOTransport::UNIQUE_KEY => 'key');
	
$vehicle = $builder->createVehicle($context, $attr);
$vehicles[] = $vehicle;*/


/* USER GROUP */
/*$attr = array(
    xPDOTransport::PRESERVE_KEYS  => false,
    xPDOTransport::UPDATE_OBJECT => false,
    xPDOTransport::UNIQUE_KEY => 'name');
	
$vehicle = $builder->createVehicle($usergroup, $attr);
$vehicles[] = $vehicle;*/

/* Pack the vehicles*/
foreach ( $vehicles as $vehicle ) {

	$builder->putVehicle($vehicle);
}

/* Resolve the files on the last vehicle */
$vehicle = end($vehicles);
$vehicle->resolve('file', array(
    'source' => $sources['source_assets'],
    'target' => "return MODX_ASSETS_PATH . 'components/';"));
$vehicle->resolve('file', array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';"));
$vehicle->resolve('file', array(
    'source' => $sources['source_connectors'],
    'target' => "return MODX_CONNECTORS_PATH;"));
$vehicle->resolve('file', array(
    'source' => $sources['source_processors'],
    'target' => "return MODX_CORE_PATH .'model/modx/processors/';"));
$vehicle->resolve('php',array(
            'type' => 'php',
            'source' => $sources['resolvers'] . 'resolver.php'));

	$builder->putVehicle($vehicle);


/* Pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
	'license' => file_get_contents($sources['docs'] . 'LICENSE.txt'),
 	'readme' => file_get_contents($sources['docs'] . 'README.txt')));

/* zip up the package */
$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);
echo "\nExecution time: {$totalTime}\n";
exit ();
