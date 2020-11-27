<style>
  #shipped_div {
    display: none;
  }
  .dimg {
    max-width: 100px;
    max-height: 100px;
  }
  .document_div {
    display: block;
    border: 1px solid #ccc;
    margin: 5px; padding: 5px;
    box-shadow: 0 0 1px 0px rgba(0,0,0,0.1);
    background: #f2f2f2;
  }
  .add_new_doc_btn {
    display: block;
    margin: 15px;
  }
  .remove_btn {
    padding: 0px 10px;
    float: right;
    color: #ad1902;
  }
  .remove_btn:hover {
    color: #4a0601;
  }
  .img_cont {
    width: 150px;
    height: 130px;
    border: 1px solid #ccc;
    box-shadow: 0 0 1px rgba(0,0,0,.3);
    background-position: center;
    background-size: cover;
    margin: 10px;
  }
</style>


<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Import Incoming Inventory</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
              <form action="<?=site_url('admin/save_order_excel')?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                          <label>Import excel File</label>
                          <input type="file" name="file" class="form-control" >
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-success" style="margin-top: 34px;">Submit</button>
                        </div>
                  </div>
                </div>
              </form>
              <!-- <a href="<=base_url();?>admin/download_exelFile" class="btn btn-default  float-right addmore_btn"><i class="fa fa-download"></i> Download Sample File</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
<form action="<?=site_url('admin/save_order')?>" method="post" enctype="multipart/form-data">
      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">New Incoming Inventory</h4>

            </div>

            <div class="card-body">

              <div class="card-block">

                <?php if($this->session->flashdata('response') == 'error') { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?=$this->session->flashdata('msg')?>
                  </div>
                <?php } ?>

                  <input type="hidden" name="id" value="<?=@$record['id']?>">
                    <input type="hidden" name="reorder" value="<?php if($title=='Reorder Order'){ echo $title; } ?>">
                    <div class="row">
                        <!-- <div class="col-md-4">
                        <div class="form-group">
                          <label>Order Number *</label>
                          <input class="form-control" type="text" name="order_number" value="<=@$record['order_number']?>" required />
                        </div>
                      </div> -->

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>User</label>
                          <?php if($this->session->userdata('role') == 'admin') { ?>
                            <select class="form-control" name="user_id" required>
                           <option  value=""> -- Select User -- </option>
                           <?php foreach($users as $user){
                             if($user['role'] == 'admin') {continue;}?>
                           <?php
                             $selected = "";
                             if(@$record['user_id'] == $user['id']){
                               $selected = "selected";
                             }
                               ?>
                             <option value="<?=$user['id']?>" <?=$selected?>><?=$user['username']?></option>
                           <?php } ?>
                         </select>

                          <?php } else { ?>
                            <input type="text" name="user_id" class="form-control disabled" disabled readonly value="<?=$this->session->userdata('username')?>">
                          <?php } ?>
                          <?php
                          if($this->session->userdata('role')=='admin'){
                          ?>
                          <a href="<?=site_url('system_users/add')?>" target="_blank" title="After adding new user refresh this page" class="btn-link btn-sm"><i class="fa fa-external-link"></i> Add New User</a>
                            <?php } ?>
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date Ordered *</label>
                            <input class="form-control" type="date" name="date_ordered" value="<?=@$record['date_ordered']?>" required>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Description *</label>
                            <textarea name="description" class="form-control" rows="3" cols="40" required><?=@$record['description']?></textarea>
                          </div>
                        </div>
                    </div>


              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="card-block">
                <div class="item_row">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Image *</label>
                        <?php if(@$record_more[0]['image'] != "") { $img_req='';?>
                          <a href="<?=site_url('uploads/'.@$record_more[0]['image'])?>" target="_blank"><div class="img_cont img-thumbnail" style="background-image: url(<?=base_url('uploads/'.@$record_more[0]['image'])?>)"></div></a>
                          <input type="hidden" name="old_image[]" value="<?=@$record_more[0]['image']?>">
                        <?php }else{ $img_req='required';} ?>
                        <input type="file" class="form-control" name="image[]" title="Select or change image" <?=$img_req?>/>
                      </div>
                    </div>
                    </div>

                    <div  class="row" >
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Length(in inches)*</label>
                        <input class="form-control l1" id="l1" type="number" name="length[]" value="<?=@$record_more[0]['length']?>"
                        required>
                      </div>
                    </div>

                  <div class="col-md-3">
                      <div class="form-group">
                        <label>Width (in inches)*</label>
                        <input class="form-control w1" id="w1" type="number" name="width[]" value="<?=@$record_more[0]['width']?>"
                        required>
                      </div>
                    </div>



                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Height(in inches)*</label>
                        <input class="form-control ht1" id="ht1" type="number" name="height[]" value="<?=@$record_more[0]['height']?>"
                        required>
                      </div>
                    </div>


                  <div class="col-md-3">
                 <div class="form-group">
                  <label>Size(in Cubic Ft)*</label>
                  <input class="form-control v1" STYLE="background-color: #D3D3D3;"  name="cubicft" id="v1" value=""
                  READONLY>
                </div>
                </div>

                  </div>
