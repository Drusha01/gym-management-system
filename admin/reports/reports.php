<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in2.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
    <h5 class="col-12 fw-bold mb-3">Reports</h5>
    <div id="update-nav">
        <div id="range-selector">
            <input type="button" id="1m" class="period ui-button" value="1m" />
            <input type="button" id="3m" class="period ui-button" value="3m"/>
            <input type="button" id="6m" class="period ui-button" value="6m"/>
            <input type="button" id="1y" class="period ui-button" value="1y"/>
            <input type="button" id="all" class="period ui-button" value="All"/>
        </div>
        <div id="date-selector" class="">
            From:<input type="text" id="fromDate"  class="ui-widget">
            To:<input type="text" id="toDate"  class="ui-widget">
        </div>
    </div>
        <br/>
    <div id="chartContainer" style="height: 360px; width: 100%;"></div>


  </div>
</main>

</body>

<script>
var dps = [];

var chart = new CanvasJS.Chart("chartContainer",
	{
  title: {
  	text: "Chart with Date Selector"
  },
  data: [
		{
    	type: "line",
    	dataPoints: randomData(new Date(2017, 0, 1), 400)
    }
  ]
});
chart.render();

var axisXMin = chart.axisX[0].get("minimum");
var axisXMax = chart.axisX[0].get("maximum");

function randomData(startX, numberOfY){
var xValue, yValue = 0;
for (var i = 0; i < 400; i += 1) {
				xValue = new Date(startX.getTime() + (i * 24 * 60 * 60 * 1000));
				yValue += (Math.random() * 10 - 5) << 0;

				dps.push({
					x: xValue,
					y: yValue
				});
			}
      return dps;
}

$( function() {
 	$("#fromDate").val(CanvasJS.formatDate(axisXMin, "DD MMM YYYY"));
  $("#toDate").val(CanvasJS.formatDate(axisXMax, "DD MMM YYYY"));
  $("#fromDate").datepicker({dateFormat: "d M yy"});
  $("#toDate").datepicker({dateFormat: "d M yy"});
});

$("#date-selector").change( function() {
	var minValue = $( "#fromDate" ).val();
  var maxValue = $ ( "#toDate" ).val();
  
  if(new Date(minValue).getTime() < new Date(maxValue).getTime()){  
  	chart.axisX[0].set("minimum", new Date(minValue));
  	chart.axisX[0].set("maximum", new Date(maxValue));
  }  
});

$(".period").click( function() {
	var period = this.id;  
  var minValue;
  minValue = new Date(axisXMax);
  
  switch(period){
  	case "1m":
      minValue.setMonth(minValue.getMonth() - 1);
      break;
    case "3m":
      minValue.setMonth(minValue.getMonth() - 3);
      break;
    case "6m":
      minValue.setMonth(minValue.getMonth() - 6);
      break;
    case "1y":
      minValue.setYear(minValue.getFullYear() - 1);
      break;
    default:
    	minValue = axisXMin;
	}
  
 	chart.axisX[0].set("minimum", new Date(minValue));  
  chart.axisX[0].set("maximum", new Date(axisXMax));
});

</script>

</html>