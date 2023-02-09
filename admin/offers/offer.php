<?php require_once '../includes/header.php';?>
<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <h5 class="col-12 fw-bold mb-3">Offers</h5>
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
                            <div class="col-12 col-sm-3 form-group table-filter-option">
                                <label>Filter</label>
                                <select name="sub_type" id="sub_type" class="form-select ms-md-2">
                                    <option value="">Alphabetical</option>
                                    <option value="">Recent</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-2 d-grid d-lg-flex form-group h-50 justify-content-lg-center">
                                <a href="addoffer.php" class="btn btn-success" role="button">Add Offer</a>
                            </div>
                        </div>
                            <table  class="table table-responsive table-striped table-borderless table-custom" style="overflow-x:auto;">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    <th class="text-center">#</th>
                                    <th scope="col" class="col-12 col-lg-3">NAME OF OFFER</th>
                                    <th scope="col" class="text-center ">AGE QUALIFICATION</th>
                                    <th scope="col" class="text-center ">DAYS</th>
                                    <th scope="col" class="text-center ">SLOTS</th>
                                    <th scope="col" class="text-center ">PRICE</th>
                                    <th scope="col" class="text-center ">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td class="col-12 col-lg-3">1-Month Gym-Use(21 and Above)</td>
                                    <td class="text-center ">21 above</td>
                                    <td class="text-center ">30</td>
                                    <td class="text-center ">None</td>
                                    <td class="text-center ">₱800.00</td>
                                    <td class="text-center "><a href="editoffer.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="dataTables_info pb-3 pb-lg-1 text-center text-lg-start" id="table-pending_info" role="status" aria-live="polite">
                                Showing 1 to 6 of 6 entries
                            </div>
                            <div class="dataTables_paginate paging_simple_numbers" id="table-pending_paginate">
                                <ul class="pagination justify-content-center justify-content-lg-end">
                                    <li class="paginate_button page-item previous disabled" id="table-pending_previous">
                                        <a href="#" aria-controls="table-pending" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a>
                                    </li>
                                    <li class="paginate_button page-item active">
                                        <a href="#" aria-controls="table-pending" data-dt-idx="0" tabindex="0" class="page-link">1</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" aria-controls="table-pending" data-dt-idx="0" tabindex="0" class="page-link">2</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" aria-controls="table-pending" data-dt-idx="0" tabindex="0" class="page-link">3</a>
                                    </li>
                                    <li class="paginate_button page-item next disabled" id="table-pending_next">
                                        <a href="#" aria-controls="table-pending" data-dt-idx="next" tabindex="0" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                </div>
        </div>


    </main>
    <script>

    </script>

</body>
</html>