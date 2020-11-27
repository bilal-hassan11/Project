<div id="content" class="ninecol last">

    <div class="panel-wrapper">

        <div class="panel">

            <div class="title">

                <h4>Users</h4>

                <div class="collapse"><a href="<?=  site_url("userslist/add")?>" class="button-brown2">Add User</a></div>

            </div>

            <div class="content"> <!-- ## Panel Content  -->

                    <form method="get" action="">

                    <div class="select">

                        <label>Hotel</label>

                        <select name="hotel_id" id="hotel_id" class="validate[required]">

                            <option value="">Select</option>

                            <?= $this->basic_model->selectSelect2(@$_GET['hotel_id'], $hotels, "name", "id") ?>

                        </select>

                    </div>





                    <div class="select">

                        <input type="submit" value="Search" class="btn-add" style="margin-top:18px;" />

                    </div>





                </form>

                <table id="sample-table-sortable" class="sortable resizable">

                    <thead>

                        <tr>

                            <th>Hotel</th>

                            <th>Role</th>

                            <th>User name</th>

                            <th>First name</th>

                            <th>Last name</th>

                            <th>Password</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $i = 1;



                        if (isset($users)) {

                            foreach ($users as $key => $value) {



                                ?>

                                <tr>

                                    <td class="hidden-480"><?= @$value['short_name']; ?></td>

                                    <td class="hidden-480"><?= @$value['role']; ?></td>

                                    <td class="hidden-480"><?= @$value['username']; ?></td>

                                    <td class="hidden-480"><?= @$value['first_name']; ?></td>

                                    <td class="hidden-480"><?= @$value['last_name']; ?></td>

                                    <td class="hidden-480"><?php  echo $this->encrypt->decode($value['password']); ?></td>

                                    <td class="hidden-phone">

                                        <a href="<?=  site_url("userslist/edit/".$value['id'])?>">Edit</a>

                                        <a href="<?=  site_url("userslist/delete/".$value['id'])?>" rel="delete" class="ajax">Delete</a>

                                    </td>





                                </tr>

        <?php

        $i++;

    }

}

?>

                    </tbody>

                </table>

                <!-- ## / Panel Content  --> </div>

        </div>

        <div class="shadow"></div>

    </div>



</div>

