<?php require_once "./inc/header.php"; ?>
        <main class="main-content">
            <header class="header">
                <h1>Welcome to the Admin Dashboard - <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            </header>
            <section class="content">
                <h2>Dashboard Overview</h2>
                <p>This is where you can manage your application settings and user data.</p>
            </section>
        </main>
<?php require_once "./inc/footer.php"; ?>