<?php
$xpdo_meta_map['animal']= array (
  'package' => 'animals',
  'table' => 'animals',
  'fields' => 
  array (
    'name' => '',
    'description' => '',
    'gender' => NULL,
    'species_id' => NULL,
    'good_with_cats' => NULL,
    'good_with_dogs' => NULL,
    'good_with_children' => NULL,
    'good_with_travel' => NULL,
    'weight' => NULL,
    'height' => NULL,
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
    'gender' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '1',
      'phptype' => 'string',
    ),
    'species_id' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'good_with_cats' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'good_with_dogs' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'good_with_children' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'good_with_travel' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'weight' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'height' => 
    array (
      'dbtype' => 'int',
      'phptype' => 'integer',
    ),
    'enabled' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'boolean',
    ),
  ),
  'indexes' => 
  array (
    'index' => 
    array (
      'alias' => 'index',
      'primary' => false,
      'unique' => false,
      'type' => 'index',
      'columns' => 
      array (
        'name' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'description' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'gender' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'good_with_cats' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'good_with_dogs' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'good_with_children' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'good_with_travel' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'enabled' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'species' => 
    array (
      'class' => 'species',
      'local' => 'species_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
