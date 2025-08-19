<div class="container my-5">
    <div class="invoice border rounded p-4 bg-white" id="myBillingArea">

        <!-- Company Header -->
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="fw-bold mb-1">Company Ltd.</h2>
                <p class="mb-0">Pungsod Lawaan III, Talisay City, Cebu</p>
                <small class="text-muted">Email: info@company.com | Phone: (032) 123-4567</small>
                <hr class="mt-3">
            </div>
        </div>

        <?php if (!empty($data) && !empty($orders)) : ?>
        
        <!-- Invoice Info -->
        <div class="row mb-4">
            <div class="col-sm-6">
                <h5 class="fw-bold">Bill To:</h5>
                <p class="mb-1"><strong>Name:</strong> <?= htmlspecialchars($data['customer_name']); ?></p>
                <p class="mb-1"><strong>Phone:</strong> <?= htmlspecialchars($data['customer_phone']); ?></p>
                <p class="mb-0"><strong>Email:</strong> <?= htmlspecialchars($data['customer_email']); ?></p>
            </div>
            <div class="col-sm-6 text-sm-end">
                <h5 class="fw-bold">Invoice Details:</h5>
                <p class="mb-1"><strong>Invoice No.:</strong> <?= htmlspecialchars($data['invoice_no']); ?></p>
                <p class="mb-1"><strong>Date:</strong> <?= date('F j, Y'); ?></p>
                <p class="mb-0"><strong>Address:</strong> (Customer Address Here)</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $grandTotal = 0; 
                        $totalQty = 0; 
                        foreach ($orders as $index => $order): 
                            $total = $order['product_price'] * $order['quantity']; 
                            $grandTotal += $total;
                            $totalQty += $order['quantity'];
                    ?>
                    <tr>
                        <td class="text-center"><?= $index + 1; ?></td>
                        <td><?= htmlspecialchars($order['product_name']); ?></td>
                        <td class="text-end">₱<?= number_format($order['product_price'], 2); ?></td>
                        <td class="text-center"><?= $order['quantity']; ?></td>
                        <td class="text-end">₱<?= number_format($total, 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-center fw-bold">Total Qty</td>
                        <td class="text-end fw-bold"><?= $totalQty; ?></td>
                    </tr>
                    <tr class="table-success">
                        <td colspan="4" class="text-end fw-bold">Grand Total</td>
                        <td class="text-end fw-bold">₱<?= number_format($grandTotal, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer Note -->
        <div class="row">
            <div class="col text-center">
                <p class="small text-muted mb-0">Thank you for your business!</p>
            </div>
        </div>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                No order data available.
            </div>
        <?php endif; ?>
    </div>

    <!-- Print Button (not included in print area) -->
    <div class="text-end mt-3">
        <button type="button" class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
    </div>
</div>
 
<script>
      function printInvoice() {
            var printContents = document.getElementById('myBillingArea').innerHTML;
            var originalContents = document.body.innerHTML;

            // Replace the body with invoice content only
            document.body.innerHTML = printContents;

            // Trigger browser print dialog
            window.print();

            // Restore original page content after printing
            document.body.innerHTML = originalContents;

            // Reload page to reattach events (like JS click handlers)
            location.reload();
      }
</script>
