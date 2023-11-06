var gym_use_id =null;
var gym_use_duration;
var gym_use_multiplier =1;

var locker_use_id;
var locker_quantity;
var locker_duration;
var locker_multiplier=1;

var trainer_use_id;
var trainer_duration;
var trainer_multiplier=1;
var trainers_id =[];
var trainers_list;
var trainers_list2;
var trainers_quantity=0;


var programs_use_id=[];
var program_list;
var programs_multiplier=[];
var program_duration;
var program_multiplier=1;
var program_quantity=1;
var programs_default=null;

var user_id;

function updateGymUseModal(){
    console.log('update gym use modal');
    if($('#gym-use-'+$('#gym_use').val()).attr('name') != null){
        var content = JSON.parse($('#gym-use-'+$('#gym_use').val()).attr('name'));
        console.log(content);
        //console.log(content);

        $('#gym_modal').attr('data-bs-target','#gym-use_subs');
        // UPDATE MODAL 
        $('#gym_offer_name').html(content.offer_name);
        $('#gym_offer_file').attr('src','../img/offer-contents/'+content.offer_file);
        $('#gym_offer_description').html(content.offer_description);
        $('#gym_age_qualification_details').html(content.age_qualification_details);
        $('#gym_offer_slots').html(content.offer_slots);
        $('#gym_offer_duration').html(content.offer_duration);
        $('#gym_offer_price').html(content.offer_price);

        // UDPATE THE DURATION 
        gym_use_id = content;
        gym_use_duration = content.offer_duration;
        gym_use_multiplier =1;
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
        $('#first_next').removeAttr('disabled');

  

        $('#locker_modal').attr('data-bs-target','');
        // update locker modal
        $('#locker_offer_name').html('');
        $('#locker_offer_file').attr('src','../img/offer-contents/'+'');
        $('#locker_offer_description').html('');
        $('#locker_age_qualification_details').html('');
        $('#locker_offer_slots').html('');
        $('#locker_offer_duration').html('');
        $('#locker_offer_price').html('');

        // update locker values
        locker_use_id=null;
        locker_duration =0;
        locker_quantity =0;
        locker_multiplier=1;
        $('#locker_use').val('None');
        $('#locker-quantity').val(0);
        $('#locker-total-duration').val(locker_duration*locker_multiplier);

        // update trainer modal
        //$('#locker_modal').attr('data-bs-target','#trainersubs');
        $('#locker_modal').attr('data-bs-target','');
        // update trainer values
        trainer_use_id =null;
        trainer_duration =0;
        trainer_multiplier=1;
         trainers_id = [];
         trainers_quantity=0;
        $('#trainer_use').val('None');
        $('.trainers').html('');
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
        $('#trainer_list_ul').html('')

        // update program modal
        $('#event_modal').attr('data-bs-target','');
        // update program values
        $('#program_use-0').val('None');
        $('#program-total-duration-0').val(0);
        $('#button-div-0').html('');
        $('#program_list_ul').html('');

        programs_use_id=[];
        program_list;
        programs_multiplier=[];
        program_duration;
        program_multiplier=1;
        program_quantity=1;
        programs_default=null;
    }else{
        // ask the user if he/she is sure to change it ?? modal maybe
        gym_use_id =null;
        gym_use_duration =0;
        gym_use_multiplier =1;
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
        

        // update locker modal
        $('#locker_modal').attr('data-bs-target','');
        // update locker modal
        $('#locker_offer_name').html('');
        $('#locker_offer_file').attr('src','../img/offer-contents/'+'');
        $('#locker_offer_description').html('');
        $('#locker_age_qualification_details').html('');
        $('#locker_offer_slots').html('');
        $('#locker_offer_duration').html('');
        $('#locker_offer_price').html('');

        // update locker values
        locker_use_id=null;
        locker_duration =0;
        locker_quantity =0;
        locker_multiplier=1;
        $('#locker_use').val('None');
        $('#locker-quantity').val(0);
        $('#locker-total-duration').val(locker_duration*locker_multiplier);

        // update trainer modal
        $('#locker_modal').attr('data-bs-target','');
        // update trainer values
        trainer_use_id =null;
        trainer_duration =0;
        trainer_multiplier=1;
         trainers_id = [];
         trainers_quantity=0;
        $('#trainer_use').val('None');
        $('.trainers').html('');
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
        $('#trainer_list_ul').html('')

        // update program modal
        // $('#event_modal').attr('data-bs-target','#eventsubs');
        $('#event_modal').attr('data-bs-target','');
        // update program values
        $('#program_use-0').val('None');
        $('#program-total-duration-0').val(0);
        $('#button-div-0').html('');
        $('#program_list_ul').html('');

        programs_use_id=[];
        program_list;
        programs_multiplier=[];
        program_duration;
        program_multiplier=1;
        program_quantity=1;
        programs_default=null;
        $('#first_next').attr('disabled','disabled');
    }
    
    
    
    
}

