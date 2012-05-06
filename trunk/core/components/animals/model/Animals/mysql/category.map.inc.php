<?php
$xpdo_meta_map['Category']= array (
  'package' => 'Animals',
  'table' => 'categories',
  'fields' => 
  array (
    'name' => '',
    'description' => '',
    'parent' => NULL,
    'enabled' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'default' => '',
    ),
    'parent' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
    ),
    'enabled' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'boolean',
    ),
  ),
  'composites' => 
  array (
    'Cateogry_X_Ref' => 
    array (
      'class' => 'CateogryXRef',
      'local' => 'id',
      'foreign' => 'cateogry_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
