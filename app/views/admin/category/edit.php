<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Edit Category
                        <a href="?page=category&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <?php if(isset($data) && !empty($data)) :?>
                  <div class="card-body">
                        <form action="index.php" method="POST">
                              <input type="hidden" name="page" value="category">
                              <input type="hidden" name="action" value="update">
                              <input type="hidden" name="id" value="<?php echo $data['id']?>">
                              <div class="row">
                                    <div class="col-md-12 mb-3">
                                          <label for="name" class="mb-2">Name <span class="text-danger">*</span></label>   
                                          <input id="name" type="text" name="name" required class="form-control" value="<?php echo htmlspecialchars($data['name'])?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                          <label for="text" class="mb-2">Description <span class="text-danger">*</span></label>   
                                          <textarea id="text" type="text" name="description" required class="form-control" rows="8" style="resize:none;"><?php echo htmlspecialchars($data['description'])?></textarea>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                           <label for="status" class="mb-2">Status</label>   
                                          <select name="status" id="status" class="col-md-3 form-control">
                                                <option value="active" <?php echo (isset($data['status']) && $data['status'] == 1) ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?php echo (isset($data['status']) && $data['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                                          </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
                                    </div>
                              </div>
                        </form>
                  </div>
            <?php endif;?>
      </div>
</div>