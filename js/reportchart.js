function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

 // Salse & Revenue Chart
 var ctx1 = $("#salse-revenue").get(0).getContext("2d");
 var myChart1 = new Chart(ctx1, {
     type: "line",
     data: {
         labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
         datasets: [{
                 label: "Sales",
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
         responsive: true,
         interaction: {
            mode: 'index',
            intersect: false,
          },
     }
 });

// Subscriptions
var ctx2 = $("#subscriptions").get(0).getContext("2d");
var myChart2 = new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["03/26/2023","03/27/2023","03/28/2023","03/29/2023","03/30/2023","03/31/2023","04/01/2023"],
        datasets: [{
            label: "Gym Subscription",
            borderColor:getRandomColor(),
            data: [5,1,2,3,4,5,6],
            tension: 0.1
        },
        {
            label: "Trainer Susbcription",
            borderColor:getRandomColor(),
            data: [10,2,5,6,12,1,10],
            tension: 0.1
        },
        {
            label: "Locker Subscription",
            borderColor:getRandomColor(),
            data: [1,5,3,5,11,1,19],
            tension: 0.1
        },
        {
            label: "Program Subscription",
            borderColor:getRandomColor(),
            data: [3,4,3,2,28,2,1],
            tension: 0.1
        }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
          },
    }
});

// Most Availed

var ctx3 = $("#most-availed").get(0).getContext("2d");
var myChart3 = new Chart(ctx3, {
    type: "line",
    data: {
        labels: ["03/26/2023","03/27/2023","03/28/2023","03/29/2023","03/30/2023","03/31/2023","04/01/2023"],
        datasets: [{
            label: "Keno-Gym 1-Month",
            borderColor:getRandomColor(),
            data: [5,1,2,3,4,5,6],
            tension: 0.1
        },
        {
            label: "Keno-Gym 2-Month",
            borderColor:getRandomColor(),
            data: [2,4,3,2,18,3,9],
            tension: 0.1
        }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
          },
    }
});


// Most Frequent Customer
var ctx4 = $("#most-frequent").get(0).getContext("2d");
var myChart4 = new Chart(ctx4, {
    type: "line",
    data: {
        labels: ["03/26/2023","03/27/2023","03/28/2023","03/29/2023","03/30/2023","03/31/2023","04/01/2023"],
        datasets: [{
            label: "Trinidad, James Lorenz",
            borderColor:getRandomColor(),
            data: [5,1,2,3,4,5,6],
            tension: 0.1
        },
        {
            label: "Cruz, Juan Dela",
            borderColor:getRandomColor(),
            data: [2,4,3,2,10,3,9],
            tension: 0.1
        }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
          },
    }
});


// Most availed Trainer
var ctx5 = $("#trainer_most").get(0).getContext("2d");
var myChart5 = new Chart(ctx5, {
    type: "line",
    data: {
        labels: ["03/26/2023","03/27/2023","03/28/2023","03/29/2023","03/30/2023","03/31/2023","04/01/2023"],
        datasets: [{
            label: "Trinidad, James Lorenz",
            borderColor:getRandomColor(),
            data: [5,1,2,3,4,5,6],
            tension: 0.1
        },
        {
            label: "Cruz, Juan Dela",
            borderColor:getRandomColor(),
            data: [2,4,3,2,18,3,9],
            tension: 0.1
        }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
          },
    }
});