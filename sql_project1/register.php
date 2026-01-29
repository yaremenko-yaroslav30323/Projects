<?php
include 'connection_to_db.php';
include 'header.php';

$username = $email = $password = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (!empty($username) && !empty($email) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO customer (username, email, password, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $success = "🎉 Registration successful! You can now <a href='login.php'>log in</a>.";
            $username = $email = "";
        } else {
            $error = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "❌ Please fill in all fields.";
    }
}
?>

    <h2 class="mb-4">📝 Create Your <span class="text-primary">YariDia</span> Account</h2>

<?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php elseif ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">👤 Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">📧 Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">🔐 Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">📝 Register</button>
        <p class="mt-3">Already have an account? <a href="login.php">🚪 Log in</a>.</p>
    </form>

<?php include 'footer.php'; ?>