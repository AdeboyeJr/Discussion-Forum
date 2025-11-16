<?php
function doDB() {
    global $mysqli;

    // connect to server and select database; you may need it
    $mysqli = mysqli_connect("localhost", "u667897109_adejr", "D#vstack11", "u667897109_web_collection");

    // if connection faills, stop script execution
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
}
?>