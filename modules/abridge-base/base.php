<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("db.php");
include 'config.php';
date_default_timezone_set('Asia/Dhaka');
function loadTemplate($templateName, $viewName, $func_param = [])
{
    $view = $viewName;
    $params = $func_param;
    include ("./modules/abridge-template/" . $templateName . ".php");
}

function loadRoute($route)
{
    $explodeRoute = explode("/", $route);
    include ("./modules/abridge-controller/" . $explodeRoute[0] . ".php");
    $explodeRoute[1]();
}

function redirect_route($route)
{
    echo "redirect";
    header("Location:".$base_url ."?r=". $route);
}
