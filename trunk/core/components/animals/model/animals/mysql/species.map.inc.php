<?php
$xpdo_meta_map['species']= array (
  'package' => 'animals',
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
    'animal' => 
    array (
      'class' => 'animal',
      'local' => 'id',
      'foreign' => 'species_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
