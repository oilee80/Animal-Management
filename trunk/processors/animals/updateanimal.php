<?php
/**
 * Gets a list of database tables
 *
 * @package modx
 * @subpackage processors.system.databasetable
 */
header('testA: test');
if (!$modx->hasPermission('database')) return $modx->error->failure($modx->lexicon('permission_denied'));
header('testB: test');

$corePath = $modx->config['core_path'].'components/animals/';
$modx->addPackage('animals', $corePath.'model/',$modx->getOption(xPDO::OPT_TABLE_PREFIX).'animals_');

$modx->lexicon->load('system_info');

	if ($scriptProperties['id']) {
		$obj = $modx->getObject('animal',$scriptProperties['id']);
	} else {
		$obj = $modx->newObject('animal');
	}
	if (is_object($obj)) {
		header('obj: LOADED');
		$tStamp = date('Y-m-d H:i:s');	//2011-05-20 10:25:23

		foreach($scriptProperties AS $k=>$v) {
			switch($k) {
				case 'action':
				case 'HTTP_MODAUTH':
				case 'id':
					continue;
				break;

				default:
					$obj->set($k,$v);
				break;
			}
header('set-'.$k.': v='.json_encode($v));
		}

		if ($obj->save()) {
			header('obj: SAVED');
		} else {
			header('obj: FAILED-SAVE');
		}
	} else {
		header('obj: NOT-LOADED');
	}