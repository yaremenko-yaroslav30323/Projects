<?php
include 'connection_to_db.php';
include 'header.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM customer WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ Username not found.";
    }

    $stmt->close();
}
?>

    <h2 class="mb-4">🚪 Log In to <span class="text-primary">YaDia</span></h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">👤 Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">🔐 Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">🚀 Log In</button>
        <p class="mt-3">New to YaDia? <a href="register.php">📝 Register here</a>.</p>
    </form>

<?php include 'footer.php'; ?>