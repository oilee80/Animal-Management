<?php
/**
 * Gets a list of database tables
 *
 * @package modx
 * @subpackage processors.system.databasetable
 */
if (!$modx->hasPermission('database')) return $modx->error->failure($modx->lexicon('permission_denied'));

$corePath = $modx->config['core_path'].'components/prices/';
$modx->addPackage('prices', $corePath.'model/','modx_prices_');

$modx->lexicon->load('system_info');

$dt = array();
$dbtype_processor = dirname(__FILE__) . '/' . $modx->config['dbtype'] . '/getprices.php';
if(file_exists($dbtype_processor)) {
    include $dbtype_processor;
}

return $this->outputArray($dt,$rowCount);