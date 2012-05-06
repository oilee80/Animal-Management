<?php
$xpdo_meta_map['CateogryXRef']= array (
  'package' => 'Animals',
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
    'Animal' => 
    array (
      'class' => 'Animal',
      'local' => 'animal_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Cateogory' => 
    array (
      'class' => 'Cateogry',
      'local' => 'category_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
