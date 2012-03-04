<?php
/**
 * Actions build script
 *
 * @category  Animal Management
 * @package   Animal Management
 * @author    L. Bradley (www.new-it.co.uk)
 * @license   GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link      none
 **/

/* Actions */
$action= $modx->newObject('modAction');
$action->fromArray(array(
	'id' => 1,
	'namespace' => 'animals',
	'parent' => '0',
	'controller' => 'index',
	'haslayout' => '1',
	'lang_topics' => 'animals:default,file',
	'assets' => '',
), '', true, true);

/* load menu into action */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
	'text' => 'animals',
	'parent' => 'components',
	'text' => 'animals',
	'description' => 'animals.menu_desc',
	'icon' => 'images/icons/plugin.gif',
	'menuindex' => '0',
	'params' => '',
	'handler' => '',
), '', true, true);
$menu->addOne($action);

return $menu;
