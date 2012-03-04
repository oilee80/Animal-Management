<?php
$xpdo_meta_map['category']= array (
  'package' => 'animals',
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
    'cateogry_x_refs' => 
    array (
      'class' => 'cateogry_x_ref',
      'local' => 'id',
      'foreign' => 'cateogry_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