function gym_use_total_durationChange(){
    console.log('gym_use_total_durationChange');
    if(gym_use_id != null){
        if($('#gym_use_total_duration').val()>gym_use_duration*gym_use_multiplier){
            gym_use_multiplier++;
        }else  {
            gym_use_multiplier--;
            // check other value
            if(locker_duration*locker_multiplier>gym_use_duration*gym_use_multiplier || trainer_duration*trainer_multiplier >gym_use_duration*gym_use_multiplier){
                let text = "Gym use duration is less than the other duration!\n Reset other subscription? ";
                if (confirm(text) == true) {
                     // update locker values
                    $('#locker_modal').attr('data-bs-target','');
                    locker_use_id=null;
                    locker_duration =0;
                    locker_quantity =0;
                    locker_multiplier=1;
                    $('#locker_use').val('None');
                    $('#locker-quantity').val(0);
                    $('#locker-total-duration').val(locker_duration*locker_multiplier);

                    // update trainer modal
                    $('#locker_modal').attr('data-bs-target','');
                    // update trainer values
                    trainer_use_id =null;
                    trainer_duration =0;
                    trainer_multiplier=1;
                     trainers_id = [];
                     trainers_quantity=0;
                    $('#trainer_use').val('None');
                    $('.trainers').html('');
                    $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
                    $('#trainer_list_ul').html('')

                    // update program modal
                    $('#event_modal').attr('data-bs-target','');    
                    // update program values
                    $('#program_use-0').val('None');
                    $('#program-total-duration-0').val(0);
                    $('#button-div-0').html('');
                    $('#program_list_ul').html('');

                    programs_use_id=[];
                    program_list;
                    programs_multiplier=[];
                    program_duration;
                    program_multiplier=1;
                    program_quantity=1;
                    programs_default=null;
                } else {
                    gym_use_multiplier++;
                }
            }
            var counter=0;
            programs_use_id.forEach(element => {
                console.log(programs_multiplier[counter].duration);
                if(programs_multiplier[counter].duration > gym_use_duration*gym_use_multiplier){
                    let text = "Gym use duration is less than the other duration!\n Reset other subscription? ";
                    if (confirm(text) == true) {
                        // update locker values
                        $('#locker_modal').attr('data-bs-target','');
                        locker_use_id=null;
                        locker_duration =0;
                        locker_quantity =0;
                        locker_multiplier=1;
                        $('#locker_use').val('None');
                        $('#locker-quantity').val(0);
                        $('#locker-total-duration').val(locker_duration*locker_multiplier);

                        // update trainer modal
                        $('#locker_modal').attr('data-bs-target','');
                        // update trainer values
                        trainer_use_id =null;
                        trainer_duration =0;
                        trainer_multiplier=1;
                        trainers_id = [];
                        trainers_quantity=0;
                        $('#trainer_use').val('None');
                        $('.trainers').html('');
                        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
                        $('#trainer_list_ul').html('')

                        // update program modal
                        $('#event_modal').attr('data-bs-target','');    
                        // update program values
                        $('#program_use-0').val('None');
                        $('#program-total-duration-0').val(0);
                        $('#button-div-0').html('');
                        $('#program_list_ul').html('');

                        programs_use_id=[];
                        program_list;
                        programs_multiplier=[];
                        program_duration;
                        program_multiplier=1;
                        program_quantity=1;
                        programs_default=null;
                    } else {
                        gym_use_multiplier++;
                    }
                }
                
                counter++;
            });
            
        }
        if(gym_use_multiplier == 0){
            gym_use_multiplier=1;
        }
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
    }else{
        alert('please select Gym-Subscription');
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
    }
}

