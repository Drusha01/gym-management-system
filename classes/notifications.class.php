<?php 
require_once 'database.php';
class notifications
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($notification_creator,$notification_target,$notification_type_details,$notification_icon_details,$notification_info){
        try{
            $sql = 'INSERT INTO notifications (notification_id,notification_creator,notification_target,notification_type_id,notification_icon_id,notification_info,notification_is_read,notification_date_created,notification_date_updated) VALUES
            (
                null,
                :notification_creator,
                :notification_target,
                (SELECT notification_type_id FROM notification_types WHERE notification_type_details =:notification_type_details),
                (SELECT notification_icon_id FROM notification_icons WHERE notification_icon_details =:notification_icon_details),
                :notification_info,
                0,
                NOW(),
                NOW()
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_creator', $notification_creator);
            $query->bindParam(':notification_target', $notification_target);
            $query->bindParam(':notification_type_details', $notification_type_details);
            $query->bindParam(':notification_icon_details', $notification_icon_details);
            $query->bindParam(':notification_info', $notification_info);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_notification_with_id($notification_id){
        try{
            $sql = 'SELECT notification_id,notification_target,notification_icon_details,notification_type_details,notification_info,notification_date_created,notification_date_updated,notification_info,notification_is_read FROM notifications
            LEFT OUTER JOIN notification_types ON notification_types.notification_type_id=notifications.notification_type_id
            LEFT OUTER JOIN notification_icons ON notification_icons.notification_icon_id=notifications.notification_icon_id
            WHERE notification_id = :notification_id 
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_id', $notification_id);
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function update($notification_id){
        try{
            $sql = 'UPDATE notifications 
            SET notification_is_read = true
            WHERE notification_id = :notification_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_id', $notification_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete($notification_id){
        try{
            $sql = 'DELETE FROM notifications WHERE notification_id = :notification_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_id', $notification_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function mark_all_as_read($notification_target){
        try{
            $sql = 'UPDATE notifications 
            SET notification_is_read = true
            WHERE notification_target = :notification_target;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_target', $notification_target);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    

    

    function get_number_of_notifications($notification_target){
        try{
            $sql = 'SELECT count(notification_is_read)as number_of_notification FROM notifications 
            WHERE notification_target = :notification_target AND notification_is_read = 0
            ORDER BY notification_date_created DESC;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_target', $notification_target);
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function get_three_latest_notifications($notification_target){
        try{
            $sql = 'SELECT notification_id,notification_icon_details,notification_type_details,notification_date_created,notification_date_updated,notification_info,notification_is_read FROM notifications
            LEFT OUTER JOIN notification_types ON notification_types.notification_type_id=notifications.notification_type_id
            LEFT OUTER JOIN notification_icons ON notification_icons.notification_icon_id=notifications.notification_icon_id
            WHERE notification_target = :notification_target 
            ORDER BY notification_date_created DESC
            LIMIT 3
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_target', $notification_target);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function get_notifications($notification_target){
        try{
            $sql = 'SELECT notification_id,notification_icon_details,notification_type_details,notification_info,notification_date_created,notification_date_updated,notification_info,notification_is_read FROM notifications
            LEFT OUTER JOIN notification_types ON notification_types.notification_type_id=notifications.notification_type_id
            LEFT OUTER JOIN notification_icons ON notification_icons.notification_icon_id=notifications.notification_icon_id
            WHERE notification_target = :notification_target 
            ORDER BY notification_date_created DESC
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':notification_target', $notification_target);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    

    
    
}


?>