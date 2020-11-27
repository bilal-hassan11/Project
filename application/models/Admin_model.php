<?php

class Admin_model extends CI_Model {


  function search($search_val, $status, $is_archives = '') {
    $this->db->select("orders.*,users.username, orders_more.image, orders_more.qty order_qty, orders_more.good_qty,orders_more.bad_qty,orders_more.location");
    $this->db->from('orders');
    $this->db->join('orders_more', 'orders_more.order_id = orders.id', 'LEFT');

    if($this->session->userdata('role') != "admin") {
      $this->db->join('users', 'users.id = orders.user_id AND orders.user_id = '.$this->session->userdata('user_id'));
    } else {
      $this->db->join('users', 'users.id = orders.user_id', 'LEFT');
    }

    $this->db->group_start();
    $this->db->or_like('orders.date_ordered', $search_val);
    $this->db->or_like('orders.description', $search_val);
    $this->db->or_like('orders.status', $search_val);
    $this->db->or_like('orders_more.qty', $search_val);
    $this->db->or_like('orders_more.asin_number', $search_val);
    $this->db->or_like('users.username', $search_val);
    $this->db->or_like('orders_more.tracking_number', $search_val);
    $this->db->or_like('orders_more.location', $search_val);
    $this->db->group_end();
    $this->db->group_start();
    $this->db->where('orders.is_deleted', 0);
    if($is_archives == "") {
      $this->db->where('orders.is_archive', 0);
    } else {
      $this->db->where('orders.is_archive', 1);
    }
    if($status == 'incoming') {
      $this->db->where('orders.status', $status);
    } else {
      $this->db->where('orders.status !=', 'incoming');
      $this->db->where('orders.status !=', 'ordered');
    }
    $this->db->group_end();
    $this->db->order_by('orders.id', 'desc');
    return $this->db->get()->result_array();
  }

    function orders($status) {
      $this->db->select("orders.*,users.username, orders_more.image, orders_more.qty order_qty,orders_more.bad_qty, orders_more.good_qty,orders_more.location");
      $this->db->from('orders');
      $this->db->join('users', 'users.id = orders.user_id', 'LEFT');
      $this->db->join('orders_more', 'orders_more.order_id = orders.id', 'LEFT');
      $this->db->order_by('orders.id', 'desc');
      $this->db->where('orders.is_deleted', 0);
      $this->db->where('orders.is_archive', 0);
      $this->db->where('status !=', 'ordered');

      if($status == 'incoming') {
        $this->db->where('status', $status);
      } else {
        $this->db->where('status !=', 'incoming');
      }

      if($this->session->userdata('role') != "admin") {
        $this->db->where('orders.user_id', $this->session->userdata('user_id'));
      }



      return $this->db->get()->result_array();
    }
    // fetch Archives
    function ordersArchive($status) {
      $this->db->select("orders.*,users.username, orders_more.image, orders_more.qty order_qty, orders_more.good_qty,orders_more.location");
      $this->db->from('orders');
      $this->db->join('users', 'users.id = orders.user_id', 'LEFT');
      $this->db->join('orders_more', 'orders_more.order_id = orders.id', 'LEFT');
      $this->db->order_by('orders.id', 'desc');
      $this->db->where('orders.is_deleted', 0);
      $this->db->where('orders.is_archive', 1);
      $this->db->where('status !=', 'ordered');

      if($this->session->userdata('role') != "admin") {
        $this->db->where('orders.user_id', $this->session->userdata('user_id'));
      }



      return $this->db->get()->result_array();
    }



    public function get_low_stock($value='')
    {
      $this->db->select("orders.*,users.username, orders_more.image, orders_more.qty order_qty, orders_more.good_qty,orders_more.location");
      $this->db->from('orders');
      $this->db->join('users', 'users.id = orders.user_id', 'LEFT');
      $this->db->join('orders_more', 'orders_more.order_id = orders.id', 'LEFT');
      $this->db->order_by('orders.id', 'desc');
      $this->db->where('orders.is_deleted', 0);
      $this->db->where('orders.is_archive', 0);
      $this->db->where('status !=', 'ordered');
      $this->db->where('orders_more.qty <', '5');
      $this->db->where('orders.user_id', $this->session->userdata('user_id'));

      return $this->db->get()->result_array();
    }

