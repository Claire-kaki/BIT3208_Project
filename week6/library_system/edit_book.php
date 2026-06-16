<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM books WHERE book_id = $book_id");
    $row = mysqli_fetch_assoc($res);
    if (!$row) { die("Book record not found."); }
}

if (isset($_POST['update_book'])) {
    $book_id = intval($_POST['book_id']);
    $title = mysqli_real_escape_string($conn, trim($_POST['title']));
    $author = mysqli_real_escape_string($conn, trim($_POST['author']));
    $category = mysqli_real_escape_string($conn, trim($_POST['category']));

    $sql = "UPDATE books SET title='$title', author='$author', category='$category' WHERE book_id=$book_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: /BIT3208_Project/week6/library_system/index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Catalog Book</title>
    <style>
        body { font-family: system-ui, sans-serif; background-color: #f1f5f9; padding: 40px; }
        .edit-card { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; font-weight: bold; margin-top: 15px; margin-bottom: 5px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }
        button { background-color: #4f46e5; color: white; font-weight: bold; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
    </style>
</head>
<body>

<div class="edit-card">
    <h3>Update Catalog Book Entry</h3>
    <form method="POST" action="edit_book.php">
        <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">

        <label>Book Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>

        <label>Author</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>

        <label>Category</label>
        <select name="category" required>
            <option value="Programming" <?php if($row['category'] == 'Programming') echo 'selected'; ?>>Programming</option>
            <option value="Networking" <?php if($row['category'] == 'Networking') echo 'selected'; ?>>Networking</option>
            <option value="Cybersecurity" <?php if($row['category'] == 'Cybersecurity') echo 'selected'; ?>>Cybersecurity</option>
            <option value="Database Systems" <?php if($row['category'] == 'Database Systems') echo 'selected'; ?>>Database Systems</option>
        </select>

        <button type="submit" name="update_book">Save Changes</button>
        <a href="/BIT3208_Project/week6/library_system/index.php" style="margin-left: 15px; color: #64748b; text-decoration: none;">Cancel</a>
    </form>
</div>

</body>
</html>