<?php



/**

 * Description of users

 *

 */

class users extends CI_Controller {



    function __construct() {



        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('basic_model');
        $this->load->model('admin_model');
        $this->load->model('usersmodel');
        $this->load->library('encryption');
        $this->load->database();
	    $this->user_id = $this->session->userdata("id");

    }



    function index() {

        $this->login();
        $user_id = $this->session->userdata("id");
        if ($user_id != "") {

            redirect(site_url("System_users"));
        }

    }

    function signup() {

        $this->load->library(('encryption'));
        if ($this->input->post()) {
            extract($_POST);
            if (empty($username) || empty($email) || empty($password)) {

                echo json_encode(array("error" => 1, "message" => "Missing parameters"));
            } else {

                $userdata = $this->usersmodel->validateUser($username, $email);

                if (is_array($userdata)) {

                    echo json_encode(array("error" => 1, "message" => "Username or email already exist"));

                } else {

                    $password = $this->encryption->encrypt($password);

                    $arr = array("username" => $username, "email" => $email, "password" => $password, "dob" => date("Y-m-d H:i:s", strtotime(@$dob)), "gender" => (is_numeric(@$gender) ? $gender : 0), "country" => @$country, "dateof" => date("Y-m-d H:i:s"));

                    $this->basic_model->insertRecord($arr, "users");

                    echo json_encode(array("success" => 1, "error" => 0, "message" => "User registered successfully"));

                }

            }

        } else {

            echo json_encode(array("error" => 1, "message" => "Please call valid request"));

        }

    }



    function login() {

      // getting requested URI

        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $_SERVER['REQUEST_URI'], $url);

        if(isset($url[0][0])) {

          $this->session->set_userdata(array('referrel'=>$url[0][0]));

        }



        $this->load->library(('encryption'));



