<?php
include 'functions.php';
include 'connect.php';

$conn=CreateConnection();
GetRace($conn, '');
GetRace($conn, 'Aliens');
?>