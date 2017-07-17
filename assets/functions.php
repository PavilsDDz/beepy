<?php

function getData($name = "", $method="POST") {
    if($name == "") return false;
    $data = $method == "POST" ? (isset($_POST[$name]) ? $_POST[$name] : "") : (isset($_GET[$name]) ? $_GET[$name] : "");
    
    return $data;
}
function print_r2($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function notEmpty($field) {
    return isset($_POST[$field]) && $_POST[$field] != "";
}