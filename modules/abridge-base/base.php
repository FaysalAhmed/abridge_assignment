<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("db.php");



function loadTemplate($templateName, $viewName,$func_param = []) {
    $view = $viewName;
    $params = $func_param;
    include("./modules/abridge-template/" . $templateName . ".php");
}

function loadRoute($route) {
    $explodeRoute = explode("/", $route);
    include("./modules/abridge-controller/" . $explodeRoute[0] . ".php");
    $explodeRoute[1]();
}
