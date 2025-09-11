<div class="container-fluid px-4 mt-5">
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Edit Admin
                        <a href="?page=admin&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <?php if(isset($data) && !empty($data)) : ?>
                  <div class="card-body">
                        <form action="index.php" method="POST">
                              <input type="hidden" name="page" value="admin">
                              <input type="hidden" name="action" value="update">
                              <input type="hidden" name="id" value="<?php echo $data['id']?>">
                              <div class="row">
                                    <div class="col-md-12 mb-3">
                                          <label for="name" class="mb-2">Name <span class="text-danger">*</span></label>   
                                          <input id="name" type="text" name="name" required class="form-control" value="<?php echo $data['name']?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                          <label for="email" class="mb-2">Email<span class="text-danger">*</span></label>   
                                          <input id="email" type="email" name="email" required class="form-control" value="<?php echo $data['email'] ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                          <label for="password" class="mb-2">Password <span class="text-danger">*</span></label>   
                                          <input id="password" type="password" name="password" required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                          <label for="phone" class="mb-2">Phone <span class="text-danger">*</span></label>   
                                          <input id="phone" type="text" name="phone" required class="form-control" value="<?php echo $data['phone'] ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                          <label for="role_id" class="mb-2">Role</label>   
                                          <select name="role_id" id="role_id" class="form-select">
                                                <option value="">-- Select Role --</option>
                                                <?php if(!empty($roles)) :?>
                                                      <?php foreach($roles as $role): ?>
                                                            <option value="<?= $role['id'] ?>" <?= $role['id'] === $data['role_id'] ? 'selected' : '' ?>>
                                                                  <?= ucfirst($role['name']) ?>
                                                            </option>
                                                      <?php endforeach; ?>
                                                <?php endif;?>
                                          </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                    </div>
                              </div>
                        </form>
                  </div>
            <?php endif; ?>

      </div>
</div>