// ---------------------------------------------------- LOCKER ----------------------------------------------------

function updateLockerUseModal(){
    // first check if the gym use id is populater
    if(gym_use_id != null){
        if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
            console.log('update locker use modal');
            var content = JSON.parse($('#locker-use-'+$('#locker_use').val()).attr('name'));
            console.log(content);

            // UPDATE MODAL 
            $('#locker_modal').attr('data-bs-target','#lockersubs');
            // update locker modal
            $('#locker_offer_name').html(content.offer_name);
            $('#locker_offer_file').attr('src','../img/offer-contents/'+content.offer_file);
            $('#locker_offer_description').html(content.offer_description);
            $('#locker_age_qualification_details').html(content.age_qualification_details);
            $('#locker_offer_slots').html(content.offer_slots);
            $('#locker_offer_duration').html(content.offer_duration);
            $('#locker_offer_price').html(content.offer_price);
            
            if(content.offer_duration*locker_multiplier<= gym_use_duration*gym_use_multiplier){
                // UPDATE DURATION AND QUANTITY
                locker_use_id=content;
                locker_duration =content.offer_duration;
                locker_quantity =1;
                $('#locker-quantity').val(1);
                $('#locker-total-duration').val(locker_duration*locker_multiplier);
            }else{
                alert('Locker duration can\'t be greater than Gym duration');
                locker_use_id=null;
                locker_duration =0;
                $('#locker-quantity').val(0);
                $('#locker-total-duration').val(locker_duration*locker_multiplier);
                $('#locker_use').val('None');
            }
        }else{
            $('#locker_modal').attr('data-bs-target','');  
            locker_use_id=null;
            locker_duration =0;
            $('#locker-quantity').val(0);
            $('#locker-total-duration').val(locker_duration*locker_multiplier);
        }
        
    }else{
        alert('please select Gym-Subscription');
        $('#locker_use').val('None');
    }
}

function locker_use_total_durationChange(){
    console.log('locker_use_total_durationChange');
    if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
        if($('#locker-total-duration').val()>locker_duration*locker_multiplier){
            locker_multiplier++;
            // check if the locker is greater than the gym use
            if(locker_duration*locker_multiplier >gym_use_duration*gym_use_multiplier){
                locker_multiplier--;
                alert('locker use can\'t be greater than gym use');
            }
        }else  {
            locker_multiplier--;
            
        }
        if(locker_multiplier == 0){
            locker_multiplier=1;
        }
        $('#locker-total-duration').val(locker_duration*locker_multiplier);
    }else{
        alert('please select Locker-Subscription');
        $('#locker_use').val('None');
        $('#locker-total-duration').val(locker_duration*locker_multiplier);
    }
}

function locker_use_quantityChange(){
    if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
        locker_quantity =$('#locker-quantity').val();
        if(locker_use_id !=0 && $('#locker-quantity').val()<=0){
            $('#locker-quantity').val(1); 
        }
    }else{
        alert('please select Locker-Subscription');
        $('#locker_use').val('None');
        $('#locker-quantity').val(0);
    }
}

