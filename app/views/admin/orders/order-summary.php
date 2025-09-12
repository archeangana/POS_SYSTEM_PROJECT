<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Order Summary</h4>
                    <a href="?page=order&action=create" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to Create Order
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div id="myBillingArea">
                        <?php if (!empty($data) && !empty($invoice_no)) : ?>
                            
                            <!-- Company Info -->
                            <div class="text-center mb-4">
                                <h4 class="fw-bold mb-1"><?= $companyDetails['company_name'] ?? 'Company Name Here' ?></h4>
                                <p class="mb-0"><?= $companyDetails['company_address'] ?? 'Company Address Here'?></p>
                            </div>

                            <!-- Customer & Invoice Details -->
                            <div class="row g-4 mb-4">
                                <!-- Customer Details -->
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-light h-100">
                                        <h5 class="fw-bold mb-3">
                                            <i class="bi bi-person-fill me-2"></i>Customer Details
                                        </h5>
                                        <p class="mb-1"><strong>Name:</strong> <?= htmlspecialchars($data['name']); ?></p>
                                        <p class="mb-1"><strong>Phone:</strong> <?= htmlspecialchars($data['phone']); ?></p>
                                        <p class="mb-0"><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></p>
                                    </div>
                                </div>

                                <!-- Invoice Details -->
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-light h-100">
                                        <h5 class="fw-bold mb-3">
                                            <i class="bi bi-receipt me-2"></i>Invoice Details
                                        </h5>
                                        <p class="mb-1"><strong>Invoice No.:</strong> <?= htmlspecialchars($invoice_no); ?></p>
                                        <p class="mb-1"><strong>Date:</strong> <?= date('F j, Y'); ?></p>
                                        <p class="mb-0"><strong>Address:</strong> (Customer Address Here)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          $grandTotal = 0; 
                                          $totalQty = 0; 
                                          foreach ($orders as $index => $order): 
                                                $total = $order['price'] * $order['quantity']; 
                                                $grandTotal += $total;
                                                $totalQty += $order['quantity'];
                                          ?>
                                          <tr>
                                                <td class="text-center"><?= $index + 1; ?></td>
                                                <td><?= htmlspecialchars($order['name']); ?></td>
                                                <td class="text-end">₱<?= number_format($order['price'], 2); ?></td>
                                                <td class="text-center"><?= $order['quantity']; ?></td>
                                                <td class="text-end fw-bold">₱<?= number_format($total, 2); ?></td>
                                          </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light fw-bold">
                                            <td colspan="3" class="text-end">Total Quantity:</td>
                                            <td class="text-center"><?= $totalQty; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr class="table-success fw-bold">
                                            <td colspan="4" class="text-end">Grand Total:</td>
                                            <td class="text-end">₱<?= number_format($grandTotal, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" align="right">
                                                <button type="button" id="create-order-btn" class="btn btn-primary">Create Order</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        <?php else: ?>
                            <div class="alert alert-warning text-center">
                                No order data available.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
