<?php
$xpdo_meta_map['Species']= array (
  'package' => 'Animals',
  'table' => 'species',
  'fields' => 
  array (
    'species' => '',
  ),
  'fieldMeta' => 
  array (
    'species' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
  ),
  'composites' => 
  array (
    'Animal' => 
    array (
      'class' => 'Animal',
      'local' => 'id',
      'foreign' => 'species_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
