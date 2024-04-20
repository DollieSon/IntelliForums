<?php
$conn = new mysqli('localhost', 'root', '', 'intelliforums');

if (!$conn) {
	die("Connection failed: " . $conn->connect_error);
}
session_start();
?>