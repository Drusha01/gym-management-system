<div class="container">
    <div class="row g-2 mb-2 mt-1">
        <div class="form-group col-12 col-lg-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
        <div class="table-responsive table-1">
            <table id="table-1" class="table table-bordered table-striped " style="width:100%;border: 3px solid black;">
                <thead class="table-dark ">
                    <tr>
                    <th class="d-lg-none d-sm-none" rowspan="2"></th>
                    <th class="text-center align-middle d-none d-sm-table-cell" rowspan="2">#</th>
                    <th class="text-center align-middle" rowspan="2" >NAME</th>
                    <th class="text-center" colspan="4">SUBSCRIPTION TYPE</th>
                    <th class="text-center align-middle" rowspan="2">ACTION</th>
                    </tr>
                    <tr>
                    <th class="text-center">Gym-Use</th>
                    <th class="text-center">Trainer</th>
                    <th class="text-center">Locker</th>
                    <th class="text-center">Program</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="d-lg-none d-sm-none"></td>
                    <td class="text-center d-none d-sm-table-cell">1</td>
                    <td class="text-center">Trinidad, James Lorenz</td>
                    <td class="text-center">Active</td>
                    <td class="text-center">Pending</td>
                    <td class="text-center">Active</td>
                    <td class="text-center">None</td>
                    <td class="text-center"><a href="activate.php" class="btn btn-primary btn-sm" role="button">Manage</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



