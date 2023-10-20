<?php
require __DIR__ . '/vendor/autoload.php';
use PolygonIO\Rest\Rest;

$api_key = 'ZKgbcNT96nxgF4M89inf4xn2zzkWlxCf';

$rest = new Rest($api_key); 
$data = json_encode($rest->stocks->groupedDaily->get(date("Y-m-d", strtotime("yesterday")) ,'us','stocks',array('adjusted'=>'false')));
echo $data;
