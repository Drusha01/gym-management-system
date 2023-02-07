
<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <section id="subscription">
        <?php require_once 'subscription.php';?>
        </section>
        <br>
        <section id="expiration">
        <?php require_once 'expiration.php';?>
        </section>
        <br>
        <section id="walk-in">
        <?php require_once 'walk-in.php';?>
        </section>
    </div>
</main>



</body>
</html>