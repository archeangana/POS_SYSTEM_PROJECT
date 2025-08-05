<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Create Category
                        <a href="?page=category&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <div class="card-body">
                  <form action="index.php" method="POST">
                        <input type="hidden" name="page" value="category">
                        <input type="hidden" name="action" value="add">
                        <div class="row">
                              <div class="col-md-12 mb-3">
                                    <label for="name" class="mb-2">Name <span class="text-danger">*</span></label>   
                                    <input id="name" type="text" name="name" required class="form-control">
                              </div>
                              <div class="col-md-12 mb-3">
                                    <label for="text" class="mb-2">Description <span class="text-danger">*</span></label>   
                                    <textarea id="text" type="text" name="description" required class="form-control" style="resize:none;" rows='8'></textarea>
                              </div>
                              <div class="col-md-2 mb-3">
                                    <label for="status" class="mb-2">Status</label>   
                                    <select name="status" id="" class="col-md-3 form-select">
                                          <option value="active" class="form-control">Active</option>
                                          <option value="inactive" class="form-control">Inactive</option>
                                    </select>
                              </div>
                              <div class="col-md-12 mb-3">
                                   <button type="submit" name="submit" class="btn btn-success">Create</button>
                              </div>
                        </div>
                  </form>
            </div>

      </div>
</div>