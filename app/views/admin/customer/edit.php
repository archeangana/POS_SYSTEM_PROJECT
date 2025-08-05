<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Edit Customer
                        <a href="?page=customer&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <?php if(!empty($data)) :?>
                  <div class="card-body">
                        <form action="index.php" method="POST">
                              <input type="hidden" name="page" value="customer">
                              <input type="hidden" name="action" value="update">
                              <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                              <div class="row">
                                    <div class="col-md-12 mb-3">
                                          <label for="name" class="mb-2">Name <span class="text-danger">*</span></label>   
                                          <input id="name" type="text" name="name" required class="form-control" value="<?php echo htmlspecialchars($data['name'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                          <label for="email" class="mb-2">Email<span class="text-danger">*</span></label>   
                                          <input id="email" type="email" name="email" required class="form-control" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                          <label for="phone" class="mb-2">Phone <span class="text-danger">*</span></label>   
                                          <input id="phone" type="text" name="phone" required class="form-control" value="<?= trim($data['phone']) ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                          <label for="status" class="mb-2">Select Status</label>
                                          <select name="status" id="status" class="form-select">
                                                <option value="active" <?php echo isset($data['status']) == 1 ? 'selected' : ''?>>Active</option>
                                                <option value="inactive" <?php echo isset($data['status']) == 0 ? 'selected' : ''?>>Inactive</option>
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