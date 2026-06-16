<?php 
include 'db_connect.php'; 
$message = "";

if (isset($_POST['add_book'])) {
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $author = mysqli_real_escape_string($conn, trim($_POST['author']));
    $category = mysqli_real_escape_string($conn, trim($_POST['category']));

    if (!empty($title) && !empty($author) && !empty($category)) {
        $sql = "INSERT INTO books (title, author, category) VALUES ('$title', '$author', '$category')";
        if (mysqli_query($conn, $sql)) {
            $message = "<p style='color: green; font-weight: bold;'>Book successfully cataloged!</p>";
        }
    } else {
        $message = "<p style='color: red;'>All fields are required.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practical Task 2: Library Book Management System</title>
    <style>
        body { font-family: system-ui, sans-serif; background-color: #f1f5f9; margin: 0; padding: 40px; }
        .container { max-width: 850px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; font-weight: bold; margin-top: 15px; margin-bottom: 5px; color: #475569; }
        input[type="text"], select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        button { background-color: #4f46e5; color: white; font-weight: bold; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { padding: 12px; border: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #4f46e5; color: white; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .btn-edit { color: #4f46e5; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .btn-delete { color: #ef4444; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2>Practical Task 2: Library Book Management System</h2>
    <?php echo $message; ?>

    <form method="POST" action="index.php">
        <label>Book Title</label>
        <input type="text" name="title" placeholder="e.g., Enterprise Web Development" required>

        <label>Author</label>
        <input type="text" name="author" placeholder="e.g., Dr. John Kamau" required>

        <label>Category</label>
        <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="Programming">Programming</option>
            <option value="Networking">Networking</option>
            <option value="Cybersecurity">Cybersecurity</option>
            <option value="Database Systems">Database Systems</option>
        </select>

        <button type="submit" name="add_book">Add Book to Catalog</button>
    </form>

    <hr style="margin: 40px 0; border: 0; border-top: 2px solid #e2e8f0;">

    <h3>Current Library Inventory</h3>
    <table>
        <thead>
            <tr>
                <th>Book ID</th><th>Title</th><th>Author</th><th>Category</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM books ORDER BY book_id DESC");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['book_id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    // Paths updated to include week6/library_system
                    echo "<td>
                            <a class='btn-edit' href='/BIT3208_Project/week6/library_system/edit_book.php?id=" . $row['book_id'] . "'>Modify</a>
                            <a class='btn-delete' href='/BIT3208_Project/week6/library_system/delete_book.php?id=" . $row['book_id'] . "' onclick='return confirm(\"Remove this book?\");'>Remove</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align: center; color: #64748b;'>No books found in inventory.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>