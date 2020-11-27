<?php

/**

 * Description of purchase vouchers

 *

 */

class Admin extends CI_Controller {

    private $user_id;
    private $permission;

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->model('basic_model');
        $this->load->model('admin_model');
        $this->permission = $this->session->userdata('permission');
        $this->load->database();
       $this->load->library('excel');
    }

    public function index() {
      redirect('users');
    }

    function orders($status="") {

      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }

      if($status == "incoming") {
        if($this->session->userdata('role') != "admin" && $this->session->userdata('role') != "customer" ) {
          redirect('admin/orders');
        }
      }

      if($status == "") {
        $status = 'recieved';
      }

        $data=array(
          'title'=>"Inventory",
          "active_menu" => $status,
          "status" => $status,
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("orders");
        $this->load->view("footer");

    }

    function items_ordered($status="") {

      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }

      if($status == "") {
        $status = 'recieved';
      }
        $data=array(
          'title'=>"Items Ordered",
          "active_menu" => 'items_ordered',
          'orders' => $this->admin_model->getCustomerOrders()
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("item_ordered");
        $this->load->view("footer");
    }


    function order_item() {
      $orderno = $this->input->post('orderno');
      $notes = $this->input->post('notes');

      $userorder = array(
        'order_no' => $orderno,
        'notes' => $notes,
        'datetime' => date('Y-m-d'),
        'status' => 'new',
        'user_id' =>$this->session->userdata('user_id')
      );

      $data=$this->cart->contents();
      if(empty($data)) {
        $this->session->set_flashdata(array('response' => 'error', 'msg' => "Please add atleast one item to cart before Creating Order!"));
        redirect('admin/orders/recieved');
      }

      $userorderid = $this->basic_model->insert($userorder, 'user_orders');
      foreach ($data as $key => $value) {
        $order_id=$value['id'];
        $orderfields= array(
          'bundle_qty'=>$value['price'],
          'qty'=>$value['qty'],
          'notes'=>$value['name'],
        );
        $orderdetails=$this->admin_model->orderdetails($order_id);
        if ($orderfields['qty'] > 0) {
        $data =  array(
            'user_id' => $orderdetails[0]['user_id'],
            'date_ordered' => $orderdetails[0]['date_ordered'],
            'description' => $orderdetails[0]['description'].'sasasasasasa',
            'status' => "ordered"
          );
          $id = $this->basic_model->insertRecord($data, 'orders');

          $more_arr=[];
            $more_arr[0]=[
                'order_id'=>$id,
                'image' => $orderdetails[0]['image'],
                'upc' => $orderdetails[0]['upc'],
                'part_no' => $orderdetails[0]['part_no'],
                'supplier' => $orderdetails[0]['supplier'],
                'tracking_number' => $orderdetails[0]['tracking_number'],
                'qty' => $orderfields['qty'],
                'good_qty' => $orderfields['qty'],
                'asin_number' => $orderdetails[0]['asin_number'],
                'length' => $orderdetails[0]['length'],
                'width' => $orderdetails[0]['width'],
                'height' => $orderdetails[0]['height'],
                'services' => $orderdetails[0]['services'],
                'notes' => $orderdetails[0]['notes'],
                'location' => $orderdetails[0]['location'],
            ];

          $this->basic_model->insertMultiple($more_arr, 'orders_more');
          $goodqty=$orderdetails[0]['good_qty']-$orderfields['qty'];
          $qty=$orderdetails[0]['qty']-$orderfields['qty'];

          $this->basic_model->updateRecord(array('qty'=>$qty ,'good_qty'=>$goodqty),'orders_more','order_id',$order_id);
        $data = array(
          'user_orderid' => $userorderid,
          'order_id'=> $id,
          'bundle_quantity' => $orderfields['bundle_qty'],
          'orderdetail_notes' => $orderfields['notes']
        );
        $this->basic_model->insertRecord($data, 'user_orderdetails');

      }

      $this->session->set_flashdata(array('response' => 'success', 'msg' => "Ordered successfully!"));

      $orderdetails11=$this->admin_model->orderdetails($order_id);

      if($orderdetails11[0]['good_qty'] == 0 && $orderdetails11[0]['bad_qty'] == 0){
        $this->basic_model->updateRecord(array('status'=>'ordered'), 'orders','id',$order_id);
      }

      // else if($orderdetails[0]['good_qty'] == 0 && $orderdetails[0]['bad_qty'] == 0){
      //   $this->basic_model->updateRecord(array('status'=>'ordered'), 'orders','id',$order_id);
      // }
      // else if($orderfields['qty']==$orderdetails[0]['good_qty']){
      //   $data = array(
      //     'user_orderid' => $userorderid,
      //     'order_id'=> $order_id,
      //     'bundle_quantity' => $orderfields['bundle_qty'],
      //     'orderdetail_notes' => $orderfields['notes'],
      //   );
      //   $this->basic_model->insertRecord($data, 'user_orderdetails');
      //   $this->session->set_flashdata(array('response' => 'success', 'msg' => "Ordered successfully!"));
      // }


      }
      $this->destroy_cart();
      redirect('admin/orders');
    }

    function inventory() {

      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }

        $data=array(
          'title'=>"Recieved orders",
          "active_menu" => "inventory",
        );
        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("inventory");
        $this->load->view("footer");
    }



    function invoices() {

      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }

      $data=array(
        'title'=>"Invoices",
        "active_menu" => "invoices",
        'invoices' => $this->admin_model->getAllInvoices()
      );

      $this->load->view("header",$data);
      $this->load->view("sidebar");
      $this->load->view("invoices");
      $this->load->view("footer");
    }

    function create_invoice( $order_id='') {
      if($this->session->userdata('user_id') == '' && $this->session->userdata('role') != 'admin') {
        redirect("/");
      }

      if($order_id == "" ) {
        redirect('admin/invoices');
      }

      // generate invoice
      $data = array(
        'user_orders_id' => $order_id
      );
      $invoice_id = $this->basic_model->insertRecord($data, 'invoices');


      // change order status
      $this->basic_model->updateData('user_orders', array('status' => 'completed'), $order_id);

      redirect('admin/print_orderdetails/'.$order_id);

    }
    function print_orderdetails($order_id) {

      $this->load->model('Admin_model');

      $data['order']=$this->basic_model->getRow('user_orders', 'id', $order_id);
      $data['orderdetails']=$this->Admin_model->fetchitemordereddetials($order_id);

      $this->load->view("print_orderdetails",$data);
    }

    function new_order() {

      if($this->session->userdata('role') != "admin" && $this->session->userdata('role') != "customer") {
        redirect('/');
      }

      $data = array(
        'title' => "New Incoming Order",
        "active_menu" => "new_order",
        "users" => $this->basic_model->getRows('users', 'is_deleted', 0),
      );


      $this->load->view("header",$data);
      $this->load->view("sidebar");
      $this->load->view("new_order");
      $this->load->view("footer");
    }


    function save_order() {
      if($this->input->post()) {

        $id = $this->input->post('id', TRUE);
        $Reorder = $this->input->post('reorder', TRUE);
        // $order_number = $this->input->post('order_number', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $date_ordered = $this->input->post('date_ordered', TRUE);
        $description = $this->input->post('description', TRUE);
         //multiple
        $upc = $this->input->post('upc', TRUE);
        $part_no = $this->input->post('part_no', TRUE);
        $supplier = $this->input->post('supplier', TRUE);
        $tracking_number = $this->input->post('tracking_number', TRUE);
        $qty = $this->input->post('qty', TRUE);
        $asin_number = $this->input->post('asin_number', TRUE);

        $length = $this->input->post('length', TRUE);
        $width = $this->input->post('width', TRUE);
        $height = $this->input->post('height', TRUE);

        $service = $this->input->post('service', TRUE);
        $notes = $this->input->post('notes', TRUE);
        $status = $this->input->post('status', TRUE);
        $current_image = $this->input->post('old_image', TRUE);

        if($this->session->userdata('role') != "admin") {
          $user_id = $this->session->userdata('user_id');
        }


        $image = [];
        if($id == ''){ // insert
            $count = count($_FILES['image']['name']);

            for($i=0;$i<$count;$i++)
            {
              if(!empty($_FILES['image']['name'][$i]))
              {
                $file = array(
                  'name' => $_FILES['image']['name'][$i],
                  'type' => $_FILES['image']['type'][$i],
                  'tmp_name' => $_FILES['image']['tmp_name'][$i],
                  'error' => $_FILES['image']['error'][$i],
                  'size' => $_FILES['image']['size'][$i],
                );
                $img =  $this->basic_model->uploadFile($file, 'uploads');

                $image[] = $img;
              } else {
                if (!empty($hi[$i])){
                  $image[]=$hi[$i];
                } else {
                  $image[]="";
                }
              }
            }
        } else { // update
            $count = count($_FILES['image']['name']);
            $hi=$this->input->post('old_image', TRUE);
            for ($i=0; $i<$count ; $i++)
            {
                if(!empty($_FILES['image']['name'][$i]))
                {
                  $file = array(
                    'name' => $_FILES['image']['name'][$i],
                    'type' => $_FILES['image']['type'][$i],
                    'tmp_name' => $_FILES['image']['tmp_name'][$i],
                    'error' => $_FILES['image']['error'][$i],
                    'size' => $_FILES['image']['size'][$i],
                  );
                  $img =  $this->basic_model->uploadFile($file, 'uploads');

                  $image[] = $img;

                } else {
                  if (!empty($hi[$i])){
                    $image[]=$hi[$i];
                  } else {
                    $image[]="";
                  }
                }
            }

        }

        if(empty($image)) {
          $this->session->set_flashdata(array('response' => 'error', 'msg' => "There is an issue with an image you have uploaded! Please try again with a differnt image"));
          redirect('admin/new_order');
        }

        if($id != "" && $Reorder =="Reorder Order" ) {
          // insert Reorder
          $data =  array(
            'user_id' => $user_id,
            'date_ordered' => $date_ordered,
            'description' => $description,
            'status' => ($status == "")?"incoming":$status
          );
          $id = $this->basic_model->insertRecord($data, 'orders');

          $more_arr=[];
          for($f=0;$f<count($upc);$f++){
            $more_arr[$f]=[
                'order_id'=>$id,
                'image' => $image[$f],
                'upc' => $upc[$f],
                'part_no' => $part_no[$f],
                'supplier' => $supplier[$f],
                'tracking_number' => $tracking_number[$f],
                'qty' => $qty[$f],
                'asin_number' => $asin_number[$f],
                'length' => $length[$f],
                'width' => $width[$f],
                'height' => $height[$f],
                'services' => $service[$f],
                'notes' => $notes[$f]
            ];
          }
          $this->basic_model->insertMultiple($more_arr, 'orders_more');

          $msg = "Order Added Successfully!";
        } else if($id == "" || $ReOrder="" ){
          // Add form insert
          $data =  array(
            'user_id' => $user_id,
            'date_ordered' => $date_ordered,
            'description' => $description,
            'status' => ($status == "")?"incoming":$status
          );
          $id = $this->basic_model->insertRecord($data, 'orders');

          $more_arr=[];
          for($f=0;$f<count($upc);$f++){
            $more_arr[$f]=[
                'order_id'=>$id,
                'image' => $image[$f],
                'upc' => $upc[$f],
                'part_no' => $part_no[$f],
                'supplier' => $supplier[$f],
                'tracking_number' => $tracking_number[$f],
                'qty' => $qty[$f],
                'asin_number' => $asin_number[$f],
                'length' => $length[$f],
                'width' => $width[$f],
                'height' => $height[$f],
                'services' => $service[$f],
                'notes' => $notes[$f]
            ];
          }
          $this->basic_model->insertMultiple($more_arr, 'orders_more');

          $msg = "Order Added Successfully!";
        } else {
          // update
          $data =  array(
            'user_id' => $user_id,
            'date_ordered' => $date_ordered,
            'description' => $description,
          );
          $this->basic_model->updateRecord($data, 'orders', 'id', $id);
          // $this->basic_model->deleteRecord('order_id', $id, 'orders_more');
         $more_arr=[];
          for($f=0;$f<count($upc);$f++){
            $more_arr[] = array(
              'order_id'=>$id,
              'image' => $image[$f],
              'upc' => $upc[$f],
              'part_no' => $part_no[$f],
              'supplier' => $supplier[$f],
              'tracking_number' => $tracking_number[$f],
              'qty' => $qty[$f],
              'asin_number' => $asin_number[$f],
              'length' => $length[$f],
                'width' => $width[$f],
                'height' => $height[$f],
                'services' => $service[$f],
              'notes' => $notes[$f]
            );
          }

          $resp = $this->admin_model->updateOrders($more_arr, $id);
          $msg = "Order Updated Successfully!";
        }

        $this->session->set_flashdata(array('response' => 'success', 'msg' => $msg));

        if(isset($data['status'])) {
          redirect('admin/orders/'.$data['status']);
        } else {
          redirect('admin/orders/');
        }
      }
    }

    public function edit_order($id = "", $type= "") {

      if($id == "" || $type == "") {
        redirect('admin/orders/incoming');
      }

      $data = array(
        'title' => "Edit Order",
        "active_menu" => $type,
        "record" => $this->basic_model->getRow('orders', 'id', $id),
        "record_more" => $this->basic_model->getRows2('orders_more','order_id',$id),
        "users" => $this->basic_model->getRows('users', 'is_deleted', 0),
      );

      $this->load->view("header",$data);
      $this->load->view("sidebar");
      $this->load->view("new_order");
      $this->load->view("footer");
    }

    public function Reorder($id = "", $type= "") {
      if($id == "" || $type == "") {
        redirect('admin/orders/incoming');
      }
      $data = array(
        'title' => "Reorder Order",
        "active_menu" => $type,
        "record" => $this->basic_model->getRow('orders', 'id', $id),
        "record_more" => $this->basic_model->getRows2('orders_more','order_id',$id),
        "users" => $this->basic_model->getRows('users', 'is_deleted', 0),
      );
      $this->load->view("header",$data);
      $this->load->view("sidebar");
      $this->load->view("new_order");
      $this->load->view("footer");
    }

    public function view_details($id, $status='incoming') {
      $data = array(
        'title' => "Order details",
        "active_menu" => $status,
        "status" => $status,
        "record" => $this->basic_model->getRow('orders', 'id', $id),
        "record_more" => $this->basic_model->getRows2('orders_more','order_id',$id)
      );
      $this->load->view("header",$data);
      $this->load->view("sidebar");
      $this->load->view("order_details");
      $this->load->view("footer");

    }

    public function delete_order($id = "", $type= "") {
      if($id == "" || $type == "") {
        redirect('admin/orders/incoming');
      }
      $this->basic_model->deleteRecord('id', $id, 'orders');
      $this->basic_model->deleteRecord('order_id', $id, 'orders_more');
      redirect('admin/orders/'.$type);
    }
    public function archive_order($id = "", $type= "") {
      if($id == "" || $type == "") {
        redirect('admin/orders/incoming');
      }
      $this->basic_model->ArchiveRecord('id', $id, 'orders');
      // $this->basic_model->ArchiveRecord('order_id', $id, 'orders_more');
      redirect('admin/orders/'.$type);
    }
    public function archive_orderitem($id = "") {
      if($id == "") {
        redirect('admin/items_ordered');
      }
      $this->basic_model->ArchiveRecord('id', $id, 'user_orders');
      // $this->basic_model->ArchiveRecord('order_id', $id, 'orders_more');
      redirect('admin/items_ordered');
    }

    public function getOrders($status = 'incoming') {

      @$search_val = $this->input->post('search')['value'];
      if($search_val != "") {
        $result = $this->admin_model->search($search_val, $status);
      } else {
        $result = $this->admin_model->orders($status);
      }

      $data = array();
      $sno = 1;

      foreach($result as $row)
      {

       $sub_array = array();
       $sub_array[] = $sno;
        if ($this->session->userdata('is_customer')=='yes') {
           $sub_array[] = $row['username'];
         }
         if ($this->session->userdata('is_img')=='yes') {
           if(file_exists('uploads/'.$row['image'])) {
             $sub_array[] = "<a href='".base_url('uploads/'.$row['image'])."' target='_blank'><img src='".base_url('uploads/'.$row['image'])."' style='min-width: 10px; max-width: 50px;' class='img-thumbnail' /></a>";
           } else {
             $sub_array[] = "No Image";
           }
         }
         if ($this->session->userdata('is_descr')=='yes') {
           $sub_array[] = $row['description'];
         }

         if($status == 'incoming') {
           $sub_array[] = $row['order_qty'];
           $sub_array[] = date('d M Y', strtotime($row['date_ordered']));
         } else {

           if ($this->session->userdata('is_quantity')=='yes') {
            $sub_array[] = $row['good_qty'];
            $sub_array[] = $row['bad_qty'];
            // $sub_array[] = $row['order_qty'];
            $sub_array[] = $row['good_qty']+$row['bad_qty'];
          }
           if ($this->session->userdata('is_date_order')=='yes') {
             $sub_array[] = date('d M Y', strtotime($row['received_date']));
           }
           $sub_array[] = $row['location'];
         }

         if ($this->session->userdata('is_status')=='yes') {

           // if all items recieved good turn the status badge green otherwise turn red
          if($row['good_qty'] + $row['bad_qty'] == $row['order_qty']) {
             $badge_color = "success";
           } else {
             $badge_color = "danger";
           }
          if($this->session->userdata('role') == "admin") {
            // onclick='show_modal(".$row['id'].")'
            $sub_array[] = "<a><span class='badge badge-".$badge_color."'>".$row['status']."</span></a>";
          } elseif ($this->session->userdata('role') == "customer") {
             $sub_array[] = "<a><span class='badge badge-".$badge_color."'>".$row['status']."</span></a>";
          }
         }

       $buttons = "";

       $buttons = "<a href='javascript:void(0)' onclick='showViewModal(".$row['id'].")' class='btn small-btn'><i class='icon-eye'></i> View </a>";
       $buttons .= "<a href='".site_url('admin/reorder/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn reorderproduct' ><i class='ft-rotate-ccw'></i> Reorder </a>";

        if ($this->session->userdata('is_status')=='yes') {
       if($this->session->userdata('role') == "admin") {
         if ($status == 'incoming') {
         $buttons .= " <a href='javascript:void(0)' class='btn small-btn' onclick='show_modal(".$row['id'].")'><i class='icon-arrow-left'></i> Receive Item </a>";
       } else {
          $buttons .= " <a href='javascript:void(0)' class='btn small-btn' onclick='show_modal(".$row['id'].")'><i class='icon-arrow-left'></i> Change Qty</a>";
       }
       }
      }

         // check if item is recieved donot allow to edit item to customer
      if($this->session->userdata('role') == "admin") {
        $buttons .="<a href='".site_url('admin/edit_order/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn'><i class='icon-pencil'></i> Edit </a>
        <a href='".site_url('admin/delete_order/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn' onclick=\"return confirm('Are you sure you want to delete?')\"><i class='icon-trash'></i> Delete </a>";
      } elseif($status == 'incoming') {
        $buttons .="<a href='".site_url('admin/edit_order/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn'><i class='icon-pencil'></i> Edit </a>
        <a href='".site_url('admin/delete_order/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn' onclick=\"return confirm('Are you sure you want to delete?')\"><i class='icon-trash'></i> Delete </a>";
      }
      if ($row['good_qty']<=0) {
       $buttons .="<a href='".site_url('admin/archive_order/'.@$row['id'].'/'.$row['status'])."' class='btn small-btn' onclick=\"return confirm('Are you sure you want to Archive?')\"><i class='ft-package'></i>Archive</a>";
      }
       $sub_array[] = $buttons;

       if($this->session->userdata('role') == 'customer') {
          $order_btns = "";
          // $order_btns .= "<a href='".site_url('admin/order_item/'.@$row['id'])."' class='btn small-btn'> Order Now</a>";
          if($status != 'incoming') {
            $order_btns .= "<a href='#' class='btn small-btn' onclick='addtocartmodal(".$row['id'].",".$row['good_qty'].")'><i class='ft-shopping-cart'></i> Add to cart</a>";
          }

          $sub_array[] = $order_btns;
       }
       $data[] = $sub_array;
       $sno++;
      }

      $output = array(
       'draw'    => @intval($this->input->post['draw']),
       'recordsTotal'  => count($result),
       'recordsFiltered' => count($result),
       'data'    => $data
      );
      echo json_encode($output);
    }

    // Fetching Archive
    public function getOrdersArchive($status = 'incoming') {

      $search_val = $this->input->post('search')['value'];
      if($search_val != "") {
        $result = $this->admin_model->search($search_val, $status, 'archives');
      } else {
        $result = $this->admin_model->ordersArchive($status);
      }

      $data = array();
      $sno = 1;

      foreach($result as $row)
      {
       $sub_array = array();
       $sub_array[] = $sno;
        if ($this->session->userdata('is_customer')=='yes') {
           $sub_array[] = $row['username'];
         }
         if ($this->session->userdata('is_img')=='yes') {
           if(file_exists('uploads/'.$row['image'])) {
             $sub_array[] = "<a href='".base_url('uploads/'.$row['image'])."' target='_blank'><img src='".base_url('uploads/'.$row['image'])."' width='100' height='100' style='height:50px!important;' class='img-thumbnail' /></a>";
           } else {
             $sub_array[] = "No Image";
           }
         }
         if ($this->session->userdata('is_descr')=='yes') {
           $sub_array[] = $row['description'];
         }

         if($status == 'incoming') {
           $sub_array[] = $row['order_qty'];
           $sub_array[] = date('d M Y', strtotime($row['date_ordered']));
         } else {

           if ($this->session->userdata('is_quantity')=='yes') {
             $sub_array[] = $row['good_qty'];
           }
           if ($this->session->userdata('is_date_order')=='yes') {
             $sub_array[] = date('d M Y', strtotime($row['received_date']));
           }
           $sub_array[] = $row['location'];
         }

       if ($this->session->userdata('is_status')=='yes') {

        if($this->session->userdata('role') == "admin") {
       $sub_array[] = "<a href='javascript:void(0)' onclick='show_modal(".$row['id'].")'><span class='badge badge-dark'>".$row['status']."</span></a>";
        }elseif ($this->session->userdata('role') == "customer") {
           $sub_array[] = "<a href='javascript:void(0)'><span class='badge badge-dark'>".$row['status']."</span></a>";
        }
       }

       $sub_array[] = "<a href='javascript:void(0)' onclick='showViewModal(".$row['id'].")' class='btn small-btn'><i class='icon-eye'></i> View </a>";

       if($this->session->userdata('role') == 'customer') {
         $sub_array[] = "<a href='".site_url('admin/order_item/'.@$row['id'])."' class='btn small-btn'> Order Now</a>";
       }
       $data[] = $sub_array;
       $sno++;
      }

      $output = array(
       'draw'    => @intval($this->input->post['draw']),
       'recordsTotal'  => count($result),
       'recordsFiltered' => count($result),
       'data'    => $data
      );
      echo json_encode($output);
    }

    public function change_status() {

      if($this->input->post()) {

        $id = $this->input->post('order_id');
        $status = $this->input->post('status');

        if ($status == 'received') {
          $this->basic_model->updateRecord(array('status' => $status,'received_date' => $this->input->post('received_date'), 'checked_in_user_id' => $this->session->userdata('user_id')), 'orders', 'id', $id);
          $data = $this->admin_model->getReceivedOrderInfo($id);

          $arr=[];
          foreach ($data as $v) {
            $qualities = [
              'order_more_id' => $v['order_more_id'],
              'good_qty' =>  $this->input->post('recieved_good_'.$v['order_more_id']),
              'bad_qty' =>  $this->input->post('recieved_bad_'.$v['order_more_id']),
              'location' =>  $this->input->post('location_'.$v['order_more_id']),
              'recieved_notes' =>  $this->input->post('recieved_notes_'.$v['order_more_id']),
            ];

            $arr[]=$qualities; //print_r($arr); exit();
          }

           $this->admin_model->batch_update('orders_more', $arr, 'order_more_id');
        } else {

          $this->basic_model->updateRecord(array('status' => $status), 'orders', 'id', $id);
        }

        if($status == 'incoming') {
          $this->session->set_flashdata(array('response' => 'success', 'msg' => "Order has been updated to $status"));
          redirect('admin/orders/'.$status);
        } else {
          $this->session->set_flashdata(array('response' => 'success', 'msg' => "Order has been updated Successfully"));
          redirect('admin/orders');
        }
      }
    }

    public function getReceivedOrderInfo()
    {
      $id = $this->input->post('id');
      $data = array(
        'items' => $this->admin_model->getReceivedOrderInfo($id),
        'order' => $this->admin_model->getReceivedDate($id)
      );

      echo $this->load->view('items_quality', $data, true);
    }

    public function view_details_popup($id, $status='incoming') {
      $data = array(
        'title' => "Order details",
        "active_menu" => $status,
        "status" => $status,
        "record_more" => $this->basic_model->getRows2('orders_more','order_id',$id),
        "record" => $this->basic_model->get_order_data($id),
      );


      $data=$this->load->view("order_details_popup",$data,TRUE);

      // print_r($html);
      echo json_encode($data);


    }

    public function setting()
    {
      if($this->session->userdata('user_id') == '') {

        redirect("users");

      }

      $data = array(

        'title' => "Setting",

        "active_menu" => 'setting',
        'auths' => $this->admin_model->getAuths()
      );


      $this->load->view("header",$data);

      $this->load->view("sidebar");

      $this->load->view("setting");

      $this->load->view("footer");



    }

    public function update_setting()
    {
      if($this->session->userdata('user_id') == '') {

        redirect("users");

      }

      if (empty($this->input->post('order_no'))) {
          $order_no='no';
      }else{
        $order_no='yes';
      }
      if (empty($this->input->post('customer'))) {
          $customer='no';
      }else{
        $customer='yes';
      }
      if (empty($this->input->post('date_order'))) {
          $date_order='no';
      }else{
        $date_order='yes';
      }
      if (empty($this->input->post('received_date'))) {
          $received_date='no';
      }else{
        $received_date='yes';
      }
      if (empty($this->input->post('status'))) {
          $status='no';
      }else{
        $status='yes';
      }
      if (empty($this->input->post('desc'))) {
          $desc='no';
      }else{
        $desc='yes';
      }
      if (empty($this->input->post('img'))) {
          $img='no';
      }else{
        $img='yes';
      }
      if (empty($this->input->post('upc'))) {
          $upc='no';
      }else{
        $upc='yes';
      }
      if (empty($this->input->post('part_no'))) {
          $part_no='no';
      }else{
        $part_no='yes';
      }
      if (empty($this->input->post('supplier'))) {
          $supplier='no';
      }else{
        $supplier='yes';
      }
      if (empty($this->input->post('track_numb'))) {
          $track_numb='no';
      }else{
        $track_numb='yes';
      }
      if (empty($this->input->post('asin_numb'))) {
          $asin_numb='no';
      }else{
        $asin_numb='yes';
      }
      if (empty($this->input->post('quantity'))) {
          $quantity='no';
      }else{
        $quantity='yes';
      }
      if (empty($this->input->post('size'))) {
          $size='no';
      }else{
        $size='yes';
      }
      if (empty($this->input->post('service'))) {
          $service='no';
      }else{
        $service='yes';
      }
      if (empty($this->input->post('condition'))) {
          $condition='no';
      }else{
        $condition='yes';
      }

      $fields = [
        'order_no'=>$order_no,
        'customer'=>$customer,
        'date_order'=>$date_order,
        'received_date'=>$received_date,
        'status'=>$status,
        'descr'=>$desc,
        'img'=>$img,
        'upc'=>$upc,
        'part_no'=>$part_no,
        'supplier'=>$supplier,
        'track_numb'=>$track_numb,
        'asin_numb'=>$asin_numb,
        'quantity'=>$quantity,
        'size'=>$size,
        'service'=>$service,
        'cond'=>$condition

      ];

      $this->basic_model->updateRecord($fields, 'auths', 'auth_id', 1);

      $this->session->set_userdata('is_order_no',$order_no);
      $this->session->set_userdata('is_customer',$customer);
      $this->session->set_userdata('is_date_order',$date_order);
      $this->session->set_userdata('is_received_date',$received_date);
      $this->session->set_userdata('is_status',$status);
      $this->session->set_userdata('is_descr',$desc);
      $this->session->set_userdata('is_img',$img);
      // $this->session->set_userdata('is_title',$title);
      $this->session->set_userdata('is_upc',$upc);
      $this->session->set_userdata('is_part_no',$part_no);
      $this->session->set_userdata('is_supplier',$supplier);
      $this->session->set_userdata('is_track_numb',$track_numb);
      $this->session->set_userdata('is_asin_numb',$asin_numb);
      $this->session->set_userdata('is_quantity',$quantity);
      $this->session->set_userdata('is_size',$size);
      $this->session->set_userdata('is_service',$service);
      $this->session->set_userdata('is_cond',$condition);

      $this->session->set_flashdata('success','Setting has been updated Successfully');
      redirect('admin/setting');
    }

    public function dashboard()
    {

      // check if user is logged in
      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }

      $date = strtotime(date('d-m-Y'));
      $newDate = date('Y-m-d',strtotime('-15 days',$date));

      if ($this->session->userdata('role') == "admin") {
        $start_data = date("Y-m-d",strtotime('monday this week'));
        $end_data = date("Y-m-d",strtotime("sunday this week"));


        $data = array(
          'title' => "Dashboard",
          "active_menu" => 'dashboard',
          'auths' => $this->admin_model->getAuths(),
          'shipped' => $this->basic_model->getShippedItemsTotal($start_data,$end_data),
          'inventory' => $this->basic_model->get_graphs('inventory',$user_id='',$start_data,$end_data),
          'incoming' => $this->basic_model->get_graphs('incoming',$user_id='',$start_data,$end_data),
          'active_customer' => $this->basic_model->get_users_graphs('active',$user_id='',$start_data,$end_data),
          'users' => $this->basic_model->getMultiData('users', 'DESC'),
          'inactive_customer' => $this->basic_model->get_users_graphs('inactive',$user_id='',$start_data,$end_data),
          'open_orders' => $this->basic_model->get_orders_graphs('new',$user_id=''),
          'pastdue_orders' => $this->basic_model->get_pastdueorders_graphs('new','',$date),
          'sizes1' => $this->basic_model->get_users_size('sizes1',$user_id=''),
          'storage_under_15' => $this->admin_model->getStorageUnder15(),
          'bill_over_15' => $this->admin_model->getBillOver15($newDate)
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $googlemap['googlemap']=$this;
        $this->load->view("dashboard",$googlemap);
        $this->load->view("footer");
      }
       else {
        $start_data = date("Y-m-d",strtotime('monday this week'));
        $end_data = date("Y-m-d",strtotime("sunday this week"));
        $data = array(
          'title' => "Dashboard",
          "active_menu" => 'dashboard',
          'auths' => $this->admin_model->getAuths(),
          'low_stock' => $this->admin_model->get_low_stock(),
          // 'shipped' => $this->basic_model->get_graphs('ordered',$user_id='',$start_data,$end_data),
          'incoming' => $this->basic_model->get_graphs('incoming',$_SESSION['user_id'],$start_data,$end_data),
          'inventories' => $this->basic_model->get_graphs('inventory',$_SESSION['user_id'], $start_data,$end_data),
          'size_user' => $this->basic_model->get_users_size('size_user',$_SESSION['user_id']),
          'open_orders' => $this->basic_model->get_orders_graphs('new',$_SESSION['user_id']),
          'pastdue_orders' => $this->basic_model->get_pastdueorders_graphs('new',$_SESSION['user_id'],$date),
          'storage_under_15' => $this->admin_model->getStorageUnder15($_SESSION['user_id']),
          'bill_over_15' => $this->admin_model->getBillOver15($newDate,$_SESSION['user_id'])
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("customer_dashboard");
        $this->load->view("footer");
      }
    }

    public function get_graphs()
    {
      if ($this->session->userdata('role') == "admin") {
        $user_id = '';
      }else{ $user_id = $_SESSION['user_id']; }
      if ($_POST['type'] == 'weekly') {
        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_data = date("Y-m-d",$start_week);
        $end_data = date("Y-m-d",$end_week);
      }if ($_POST['type'] == 'monthly') {
        $start_data = date("Y-".$_POST['month']."-1");
        $end_data = date("Y-".$_POST['month']."-t");
      }if ($_POST['type'] == 'yearly') {
        $start_data = date($_POST['year']."-01-t");
        $end_data = date($_POST['year']."-12-t");
      }if ($_POST['type'] == 'lifetime') {
        $start_data = 'all';
        $end_data = 'all';
      }
      $shipped = $this->basic_model->get_graphs('shipped',$user_id,$start_data,$end_data);
      $inventory = $this->basic_model->get_graphs('inventory',$user_id,$start_data,$end_data);
      $incoming = $this->basic_model->get_graphs('incoming',$user_id,$start_data,$end_data);
      $active_customer = $this->basic_model->get_users_graphs('active');
      $inactive_customer = $this->basic_model->get_users_graphs('inactive');

      $josn['shipped_qty'] = ($shipped->qty == '') ? 0 : $shipped_qty;
      $josn['inventory'] = ($inventory->qty == '') ? 0 : $inventory->qty;
      $josn['incoming'] = ($incoming->qty == '') ? 0 : $incoming->qty;
      $josn['active_customer'] = ($active_customer->qty == '') ? 0 : $active_customer->qty;
      $josn['inactive_customer'] = ($inactive_customer->qty == '') ? 0 : $inactive_customer->qty;
      echo json_encode($josn);
    }

    public function save_order_excel()
    {
      $path = $_FILES["file"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);

      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        for($row=2; $row<=$highestRow; $row++)
        {
            $user_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
            $order_date = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $dec = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
           // $size = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
           $length = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
           $width = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
           $height = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

           $upc = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $part_no = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $service = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $supplier = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $track_numb = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
            $qty = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
            $asin_numb = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
            $notes = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
            $user_data = $this->basic_model->getOneCol('users','username',$user_name);
            if(empty($user_data)) {
              $user_id = 0;
            } else {
              $user_id = $user_data->id;
            }
            $data = array(
              'user_id' => $user_id,
              'date_ordered' => $order_date,
              'description' => $dec,
              'status' => 'incoming',
            );

            $order_id = $this->basic_model->insertDataReturnLastId('orders', $data);
            $order_data = array(
              'order_id' => $order_id,
              'upc' => $upc,
              'part_no' => $part_no,
              'image' => 'default.png',
              'supplier' => $supplier,
              'tracking_number' => $track_numb,
              'asin_number' => $asin_numb,
              'qty' => $qty,
              'length' => $length,
              'width' => $width,
              'height' => $height,
              'services' => $service,
              'notes' => $notes,
              'quality' => $qty,
            );
            $this->basic_model->insert_alltable('orders_more',$order_data);
        }

        $msg = "Order Added Successfully!";
        $this->session->set_flashdata(array('response' => 'success', 'msg' => $msg));
        redirect('admin/orders/'.$data['status']);
      }
    }

    public function change_user_status()
    {
      $last_date = date('Y-m-d', strtotime('-30 days'));

      $start_date = date('Y-m-d', strtotime('first day of previous month'));
      $end_date = date('Y-m-d', strtotime('last day of previous month'));
      $order_data = $this->basic_model->change_user_status($start_date,$end_date);

      foreach ($order_data as $value) {
        if ($value->date_added == $last_date) {
            $data = array('user_status' => 'inactive');
            $this->basic_model->updateData('users', $data, $value->user_id);
        }
      }

    }

    function archives()
    {
      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }
        $data=array(
          'title'=>"Archive",
          "active_menu" => "archives",
          "sub_menu" => "archive_itemsordered",
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("archive");
        $this->load->view("footer");
    }
    function archives_itemordered()
    {

      if($this->session->userdata('user_id') == '') {
        redirect("users");
      }
        $data=array(
          'title'=>"Archive Item Ordered",
          "active_menu" => "archives",
          "sub_menu" => "archive_itemsordered",
          "orders"=>$this->admin_model->getCustomerOrdersarchives(),
        );

        $this->load->view("header",$data);
        $this->load->view("sidebar");
        $this->load->view("archives_itemordered");
        $this->load->view("footer");
    }

    public function getLatLong(){

      $users = array(
        '0' => array('latitude'=>'24.794500','longitude'=> '73.055000','location_name'=> 'Pindwara, Rajasthan, India'),
        '1'=>array('latitude'=>'21.250000','longitude'=> '81.629997', 'location_name'=>  'Chhattisgarh, India')
      );

    // $users = $this->google->get_list();

        $markers = [];
        $infowindow = [];

        foreach($users as $value) {
          $markers[] = [
            $value['location_name'], $value['latitude'], $value['longitude']
          ];
          $infowindow[] = [
           "<div class=info_content><h3>".$value['location_name']."</h3></div>"
          ];
        }
        $location['markers'] = json_encode($markers);
        $location['infowindow'] = json_encode($infowindow);

        $this->load->view('googlemap',$location);
      }

      public function tickets() {
        if($this->session->userdata('user_id') == '') {
          redirect("users");
        }
            $data = array(
              'title' => "Support Tickets",
              "active_menu" => 'tickets',
              "tickets" => $this->admin_model->getTickets()
            );

            $this->load->view("header",$data);
            $this->load->view("sidebar");
            $this->load->view("tickets");
            $this->load->view("footer");
          }

          public function view_ticket($id = "") {
            // if ticket id is not provided
            if($id == "") {
              redirect('admin/tickets');
            }

            // getting ticket info
            $ticket = $this->admin_model->get_ticket_info($id);

            // check if this ticket is related to this logged in customer
            if($this->session->userdata('role') == "customer") {
              if($ticket['user_id'] != $this->session->userdata('user_id')) {
                redirect('admin/tickets');
              }
            }

            $data = array(
              'title' => "Support Ticket",
              "active_menu" => 'tickets',
              "ticket" => $ticket,
              "ticket_msgs" => $this->admin_model->get_ticket_replies($id),
            );

            $this->load->view("header",$data);
            $this->load->view("sidebar");
            $this->load->view("view_ticket");
            $this->load->view("footer");
          }

          public function add_new_ticket() {
            if($this->session->userdata('user_id') == '') {
              redirect("users");
            }
            if($this->input->post()) {
              $title = $this->input->post('title', TRUE);
              $issue = $this->input->post('issue', TRUE);
              $user_id = $this->session->userdata('user_id', TRUE);
              $ticket_number = rand(100000, 999999);

              $arr = array(
                'title' => $title,
                'issue' => $issue,
                'user_id' => $user_id,
                'ticket_number' => $ticket_number,
              );

              $this->basic_model->insertRecord($arr, 'tickets');
            //   add notification
              $notification_array=array(
                'subject'               =>"New Ticket",
                'message'               =>"You have a new support ticket",
                'notification_for'      =>'admin',
                'create_at'             =>date("Y-m-d h:i:s"),
                'page_url'              =>'admin/tickets',
                'from_user_id'           =>$this->session->userdata('user_id')
            );

            $this->basic_model->insertRecord($notification_array, 'notifications');

            //




              $this->session->set_flashdata('success', 'New Ticket Added Successfully!');
              redirect('admin/tickets');
            } else {
              $data = array(
                'title' => "Dashboard",
                "active_menu" => 'tickets',
              );

              $this->load->view("header",$data);
              $this->load->view("sidebar");
              $this->load->view("add_new_ticket");
              $this->load->view("footer");
            }

          }

          public function send_ticket_reply($id) {
            if($this->input->post()) {

              $ticket = $this->basic_model->getRow("tickets", 'id', $id);
              $user_id = $this->session->userdata("user_id");

              // check if reply is added by admin
              if($ticket['user_id'] != $user_id) {
                $this->basic_model->updateRecord(array(
                  'status' => 'active'
                ), 'tickets', 'id', $id);
              }

              $data = array(
                'ticket_id' => $id,
                'msg' => $this->input->post("msg", TRUE),
                'user_id' => $user_id,
                'is_customer' => ($ticket['user_id'] == $user_id)? 1: 0,
              );
              $this->basic_model->insertRecord($data, 'tickets_msgs');
                //for notification
                $tickect_data=$this->basic_model->getRows('tickets','id',$id);
                //
                $notification_array=array(
                        'subject'               =>"Ticket Replay",
                        'message'          =>"You have a reply on Ticket #". $tickect_data[0]['ticket_number'],
                        'notification_for'      => ($ticket['user_id'] == $user_id)? 'admin': 'customer',
                        'create_at'             =>date("Y-m-d h:i:s"),
                        'page_url'              =>'admin/tickets',
                        'from_user_id'           =>$this->session->userdata('user_id')
                    );
                $this->basic_model->insertRecord($notification_array, 'notifications');


              redirect('admin/view_ticket/'.$id);

            }
          }

          public function mark_ticket_resolved($id) {
            $this->basic_model->updateRecord(array(
              'status' => 'resolved',
              'resolved_by' => $this->session->userdata('user_id'),
            ),'tickets', 'id', $id);

            $user_id = $this->session->userdata("user_id");
            $tickect_data=$this->basic_model->getRows('tickets','id',$id);

            $notification_array=array(
                'subject'               =>"Ticket resolved",
                'message'          =>"Ticket ".$tickect_data[0]['ticket_number']." has been resolved",
                'notification_for'      => ($ticket['user_id'] != $user_id)? 'admin': 'customer',
                'create_at'             =>date("Y-m-d h:i:s"),
                'page_url'              =>'admin/tickets',
                'from_user_id'           =>$this->session->userdata('user_id')
            );


            $this->basic_model->insertRecord($notification_array, 'notifications');


            redirect('admin/view_ticket/'.$id);
          }
          public function delete_ticket($id) {
            if($this->session->userdata('user_id') == '') {
              redirect("users");
            }
            // delete all ticket replies
            $this->basic_model->deleteRecord('ticket_id', $id, 'tickets_msgs');
            // delete ticket itself
            $this->basic_model->deleteRecord('id', $id, 'tickets');
            redirect('admin/tickets');
          }

    // cart functions Start
      public function addtocart()
      {
        $notes = $this->input->post('notes');
        // if notes is empty then put a string with a space
        $notes = ($notes == "") ? " " : $notes;

        $data = array(
          'id'    => $this->input->post('order_id'),
          'qty'   => $this->input->post('qty'),
          'price' => $this->input->post('bundle'),
          'name'  => $notes,
          'options'  => array('max_qty' => $this->input->post('max_qty')),
        );
        $this->cart->insert($data);
        redirect('admin/orders');
      }

      public function loadcart() {
        $data=$this->show_cart();
        echo json_encode($data);
      }

      function show_cart(){
        $output = '';
        $no = 0;

        foreach ($this->cart->contents() as $items) {
          $order_id=$items['id'];
          $data=$this->admin_model->orderdetails($order_id);

          $img='';
          if($data[0]['image']=='' OR !file_exists('uploads/'.$data[0]['image'])) {
            $img= base_url('uploads/download.png');
          } else {
            $img=base_url('uploads/'.$data[0]['image']);
          }

          $no++;
          $output .= '
            <tr data-max-qty="'.$items['options']['max_qty'].'">
                <td>'.$items['id'].'</td>
                <td><img style="height:50px;width:50px;" src='.$img.'></td>
                <td><i class="fa fa-minus-circle minusqty" style="cursor:pointer!important" data="'.$items['rowid'].'"></i> &nbsp&nbsp<a class=" getQty'.$items['rowid'].'">'.$items['qty'].'</a> &nbsp&nbsp<i class="fa fa-plus-circle plusqty" data="'.$items['rowid'].'" style="cursor:pointer!important"></i></td>
                <td><i class="fa fa-minus-circle minusprice" style="cursor:pointer!important" data="'.$items['rowid'].'"></i> &nbsp&nbsp<a class=" getPrice'.$items['rowid'].'">'.$items['price'].'</a> &nbsp&nbsp<i class="fa fa-plus-circle plusprice" data="'.$items['rowid'].'" style="cursor:pointer!important"></i></td>
                <td>'.$items['name'].'</td>
                <td>'.$data[0]['description'].'</td>
                <td><button type="button" class="btn btn-primary update_cart" data="'.$items['rowid'].'" >Update</button>
                <button type="button" class="btn btn-danger remove_cart" data="'.$items['rowid'].'" >Remove</button>
                </td>
            </tr>
          ';
        }
        return $output;

    // <td><button type="button" onclick="removecartitme('.$items['rowid'].')" class=" btn btn-danger btn-sm">Remove</button></td>
    }
    public function delete_cart(){
      $id=$this->input->post('id');
      // echo $id;
        $data = array(
            'rowid' => $id,
            'qty' => 0
        );
        $this->cart->update($data);
        $a=$this->show_cart();
        echo json_encode($a);
    }
    public function update_cart(){
      $id=$this->input->post('id');
      $qty=$this->input->post('qty');
      $price=$this->input->post('price');
      $name=$this->input->post('name');
      // echo $name;exit();
        $data = array(
            'rowid' => $id,
            'qty' => $qty,
            'price' => $price,
            'name' => $name
        );
        // print_r($data);exit();
        $this->cart->update($data);
        $a=$this->show_cart();
        echo json_encode($a);
    }
    public function destroy_cart()
    {
        $this->cart->destroy();
    }

    // view Item Ordered Details Function

    public function getOrderDetails($id)
    {
      $arr = array(
          'order' => $this->basic_model->getRow('user_orders', 'id', $id),
          'itemordereddetailsdata' => $this->admin_model->fetchitemordereddetials($id),
      );

      echo $this->load->view("item_ordereddetails", $arr, TRUE);
    }
    public function check_notification(){
        $condtions=array(
            'is_read' =>0,
            'notification_for' =>$this->session->userdata('role')
        );

        $this->db->select('*');
        $this->db->where($condtions);
        $this->db->order_by('create_at' , 'DESC');
        $records = $this->db->get('notifications')->result_array();

        // $records= $this->basic_model->getRows('notifications','is_read',0);

        echo json_encode($records);
    }

    public function notification_link($id) {
      // get notification
      $notification_record = $this->basic_model->getRow('notifications', 'id', $id);

      // mark is_read
      $id = $this->basic_model->updateData('notifications', array('is_read'=> 1), $id);

      redirect($notification_record['page_url']);
    }

    public function check_order_number($order_no = '') {
      $order = $this->basic_model->getRow('user_orders', 'order_no', $order_no);
      if(!empty($order)) {
        echo json_encode(array('type' => 'exists'));
      } else {
        echo json_encode(array('type' => 'not_exists'));
      }
    }
}

?>
