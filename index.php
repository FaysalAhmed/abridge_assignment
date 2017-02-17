<?php

/**
 * including base php which will have all necessary function
 */
include ("./modules/abridge-base/base.php");
/**
 * calling welcome page which is in abridge-views module.
 * templates are in abridge-template module
 */
try {
    if (array_key_exists("r", $_GET)) {
        loadRoute($_GET["r"]);
    } else {
        loadTemplate("baseView", "threadlist");
    }
} catch (Exception $e) {
    var_dump($e);
    loadTemplate("login_template", "welcomePage");
}
?>