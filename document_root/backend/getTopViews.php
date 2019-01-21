<?php
/*
SELECT sv.shrink_id, s.shrink_code, count(sv.shrink_id) as count
FROM shrink_views sv, shrink s
WHERE sv.shrink_id = s.shrink_id
GROUP BY sv.shrink_id
ORDER BY count DESC
LIMIT 0,10
*/

//New instance of Obj
$shrink = new Shrink();
$get = $shrink->Ao;

//Set params
$fields = Array('sv.shrink_id, s.shrink_code, count(sv.shrink_id) as count');
$tables = "shrink_views sv, shrink s";
$filter = "sv.shrink_id = s.shrink_id GROUP BY sv.shrink_id ORDER BY count DESC LIMIT 0, 10";

//Query db
$rs = $get->getDataByQuery($fields, $tables, $filter);
//Inject return data
$shrink->populator($rs);

//Return Json
echo json_encode($shrink->data);