    function getUserOrders() {
      $this->db->select("orders.*");
      $this->db->from('orders');
      $this->db->order_by('orders.id', 'desc');
      $this->db->where('orders.is_deleted', 0);
      $this->db->where('orders.is_archive', 0);
      $this->db->where('orders.status !=', 'incoming');
      $this->db->where('orders.status !=', 'ordered');
      $this->db->where('orders.user_id', $this->session->userdata('user_id'));
      return $this->db->get()->result_array();
    }

    function getCustomerOrders() {
      $this->db->select("user_orders.*,users.username");
      $this->db->from('user_orders');
      $this->db->join('users', 'users.id = user_orders.user_id');

      if($this->session->userdata('role') != 'admin') {
      //   $this->db->where('orders.status', 'ordered' );
        $this->db->where('user_orders.user_id', $this->session->userdata('user_id'));
      }
      $this->db->where('user_orders.is_archive', 0);
      // print_r($this->db->get()->result_array());exit();
      return $this->db->get()->result_array();
    }
    function getCustomerOrdersarchives() {
      $this->db->select("user_orders.*,users.username");
      $this->db->from('user_orders');
      $this->db->join('users', 'users.id = user_orders.user_id');

      if($this->session->userdata('role') != 'admin') {
      //   $this->db->where('orders.status', 'ordered' );
        $this->db->where('user_orders.user_id', $this->session->userdata('user_id'));
      }
      $this->db->where('user_orders.is_archive', 1);
      $this->db->order_by('user_orders.id','desc');
      // print_r($this->db->get()->result_array());exit();
      return $this->db->get()->result_array();
    }
    function getInvoiceDetails($id) {
      $this->db->select("*");
      $this->db->from('invoices');
      $this->db->join('user_orders', 'invoices.user_orders_id = user_orders.id');
      $this->db->join('user_orderdetails', 'user_orders.id = user_orderdetails.user_orderid');
      $this->db->join('orders', 'orders.id = user_orderdetails.order_id');
      $this->db->join('orders_more', 'orders.id = orders_more.order_id');
      // $this->db->join('orders', 'invoices.orders_id = orders.id');
      // $this->db->join('users', 'invoices.user_id = users.id');
      // if($this->session->userdata('role') != 'admin') {
      //   $this->db->where('invoices.user_id', $this->session->userdata('user_id'));
      // }
      $this->db->where('invoices.id', $id);
      return $this->db->get()->row_array();
    }

    function getAllInvoices() {
      // $this->db->select("orders.*, orders.id order_id, user_orders.datetime order_date, users.*, invoices.id invoice_id,invoices.datetime invoice_dt, user_orders.order_no");
      $this->db->select("user_orders.id order_id, user_orders.datetime order_date, users.*, invoices.id invoice_id,invoices.datetime invoice_dt, user_orders.order_no");
      $this->db->from('invoices');
      $this->db->join('user_orders', 'invoices.user_orders_id = user_orders.id');
      // $this->db->join('orders', 'invoices.user_orders_id = orders.id');
      $this->db->join('users', 'user_orders.user_id = users.id');
      if($this->session->userdata('role') != 'admin') {
        $this->db->where('user_orders.user_id', $this->session->userdata('user_id'));
      }

      return $this->db->get()->result_array();
    }

    function getReceivedOrderInfo($id){
      $this->db->select('*');
      $this->db->from('orders_more');
      $this->db->where('order_id',$id);
      return $this->db->get()->result_array();
    }

    function batch_update($tbl_name, $arr, $column) {
      $this->db->update_batch($tbl_name, $arr, $column);
    }

    function getAuths()
    {
      $this->db->where('auth_id',1);
      return $this->db->get('auths')->row();
    }

    function getReceivedDate($id){
      $this->db->where('id',$id);
      return $this->db->get('orders')->row();
    }

    public function getTickets() {
      $this->db->select('tickets.*, users.username as customer_name');
      if($this->session->userdata('role') == "customer") {
        $this->db->where('user_id', $this->session->userdata('user_id'));
      }
      $this->db->join('users', 'tickets.user_id = users.id');
      $this->db->from('tickets');
      $this->db->order_by('tickets.id', 'desc');
      return $this->db->get()->result_array();
    }

