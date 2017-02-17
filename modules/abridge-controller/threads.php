<?php

function threadlist(){
    $db = connectDB();
    $sql = "select * from threads";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if($rows > 0){
        loadTemplate("baseView", "threadlist",array('threads'=>$rows));
    } else {
        loadTemplate("baseView", "threadlist",array('error'=>"No Thread Found"));
    }
}