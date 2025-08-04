
<div class="container-fluid px-4 mt-5">
    <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
    
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0 d-flex justify-content-between align-items-center">
                  Products
                  <a href="?page=product&action=create" class="btn btn-primary">Add Product</a>
                  </h4>
            </div>
                  <div class="card-body">
                              <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle">
                                          <thead class="table-light">
                                                <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php if(!empty($data)) : ?>
                                                      <?php foreach ($data as $item) : ?>
                                                            <tr>
                                                                  <td><?php echo $item['id']; ?></td>
                                                                  <td>
                                                                        <img src="/<?php echo htmlspecialchars($item['image'])?>" alt="<?php echo 'Image of product' . $item['name']?>" style="width:50px; height: 50px; aspect-ratio: 1/1">
                                                                  </td>
                                                                  <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                                  <td>
                                                                        <span class="badge <?php echo $item['status'] == 1 ? 'bg-primary' : 'bg-danger' ?>">
                                                                        <?php echo $item['status'] == 1 ? 'Active' : 'Inactive' ?>
                                                                        </span>
                                                                  </td>
                                                                  <td>
                                                                        <a href="?page=product&action=delete&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                                        <a href="?page=product&action=edit&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                                  </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                      <?php else: ?>
                                                            <tr>
                                                                  <td colspan='5' class="text-center">No Products data found.</td>
                                                            </tr>
                                                <?php endif; ?>
                                          </tbody>
                                    </table>
                              </div>
                  </div>
      </div>
</div>
