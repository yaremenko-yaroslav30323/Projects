<?php
include 'connection_to_db.php';
include 'header.php';


$sql = "SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Posts</h2>
        <a href="add_post.php" class="btn btn-success">+ Create New Post</a>
    </div>

<?php if ($result->num_rows > 0): ?>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 150))); ?>...</p>
                        <p class="text-muted small">Posted on <?php echo date("F j, Y", strtotime($row['created_at'])); ?></p>
                        <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">No posts found.</div>
<?php endif; ?>

<?php include 'footer.php'; ?>