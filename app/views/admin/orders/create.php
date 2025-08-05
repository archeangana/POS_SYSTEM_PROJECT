<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <div class="card shadow-sm">
            <div class="card-header">
                  <h4 class="mb-0">
                        Create Order
                        <a href="?page=customer&action=show" class="btn btn-primary float-end">Back</a>
                  </h4>
            </div>
            <div class="card-body">
                  <form action="index.php" method="POST">
                        <input type="hidden" name="page" value="order">
                        <input type="hidden" name="action" value="add">
                        <div class="row">
                              <div class="col-md-3 mb-3">
                                    <label for="product" class="mb-2">Select Product <span class="text-danger">*</span></label>   
                                    <select name="product_id" id="" class="form-select productSearchSelet">
                                          <option value="">--Select Product--</option>
                                          <?php if(!empty($products)) :?>
                                                <?php foreach($products as $product) :?>
                                                      <option value="<?php echo $product['id']?>"><?php echo htmlspecialchars($product['name']);?></option>
                                                <?php endforeach; ?>
                                          <?php endif;?>
                                    </select>
                              </div>
                              <div class="col-md-2 mb-3">
                                    <label for="quantity" class="mb-2">Quantity <span class="text-danger">*</span></label>   
                                    <input id="quantity" type="number" name="quantity" required class="form-control" value="1">
                              </div>
                              <div class="col-md-3 mb-3 align-self-end" >
                                   <button type="submit" name="submit" class="btn btn-primary">Save Order</button>
                              </div>
                        </div>
                  </form>
            </div>    
      </div>
      
      <div class="card mt-4 shadow-sm">
            <div class="card-header">
                  <h5>Orders</h5>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                              <thead>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                              </thead>
                              <tbody>
                                    <?php if(!empty($_SESSION['productOrders'])) :?>
                                          <?php $orders = $_SESSION['productOrders']?>
                                          <?php foreach($orders as $key => $order) :?>
                                                <tr>
                                                      <td><?= $key + 1?></td>
                                                      <td><?= $order['name']?></td>
                                                      <td><?= $order['price']?></td>
                                                      <td>
                                                            <div class="input-group">
                                                                  <button class="input-group-text">-</button>
                                                                  <input type="text" value="<?= $order['quantity']?>" class="qty quantityInput" style="width: 50px !important;padding: 6px 3px;text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                  <button class="input-group-text">+</button>
                                                            </div>
                                                      </td>
                                                      <td><?= number_format($order['price'] * $order['quantity'], 0)?></td>
                                                      <td>
                                                            <a href="" class="btn btn-danger">Remove</a href="">
                                                      </td>
                                                </tr>
                                          <?php endforeach;?>
                                          <?php else:?>
                                                <tr>
                                                      <td colspan="6">No Orders Added Yet</td>
                                                </tr>
                                    <?php endif;?>
                              </tbody>
                        </table>
                  </div>
            </div>
           
      </div>
</div>