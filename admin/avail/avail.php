
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
                    <div class="container">
                        <div class="row g-2 mb-2 mt-1">
                            <div class="col-12 col-sm-3 col-xs-12 form-group table-filter-option">
                                <label>Type</label>
                                <select name="sub_type" id="sub_type" class="form-select ms-md-2">
                                    <option value="">All</option>
                                    <option value="">Gym-Use Subsciption</option>
                                    <option value="New Student">Trainer Subscription</option>
                                    <option value="Shiftee">Locker Subscription</option>
                                    <option value="Transferee">Program Subscription</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-4 form-group table-filter-option">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" style="border-radius:0px 5px 5px 0px"><i class="bx bx-search" style="font-size:18px; vertical-align: middle;"></i></button>
                                </div>
                            </div>

                            </div>
                            <div class="col-12 col-sm-2 form-group table-filter-option">
                                <label>Filter</label>
                                <select name="sub_type" id="sub_type" class="form-select ms-md-2">
                                    <option value="">Alphabetical</option>
                                    <option value="">Recent</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-3 d-grid d-lg-flex form-group h-50 justify-content-center">
                                <button class="btn btn-success">Add Subscription</button>
                            </div>
                        </div>
                            <table class="table table-responsive table-striped table-borderless table-custom">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col" class="text-center">DATE SUBSCRIBED</th>
                                    <th scope="col" class="text-center">STATUS</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td class="col-sm-2">Trinidad, James Trinidad</td>
                                    <td class="text-center">October 16, 2022</td>
                                    <td class="text-center">Paid</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td class="col-sm-2">Trinidad, James Trinidad</td>
                                    <td class="text-center">October 16, 2022</td>
                                    <td class="text-center">Paid</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td class="col-sm-2">Trinidad, James Trinidad</td>
                                    <td class="text-center">October 16, 2022</td>
                                    <td class="text-center">Paid</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="tab-pane show fade" id="tab-exp">
                    Some Expiration
                </div>
                <div class="tab-pane show fade" id="tab-walk_in">
                    Some Walk-In
                </div>
            </div>
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