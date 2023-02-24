<div class="row g-2 mb-2 mt-1">
    <div class="form-group col-12 col-sm-4 table-filter-option">
        <label>Type</label>
        <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
            <option value="">All</option>
            <option value="Subscribe">Subscribe</option>
            <option value="Not Availed">Not Availed</option>
        </select>
    </div>
    <div class="form-group col-12 col-sm-5 table-filter-option">
        <label for="keyword">Search</label>
        <input type="search" name="keyword" id="keyword" placeholder="Enter Name" class="form-control ms-md-2">
    </div>
    <div class="table-responsive ">
        <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
            <thead class="bg-dark text-light">
                <tr>
                <th class="d-lg-none"></th>
                <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                <th>USER NAME</th>
                <th>NAME</th>
                <th scope="col" class="text-center">AGE</th>
                <th scope="col" class="text-center">GENDER</th>
                <th scope="col" class="text-center">STATUS</th>
                <th scope="col" class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th class="d-lg-none"></th>
                <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                <td>James_Nolegs</td>
                <td>Trinidad, James Lorenz</td>
                <td class="text-center">23</td>
                <td class="text-center">Male</td>
                <td class="text-center">To be implemented</td>
                <td class="text-center"><button  class="btn btn-primary btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#myModal">Add</button></td>
                </tr>
            </tbody>
        </table>
    </div>
 </div>

