<?php

function threadlist() {
    $db = connectDB();
    $stmt = null;
    if (array_key_exists("search", $_GET)) {
        $sql = "select threads.*,users.username from threads join users on users.id=threads.creator where name like :search or text like :search2 or users.username like :search3";
        $stmt = $db->prepare($sql);
        $searchText = "%" . $_GET['search'] . "%";

        $stmt->bindValue(":search", $searchText);
        $stmt->bindValue(":search2", $searchText);
        $stmt->bindValue(":search3", $searchText);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    } else {
        $sql = "select threads.*,users.username from threads join users on users.id=threads.creator";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
    }

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

function create() {
    loadTemplate("baseView", "createThread");
}

function search() {
    
}

function delete() {
    $db = connectDB();
    $sql = "delete from threads where id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $_GET['thread_id']);
    $stmt->execute();
    redirect_route('threads/threadlist');
}

function details() {
    $db = connectDB();
    $sql = "select threads.* from threads where threads.id=:id ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $_GET['thread_id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (count($row) > 0) {
        $sql = "select *,comments.id as comment_id from comments join users on users.id = comments.commented_by where thread_id=:id ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $_GET['thread_id']);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        loadTemplate("baseView", "threaddetails", ['thread' => $row, 'comments' => $comments]);
    } else {
        $_SESSION['error'] = "No thread found";
        redirect_route('threads/threadlist');
    }
}

function update() {
    $db = connectDB();
    $sql = "select * from threads where id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $_GET['thread_id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (count($row) > 0) {
        if ($row['creator'] == $_SESSION['userid']) {
            loadTemplate("baseView", "createThread", ['thread' => $row]);
        } else {
            $_SESSION['error'] = "Not allowed to edit the thread";
            redirect_route('threads/threadlist');
        }
    } else {
        $_SESSION['error'] = "No thread found";
        redirect_route('threads/threadlist');
    }
}

function save() {
    $db = connectDB();
    $stmt = null;
    if ($_POST['id'] != 0) {
        $sql = "update threads set name=:name,creator=:creator,created_at=:created_at,text=:text where id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $_POST['id']);
    } else {
        $sql = "insert into threads(name,creator,created_at,text) values(:name,:creator,:created_at,:text)";
        $stmt = $db->prepare($sql);
    }
    $stmt->bindParam(":name", $_POST['thread_name']);
    $stmt->bindParam(":creator", $_SESSION['userid']);
    $createdAt = date('Y-m-d G:i:s');
    $stmt->bindParam(':created_at', $createdAt);
    $stmt->bindParam(":text", $_POST['thread_text']);
    $stmt->execute();
    if ($db->lastInsertId() > 0) {
        if ($_POST['id'] != 0) {
            $_SESSION['success'] = "Thread updated";
        } else {
            $_SESSION['success'] = "Thread created";
        }
        redirect_route('threads/threadlist');
    } else {
        if ($_POST['id'] != 0) {
            $_SESSION['success'] = "Failed to update thread";
        } else {
            $_SESSION['error'] = "Failed to create thread";
        }
        redirect_route('threads/threadlist');
    }
}
