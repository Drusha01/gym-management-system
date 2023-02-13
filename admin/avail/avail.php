
<?php 
session_start();


?>


<?php require_once '../includes/header.php';?>
<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <h5 class="col-12 fw-bold mb-3">Avail</h5>
            <ul class="nav nav-tabs application">
                        <li class="nav-item active ">
                            <a class="nav-link" href="#tab-subs" data-bs-toggle="tab">Subscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-exp" data-bs-toggle="tab">Expiration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-walk_in" data-bs-toggle="tab">Walk-In</a>
                        </li>
                    </ul>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="tab-subs">
                    <?php require_once 'subscription.php';?>
                </div>
                <div class="tab-pane show fade" id="tab-exp">
                    <?php require_once 'expiration.php';?>
                </div>
                <div class="tab-pane show fade" id="tab-walk_in">
                    Some Walk-In for subs
                </div>
            </div>
            <!-- end of tab-content -->
        </div>

    </main>

<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

});
</script>

</body>
</html>