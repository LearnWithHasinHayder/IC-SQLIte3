<?php 
//author and book insert data

$db = new PDO('sqlite:students.sqlite3');

$author = "Henry Rider Haggard";
$book1 = "King Solomon's Mines";
$book2 = "She";

$insertAuthorSQL = "INSERT INTO authors (name) VALUES (:name)";
$stmt = $db->prepare($insertAuthorSQL);

$stmt->execute([':name' => $author]);
$authorID = $db->lastInsertId();

$insertBookSQL = "INSERT INTO books (title, author_id) VALUES (:title, :author_id)";
$stmt = $db->prepare($insertBookSQL);

$stmt->execute([':title' => $book1, ':author_id' => $authorID]);
$stmt->execute([':title' => $book2, ':author_id' => $authorID]);

echo "Book Inserted Successfully";