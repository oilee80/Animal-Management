<?php
/**
 * Gets a list of database tables
 *
 * @package modx
 * @subpackage processors.system.databasetable
 */
if (!$modx->hasPermission('database')) return $modx->error->failure($modx->lexicon('permission_denied'));
header('FILE: '.__FILE__);
$corePath = $modx->config['core_path'].'components/animals/';
$modx->addPackage('animals', $corePath.'model/','modx_animals_');

$modx->lexicon->load('system_info');

$dt = array();
$dbtype_processor = dirname(__FILE__) . '/' . $modx->config['dbtype'] . '/getanimals.php';
if(file_exists($dbtype_processor)) {
    include $dbtype_processor;
}

return $this->outputArray($dt,$rowCount);