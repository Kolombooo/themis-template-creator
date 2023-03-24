<?php

function config() {
    $config = array(
        'projectid' => "*insert the project id*",
        'token' => "*insert the project token*"
    );
    return $config;
}

function element($key) {
    $json = file_get_contents('http://api.themiscms.eu/element.php?projectid=' . config()['projectid'] . '&token=' . config()['token'] . '&element=' . $key);
    $obj = json_decode($json);
    return $obj;
}