<div class="main-content">
          <div class="content-wrapper"><!--User Profile Starts-->
<!--Basic User Details Starts-->
<section id="user-profile">
    <div class="row">
        <div class="col-12">
            <div class="card profile-with-cover">
                <div class="card-img-top img-fluid bg-cover height-300" style="background: url('<?=base_url();?>app-assets/img/photos/14.jpg') 50%;"></div>
                <div class="media profil-cover-details row">
                    <div class="col-5">
                        <div class="align-self-start halfway-fab pl-3 pt-2">
                            <div class="text-left">
                                <h3 class="card-title white"><?=$record['customer_name']?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="align-self-center halfway-fab text-center">
                            <a class="profile-image">
                                <img src="<?=base_url();?>assets/pp.png" class="rounded-circle img-border gradient-summer width-100" alt="Card image">
                            </a>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="media-body halfway-fab align-self-end">
                            <div class="text-right d-none d-sm-none d-md-none d-lg-block">
                                <a href="<?=base_url();?>system_users/edit/<?=$record['id']?>" class="btn btn-success btn-raised mr-3"><i class="ft-edit mr-2"></i> Edit</a>
                            </div>
                            <div class="text-right d-block d-sm-block d-md-block d-lg-none">
                                <button type="button" class="btn btn-primary btn-raised mr-2"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-success btn-raised mr-3"><i class="fa fa-dashcube"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-section">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 ">
                           <!--  <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#about" class="primary font-medium-2 font-weight-600">About</a>
                                </li>
                                <li>
                                    <a href="#user" class="primary font-medium-2 font-weight-600">Timeline</a>
                                </li>
                            </ul> -->
                        </div>
                        <div class="col-lg-2 col-md-2 text-center">
                            <span class="font-medium-2 text-uppercase"><?=$record['customer_name']?></span>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <!-- <ul class="profile-menu no-list-style">
                                <li>
                                    <a href="#friends" class="primary font-medium-2 font-weight-600">Friends</a>
                                </li>
                                <li>
                                    <a href="#photos" class="primary font-medium-2 font-weight-600">Photos</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Basic User Details Ends-->

<!--About section starts-->
<section id="about">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-user font-small-3"></i> Username:</a></span>
                                        <span class="display-block overflow-hidden"><?=$record['username']?></span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-briefcase font-small-3"></i> Store Name:</a></span>
                                        <span class="display-block overflow-hidden"><?=$record['store_name']?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-mail font-small-3"></i> Email:</a></span>
                                        <a class="display-block overflow-hidden"><?=$record['email']?></a>
                                    </li>
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-map-pin font-small-3"></i> Address:</a></span>
                                        <span class="display-block overflow-hidden"><?=$record['address']?></span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col-12 col-md-6 col-lg-4">
                                <ul class="no-list-style">
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> Phone Number:</a></span>
                                        <span class="display-block overflow-hidden"><?=$record['phone']?></span>
                                    </li>
                                    
                                    <li class="mb-2">
                                        <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Joined:</a></span>
                                        <span class="display-block overflow-hidden"><?=date('d M Y', strtotime($record['created_on']))?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

          </div>
        </div>