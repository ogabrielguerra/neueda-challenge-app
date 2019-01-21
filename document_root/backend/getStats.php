<?php
//New instance of Obj
$shrink = new Shrink();
$get = $shrink->Ao;

//QUERY 1
//Set params
$fields = Array('COUNT(shrink_id) as numViews');
$tables = "shrink_views";
$filter = "shrink_id > 0";
$rs = $get->getDataByQuery($fields, $tables, $filter);
//Inject return data
$shrink->populator($rs);
$numView = $shrink->data[0]->numViews;
//

//Reset obj data
$shrink->resetData();

//QUERY 2
//Set params
$fields = Array('COUNT(shrink_id) as numShrimps');
$tables = "shrink";
$filter = "shrink_id > 0";
$rs = $get->getDataByQuery($fields, $tables, $filter);
//Inject return data
$shrink->populator($rs);
$numShrimps = $shrink->data[0]->numShrimps;
//

$jsonData = Array("numViews"=>$numView, "numShrimps"=>$numShrimps);

//Return Json
echo json_encode($jsonData);