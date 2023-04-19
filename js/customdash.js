 // Worldwide Sales Chart
 var ctx1 = $("#total-subs").get(0).getContext("2d");
 var myChart1 = new Chart(ctx1, {
     type: "bar",
     data: {
         labels: ["Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"],
         datasets: [{
                 label: "Gym-Use",
                 data: [15, 30, 55, 65, 60, 80],
                 backgroundColor: "rgba(165, 215, 226, 1)"
             },
             {
                 label: "Trainer",
                 data: [8, 35, 40, 60, 70, 55],
                 backgroundColor: "rgba(243, 203, 156, 1)"
             },
             {
                 label: "Locker",
                 data: [12, 25, 45, 55, 65, 70],
                 backgroundColor: "rgba(0, 208, 58, 1)"
             },
             {
                label: "Programs",
                data: [12, 25, 45, 55, 65, 70],
                backgroundColor: "rgba(234, 135, 236, 1)"
            }
         ]
         },
     options: {
         responsive: true,
         maintainAspectRatio: false
     }
 });


 // Salse & Revenue Chart
 var ctx2 = $("#salse-revenue").get(0).getContext("2d");
  $.ajax({url: '../dashboard/sales_and_revenue.php', 
    success: function(result){
        // console.log(result);
        var sales_and_rev = JSON.parse(result);
        // console.log(sales_and_rev);
        var data_val=[];
        var data_years=[];
        for (let index = 0; index < sales_and_rev.length; index++) {
            data_years.push(sales_and_rev[index].YEAR);
           data_val.push(sales_and_rev[index].Sales_Revenue)
        }
        
        
        
        var myChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: data_years,
                datasets: [{
                        data_labels: "Income",
                        data: [15, 30, 55, 45, 70, 65, 85],
                        backgroundColor: "rgba(0, 156, 255, .5)",
                        fill: true
                    },
                    {
                        label: "Revenue",
                        data: data_val,
                        backgroundColor: "rgba(0, 156, 255, .3)",
                        fill: true
                    }
                ]
                },
            options: {
                responsive: true
            }
        });
    }
});
 
 
  // Pie Chart

  var ctx5 = $("#pie-chart").get(0).getContext("2d");
  $.ajax({url: '../dashboard/accounts_stat.php', 
    success: function(result){
        var data_val=[];
        var obj = JSON.parse(result);
        data_val.push(obj.not_verified);
        data_val.push(obj.verified);
        // console.log(obj.not_verified);
        // console.log(data_val);
        var myChart5 = new Chart(ctx5, {
            type: "pie",
            data: {
                labels: ["Not Verified", "Verified"],
                datasets: [{
                    backgroundColor: [
                        "rgba(253, 208, 35, .7)",
                        "rgba(0, 102, 0, .6)",
                        
                    ],
                    data: data_val
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});

  


  // doughnnut
 var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
    var myChart6 = new Chart(ctx6, {
        type: "doughnut",
        data: {
            labels: ["Paid","Pending", "Partial", "Unpaid", "Overdue"],
            datasets: [{
                backgroundColor: [
                    "rgba(0, 102, 0, .7)",
                    "rgba(253, 208, 35, .7)",
                    "rgba(0, 156, 255, .6)",
                    "rgba(204, 0, 0, .5)",
                    "rgba(153, 0, 0, .4)"
                ],
                data: [60, 30, 49, 44, 24]
            }]
        },
        options: {
            responsive: true
        }
    });

    // Single Bar Chart
    var ctx4 = $("#bar-chart").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {
            labels: ["Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"],
            datasets: [{
                label: "Walk-In",
                backgroundColor: [
                    "rgba(153, 0, 0, .7)",
                ],
                data: [10, 5, 3, 2, 10, 4]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });