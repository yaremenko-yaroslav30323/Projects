<?php
include 'connection_to_db.php';
include 'header.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$title = $content = "";
$error = "";

if (!$id) {
    echo "<div class='alert alert-danger'>Invalid post ID.</div>";
    include 'footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);

    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $id);

        if ($stmt->execute()) {
            header("Location: posts.php");
            exit();
        } else {
            $error = "Error updating post: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
} else {
    $stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $content);
    if (!$stmt->fetch()) {
        echo "<div class='alert alert-danger'>Post not found.</div>";
        include 'footer.php';
        exit();
    }
    $stmt->close();
}
?>

<h2>Edit Post</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="6" required><?php echo htmlspecialchars($content); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Post</button>
</form>

<?php include 'footer.php'; ?>
