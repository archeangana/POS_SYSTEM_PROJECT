
<div class="container-fluid px-4 mt-5">
      <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
    
      <div class="card">
            <div class="card-header">
                  <h4 class="mb-0 d-flex justify-content-between align-items-center">
                  Orders
                  </h4>
            </div>
            <?php if(!empty($orders)) :?>
                  <div class="card-body">
                        <div class="table-responsive">
                              <table class="table table-striped table-bordered align-middle">
                                    <thead class="table-light">
                                          <tr>
                                                <th>Tracking No.</th>
                                                <th>Customer Name</th>
                                                <th>Customer Phone</th>
                                                <th>Order Date</th>
                                                <th>Order Status</th>
                                                <th>Payment Method</th>
                                                <th>Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php foreach($orders as $orderItem) :?>
                                                <tr>
                                                      <td><?= $orderItem['tracking_no']?></td>
                                                      <td><?= $orderItem['customer_name']?></td>
                                                      <td><?= $orderItem['customer_phone']?></td>
                                                      <td><?php  
                                                            $date = new DateTime($orderItem['created_at']);
                                                            echo $date->format("M. d, Y");?>
                                                      </td>
                                                      <td>
                                                            <?php
                                                                  switch($orderItem['order_status']) {
                                                                        case 'pending':
                                                                              echo '<span class="badge bg-warning">Pending</span>';
                                                                              break;
                                                                        case 'completed':
                                                                              echo '<span class="badge bg-success">Completed</span>';
                                                                              break;
                                                                        case 'cancelled':
                                                                              echo '<span class="badge bg-danger">Cancelled</span>';
                                                                              break;
                                                                        case 'processing':
                                                                              echo '<span class="badge bg-info">Processing</span>';
                                                                              break;
                                                                        case 'refunded':
                                                                              echo '<span class="badge bg-secondary">Refunded</span>';
                                                                              break;
                                                                        default:
                                                                              echo '<span class="badge bg-secondary">Unknown</span>';
                                                                  }
                                                            ?>
                                                      </td>
                                                      <td><?= ucwords(str_replace('_', ' ', $orderItem['payment_method']))?></td>
                                                      <td>
                                                            <a href="?page=order&action=view&track=<?= $orderItem['tracking_no']?>" class="btn btn-info btn-sm mb-0 px-2">View</a>
                                                            <a href="?page=order&action=print&track=<?= $orderItem['tracking_no']?>" class="btn btn-primary btn-sm mb-0 px-2">Print</a>
                                                            <a href="" class="btn btn-danger btn-sm mb-0 px-2">Download PDF</a>
                                                      </td>
                                                </tr>
                                          <?php endforeach;?>
                                    </tbody>  
                              </table>
                        </div>
                  </div>
            <?php else :?>
                  <div class="card-body">
                        <div class="alert alert-info text-center">
                              No orders found.
                        </div>
                  </div>
            <?php endif; ?>
      </div>
</div>
