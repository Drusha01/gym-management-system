<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym</title>
    <link rel="icon" type="images/x-icon" href="../../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://kit.fontawesome.com/30ff5f2a0c.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://datatables.net/extensions/fixedheader/examples/integration/responsive-bootstrap.html"></script>
</head>
<body>
<?php require_once '../includes/header.php';?>
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
                            <div class="col-12 col-sm-3 form-group table-filter-option">
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
                            <div class="col-12 col-sm-3 d-grid d-lg-grid form-group h-50">
                                <a href="addoffer.php" class="btn btn-success" role="button">Add Offer</a>
                            </div>
                        </div>
                            <table class="table table-responsive table-striped table-borderless table-custom">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">NAME OF OFFER</th>
                                    <th scope="col" class="text-center">AGE QUALIFICATION</th>
                                    <th scope="col" class="text-center">DAYS</th>
                                    <th scope="col" class="text-center">SLOTS</th>
                                    <th scope="col" class="text-center">PRICE</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row" class="text-center">1</th>
                                    <td class="col-sm-3">1-Month Gym-Use(21 and Above)</td>
                                    <td class="text-center">21 above</td>
                                    <td class="text-center">30</td>
                                    <td class="text-center">None</td>
                                    <td class="text-center">₱800.00</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr>
                                    <th scope="row" class="text-center">2</th>
                                    <td class="col-sm-3">3-Month Gym-Use(21 and Above)</td>
                                    <td class="text-center">21 above</td>
                                    <td class="text-center">90</td>
                                    <td class="text-center">None</td>
                                    <td class="text-center">₱2100.00</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr>
                                    <th scope="row" class="text-center">3</th>
                                    <td class="col-sm-3">1-Month Gym-Use(20 below)</td>
                                    <td class="text-center">20 below</td>
                                    <td class="text-center">30</td>
                                    <td class="text-center">None</td>
                                    <td class="text-center">₱750.00</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr>
                                    <th scope="row" class="text-center">4</th>
                                    <td class="col-sm-3">1-Month Locker</td>
                                    <td class="text-center">None</td>
                                    <td class="text-center">30</td>
                                    <td class="text-center">None</td>
                                    <td class="text-center">₱100.00</td>
                                    <td class="text-center"><button class="btn btn-primary btn-sm px-3">Edit</button> <button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
        </div>


    </main>
    

</body>
</html>