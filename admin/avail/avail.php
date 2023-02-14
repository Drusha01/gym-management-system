
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
                        <li class="nav-item active " id="subs">
                            <a class="nav-link" href="#tab-subs" data-bs-toggle="tab" >Subscription </a>
                        </li>
                        <li class="nav-item" id="exp">
                            <a class="nav-link" href="#tab-exp" data-bs-toggle="tab" >Expiration</a>
                        </li>
                        <li class="nav-item" id="walk">
                            <a class="nav-link" href="#tab-walk_in" data-bs-toggle="tab" >Walk-In</a>
                        </li>
                    </ul>
            <div class="tab-content" >
                <div class="tab-pane active show fade" id="tab">
                    
                </div>
            </div>
        </div>

    </main>

<script>
// setting the default into subscription
$.ajax({
    type: "GET",
    url: 'subscription.php',
    success: function(result)
    {
        
        $('div#tab').html(result);
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
                
                new $.fn.dataTable.FixedHeader(dataTable);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
        
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
});

$(".nav-item").on("click", function(){
            
    if($(this).attr('id') =='subs'){
        $.ajax({
            type: "GET",
            url: 'subscription.php',
            success: function(result)
            {
                
                $('div#tab').html(result);
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
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
        
        
        
    }else if($(this).attr('id') =='exp'){
        $.ajax({
            type: "GET",
            url: 'expiration.php',
            success: function(result)
            {
                
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'exptable.php',
                    success: function(result)
                    {
                        $('div.table-2').html(result);
                        dataTable = $("#table-2").DataTable({
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
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else if($(this).attr('id') =='walk'){

    }
           

});




</script>

</body>
</html>