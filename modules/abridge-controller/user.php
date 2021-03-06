<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function auth()
{
    loadTemplate("login_template", "welcomePage");
}

function register()
{
    $db = connectDB();
    $sql = "select count(*) from users where username=?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $_POST['reg_name'], PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch();
    if ($rows[0] > 0) {
        // user exists already, redirect to login with a error message
        loadTemplate("login_template", "welcomePage", array(
            "error" => "User exists already"
        ));
    } else {
        $sql2 = "insert into users(username,password) values(:reg_name, :reg_pass)";
        $stmt2 = $db->prepare($sql2);
        $stmt2->bindParam(':reg_name', $_POST['reg_name'], PDO::PARAM_STR);
        $pass = md5($_POST['reg_password']);
        $stmt2->bindParam(":reg_pass", $pass);
        $stmt2->execute();
        if ($db->lastInsertId() > 0) {
            // user registered, go to main menu to say user can login now.
            loadTemplate("login_template", "welcomePage", array(
                "error" => "User can login now"
            ));
        } else {
            // user failed to registered, go to login with error
            loadTemplate("login_template", "welcomePage", array(
                "error" => "Error while registring"
            ));
        }
    }
}

function logout(){
    unset($_SESSION['userid']);
    redirect_route("threads/threadlist");
//     loadRoute("threads/threadlist");
}

function login()
{
    $db = connectDB();
    
    
    $sql = "select * from users where username=?";
    $stmt = $db->prepare($sql);
    // $stmt->bindParam(":username", $_GET['login_username'],PDO::PARAM_STR);
    $password = md5($_POST['login_password']);
    
    $stmt->bindValue(1, $_POST['login_username'], PDO::PARAM_STR);
    $stmt->bindValue(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetch(); // there will be one data per user
    
    if (! $rows) {
        loadTemplate("login_template", "welcomePage", array(
            "error" => "Username or password invalid"
        ));
    } else {
        $_SESSION['userid'] = $rows['id'];
        redirect_route("threads/threadlist");
    }
}
