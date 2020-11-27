<?php

/**
 * Description of System_users
 *
 */

class System_users extends CI_Controller
{
  private $user_id;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('basic_model');
        $this->load->model('usersmodel');
        $this->load->library('encryption');
        $this->load->library('cart');
        $this->load->database();
        $this->user_id = $this->session->userdata("user_id");

        if ($this->user_id == "") {
            $redirect_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            redirect('users/login/' . $redirect_url);
        }

    }



    function index() {

        if($this->session->userdata('type') == 'farmer') {
          redirect('/');
        }

        $data = array(
            'title' => "View Users",
            "active_menu" => "system_users",
            "sub_menu" => "view_user",
            'users' => $this->basic_model->getMultiData("users"),
        );

        $this->load->view("header", $data);
        $this->load->view("sidebar");
        $this->load->view("users_view");
        $this->load->view("footer");
    }



    function add()
    {
        if($this->session->userdata('type') == 'farmer') {
          redirect('/');
        }

        if ($this->input->post()) {

            $username = $this->input->post('username');
            $address = $this->input->post('address');
            $phone = $this->input->post('phone');
            $password = $this->encryption->encrypt($this->input->post('password'));
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $role = $this->input->post('role');
            $cname = $this->input->post('customer');
            $sname = $this->input->post('store');
            $amazon_acc_name = $this->input->post('amazon_acc');

            if ($role == 'admin') {
              $arr = array(
                'username' => $username,
                'phone' => $phone,
                'password' => $password,
                'email' => $email,
                'role' => $role,
                'phone' => $phone,
                'address' => $address,
                'store_name' => $sname,
                'customer_name' => $cname,
                'amazon_acc_name' => $amazon_acc_name
              );
            } else {
              $arr = array(
                'username' => $username,
                'phone' => $phone,
                'password' => $password,
                'email' => $email,
                'role' => $role,
                'phone' => $phone,
                'address' => $address,
                'store_name' => $sname,
                'customer_name' => $cname
              );
            }

            if ($this->input->post('user_id')) {

                $this->basic_model->updateRecord($arr, "users", "id", $this->input->post('user_id'));

                if($role == 'admin') {
                    $url = site_url("system_users");
                } else {
                   $url = site_url("system_users/account_information");
                }

                $msg_arr = array(
                  'success' => true,
                  'msg' => 'User updated Successfully!',
                  'redirect' => $url
                );
                echo json_encode($msg_arr);
                exit;
            } else {

                $userExist = $this->basic_model->getRow("users", "username", $username);

                if ($userExist > 0) {
                    $msg_arr = array(
                      'success' => false,
                      'msg' => 'User already exists!',
                      'redirect' => site_url('system_users/add')
                    );
                    echo json_encode($msg_arr);
                    exit;
                }

                $user_id = $this->basic_model->insertRecord($arr, "users");

                $msg_arr = array(
                  'success' => true,
                  'msg' => 'User added Successfully!',
                  'redirect' => site_url('system_users')
                );
                echo json_encode($msg_arr);
                exit;
            }

        } else {



            $user_id     = $this->session->userdata('id');



            $data = array(

                'title' => "Add User",

                "active_menu" => "system_users",

                "sub_menu" => "add_user",

            );



            $this->load->view("header", $data);

            $this->load->view("sidebar");

            $this->load->view("user_add");

            $this->load->view("footer");

        }

    }



    function edit($id)

    {

        $data = array(

            "title" => "Edit User",

            "active_menu" => "system_users",

            "sub_menu" => "view_user",

            "record" => $this->basic_model->getRow("users", "id", $id),

        );



        $this->load->view("header", $data);

        $this->load->view("sidebar");

        $this->load->view("user_add");

        $this->load->view("footer");

    }



    function delete($id = 0)

    {

        if ($id != 0) {

            $this->basic_model->deleteRecord("id", $id, "users");

            // echo json_encode(array(

            //     "redirect" => site_url('system_users')

            // ));

            echo "<script>alert('Deleted Successfully!')</script>";

            echo "<script>window.open('".site_url('system_users')."','_self')</script>";

            exit;

        }

    }

    public function block()
    {
        $msg_arr = array(
            'success' => true,
            'redirect' => site_url('system_users')
        );
        if ($_POST['status'] == 'active') {
            $data = array('user_status' => 'blocked');
            $msg_arr['msg'] = 'user blocked successfully!';
        }else{
            $data = array('user_status' => 'active');
            $msg_arr['msg'] = 'user activated successfully!';
        }
        $this->basic_model->updateData('users', $data, $_POST['user_id']);

            echo json_encode($msg_arr);
    }

    public function account_information()
    {
        if ($_SESSION['role'] == 'admin') {
            redirect(site_url("system_users"));
        }
        $data = array(

            "title" => "Account Information",
            "record" => $this->basic_model->getRow("users", "id", $_SESSION['user_id']),

        );
        $this->load->view("header", $data);

        $this->load->view("sidebar");

        $this->load->view("user_profile");

        $this->load->view("footer");
    }

}

?>
