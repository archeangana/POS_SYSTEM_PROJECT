<div class="container-fluid px-4 mt-4">

      <?php include dirname(__DIR__, 4) . '/components/notifications/flash.php'; ?>

     <div class="card shadow-sm">
            <div class="card-header">
                  <h3>Site Information</h3>
            </div>
            <div class="card-body">
                  <form method="POST" action="?page=settings&action=save">
                        <input type="hidden" name='id' value="<?= htmlspecialchars($settings['id'] ?? '') ?>">
                        <div class="row d-block">
                              <div class="col-md-4 mb-3">
                                    <label for="company_name" class="mb-2">Company Name:</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?= htmlspecialchars($settings['company_name'] ?? '') ?>">
                              </div>
                              <div class="col-md-4 mb-3">
                                    <label for="company_address" class="mb-2">Company Address:</label>
                                    <input type="text" class="form-control" id="company_address" name="company_address" value="<?= htmlspecialchars($settings['company_address'] ?? '') ?>">
                              </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
            </div>
     </div>
</div>