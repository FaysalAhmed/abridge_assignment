<?php

/**
 * including base php which will have all necessary function
 */
include ("./modules/abridge-base/base.php");
/**
 * calling welcome page which is in abridge-views module.
 * templates are in abridge-template module
 */
session_start();
try {
    if (array_key_exists("r", $_GET)) {
        loadRoute($_GET["r"]);
    } else {
        loadRoute("threads/threadlist");
    }
} catch (Exception $e) {
    loadRoute("threads/threadlist");
}
?>