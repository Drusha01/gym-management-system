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
         responsive: true
     }
 });


 // Salse & Revenue Chart
 var ctx2 = $("#salse-revenue").get(0).getContext("2d");
 var myChart2 = new Chart(ctx2, {
     type: "line",
     data: {
         labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
         datasets: [{
                 label: "Income",
                 data: [15, 30, 55, 45, 70, 65, 85],
                 backgroundColor: "rgba(0, 156, 255, .5)",
                 fill: true
             },
             {
                 label: "Revenue",
                 data: [99, 135, 170, 130, 190, 180, 270],
                 backgroundColor: "rgba(0, 156, 255, .3)",
                 fill: true
             }
         ]
         },
     options: {
         responsive: true
     }
 });