<script>
$( ".l1" ).keyup(function() {
  length = $(this).val();
  width = $(".w1").val();
  height = $(".ht1").val();
  if(length == ''){length = 1}
  if(width == ''){width = 1}
  if(height == ''){height = 1}
  p=length*width*height;
  if(p!=1){
  ans1=(p)/1728;
  ans=ans1.toFixed(4);
  }
  else{
    ans=0;
  }
  $(".v1").val(ans);
});

$( ".w1" ).keyup(function() {
  length = $('.l1').val();
  width = $(this).val();
  height = $('.ht1').val();
  if(width == ''){width = 1}
  if(length == ''){length = 1}
  if(height == ''){height = 1}
  p=length*width*height;
  if(p!=1){
  ans1=(p)/1728;
  ans=ans1.toFixed(4);
  }
  else{
    ans=0;
  }$(".v1").val(ans);
});

$( ".ht1" ).keyup(function() {
  length = $('.l1').val();
  width = $('.w1').val();
  height = $(this).val();
  if(height == ''){height = 1}
  if(width == ''){width = 1}
  if(length == ''){length = 1}
  p=length*width*height;
  if(p!=1){
  ans1=(p)/1728;
  ans=ans1.toFixed(4);
  }
  else{
    ans=0;
  }$(".v1").val(ans);
});


</script>

                  <div class="row">
                    <div class="col-md-4">

                      <div class="form-group">
                        <label>UPC *</label>
                          <input class="form-control" type="text" name="upc[]" value="<?=@$record_more[0]['upc']?>" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                     <div class="form-group">
                        <label>Part Number *</label>
                        <input class="form-control" type="text" name="part_no[]" value="<?=@$record_more[0]['part_no']?>" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Inventory Type *</label>
                        <select class="form-control" type="text" name="service[]"   required>
                          <option  value=""> Select Inventory type</option>
                           <option  value="box contents" <?=@$record_more[0]['services'] == 'box contents'? "selected": ""?>> box contents </option>
                           <option  value="box" <?=@$record_more[0]['services'] == 'box'? "selected": ""?>> box </option>
                         </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>Supplier *</label>
                        <input class="form-control" type="text" name="supplier[]" value="<?=@$record_more[0]['supplier']?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tracking Number *</label>
                        <input class="form-control" type="text" name="tracking_number[]" value="<?=@$record_more[0]['tracking_number']?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <label>Qty *</label>
                        <input class="form-control" type="number" name="qty[]" value="<?=@$record_more[0]['qty']?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Asin Number *</label>
                         <input class="form-control" type="text" name="asin_number[]" value="<?=@$record_more[0]['asin_number']?>" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Notes *</label>
                        <textarea name="notes[]" class="form-control" rows="6" cols="80"><?=@$record_more[0]['notes']?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="addmore_items">
          <?php if(@count($record_more)>1){
            for($er=1;$er<@count($record_more);$er++){ ?>
              <div class="row moremain_row<?=$record_more[$er]['order_more_id']?>">
                <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                      <div class="card-block">
                        <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <a title="Remove item" class="btn-link btn-sm removemmore_btn  float-right" data="<?=$record_more[$er]['order_more_id']?>"><i class="fa fa-minus"></i> Remove</a>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Image *</label>
                            <?php if(@$record_more[$er]['image'] != "") { $img_req='';?>
                              <a href="<?=site_url('uploads/'.@$record_more[$er]['image'])?>" target="_blank"><div class="img_cont img-thumbnail" style="background-image: url(<?=base_url('uploads/'.@$record_more[$er]['image'])?>)"></div></a>
                              <input type="hidden" name="old_image[]" value="<?=@$record_more[$er]['image']?>">
                            <?php }else{$img_req='required';} ?>
                            <input type="file" class="form-control" name="image[]" title="Select or change image" <?=$img_req?>/>
                          </div>
                        </div>
                        <div class="col-md-6">

                          <div class="form-group">
                            <label>Size (in inches) *</label>
                            <input class="form-control" type="number" name="size_in_inches[]" value="<?=@$record_more[$er]['size_in_inches']?>" required>
                          </div>
                        </div>
                        </div>


                        <div class="row">
                        <div class="col-md-4">

                          <div class="form-group">
                            <label>UPC *</label>
                            <input class="form-control" type="text" name="upc[]" value="<?=$record_more[$er]['upc']?>" required>
                          </div>
                        </div>
                        <div class="col-md-4">

                          <div class="form-group">
                            <label>Product Number *</label>
                            <input class="form-control" type="text" name="part_no[]" value="<?=$record_more[$er]['part_no']?>" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Service *</label>
                            <input class="form-control" type="text" name="service[]" value="<?=@$record_more[$er]['services']?>" required>
                          </div>
                        </div>

                        </div>

                        <div class="row">
                        <div class="col-md-6">

                          <div class="form-group">
                            <label>Supplier *</label>
                            <input class="form-control" type="text" name="supplier[]" value="<?=@$record_more[$er]['supplier']?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tracking Number *</label>
                            <input class="form-control" type="text" name="tracking_number[]" value="<?=@$record_more[$er]['tracking_number']?>" required>
                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">

                          <div class="form-group">
                            <label>Qty *</label>
                            <input class="form-control" type="number" name="qty[]" value="<?=@$record_more[$er]['qty']?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Asin Number *</label>
                            <input class="form-control" type="text" name="asin_number[]" value="<?=@$record_more[$er]['asin_number']?>" required>
                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Notes *</label>
                            <textarea name="notes[]" class="form-control" rows="6" cols="80" required><?=@$record_more[$er]['notes']?></textarea>
                          </div>
                        </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
        }
        } ?>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="card-block">
                <a title="Addmore item" class="btn btn-default  float-right addmore_btn"><i class="fa fa-plus"></i> Addmore</a>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-success "><i class="fa fa-check"></i> Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</form>
  </div>

