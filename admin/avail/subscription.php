<div class="container">
    <div class="row g-2 mb-2 mt-1">
        <div class="form-group col-12 col-sm-3 table-filter-option">
            <label>Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                <option value="Trainer Subscription">Trainer Subscription</option>
                <option value="Locker Subscription">Locker Subscription</option>
                <option value="Program Subscription">Program Subscription</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-3 form-group table-filter-option">
            <label>Status</label>
            <select name="filter" id="filter" class="form-select ms-md-2">
                <option value="">Paid</option>
                <option value="">Pending</option>
                <option value="">Partial</option>
                <option value="">Unpaid</option>
                <option value="">Overdue</option>
            </select>
        </div>
        <div class="table-responsive table-container table-1">

        </div>
    </div>
</div>

<script>
    $.ajax({
    type: "GET",
    url: 'availtable.php',
    success: function(result)
    {
        $('div.table-1').html(result);
        dataTable = $("#table-1").DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            responsive: true,
        });
        $('input#keyword').on('input', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
        })
        $('select#categoryFilter').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([3]).search(status).draw();
        })
        $('select#program').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([4]).search(status).draw();
        })
        new $.fn.dataTable.FixedHeader(dataTable);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
    });
</script>