        if ($this->input->post()) {

            extract($_POST);



            if(empty($username) || empty($password)) {

                echo "<script>alert('Error: Enter Username / Password Before Submitting!')</script>";

                echo "<script>window.open('".site_url('users/login')."','_self')</script>";

                exit;

            } else {



                $userdata = $this->usersmodel->checkUser($username);
                if ($userdata['user_status'] == 'blocked') {
                    echo "<script>alert('Your account is blocked!. please contact customer service to restore your account')</script>";

                    echo "<script>window.open('".site_url('users')."','_self')</script>";

                    exit;
                }


                $session_arr = array();






                $session_arr['user_id'] = $userdata['id'];

                $session_arr['username'] = $userdata['username'];
                $session_arr['role'] = $userdata['role'];





                $ppassword = $this->encryption->decrypt(@$userdata['password']);



                if ($ppassword == $password) {

                    $redirect = "";



                    if($this->session->userdata('referrel') != '') {

                      $redirect = $this->session->userdata('referrel');

                    } else {

                      $redirect = site_url("admin/dashboard");

                    }



                    $this->session->set_userdata($session_arr);


                    // echo json_encode(array("success" => "", "redirect" => $redirect));
                    $data_auths=$this->admin_model->getAuths();
                      $this->session->set_userdata('is_order_no',$data_auths->order_no);
                      $this->session->set_userdata('is_customer',$data_auths->customer);
                      $this->session->set_userdata('is_date_order',$data_auths->date_order);
                      $this->session->set_userdata('is_received_date',$data_auths->received_date);
                      $this->session->set_userdata('is_status',$data_auths->status);
                      $this->session->set_userdata('is_descr',$data_auths->descr);
                      $this->session->set_userdata('is_img',$data_auths->img);
                      $this->session->set_userdata('is_title',$data_auths->title);
                      $this->session->set_userdata('is_supplier',$data_auths->supplier);
                      $this->session->set_userdata('is_track_numb',$data_auths->track_numb);
                      $this->session->set_userdata('is_asin_numb',$data_auths->asin_numb);
                      $this->session->set_userdata('is_quantity',$data_auths->quantity);
                      $this->session->set_userdata('is_size',$data_auths->size);
                      $this->session->set_userdata('is_service',$data_auths->service);
                      $this->session->set_userdata('is_cond',$data_auths->cond);

                    echo "<script>alert('Successfully logged In!')</script>";

                    echo "<script>window.open('".$redirect."','_self')</script>";

                } else {

                    // echo json_encode(array("error" => "Invalid username or password"));

                    echo "<script>alert('Error: Invalid username or password!')</script>";

                    echo "<script>window.open('".site_url('users')."','_self')</script>";

                    exit;

                }

            }

        } else {

            $this->load->view("login");

        }

    }



    function changePassword() {

        $this->load->library(('encryption'));

        if ($this->input->post()) {

            extract($_POST);

            if (empty($old_password) || empty($new_password) || empty($confirm_password)) {

                echo json_encode(array("error" => 1, "message" => "Missing parameters"));

            } else if ($new_password != $confirm_password) {

                echo json_encode(array("error" => "Passwords did not matched."));

            } else {

                $user_id = $this->session->userdata('user_id');

                $userdata = $this->usersmodel->changePassword($user_id);

                $ppassword = $this->encryption->decrypt($userdata['password']);



                if ($ppassword == $old_password) {

                    $new_password = $this->encryption->encrypt($new_password);

                    $arr = array("password" => $new_password);

                    $this->basic_model->updateRecord($arr, "user", "id", $user_id);

                    echo json_encode(array("success" => "Successfully Changed!","redirect"=>site_url()));

                } else {

                    echo json_encode(array("error" => "Invalid Password!"));

                }

            }

        } else {

            echo json_encode(array("error" => 1, "message" => "Please call valid request"));

        }

    }



    function settings(){

        $data=array(

            'title'=>"Settings",

            "active_menu" => "settings",

            "settings" => $this->basic_model->getRows("settings","meta_type","purchase_form"),

            'user_rights' => $this->rights,

        );



        $this->load->view("header",$data);

        $this->load->view("sidebar");

        $this->load->view("topmenu");

        $this->load->view("settings");

        $this->load->view("footer");

    }



    function system_settings(){



        if($this->input->post()){

            $field_meta_value = $this->input->post('field_box_tare');

            $plastic_meta_value = $this->input->post('plastic_box_tare');

            $carton_tare = $this->input->post('carton_tare');

            $bag_tare = $this->input->post('bag_tare');



            // field value

            $this->db->where("meta_type","pitting_voucher_outward");

            $this->db->where("meta_section","field_box_tare");

            $this->db->update("settings",array("meta_value"=>$field_meta_value));



            // plastic value

            $this->db->where("meta_type","pitting_voucher_outward");

            $this->db->where("meta_section","plastic_box_tare");

            $this->db->update("settings",array("meta_value"=>$plastic_meta_value));



            // carton tare value

            $this->db->where("meta_type","finished_produced_voucher");

            $this->db->where("meta_section","carton_tare");

            $this->db->update("settings",array("meta_value"=>$carton_tare));



            // bag tare value

            $this->db->where("meta_type","finished_produced_voucher");

            $this->db->where("meta_section","bag_tare");

            $this->db->update("settings",array("meta_value"=>$bag_tare));



            echo json_encode(array("success"=>"Settings updated successfully!","redirect"=>site_url("users/system_settings")));

        }else{



            $user_id = $this->session->userdata('id');

            $data=array(

                'title'=>"System Settings",

                "settings" => $this->basic_model->getMultiData("settings"),

                'user_rights' => $this->usersmodel->getUserRights($user_id)

            );



            $this->load->view("header",$data);

            $this->load->view("sidebar");

            $this->load->view("topmenu");

            $this->load->view("system_settings");

            $this->load->view("footer");

        }

    }



    function update_settings(){



    }



    function logout() {

        $this->session->sess_destroy();

        redirect(site_url(), 'refresh');

    }



    function pdr() {

        $this->load->library(('encryption'));

        $user=$this->basic_model->getMultiData("user");

        foreach ($user as $key => $value) {

            $this->basic_model->updateRecord(array("password"=>$this->encryption->encrypt("123")),"user","id",$value['id']);

        }

    }



    function test() {

        $this->load->library(('encryption'));

        echo $this->encryption->decrypt("SmngsThyklTKnHLyUslj4kwiiYUzKQiVPXHWN4pNx/z4RYJ9dQovg457y6CWImedIjiMov4kUJLlkf6wdNmrFw==");

    }



    function get_user_rights($user_id) {

        if(!$user_id) {

            return false;

            die();

        }



        $row = $this->basic_model->getRows('user','id',$user_id);

    }



    function forwarders_login($form_id,$forwarder_id){



      $this->load->library(('encryption'));



      $username = 'forwarders';

      $password = 'forwarders';



      $userdata = $this->usersmodel->checkUser($username);

      $userdata['user_id']=$userdata['id'];



      $ppassword = $this->encryption->decrypt(@$userdata['password']);



        if ($ppassword == $password){

           $redirect = "";



           if($this->session->userdata('referrel') != '') {

             $redirect = $this->session->userdata('referrel');

           } else {

            $redirect = site_url("System_users");

           }



           $userdata['template'] = "admin";

           UNSET($userdata['rights']);



           $this->session->set_userdata($userdata);



           redirect(site_url('logistics_qoute_form/edit/'.$form_id.'/'.$forwarder_id));

        } else {

          $this->load->view("login");

        }

    }



}



?>
