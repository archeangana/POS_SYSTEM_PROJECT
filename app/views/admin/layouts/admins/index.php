<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 4) . '/components/notifications/flash.php' ;?>
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Admins/Staff
                        <a href="?page=admin&action=createAdmin" class="btn btn-primary float-end">Add Admin</a>
                  </h4>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                              <thead>
                                    <tr>
                                          <th>ID</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php 
                                          if(!empty($admins)) : 
                                                foreach($admins as $admin) : 
                                          ?>
                                          <tr>
                                                <td><?php echo $admin['id']?></td>
                                                <td><?php echo $admin['name']?></td>
                                                <td><?php echo $admin['email']?></td>
                                                <td>
                                                      <a href="?page=admin&action=delete" class="btn btn-danger">Delete</a>
                                                      <button class="btn btn-warning">Update</button>
                                                      <button class="btn btn-info">Details</button>
                                                </td>
                                          </tr>
                                          <?php endforeach;
                                                endif; 
                                          ?>
                              </tbody>
                        </table>
                  </div>
            </div>

      </div>
</div>