    public function get_ticket_info($id) {
      $this->db->select('tickets.*, users.username as customer_name');
      $this->db->from('tickets');
      $this->db->join('users', 'tickets.user_id = users.id');
      $this->db->where('tickets.id', $id);
      return $this->db->get()->row_array();
    }

    public function get_ticket_replies($id) {
      $this->db->select('tickets_msgs.*, users.username');
      $this->db->from('tickets_msgs');
      $this->db->join('users', 'tickets_msgs.user_id = users.id');
      $this->db->where('tickets_msgs.ticket_id', $id);
      return $this->db->get()->result_array();
    }

    public function orderdetails($order_id)
    {
      $this->db->select("*");
      $this->db->from('orders');
      $this->db->join('users', 'users.id = orders.user_id', 'LEFT');
      $this->db->join('orders_more', 'orders_more.order_id = orders.id', 'LEFT');
      $this->db->order_by('orders.id', 'desc');
      $this->db->where('orders.is_deleted', 0);
      $this->db->where('orders.is_archive', 0);
      $this->db->where('orders.id =', $order_id);

      return $this->db->get()->result_array();
    }

    public function fetchitemordereddetials($id)
    {
      $this->db->select("*, uod.orderdetail_notes");
      $this->db->from('user_orderdetails uod');
      $this->db->join('orders o', 'uod.order_id = o.id');
      $this->db->join('orders_more om', 'om.order_id = o.id');
      $this->db->where('uod.user_orderid =', $id);

      return $this->db->get()->result_array();
    }

    public function updateOrders($arr, $id) {
      return $this->db->update_batch('orders_more', $arr,'order_id');
    }

    public function getStorageUnder15($id='')
    {

      $this->db->select('orders_more.*');
      $this->db->from('orders_more');
      $this->db->join('orders','orders_more.order_id = orders.id');

      if ($id != '') {

          $this->db->where('orders.user_id',$id);

      }

      $this->db->where('orders.date_ordered BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()');

      $this->db->where('orders.status', 'received');
      $this->db->where('orders.is_archive', '0');

      $query = $this->db->get()->result();


      $qty=0;

              foreach($query as $countsize){
                  $width1=$countsize->width;
                  $length=$countsize->length;
                  $height=$countsize->height;

                  if($length == 0)
                  { $length = 1;}
                      if($width1 == 0){$width1 = 1;}
                      if($height == 0){$height = 1;}
                      $p=$length*$width1*$height;
                      $ans1=($p)/1728;
                      $ans=round($ans1, 3);
                      $qty+=$ans*$countsize->qty;;
              }
              return $qty;

      foreach($query as $countsize){

          $width1=$countsize->width;
          $length=$countsize->length;
          $height=$countsize->height;

          if($length == 0){ $length = 1;}
          if($width1 == 0){$width1 = 1;}
          if($height == 0){$height = 1;}

          $p=$length*$width1*$height;
          $ans1=($p)/1728;
          $ans=round($ans1, 3);
          $qty+=$ans;

          // $tot = $width1*$length*$height*$countsize->qty;

          // $qty+=$tot;
      }

      return $qty;

    }

    public function getBillOver15($date , $id='')
    {

      $this->db->select('orders_more.*');
      $this->db->from('orders_more');
      $this->db->join('orders','orders_more.order_id = orders.id');

      if ($id != '') {

          $this->db->where('orders.user_id',$id);

      }
      $this->db->where('DATE_FORMAT(orders.date_ordered,"%Y-%m-%d") <=',$date);
      $this->db->where('orders.date_ordered BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()');

      $query = $this->db->get()->result();

      $qty=0;

      foreach($query as $countsize){

          $width1=$countsize->width;
          $length=$countsize->length;
          $height=$countsize->height;

          $tot = $width1*$length*$height*$countsize->qty;
          $ans1=($tot)/1728;
          $tote=round($ans1, 3);

          $qty+=$tote;
      }

      return $qty;


    }

}



?>
