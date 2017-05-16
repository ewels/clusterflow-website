0.5
<?php

// Log version of tool that's asking
$remote_version = trim($_GET['v']);
$dev = substr($remote_version, -3) == 'dev' ? 'dev' : '';
$remote_version = preg_replace('/[^\d\.]/', '', $remote_version).$dev;

// Connect to the database
$dbconfig = parse_ini_file("../config.ini");
$db = new mysqli('localhost', $dbconfig['user'], $dbconfig['password'], $dbconfig['db']);
if($db->connect_errno == 0){

    // Insert new record with querying version
    $stmt = $db->prepare("INSERT INTO version_checks (version, ip, addr) VALUES (?, ?, ?)");
    $stmt->bind_param('sss',$remote_version, $_SERVER['REMOTE_ADDR'], gethostbyaddr($_SERVER['REMOTE_ADDR']));
    $stmt->execute();
    $db->close();

}
