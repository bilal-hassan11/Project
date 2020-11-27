<div class="main-content">
    <div class="content-wrapper"><!--Statistics cards Starts-->
      <div class="row">
        <div class="col-sm-12">
          <section id="fabs-examples">

            <!-- Ticket start -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Add New Ticket</h3>
                  </div>
                  <div class="card-body">
                    <div class="card-block">
                      <br>
                      <form class="form" action="<?=site_url('admin/add_new_ticket')?>" method="post">
                        <div class="form-group">
                          <label>Title:</label>
                          <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                          <label>Issue:</label>
                          <textarea name="issue" class="form-control" rows="8" cols="80" required></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-success" name="button">Create Ticket</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Ticket ends -->

          </section>
        </div>
      </div>
    </div>
  </div>
</div>
