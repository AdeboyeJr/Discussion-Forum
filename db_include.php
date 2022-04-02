<?php
function doDB() {
    global $mysqli;

    // connect to server and select database; you may need it
    $mysqli = mysqli_connect("localhost", "u667897109_Ade", "T#st1125", "u667897109_Data");

    // if connection faills, stop script execution
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
}
?>