<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0">
                        Edit Product
                        <a href="?page=product&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <div class="card-body">
                  <?php if(!empty($data)) :?>
                        <form action="index.php" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="page" value="product">
                              <input type="hidden" name="action" value="update">
                              <input type="hidden" name="id" value="<?= trim($data['id'] ?? null) ?>">
                              <div class="row">
                                    <div class="col-md-2 mb-3">
                                          <label for="category_id" class="mb-2">Select Category <span class="text-danger">*</span></label>   
                                          <select id="category_id" name="category_id" required class="form-select">
                                                <option value="">-- Select Category --</option>
                                                <?php if(!empty($categoryData )): ?>
                                                      <?php foreach($categoryData as $item): ?>
                                                      <option 
                                                            value="<?= $item['id']?>" 
                                                            <?php echo $item['status'] == 0 ? 'hidden' : ''?> 
                                                            <?php echo $data['category_id'] === $item['id'] ? 'selected' : ''?>>
                                                            <?php echo htmlspecialchars($item['name']); ?>
                                                      </option>
                                                      <?php endforeach; ?>
                                                      <?php else: ?>
                                                            <option value=''> No Categories found</option>
                                                <?php endif; ?>
                                          </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                          <label for="name" class="mb-2">Product Name <span class="text-danger">*</span></label>   
                                          <input id="name" type="text" name="name" required class="form-control" value="<?= htmlspecialchars($data['name'] ?? '')?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                          <label for="text" class="mb-2">Description <span class="text-danger">*</span></label>   
                                          <textarea id="text" type="text" name="description" required class="form-control" style="resize:none;" rows='8'><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                          <label for="price" class="mb-2">Price <span class="text-danger">*</span></label>   
                                          <input id="price" type="text" name="price" required class="form-control" value="<?= $data['price'] ?? 0?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                          <label for="quantity" class="mb-2">Quantity <span class="text-danger">*</span></label>   
                                          <input id="quantity" type="text" name="quantity" required class="form-control" value="<?= $data['quantity']?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                          <label for="status" class="mb-2">Status</label>   
                                          <select name="status" id="" class="col-md-3 form-select">
                                                <option value="active" class="form-control" <?php echo $data['status'] == 1 ? 'selected': ''; ?> >Active</option>
                                                <option value="inactive" class="form-control" <?php echo $data['status'] == 0 ? 'selected': ''; ?>>Inactive</option>
                                          </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                          <label for="image" class="mb-2">Product Image:</label>   
                                          <input id="image" type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                          
                                          <?php if (!empty($data['image'])): ?>
                                                <div class="mt-2">
                                                      <small>Current Image:</small><br>
                                                      <img src="/<?php echo htmlspecialchars($data['image']); ?>" alt="Current Product Image" class="img-thumbnail" style="max-width: 100px;">
                                                </div>
                                          <?php endif; ?>
                                          <small class="form-text text-muted">
                                                Allowed formats: jpeg, png, webp, jpg.<br>
                                                Maximum size: 2MB.
                                          </small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                          <button type="submit" name="submit" class="btn btn-success">Update</button>
                                    </div>
                              </div>
                        </form>
                  <?php endif; ?>
            </div>

      </div>
</div>