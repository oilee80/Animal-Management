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

	if ($scriptProperties['id']) {
header('rmv1: preDelete');
		if (!$modx->removeObject('procedure',$scriptProperties['id'])) {
header('rmv2: delete Fail');
			$modx->error->failure($modx->lexicon('prices_removeFailed'));
		} else {
header('rmv2: delete Success');
		}
	} else {
header('rmv3: noId');
		$modx->error->failure($modx->lexicon('prices_noId'));
	}