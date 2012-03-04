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

/*	$q = $modx->newQuery('aftercareTypes');
	$rowCount = $modx->getCount('aftercareTypes',$q);
header('rowCount: count='.$rowCount);
header('limit: '.$scriptProperties['start'].','.$scriptProperties['limit']);
	$q->select('*');

	$q->limit($scriptProperties['limit'],$scriptProperties['start']);
	if ($scriptProperties['sort']!='') {
		$q->sortby($scriptProperties['sort'],$scriptProperties['dir']);
	}

$q->prepare();
header('sql: '.$q->toSql());

	$aftercareTypes = $modx->getCollection('aftercareTypes',$q);*/
	$stays = $modx->getCollection('stayType');
	foreach($stays As $stay) {
		$dt[]=$stay->toArray();
//header('data'.(++$i).': '.json_encode($aftercareType->toArray())); 
	}