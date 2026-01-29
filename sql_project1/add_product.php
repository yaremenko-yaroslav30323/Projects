<?php
include 'connection_to_db.php';
include 'header.php';

$name = $description = $price = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);

    if (!empty($name) && !empty($description) && is_numeric($price)) {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);

        if ($stmt->execute()) {
            header("Location: products.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Please fill all fields correctly.";
    }
}
?>

<h2 class="mb-4">Add New Product</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Price ($)</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Add Product</button>
</form>

<?php include 'footer.php'; ?>
