<?php
/**
 * Common connector
 *
 * @category  Lead Management
 * @author    L. Bradley (http://www.thehospitalgroup.org)
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package   Leads
 * @subpackage connectors
 */
/*
 * To enable multi-context and isolated core/connector support, first find the
 * config.core.php file to find the proper core path, then load the connectors
 * index file to load the proper connector context and the modX object.
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

/*
$corePath = $modx->config['core_path'].'components/leads/';
$modx->addPackage('leads', $corePath.'model/');
$modx->request->handleRequest(array(
    'processors_path' => $corePath.'processors/',
    'location' => '',
));
*/