// ---------------------------------------------------- TRAINER ----------------------------------------------------
function updateTrainerUseModal(){
    if(gym_use_id != null){
        if($('#trainer-use-'+$('#trainer_use').val()).attr('name')!=null){
            console.log('update trainer use modal');
            var content = JSON.parse($('#trainer-use-'+$('#trainer_use').val()).attr('name'));
            console.log(content);

            // UPDATE MODAL 
            $('#trainer_modal').attr('data-bs-target','#trainersubs');
            // update locker modal
            $('#trainer_offer_name').html(content.offer_name);
            $('#trainer_offer_file').attr('src','../img/offer-contents/'+content.offer_file);
            $('#trainer_offer_description').html(content.offer_description);
            $('#trainer_age_qualification_details').html(content.age_qualification_details);
            $('#trainer_offer_slots').html(content.offer_slots);
            $('#trainer_offer_duration').html(content.offer_duration);
            $('#trainer_offer_price').html(content.offer_price);
            if(content.offer_duration*trainer_multiplier<= gym_use_duration*gym_use_multiplier){

                // UPDATE DURATION 
                trainer_use_id=content;
                trainer_duration =content.offer_duration;
                $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
                trainers_list = JSON.parse($('#trainer_use').attr('name'));
                trainers_list2=trainers_list;
                add_newTrainer();
            }else{
                alert('Trainer duration can\'t be greater than Gym duration');
                trainer_use_id=null;
                trainer_duration =0;
                trainers_id = [];
                trainers_quantity=0;
                $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
                $('.trainers').html('');
                $('#trainer_list_ul').html('');
                $('#trainer_use').val('None');
            }
        }else{
            // set all to default
            $('#trainer_modal').attr('data-bs-target','');
            trainer_use_id=null;
            trainer_duration =0;
            trainers_id = [];
            trainers_quantity=0;
            $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
            $('.trainers').html('');
            $('#trainer_list_ul').html('');
        }
    }else{
        alert('please select Gym-Subscription');
        $('#trainer_use').val('None');
    }
}

function trainer_use_total_durationChange(){
    //console.log('trainer_use_total_durationChange');
    if($('#trainer-use-'+$('#trainer_use').val()).attr('name')!=null){
        if($('#trainer-total-duration').val()>trainer_duration*trainer_multiplier){
            trainer_multiplier++;
            // check if the locker is greater than the gym use
            if(trainer_duration*trainer_multiplier >gym_use_duration*gym_use_multiplier){
                trainer_multiplier--;
                alert('trainer duration can\'t be greater than gym use');
            }
        }else  {
            trainer_multiplier--;
            
        }
        if(trainer_multiplier == 0){
            trainer_multiplier=1;
        }
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
    }else{
        alert('please select Trainer-Subscription');
        $('#trainer_use').val('None');
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
    }
}

function trainer_selected_changed(selected_id){
    console.log('trainer_selected cahgned');
    // update the trainer-selected modal

    $.ajax({
        type: "GET",
        url: '../user/trainer_info.php?trainer_id='+$('#select-trainer-'+selected_id).val(),
        success: function(result)
        {
            console.log(result);
            $('#trainer_info_modal').html(result);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }
    });
    // update trainer list 
    console.log('selected_index:'+selected_id);   
    console.log('selected:'+$('#select-trainer-'+selected_id).val());
    var selectedVal = $('#select-trainer-'+selected_id).val();
    
    if(selectedVal != 'None'){
        $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-sm btn-success d-flex justify-content-center align-items-center" onclick="add_newTrainer('+selected_id+')"><i class="bx bx-plus-circle py-1"></i></button>');
    }
    
    console.log(trainers_id);
}

function deleteTrainer(trainer_id){
    
    //trainers_id.remove(selected_id);
   trainers_id.forEach(function(element,index) {
        if(element.trainer_id == trainer_id){
            trainers_id.splice(index, 1);
            $('#trainer_id_'+trainer_id).remove();
        }
   });
   
    console.log(trainers_id)
    

}   


