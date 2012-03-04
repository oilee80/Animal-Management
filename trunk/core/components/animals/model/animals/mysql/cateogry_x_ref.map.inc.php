<?php
$xpdo_meta_map['cateogry_x_ref']= array (
  'package' => 'animals',
  'table' => 'cateogry_x_refs',
  'fields' => 
  array (
    'animal_id' => 0,
    'category_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'animal_id' => 
    array (
      'dbtype' => 'integer',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
    ),
    'category_id' => 
    array (
      'dbtype' => 'integer',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'animal' => 
    array (
      'class' => 'animal',
      'local' => 'animal_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'cateogry' => 
    array (
      'class' => 'cateogry',
      'local' => 'category_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
