<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function addcomment() {
    $db = connectDB();
    $sql = "insert into comments(thread_id,commented_by,text) values(:thread_id,:commented_by,:text)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":thread_id", $_GET['thread_id']);
    $stmt->bindParam(":commented_by", $_SESSION['userid']);
    $stmt->bindParam(":text", $_POST['comment']);
    $stmt->execute();
    if ($db->lastInsertId() > 0) {
        $_SESSION['success'] = "Comment added";
        loadRoute('threads/details');
    } else {
        $_SESSION['error'] = "Failed to add comment";
        loadRoute('threads/details');
    }
}

function deletecomment() {
    $db = connectDB();
    $sql = "delete from comments where id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $_GET['id']);
    $stmt->execute();
    redirect_route('threads/details&thread_id='.$_GET['thread_id']);
}
