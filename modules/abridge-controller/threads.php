<?php

function threadlist()
{
    $db = connectDB();
    $sql = "select threads.*,users.username from threads join users on users.id=threads.creator";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    if (count($rows) > 0) {
        loadTemplate("baseView", "threadlist", array(
            'threads' => $rows
        ));
    } else {
        loadTemplate("baseView", "threadlist", array(
            'error' => "No Thread Found"
        ));
    }
}

function create()
{
    loadTemplate("baseView", "createThread");
}

function save()
{
    $db = connectDB();
    $sql = "insert into threads(name,creator,created_at,text) values(:name,:creator,:created_at,:text)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":name", $_POST['thread_name']);
    $stmt->bindParam(":creator", $_SESSION['userid']);
    $createdAt = date('Y-m-d G:i:s');
    $stmt->bindParam(':created_at', $createdAt);
    $stmt->bindParam(":text", $_POST['thread_text']);
    $stmt->execute();
    if ($db->lastInsertId() > 0) {
        $_SESSION['success'] = "Thread created";
        redirect_route('threads/threadlist');
    } else {
        $_SESSION['error'] = "Thread created";
        redirect_route('threads/threadlist');
    }
    // var_dump($_POST);
}
