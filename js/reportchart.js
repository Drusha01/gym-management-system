function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

 var ctx1 = $("#revenue_chart").get(0).getContext("2d");
 $.ajax({url: '../dashboard/sales_and_revenue.php', 
    success: function(result){
        console.log(result);
        var sales_and_rev = JSON.parse(result);
        console.log(sales_and_rev);
        var data_val=[];
        var data_years=[];
        for (let index = 0; index < sales_and_rev.length; index++) {
            data_years.push(sales_and_rev[index].YEAR);
           data_val.push(sales_and_rev[index].Sales_Revenue)
        }
        var myChart1 = new Chart(ctx1, {
            type: "line",
            data: {
                labels: data_years,
                datasets: [{
                        label: "Revenue",
                        data: data_val,
                        backgroundColor: "rgba(0, 156, 255, .5)",
                        fill: true
                    },
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
    }
});
 

// Subscriptions
var ctx2 = $("#subscriptions").get(0).getContext("2d");


$.ajax({url: '../dashboard/report_subscriptions.php', 
    success: function(result){
        console.log(result);
        var obj = JSON.parse(result);
        console.log(obj);
        var data_val_gym=[];
        var data_val_trainer=[];
        var data_val_locker=[];
        var data_val_program=[];
        var data_labels=[];
        for (let index = 0; index < obj.length; index++) {
            data_labels.push(obj[index].subscription_start_date);
           data_val_gym.push(obj[index].gym_subscriptions_count)
           data_val_trainer.push(obj[index].trainer_subscriptions_count)
           data_val_locker.push(obj[index].locker_subscriptions_count)
           data_val_program.push(obj[index].program_subscriptions_count)
        }
        var myChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: data_labels,
                datasets: [{
                    label: "Gym Subscription",
                    borderColor:getRandomColor(),
                    data: data_val_gym,
                    tension: 0.1
                },
                {
                    label: "Trainer Susbcription",
                    borderColor:getRandomColor(),
                    data: data_val_trainer,
                    tension: 0.1
                },
                {
                    label: "Locker Subscription",
                    borderColor:getRandomColor(),
                    data: data_val_locker,
                    tension: 0.1
                },
                {
                    label: "Program Subscription",
                    borderColor:getRandomColor(),
                    data: data_val_program,
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
    }
});

// Most Availed

var ctx3 = $("#most-availed").get(0).getContext("2d");
$.ajax({url: '../dashboard/report_most_availed_offer.php', 
    success: function(result){
        console.log(result);
        var obj = JSON.parse(result);
        console.log(obj);
        var data_val=[];
        var data_labels=[];
        for (let index = 0; index < obj.length; index++) {
            data_labels.push(obj[index].subscription_offer_name);
            data_val.push(obj[index].subscription_quantity)
           
        }
        var myChart3 = new Chart(ctx3, {
            type: "bar",
            data: {
                labels: data_labels,
                datasets: [{
                    label: "Quantity",
                    borderColor:getRandomColor(),
                    data: data_val,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                  },
            }
        });
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
$.ajax({url: '../dashboard/report_most_availed_trainer.php', 
    success: function(result){
        console.log(result);
        var obj = JSON.parse(result);
        console.log(obj);
        var data_val=[];
        var data_labels=[];
        for (let index = 0; index < obj.length; index++) {
            data_labels.push(obj[index].user_fullname);
            data_val.push(obj[index].subscriber_trainers_trainer_count)
           
        }
        var myChart5 = new Chart(ctx5, {
            type: "bar",
            data: {
                labels: data_labels,
                datasets: [{
                    label: "Quantity",
                    color:getRandomColor(),
                    data: data_val,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                  },
            }
        });
    }
});