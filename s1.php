<?php 
$db = new SQLite3('students.sqlite3');

$query = "SELECT name, email  FROM students";

$result = $db->query($query);

while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    print_r($row);
};




// $name = "Karim";
// $email = "karim@example.com";

// $insertSQL = "INSERT INTO students (name, email) VALUES ('{$name}', '{$email}')";
// $db->exec($insertSQL);

// echo "Last Inserted ID = " . $db->lastInsertRowID();