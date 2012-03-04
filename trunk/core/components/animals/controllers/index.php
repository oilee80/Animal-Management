<?php
/**
 * Base controller file
 *
 * @category  Blog
 * @author    L. Bradley (http://www.thehospitalgroup.org)
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 *
 * @package blog
 * @subpackage controllers
 */
require_once dirname(dirname(__FILE__)).'/model/animals/animal.class.php';

/* Load our main class */
$pv = new Animal($modx);
$pv->initialize('mgr');
$assetsUrl = $modx->getOption('animals.assets_url',null,$modx->getOption('assets_url').'components/animals/');
/* Register common JS to HEAD tag */
$modx->regClientStartupScript($assetsUrl .'js/animals.js');

return $modx->smarty->fetch('index.tpl');
 