</div>
<script>
    var sno=1;
    $('.addmore_btn').click(function(){
        sno++;
        var addmorerow='<div class="row moremain_row'+sno+'">'+
          '<div class="col-sm-12">'+
            '<div class="card">'+
              '<div class="card-header">'+
              '</div>'+
              '<div class="card-body">'+
                '<div class="card-block">'+
        '<div ><div class="row">'+
                        '<div class="col-md-12">'+
                            '<a title="Remove item" class="btn-link btn-sm removemmore_btn  float-right" data="'+sno+'"><i class="fa fa-minus"></i> Remove</a>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row">'+
                    '<div class="col-md-6">'+
                      '<div class="form-group">'+
                        '<label>Image *</label>'+
                        <?php if(@$record['image'] != "") { ?>
                          '<a href="<?=site_url('uploads/'.@$record['image'])?>" target="_blank"><div class="img_cont img-thumbnail" style="background-image: url(<?=base_url('uploads/'.@$record['image'])?>)"></div></a>'+
                          '<input type="hidden" name="old_image" value="<?=@$record['image']?>">'+
                        <?php } ?>
                        '<input type="file" class="form-control" name="image[]" title="Select or change image" required/>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+

                      '<div class="form-group">'+
                        '<label>Size (in inches) *</label>'+
                        '<input class="form-control" type="number" name="size_in_inches[]" value="<?=@$record['size_in_inches']?>" required>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+


                  '<div class="row">'+
                    '<div class="col-md-4">'+

                      '<div class="form-group">'+
                        '<label>UPC *</label>'+
                        '<input class="form-control" type="text" name="upc[]" value="<?=@$record['upc']?>" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+

                      '<div class="form-group">'+
                        '<label>Product Number *</label>'+
                        '<input class="form-control" type="text" name="part_no[]" value="<?=@$record['part_no']?>" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                      '<div class="form-group">'+
                        '<label>Service *</label>'+
                        '<input class="form-control" type="text" name="service[]" value="<?=@$record['service']?>" required>'+
                      '</div>'+
                    '</div>'+

                  '</div>'+

                  '<div class="row">'+
                    '<div class="col-md-6">'+

                      '<div class="form-group">'+
                        '<label>Supplier *</label>'+
                        '<input class="form-control" type="text" name="supplier[]" value="<?=@$record['supplier']?>" required>'+
                      '</div>'+
                    '</div>'+
                   ' <div class="col-md-6">'+
                      '<div class="form-group">'+
                        '<label>Tracking Number *</label>'+
                        '<input class="form-control" type="text" name="tracking_number[]" value="<?=@$record['tracking_number']?>" required>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+

                  '<div class="row">'+
                    '<div class="col-md-6">'+

                      '<div class="form-group">'+
                        '<label>Qty *</label>'+
                        '<input class="form-control" type="number" name="qty[]" value="<?=@$record['qty']?>" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                      '<div class="form-group">'+
                        '<label>Asin Number *</label>'+
                        '<input class="form-control" type="text" name="asin_number[]" value="<?=@$record['asin_number']?>" required>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                  '<div class="row">'+
                    '<div class="col-md-12">'+
                      '<div class="form-group">'+
                        '<label>Notes *</label>'+
                        '<textarea name="notes[]" class="form-control" rows="6" cols="80" required><?=@$record['notes']?></textarea>'+
                      '</div>'+
                    '</div>'+
                  '</div></div>'+
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>';
        $('.addmore_items').append(addmorerow);
        $('.removemmore_btn').click(function(){
           var rowid=$(this).attr('data');
           $('.moremain_row'+rowid).remove();
        });
    })
    $('.removemmore_btn').click(function(){
           var rowid=$(this).attr('data');
           $('.moremain_row'+rowid).remove();
    });
</script>
