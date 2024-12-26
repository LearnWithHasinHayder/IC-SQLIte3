<?php 
$db = new PDO('sqlite:students.sqlite3');

$name = "Jahir";
$email = "jahir@example.com";

// $insertSQL = "INSERT INTO students (name, email) VALUES (?, ?)";
// $stmt = $db->prepare($insertSQL);
// $stmt->execute([$name, $email]);

$insertSQL = "INSERT INTO students (name, email) VALUES (:name, :email)";
$stmt = $db->prepare($insertSQL);
$stmt->execute([':name' => $name, ':email' => $email]);

echo "Last Inserted ID = " . $db->lastInsertId();