function add_newTrainer(selected_id){
    
    console.log('add new trainer');
    console.log(trainers_list);
    var selectedVal = $('#select-trainer-'+selected_id).val();
    // $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-sm btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
    $('#button-trainer-'+selected_id).html('');

    var valid =true;
    trainers_id.forEach(element => {
        if(element.trainer_id == selectedVal ){
            alert('already selected');
            valid = false;
            return;
        }
    });
    trainers_list.forEach(element => {
        if(element.trainer_id == selectedVal && valid){
            console.log(element)
            trainers_id.push(element);
            // add to the list
            $('#trainer_list_ul').append('<li class="py-1" id="trainer_id_'+element.trainer_id+'"><button type="button" class="btn btn-sm btn-danger" onclick="deleteTrainer('+element.trainer_id+')"><i class="bx bx-minus-circle mt-1"></i></button> '+element.user_fullname+' </li>');
            $('#select-trainer-'+selected_id).val('None');
        }
    });

    // only add if the trainers_id is less than the trainer_list
    
    if(trainers_quantity <10){
        trainers_quantity = 100;;
        $('.trainers').append('<div class="row" id=trainer><div class="col-10 col-lg-6 pb-2"><label class="fw-bold pb-2 ps-1">Search Trainer</label><select class="form-select" id="select-trainer-'+(trainers_quantity)+'" aria-label="Default select example" onchange="trainer_selected_changed('+(trainers_quantity)+')"><option value="None" selected>Open this select menu</option></select></div><div class="col-1 align-self-end mb-1 mb-lg-2"><button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalTrainer"><strong>?</strong></button></div><div class="col-12 col-lg-1 btn-group align-self-end py-1 py-lg-2" id="button-trainer-'+(trainers_quantity)+'"></div></div> ');
        trainers_list2.forEach(element => {
            $('#select-trainer-'+(trainers_quantity)).append('<option value="'+element.trainer_id+'" >'+element.user_fullname+'</option>');
        });
    }
    
}
// ---------------------------------------------------- PROGRAM ----------------------------------------------------
function updateProgramUseModal(selected_id){
    
    if(gym_use_id != null){
        if($('#program-use-'+$('#program_use-'+selected_id).val()).attr('name')!=null){
            if(programs_default == null){
                programs_default = $('.programs').html();
            }
            console.log('update program use modal');
            $('#event_modal').attr('data-bs-target','#eventsubs');
            
            if(program_list == null){
                program_list = JSON.parse($('#program_use-'+selected_id).attr('name'));
            }
            
            console.log(program_list);
            var selectedVal =$('#program_use-'+selected_id).val();
            console.log($('#program_use-'+selected_id).val());
            var valid = true;
            programs_use_id.forEach(element => {
                if(selectedVal == element.offer_id ){
                    alert('already selected');
                    valid = false;
                    return;
                }
            });
            program_list.forEach(element => {
                if(selectedVal == element.offer_id && valid){
                    // update program modal
                    $('#program_offer_name').html(element.offer_name);
                    $('#program_offer_file').attr('src','../img/offer-contents/'+element.offer_file);
                    $('#program_offer_description').html(element.offer_description);
                    $('#program_age_qualification_details').html(element.age_qualification_details);
                    $('#program_offer_slots').html(element.offer_slots);
                    $('#program_offer_duration').html(element.offer_duration);
                    $('#program_offer_price').html(element.offer_price);
                    program_duration = element.offer_duration;
                    program_multiplier = 1;
                    $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier)
                    $('#button-div-0').html('<button type="button" class="btn btn-sm btn-success d-flex justify-content-center align-items-center" onclick="addNewProgram('+element.offer_id+')"><i class="bx bx-plus-circle py-1"></i></button>');
                }
            });
        }else{
            // set all to default
            program_duration = 0;
            program_multiplier = 1;
            $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier)
            $('#button-div-0').html('');
        }
    }else{
        alert('please select Gym-Subscription');
        $('#program_use').val('None');
    }
}

