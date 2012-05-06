<?php
/**
 * Gets a list of clinics
 *
 * MySQL-specific queries and results
 *
 * @package modx
 * @subpackage processors.system.databasetable
 */
	if (!$modx->hasPermission('database')) return $modx->error->failure($modx->lexicon('permission_denied'));

	$q = $modx->newQuery('procedure');
	$rowCount = $modx->getCount('procedure',$q);
header('rowCount: '.$rowCount);
header('limit: '.$scriptProperties['start'].','.$scriptProperties['limit']);
	$q->leftJoin('aftercareType');
	$q->leftJoin('stayType');
	$q->select('procedure.id, procedure.pageId, procedure.description, procedure.priority, procedure.price, procedure.stayId, procedure.aftercareId, aftercareType.description AS aftercare, stayType.description As stay');

	$q->limit($scriptProperties['limit'],$scriptProperties['start']);
	if ($scriptProperties['sort']!='') {
		$q->sortby($scriptProperties['sort'],$scriptProperties['dir']);
	}

//$q->prepare();
//header('sql: '.$q->toSql());

	$procedures = $modx->getCollection('procedure',$q);
	foreach($procedures As $procedure) {
		$dt[]=$procedure->toArray();
//header('data'.(++$i).': '.json_encode($procedure->toArray())); 
	}