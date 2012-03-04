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
require_once dirname(__FILE__).'/model/animals/animal.class.php';
/* Load our main class */
$bl = new animal($modx);

// Load Tiny MCE for editing
/*require_once(MODX_CORE_PATH.'/components/tinymce/tinymce.class.php');
$tiny= new TinyMCE($modx);
$tiny->initialize();*/

$assetsUrl = $modx->getOption('animals.assets_url',null,$modx->getOption('assets_url').'components/animals/');
/* Register common JS to HEAD tag */
//LIVE
//$modx->regClientStartupScript($assetsUrl .'js/animals.js');
header('changeForLive: '.__FILE__);
$modx->regClientStartupScript('/3rdParty/animals/trunk/assets/components/animals/js/animals.js');

return $modx->smarty->fetch('templates/index.tpl');
