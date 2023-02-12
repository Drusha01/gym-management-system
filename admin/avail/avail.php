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
                    <div class="table-responsive table-container">

                    </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane show fade" id="tab-exp">
                Some Expiration
            </div>
            <div class="tab-pane show fade" id="tab-walk_in">
                Some Walk-In for subs
            </div>
            </div>
        </div>

    </main>

<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

});

$.ajax({
    type: "GET",
    url: 'availtable.php',
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#example").DataTable({
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

</body>
</html>