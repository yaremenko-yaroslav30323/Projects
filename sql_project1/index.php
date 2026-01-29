<?php include 'header.php'; ?>

<div class="text-center py-5">
    <h1 class="display-4 fw-bold">🌐 Welcome to <span class="text-primary">YaDia</span></h1>
    <p class="lead mt-3">Explore 📝 posts, 🛍️ products, and connect with us 📩</p>
    <a href="posts.php" class="btn btn-primary btn-lg mt-4 me-2">📝 View Posts</a>
    <a href="products.php" class="btn btn-success btn-lg mt-4">🛍️ View Products</a>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Posts</h5>
                <p class="card-text">Manage and share content easily.</p>
                <a href="posts.php" class="btn btn-light btn-sm">Go to Posts</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <p class="card-text">Showcase or manage your product list.</p>
                <a href="products.php" class="btn btn-light btn-sm">Go to Products</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-dark shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Contact</h5>
                <p class="card-text">Reach out or collect feedback from users.</p>
                <a href="contact.php" class="btn btn-light btn-sm">Contact Form</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
