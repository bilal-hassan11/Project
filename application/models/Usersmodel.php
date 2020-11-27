<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usersmodel
 *
 * @author zohaib
 */
class usersmodel extends CI_Model{
    function validateUser($username,$email)
    {
        $q="SELECT * FROM user WHERE `username`='".$this->db->escape_str($username)."' OR email='".$this->db->escape_str($email)."'";
        return $this->basic_model->getCustomRow($q);
    }
    function  checkUser($username)
    {
        $q="SELECT `users`.* FROM `users`
            WHERE `username`='".$this->db->escape_str($username)."'";
        return $this->basic_model->getCustomRow($q);
    }
    function changePassword($user_id)
    {
        $q="SELECT * FROM user WHERE id='$user_id'";
        return $this->basic_model->getCustomRow($q);
    }
    function getUsers($hotel_id)
    {
        $q="SELECT `users`.*,hotel.`short_name`,roles.`role` FROM `users`
            JOIN `user_roles` ON `user_roles`.`user_id`=`users`.`id`
            JOIN hotel ON hotel.`id`=`user_roles`.`hotel_id`
            JOIN roles ON roles.`role_id`=`user_roles`.`role_id`
            WHERE hotel_id='$hotel_id'";
        return $this->basic_model->getCustomRows($q);
    }
    function getUser($user_id)
    {
        $q="SELECT `users`.*,user_roles.hotel_id,user_roles.role_id,user_role_id FROM `users`
            JOIN `user_roles` ON `user_roles`.`user_id`=`users`.`id`
            WHERE user.id='$user_id'";
        return $this->basic_model->getCustomRow($q);
    }
    function getUserRights($user_id) {

        if(!$user_id) {
            return false;
            die();
        }

        $row = $this->basic_model->getRow('user','id',$user_id);
        $rights = unserialize($row['rights']);
        return $rights;
        /*echo "<pre>";
        print_r($rights);
        die();*/
    }
}

?>
