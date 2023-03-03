<?php 
    if(isset($_POST['gym_use_id']['offer_id']) && isset($_POST['gym_use_multiplier'])){
        echo $_POST['gym_use_id']['offer_id'];
        $gym_use_offer_id = $_POST['gym_use_id']['offer_id'];
        $gym_use_multiplier = $_POST['gym_use_multiplier'];
        
        $locker_multiplier;
        $locker_use_id;

        $trainer_use_id;
        $trainer_multiplier;
        $trainers_list;
        $trainer_quantity;

        $programs_use_id;
        $programs_multiplier;

        echo $_POST['gym_use_multiplier'];
    }
    
?>