<div class="container-fluid px-4 mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">Order Information</h4>
            <a href="?page=order&action=orders" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
        </div>
        <div class="card-body">

            <div class="row g-4">
                <!-- Order Details -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="bi bi-receipt"></i> Order Details</h5>
                            <p class="mb-1"><span class="text-muted">Tracking No:</span> 
                                <span class="fw-semibold"><?= $order['tracking_no'] ?></span>
                            </p>
                            <p class="mb-1"><span class="text-muted">Order Date:</span> 
                                <span class="fw-semibold"><?= date('M d, Y' ,strtotime($order['created_at'])) ?></span>
                            </p>
                            <p class="mb-1"><span class="text-muted">Order Status:</span> 
                                <span class="badge bg-<?= $order['order_status'] === 'completed' ? 'success' : 'warning' ?>">
                                    <?= ucfirst($order['order_status']) ?>
                                </span>
                            </p>
                            <p class="mb-0"><span class="text-muted">Payment Method:</span> 
                                <span class="fw-semibold"><?= ucwords(str_replace('_', ' ', $order['payment_method'])) ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Customer Details -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="bi bi-person-circle"></i> Customer Details</h5>
                            <p class="mb-1"><span class="text-muted">Full Name:</span> 
                                <span class="fw-semibold"><?= $order['customer_name'] ?></span>
                            </p>
                            <p class="mb-1"><span class="text-muted">Email:</span> 
                                <span class="fw-semibold"><?= $order['customer_email'] ?></span>
                            </p>
                            <p class="mb-0"><span class="text-muted">Phone:</span> 
                                <span class="fw-semibold"><?= $order['customer_phone'] ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <?php if(!empty($orderItems)) : ?>
                <div class="table-responsive mt-4">
                    <table class="table table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Product</th>
                                <th>Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orderItems as $item): ?>
                                <tr>
                                    <td class="text-start">
                                        <img src="<?= $item['image'] ?>" 
                                             alt="<?= $item['product_name'] ?>" 
                                             class="img-thumbnail me-2" style="width: 50px; height: 50px;">
                                        <?= $item['product_name'] ?>
                                    </td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td class="text-end"><?= '₱' . number_format($item['product_price'], 2) ?></td>
                                    <td class="text-end"><?= '₱' . number_format($item['subtotal'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end fw-bold">Total Amount:</td>
                                <td class="text-end fw-bold text-primary fs-5">
                                    <?= '₱' .number_format($order['total_amount'], 2) ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-4">
                    <i class="bi bi-exclamation-triangle"></i> No order items found for this order.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
