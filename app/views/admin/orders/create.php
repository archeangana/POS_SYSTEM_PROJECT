<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
      <!-- Modal -->
      <div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title">Add Customer</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                              <form id="addCustomerForm" method="POST" action="?page=customer&action=add">
                                    <input type="hidden" name="status" value="active">
                                    <label for="" class="mb-2">Customer Name</label>
                                    <input type="text" name="name" class="form-control mb-3" placeholder="e.g. John Smith" />

                                    <label for="" class="mb-2">Email</label>
                                    <input type="email" name="email" class="form-control mb-3" placeholder="e.g. example@gmail.com" />

                                    <label for="" class="mb-2">Phone</label>
                                    <input type="text" name="phone" class="form-control mb-3" placeholder="e.g. 09123456789" />

                                    <div class="text-end mt-3">
                                          <button type="submit" class="btn btn-primary w-25">Save</button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
      <!-- Modal Close -->
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
            <div class="card-body" id="productWrapper">
                  <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="productContent">
                              <thead>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                              </thead>
                              <tbody>
                                    <?php if(empty($_SESSION['productOrders'])) {
                                          unset($_SESSION['productOrders']);
                                          unset($_SESSION['productOrderIds']);
                                    } ?>
                                    <?php if(!empty($_SESSION['productOrders'])) :?>
                                          <?php $orders = $_SESSION['productOrders']?>
                                          <?php foreach($orders as $key => $order) :?>
                                                <div class="alert danger errorMessage" hidden='true'></div>
                                                <tr>
                                                      <td><?= $key + 1?></td>
                                                      <td><?= $order['name']?></td>
                                                      <td><?= $order['price']?></td>
                                                      <td>
                                                            <div class="input-group qty-wrapper">
                                                                  <input type="hidden" value="<?= $order['product_id']?>" class="productId">
                                                                  <button id="" class="input-group-text decrement">-</button>
                                                                  <input type="text" value="<?= $order['quantity']?>" class="qty quantityInput" style="width: 50px !important;padding: 6px 3px;text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                  <button id="" class="input-group-text increment">+</button>
                                                            </div>
                                                      </td>
                                                      <td>
                                                            <span class="itemTotal" data-product-id="<?= $order['product_id'] ?>">
                                                                  <?= number_format($order['price'] * $order['quantity'], 0); ?>
                                                            </span>
                                                      </td>
                                                      <td>
                                                            <a href="?page=order&action=delete&index=<?= $key ?>" class="btn btn-danger">Remove</a href="">
                                                      </td>
                                                </tr>
                                          <?php endforeach;?>
                                          <?php else:?>
                                                <tr>
                                                      <td colspan="6" class="text-center">No Orders Added Yet</td>
                                                </tr>
                                    <?php endif;?>
                              </tbody>
                        </table>
                  </div>
                  <!-- Payment Section -->
                   <hr/>
                  <div class="row mt-4">
                        <!-- <div class="errors alert alert-danger alert-dismissible fade show" style="font-size: 15px;" role="alert" hidden></div> -->
                        <div class="col-md-2">
                              <label for="" class="mb-2">Select Payment Method</label>
                              <select name="" class="form-select" id="payment_mode" required>
                                    <option value="">-- Select Payment --</option>
                                    <option value="cash">Cash Payment</option>
                                    <option value="online">Online Payment</option>
                              </select>
                        </div>
                        <div class="col-md-2">
                              <label for="" class="mb-2"> Customer Phone</label>
                              <input id="customer_phone" type="text" class="form-control" required placeholder="e.g. 09123456789">
                        </div>
                        <div class="col-md-4 align-self-end">
                              <button class="btn btn-warning" id="placeOrderBtn">Proceed to place order</button>
                        </div>
                  </div>
            </div>
      </div>
</div>