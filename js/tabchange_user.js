function load(status){
    if(status == 'history_subs'){
        $.ajax({
            type: "GET",
            url: 'historysubs.php',
            success: function(result)
            {
                $('div.table-responsive').html(result);
                dataTable = $("#history_subs").DataTable({
                    dom: 'Brtp',
                    responsive: true,
                    fixedHeader: true,
                });

                $('input#keyword').on('input', function(e){
                    var status = $(this).val();
                    dataTable.columns([1]).search(status).draw();
                });
                $('select#student_type').on('change', function(e){
                    var status = $(this).val();
                    dataTable.columns([2]).search(status).draw();
                });
                $('select#program').on('change', function(e){
                    var status = $(this).val();
                    dataTable.columns([3]).search(status).draw();
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }  
        });
    }/* else if(status == 'paid_hist'){
        $.ajax({
            type: "GET",
            url: 'paid_hist_tbl.php',
            success: function(result)
            {
                $('div.table-responsive').html(result);
                dataTable = $("#hist").DataTable({
                    dom: 'Brtp',
                    responsive: true,
                    fixedHeader: true,
                });

                $('input#keyword').on('input', function(e){
                    var status = $(this).val();
                    dataTable.columns([1]).search(status).draw();
                });
                $('select#student_type').on('change', function(e){
                    var status = $(this).val();
                    dataTable.columns([2]).search(status).draw();
                });
                $('select#program').on('change', function(e){
                    var status = $(this).val();
                    dataTable.columns([3]).search(status).draw();
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }  
        });
    } */
}
/* $(document).ready(function(){
    load('history_subs');

    $('#history_subs').on('click', function(){
        load('history_subs');
    });

    $('#paid_hist').on('click', function(){
        load('paid_hist');
    });
}); */