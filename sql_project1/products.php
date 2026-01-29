<?php
include 'connection_to_db.php';
include 'header.php';

$sql = "SELECT id, name, description, price FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Product List</h2>
    <a href="add_product.php" class="btn btn-success">+ Add New Product</a>
</div>

<?php if ($result->num_rows > 0): ?>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        <p class="fw-bold">$<?php echo number_format($row['price'], 2); ?></p>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">No products found.</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
