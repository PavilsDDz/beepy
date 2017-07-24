<?php

function getData($name = "", $method="POST") {
    if($name == "") return false;
    $data = $method == "POST" ? (isset($_POST[$name]) ? $_POST[$name] : "") : (isset($_GET[$name]) ? $_GET[$name] : "");
    
    return $data;
}
function getDataGET($name = "", $method="GET") {
    if($name == "") return false;
    $data = $method == "GET" ? (isset($_GET[$name]) ? $_GET[$name] : "") : (isset($_POST[$name]) ? $_POST[$name] : "");
    
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
function notEmptyGET($field) {
    return isset($_GET[$field]) && $_GET[$field] != "";
}