function addNewProgram(selected_id){
    var selectedVal = $('#program-use-'+selected_id).val();
    console.log(selectedVal);
    var valid = true;
    programs_use_id.forEach(element => {
        if(selectedVal == element.offer_id){
            alert('already selected');
            valid = false;
            return;
        }
    });
    program_list.forEach(element => {
        if(selectedVal == element.offer_id && valid){
            console.log($('#program-total-duration-0').val());
            console.log(element);
            programs_use_id.push(element);
            programs_multiplier.push({duration:$('#program-total-duration-0').val()});
            $('#program_list_ul').append('<li class="py-1" id="program_id_'+element.offer_id+'"><button type="button" class="btn btn-sm btn-danger" onclick="deleteProgram('+element.offer_id+')"><i class="bx bx-minus-circle mt-1"></i></button> '+$('#program-use-'+selected_id).html()+' DURATION ('+$('#program-total-duration-0').val()+') </li>')

        }
    });
    console.log(programs_use_id);
}

function deleteProgram(selected_id){
    var selectedVal = $('#program-use-'+selected_id).val();
    programs_use_id.forEach(function(element,index)  {
        if(element.offer_id == selectedVal){
            programs_use_id.splice(index, 1);
            programs_multiplier.splice(index, 1);
            $('#program_id_'+element.offer_id).remove();
        }
    });

}

