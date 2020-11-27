<?php $role = $this->session->userdata('role');?>

<?php $permission = $this->session->userdata('permission');?>
<?php $role = $this->session->userdata('role'); ?>

<!-- main menu-->
<!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
<div data-active-color="white" data-background-color="white" data-image="<?=base_url('app-assets/img/sidebar-bg/01.jpg')?>" class="app-sidebar">
  <!-- main menu header-->
  <!-- Sidebar Header starts-->
  <div class="sidebar-header">
    <div class="logo clearfix">
      <!-- <a href="<?=site_url('admin')?>" class="logo-text float-left">tgLogistics</a> -->
        <a href="<?=site_url('admin/orders')?>">
          <div class="logo-img">
            <img src="<?=base_url('app-assets/images/logo.jpg')?>" width="50" class="text align-middle" />
             <strong> Brown Box Ninja</strong>
          </div>
        </a>
      <!-- <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block">
      <i data-toggle="expanded" class="ft-toggle-right toggle-icon"></i></a> -->
      <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
  </div>
  <!-- Sidebar Header Ends-->
  <!-- / main menu header-->
  <!-- main menu content-->
  <br />
  <div class="sidebar-content">
    <div class="nav-container">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <?php if($role == "customer" || $role == "admin") { ?>
          <li class=" nav-item <?php echo (@$active_menu=='dashboard'?'active':'')?>">
            <a href="<?=site_url('admin/dashboard');?>"><i class="ft-home"></i><span data-i18n="" class="menu-title" style="font-size: 14px!important;">Dashboard</span>
            </a>
          </li>
          <li class=" nav-item <?php echo (@$active_menu=='new_order'?'active':'')?>">
            <a href="<?=site_url('admin/new_order');?>"><i class="ft-plus"></i><span data-i18n="" class="menu-title" style="font-size: 14px!important;">Add Incoming Inventory</span>
            </a>
          </li>
          <?php } ?>
        <?php if($role == "customer" || $role == "admin") { ?>
          <li class=" nav-item <?php echo (@$active_menu=='incoming'?'active':'')?>">
            <a href="<?=site_url('admin/orders/incoming');?>"><i class="ft-arrow-down-left"></i><span data-i18n="" class="menu-title">Incoming Inventory</span>
            </a>
          </li>
        <?php } ?>
        <li class=" nav-item <?php echo (@$active_menu=='recieved'?'active':'')?>">
          <a href="<?=site_url('admin/orders/recieved');?>"><i class="ft-box"></i><span data-i18n="" class="menu-title">Inventory</span>
          </a>
        </li>
        <li class=" nav-item <?php echo (@$active_menu=='items_ordered'?'active':'')?>">
          <a href="<?=site_url('admin/items_ordered');?>"><i class="ft-check-square"></i><span data-i18n="" class="menu-title">Items Ordered</span>
          </a>
        </li>
        <li class=" nav-item <?php echo (@$active_menu=='invoices'?'active':'')?>">
          <a href="<?=site_url('admin/invoices');?>"><i class="ft-file-text"></i><span data-i18n="" class="menu-title">Invoices</span>
          </a>
        </li>
        <li class="has-sub nav-item <?php echo (@$active_menu=='archives'?'active':'')?>">
          <a href="#"><i class="ft-package"></i><span data-i18n="" class="menu-title">Archives</span>
          </a>
          <ul class="menu-content">
            <li class="<?php echo (@$sub_menu=='archive_orders'?'active':'')?>">
              <a href="<?=site_url('admin/archives');?>" class="menu-item">Archived Items</a>
            </li>
            <li class="<?php echo (@$sub_menu=='archive_itemsordered'?'active':'')?>">
              <a href="<?=site_url('admin/archives_itemordered');?>" class="menu-item">Archived Orders</a>
            </li>
          </ul>
        </li>

        <?php if($role === "admin") {?>
          <li class="has-sub nav-item">
            <a href="#"><i class="ft-user"></i><span data-i18n="" class="menu-title">Users</span></a>
            <ul class="menu-content">
              <li class="<?php echo (@$sub_menu=='add_user'?'active':'')?>">
                <a href="<?=site_url('system_users/add');?>" class="menu-item">Add User</a>
              </li>
              <li class="<?php echo (@$sub_menu=='view_user'?'active':'')?>">
                <a href="<?=site_url('system_users');?>" class="menu-item">View Users</a>
              </li>
            </ul>
            <li class=" nav-item <?php echo (@$active_menu=='setting'?'active':'')?>">
              <a href="<?=site_url('admin/setting');?>"><i class="ft-settings"></i><span data-i18n="" class="menu-title">Setting</span>
              </a>
            </li>
          <?php } ?>
          <li class=" nav-item <?php echo (@$active_menu=='tickets'?'active':'')?>">
            <a href="<?=site_url('admin/tickets');?>"><i class="ft-tag"></i><span data-i18n="" class="menu-title">Support Tickets</span>
            </a>
          </li>
      </ul>
    </div>
  </div>
  <!-- main menu content-->
  <div class="sidebar-background"></div>
  <!-- main menu footer-->
  <!-- include includes/menu-footer-->
  <!-- main menu footer-->
