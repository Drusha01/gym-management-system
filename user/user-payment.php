<div class="container-sub">
    <div class="row g-2 mb-2 ">
    <h5 class="col-12 fw-bold">Payment</h5>
        <div class="form-group col-12 col-sm-3 table-filter-option">
            <label class="ps-2 pb-2">Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                <option value="Trainer Subscription">Trainer Subscription</option>
                <option value="Locker Subscription">Locker Subscription</option>
                <option value="Program Subscription">Program Subscription</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword" class="ps-2 pb-2">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Subscription Here" class="form-control ms-md-2">
        </div>
        
        <div class="table-responsive table-1">
            <table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                    <th class="col-3">NAME OF SUBSCRIPTION</th>
                    <th class="text-center ">TYPE OF SUBSCRIPTION</th>
                    <th scope="col" class="text-center">UNPAID AMOUNT</th>
                    <th scope="col" class="text-center">OVERDUE AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                    <td>1-Month Gym-Use (21 and above)</td>
                    <td class="text-center ">Gym-Use Subscription</td>
                    <td class="text-center">₱800.00</td>
                    <td class="text-center">₱1500.00</td>
                    </tr>

                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                    <td>1-Month Trainer</td>
                    <td class="text-center ">Trainer Subscription</td>
                    <td class="text-center">₱1500.00</td>
                    <td class="text-center">---</td>
                    </tr>

                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">3</th>
                    <td>1-Month Locker</td>
                    <td class="text-center ">Locker Subscription</td>
                    <td class="text-center">₱100.00</td>
                    <td class="text-center">---</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end pe-4">
            <p class="fw-bold fs-5">Total Amount: <span class="fw-normal">₱2100.00</span></p>
        </div>
    </div>
</div>