function program_use_total_durationChange(selected_id){
    if($('#program-use-'+$('#program_use-'+selected_id).val()).attr('name')!=null){
        if($('#program-total-duration-'+selected_id).val()>program_duration*program_multiplier){
            program_multiplier++;
            // check if the locker is greater than the gym use
            if(program_duration*program_multiplier >gym_use_duration*gym_use_multiplier){
                program_multiplier--;
                alert('program duration can\'t be greater than gym use');
            }
        }else  {
            program_multiplier--;
            
        }
        if(program_multiplier == 0){
            program_multiplier=1;
        }
        $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier);
    }else{
        alert('please select Program-Subscription');
        $('#program_use').val('None');
        $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier);
    }
}
// ---------------------------------------------------- VALIDATE ALL SUBSCRIPTION ----------------------------------------------------
function validate_allSubscriptions(){
    console.log('validating all subscription')
    
    if(!gym_use_id){
        alert('gym use not selected');
        
    }
    $('#tbody_summary').html('');
    // first check the gym use
    if(gym_use_id){
        var total = gym_use_multiplier*gym_use_id.offer_price;
        // check locker
        console.log(gym_use_id);
        var counter =1;
        $('#tbody_summary').append('<tr><th scope="row">'+counter+'</th><td>'+gym_use_id.offer_name+'</td><td class="text-center" >1</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(gym_use_id.offer_price)+'</td><td class="text-center" >'+gym_use_id.offer_duration+'</td><td class="text-center" >'+gym_use_multiplier*gym_use_id.offer_duration+'</td><td class="text-center" >1 X ('+gym_use_multiplier*gym_use_id.offer_duration+'/'+gym_use_id.offer_duration+') X ₱'+new Intl.NumberFormat('en-US').format(gym_use_id.offer_price)+' =</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(gym_use_multiplier*gym_use_id.offer_price)+'</td></tr>');
        counter++;
        if(locker_use_id != null && locker_use_id.offer_duration <= gym_use_id.offer_duration  ){
            console.log(locker_use_id);
            $('#tbody_summary').append('<tr><th scope="row">'+counter+'</th><td>'+locker_use_id.offer_name+'</td><td class="text-center" >'+locker_quantity+'</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(locker_use_id.offer_price)+'</td><td class="text-center" >'+locker_use_id.offer_duration+'</td><td class="text-center" >'+locker_multiplier*locker_use_id.offer_duration+'</td><td class="text-center" >'+locker_quantity+' X ('+locker_multiplier*locker_use_id.offer_duration+'/'+locker_use_id.offer_duration+') X ₱'+new Intl.NumberFormat('en-US').format(locker_use_id.offer_price)+' =</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(locker_quantity*locker_multiplier*locker_use_id.offer_price)+'</td></tr>');
            counter++;
            total+=locker_quantity*locker_multiplier*locker_use_id.offer_price;
        }
        if(trainer_use_id !=null && trainer_use_id.offer_duration <= gym_use_id.offer_duration && trainers_id.length>0){
            $('#tbody_summary').append('<tr><th scope="row">'+counter+'</th><td>'+trainer_use_id.offer_name+'</td><td class="text-center" >'+trainers_id.length+'</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(trainer_use_id.offer_price)+'</td><td class="text-center" >'+trainer_use_id.offer_duration+'</td><td class="text-center" >'+trainer_multiplier*trainer_use_id.offer_duration+'</td><td class="text-center" >'+trainers_id.length+' X ('+trainer_multiplier*trainer_use_id.offer_duration+'/'+trainer_use_id.offer_duration+') X ₱'+new Intl.NumberFormat('en-US').format(trainer_use_id.offer_price)+' =</td><td class="text-center" >₱'+new Intl.NumberFormat('en-US').format(trainers_id.length*trainer_multiplier*trainer_use_id.offer_price)+'</td></tr>');
            console.log(trainer_use_id);
            console.log(trainers_id);
            counter++;
            total+=trainers_id.length*trainer_multiplier*trainer_use_id.offer_price;
        }
        if(programs_use_id.length>0){
            for (let index = 0; index < programs_multiplier.length; index++) {
                if(programs_multiplier[index]<= gym_use_id.offer_duration){
                    console.log(programs_use_id);
                    console.log(programs_multiplier);
                }
                
            }
            programs_use_id.forEach(function(element,index) {
                $('#tbody_summary').append('<tr><th scope="row">'+counter+'</th><td>'+element.offer_name+'</td><td class="text-center" >1</td><td class="text-center" >₱'+(new Intl.NumberFormat('en-US').format(element.offer_price))+'</td><td class="text-center" >'+element.offer_duration+'</td><td class="text-center" >'+programs_multiplier[index].duration+'</td><td class="text-center" >1 X ('+programs_multiplier[index].duration+'/'+element.offer_duration+') X ₱'+new Intl.NumberFormat('en-US').format(element.offer_price)+' =</td><td class="text-center" >₱'+(new Intl.NumberFormat().format(1*(programs_multiplier[index].duration/element.offer_duration)*element.offer_price))+'</td></tr>');
                counter++;
                total+=(programs_multiplier[index].duration/element.offer_duration)*element.offer_price;
            });
        }
        $('#total_price').html('₱'+new Intl.NumberFormat('en-US').format(total));
    }
    
    
    
    
}

// avail
function avail(){
    console.log('avail');
    $.ajax({
    method: "POST",
    url: "admin-avail.php",
    dataType: 'text',
    data: { user_id:user_id, gym_use_id:gym_use_id, gym_use_multiplier:gym_use_multiplier,locker_use_id: locker_use_id,locker_quantity:locker_quantity, locker_multiplier:locker_multiplier,
    
        trainer_use_id:trainer_use_id,trainer_multiplier:trainer_multiplier,trainers_id:trainers_id,programs_use_id:programs_use_id,programs_multiplier:programs_multiplier
    },
    success: function(result){
        console.log(result);
        if(result == 1){
            console.log(result);
            alert('Availed successfully');
            
            location.href = "../avail/activate.php?user_id="+user_id;
        }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
    });

}

// var gym_use_id =null;
// var gym_use_duration;
// var gym_use_multiplier =1;

// var locker_use_id;
// var locker_quantity;
// var locker_duration;
// var locker_multiplier=1;

// var trainer_use_id;
// var trainer_duration;
// var trainer_multiplier=1;
// var trainers_id =[];
// var trainers_list;
// var trainers_list2;
// var trainers_quantity=0;


// var programs_use_id=[];
// var program_list;
// var programs_duration=[];
// var program_duration;
// var program_multiplier=1;
// var program_quantity=1;
// var programs_default=null;