</div>
<!-- / main menu-->
<div class="main-panel">

  <!-- Navbar (Header) Starts-->

  <nav class="navbar navbar-expand-lg navbar-light bg-faded">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>

      <div class="navbar-container">
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="dropdown nav-item">
              <a id="dropdownBasic2" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-bell font-medium-3 blue-grey darken-4"></i><span class="notification badge badge-pill badge-danger" id="notfication_count"></span>
              <p class="d-none">Notifications</p></a>
              <div class="notification-dropdown dropdown-menu dropdown-menu-right">
                <div class="noti-list" id="notification_area">
              </div>
            </li>
            <?php if (@$this->session->userdata('role') == 'customer'): ?>
            <li>
              <a onclick="cartitemsshow()" class="nav-link carcont">
                <i class="ft-shopping-cart font-medium-3 blue-grey darken-4"></i>View Cart
                <span class=" badge badge-pill badge-danger cartcount" id="cartcount"><?=count($this->cart->contents())?></span>
              </a>

            </li>
            <?php endif ?>

            <li class="dropdown nav-item">
              <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                <i class="ft-user font-medium-3 blue-grey darken-4"></i>
                <?=@$this->session->userdata('username')?>
                <p class="d-none">User Settings</p></a>
              <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
              <?php if (@$this->session->userdata('role') == 'customer'): ?>
                <a href="<?=site_url('system_users/account_information')?>" class="dropdown-item"><i class="ft-edit mr-2"></i><span>Account Information</span></a>
              <?php endif ?>
                <a href="<?=site_url('users/logout')?>" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Navbar (Header) Ends-->


<script type="text/javascript">
  function loadNotifications(){
      // console.log("Hello");
      $.ajax({
          url:"<?=base_url('admin/check_notification')?>",
          success:function(data)
          {
              var res = $.parseJSON(data);
              var notfication_count=0;
              var notification="";
              var base_url="<?=base_url()?>";
              for(a in res)
              {
                  notfication_count++;
                  notification+=' <a class="dropdown-item noti-container py-3 border-bottom border-bottom-blue-grey border-bottom-lighten-4" href="'+base_url+"/admin/notification_link/"+res[a].id+'"><i class="ft-bell info float-left d-block font-large-1 mt-1 mr-2"></i><span class="noti-wrapper"><span class="noti-title line-height-1 d-block text-bold-400 info">'+res[a].subject+'</span><span class="noti-text">'+res[a].message+'</span></span></a>';
              }
              $("#notfication_count").html(notfication_count);
              $("#notification_area").html(notification);
          }
      })
    }

    $(document).ready(function(){
        loadNotifications();
        setInterval(loadNotifications(), 3000);
    });


  function cartitemsshow() {
    $('#cartitemmodel').modal('show');
    $.ajax({
    url : '<?=site_url('admin/loadcart');?>',
    dataType : 'json',
    success :function(data) {
      // var a=makeid(10);
      if ($('#orderno').val()=='') {
        // $('#orderno').val(a);
      }
      $('#cartitemtablebody').html(data);
    }
   });

  }

  // function makeid(length) {
  //    var result           = '';
  //    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  //    var charactersLength = characters.length;
  //    for ( var i = 0; i < length; i++ ) {
  //       result += characters.charAt(Math.floor(Math.random() * charactersLength));
  //    }
  //    return result;
  // }


  $(document).on('click','.remove_cart',function(){
    var id= $(this).attr('data');
    $.ajax({
      url : '<?=site_url('admin/delete_cart');?>',
      data : {id:id},
      method:'post',
      dataType : 'json',
      success :function(data){
        $('#cartitemtablebody').html(data);
      }
    });
  })

  $(document).on('click','.plusqty,.minusqty',function(){

      var id = $(this).attr('data');
      var max_qty = Number($(this).parents('tr').attr('data-max-qty'));
      var n = $('.getQty'+id).text();
      var n1 = Number(n);

        if ($(this).hasClass('plusqty')) {

            var fn = n1+1;

            if(fn > max_qty) {
              alert('Cannot increase qty further ');
            } else {
              $('.getQty'+id).text(fn);
            }
        }else{

          if (n1 > 1) {
              var fn = n1-1;
              $('.getQty'+id).text(fn);
          } else {
            alert('Qty cannot be less than 1');
          }

        }


  });

  $(document).on('click','.plusprice,.minusprice',function(){
    var id = $(this).attr('data');
    var n = $('.getPrice'+id).text();
    var n1 = Number(n);

    if ($(this).hasClass('plusprice')) {

        var fn = n1+1;
        $('.getPrice'+id).text(fn);
    } else {

      if (n1 > 1) {
          var fn = n1-1;
          $('.getPrice'+id).text(fn);
      } else {
        alert('Qty cannot be less than 1');
      }
    }
  });

  $(document).on('click','.update_cart',function(){
    var id = $(this).attr('data');
    var qty = $('.getQty'+id).text();
    var price = $('.getPrice'+id).text();
    var name = $('.getName'+id).text();
    // alert(name);
    $.ajax({
      url : '<?=site_url('admin/update_cart');?>',
      data : {id:id , qty:qty , price:price , name:name },
      method:'post',
      dataType : 'json',
      success :function(data){
        $('#cartitemtablebody').html(data);
      }
    });

  })

  function destroycart()
  {
    $.ajax({
      url : '<?=site_url('admin/destroy_cart');?>',
      dataType : 'json',
      success :function(data){
      }
    });
  }

</script>
