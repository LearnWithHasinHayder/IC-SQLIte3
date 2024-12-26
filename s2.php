<?php  
//pdo example

$db = new PDO('sqlite:students.sqlite3');
$query = "SELECT name, email  FROM students";

// $result = $db->query($query);

// while($row = $result->fetch(PDO::FETCH_ASSOC)){
//     print_r($row);
// }

$result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
print_r($result);