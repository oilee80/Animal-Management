<?php
/**
 * Settings data script
 *
 * @category  Animal Management
 * @package   Animal Management
 * @author    L. Bradley (http://www.new-it.co.uk)
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 **/

/* Context */

/* Category */
$category = $modx->newObject('modCategory');
$category->fromArray(array(
	'category' => 'Animals'
	));
