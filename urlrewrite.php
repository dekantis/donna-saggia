<?php
$arUrlRewrite=array (
  13 => 
  array (
    'CONDITION' => '#^([^/]+?)/([^/]+?)\\??(.*)#',
    'RULE' => 'SECTION_ID=$1&ELEMENT_ID=$2&$3',
    'ID' => 'bitrix:catalog.element',
    'PATH' => '/catalog/ajax/detail.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'bitrix:catalog.element',
    'PATH' => '/ajax/detail.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
