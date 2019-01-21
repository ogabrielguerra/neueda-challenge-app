<?php

    $shrink = new Shrink();
    $get = $shrink->Ao;
    $info = $get->getObjData("shrink_id>0 ORDER BY shrink_id DESC LIMIT 0,10");
    echo json_encode($info);