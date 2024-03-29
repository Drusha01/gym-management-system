 // Worldwide Sales Chart
 var ctx1 = $("#total-subs").get(0).getContext("2d");
 $.ajax({url: '../dashboard/report_subscriptions.php', 
    success: function(result){
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
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: data_labels,
                datasets: [{
                        label: "Gym-Use",
                        data: data_val_gym,
                        backgroundColor: "rgba(165, 215, 226, 1)"
                    },
                    {
                        label: "Trainer",
                        data: data_val_trainer,
                        backgroundColor: "rgba(243, 203, 156, 1)"
                    },
                    {
                        label: "Locker",
                        data: data_val_locker,
                        backgroundColor: "rgba(0, 208, 58, 1)"
                    },
                    {
                        label: "Programs",
                        data: data_val_program,
                        backgroundColor: "rgba(234, 135, 236, 1)"
                    }
                ]
                },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});


 // Salse & Revenue Chart
 var ctx2 = $("#salse-revenue").get(0).getContext("2d");
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
        
        
        
        var myChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: data_years,
                datasets: [
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
        console.log(data_val);
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
 $.ajax({url: '../dashboard/status_of_subscriptions.php', 
    success: function(result){
        console.log(result);
        var obj = JSON.parse(result);
        var data=[];
        data.push(obj.active_subscriptions);
        data.push(obj.pending_subscriptions);
        data.push(obj.terminated_subscriptions);
        data.push(obj.deleted_subscriptions);
        data.push(obj.completed_subscriptions);
        var myChart6 = new Chart(ctx6, {
            type: "doughnut",
            data: {
                labels: ["Active","Pending", "Terminated", "Deleted", "Completed"],
                datasets: [{
                    backgroundColor: [
                        "rgba(0, 102, 0, .7)",
                        "rgba(253, 208, 35, .7)",
                        "rgba(0, 156, 255, .6)",
                        "rgba(204, 0, 0, .5)",
                        "rgba(153, 0, 0, .4)"
                    ],
                    data: data
                }]
            },
            options: {
                responsive: true
            }
        });
    }
});
    

    // Single Bar Chart
    


$.ajax({url: '../dashboard/dashboard_walkins.php', 
    success: function(result){
        console.log(result);
        var obj = JSON.parse(result);
        console.log(obj);
        var data_val=[];
        var data_label=[];
        for (let index = 0; index < obj.length; index++) {
            data_label.push(obj[index].walk_in_date);
           data_val.push(obj[index].number_of_walkins)
        }
        
        
        
        var ctx4 = $("#bar-chart").get(0).getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "bar",
            data: {
                labels: data_label,
                datasets: [{
                    label: "Walk-In",
                    backgroundColor: [
                        "rgba(153, 0, 0, .7)",
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