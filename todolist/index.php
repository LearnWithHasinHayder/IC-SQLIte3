<?php
//command = php -S localhost:8000
$db = new PDO('sqlite:todo.sqlite3');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$taskTableSQL = "CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    task VARCHAR(255) NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT 0
)";

$db->exec($taskTableSQL);


if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $insertTaskSQL = "INSERT INTO tasks (task) VALUES (:task)";
    $stmt = $db->prepare($insertTaskSQL);
    $stmt->execute([':task' => $task]);
    header('Location: index.php');
}

if (isset($_POST['complete'])) {
    $id = $_POST['complete'];
    $completeTaskSQL = "UPDATE tasks SET completed = 1 WHERE id = :id";
    $stmt = $db->prepare($completeTaskSQL);
    $stmt->execute([':id' => $id]);
    header('Location: index.php');
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $deleteTaskSQL = "DELETE FROM tasks WHERE id = :id";
    $stmt = $db->prepare($deleteTaskSQL);
    $stmt->execute([':id' => $id]);
    header('Location: index.php');
}

$allTasks = $db->query("SELECT * FROM tasks ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <script src="//cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">To-Do List</h1>

        <!-- Form to add a new task -->
        <form method="POST" class="mb-6 flex items-center">
            <input type="text" name="task" placeholder="Add a new task" required class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Add
            </button>
        </form>

        <!-- Task list -->
        <div class="space-y-4">
            <!-- Not completed task -->
            <?php
            foreach ($allTasks as $task) {
                ?>
                <div class="flex items-center justify-between p-4 border rounded-lg bg-white">
                    <span class="text-gray-800 <?php echo $task['completed'] ? 'line-through' : ''; ?>">
                        <?php echo $task['task']; ?>
                    </span>
                    <div class="flex space-x-2">
                        <form method="POST" class="inline">
                            <button type="submit" name="complete" value="<?php echo $task['id'];?>" class="px-2 py-1 bg-green-500 text-white text-sm font-semibold rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Complete
                            </button>
                        </form>
                        <form method="POST" class="inline">
                            <button type="submit" name="delete" value="<?php echo $task['id'];?>" class="px-2 py-1 bg-red-500 text-white text-sm font-semibold rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>