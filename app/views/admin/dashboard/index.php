<div class="container-fluid px-4">
  <div class="row mb-4">
    <div class="col-md-12">
      <h1 class="mt-4 fw-bold text-primary">Dashboard</h1>
      <p class="text-muted">Overview of your system analytics</p>
    </div>
  </div>

  <div class="row g-4">
    <!-- Total Products -->
    <div class="col-md-3 col-sm-6">
      <div class="card shadow-sm border-0 rounded-3 h-100 bg-warning">
        <div class="card-body d-flex flex-column align-items-start">
          <p class="text-uppercase fw-semibold text-white small mb-2">Total Products</p>
          <h4 class="fw-bold text-white"><?= $data['totalProducts']; ?></h4>
        </div>
      </div>
    </div>

    <!-- Total Customers -->
    <div class="col-md-3 col-sm-6">
      <div class="card shadow-sm border-0 rounded-3 h-100 bg-info">
        <div class="card-body d-flex flex-column align-items-start">
          <p class="text-uppercase fw-semibold text-white small mb-2">Total Customers</p>
          <h4 class="fw-bold text-white"><?= $data['totalCustomers']; ?></h4>
        </div>
      </div>
    </div>

    <!-- Total Orders -->
    <div class="col-md-3 col-sm-6">
      <div class="card shadow-sm border-0 rounded-3 h-100 bg-success">
        <div class="card-body d-flex flex-column align-items-start  ">
          <p class="text-uppercase fw-semibold small mb-2 text-white">Total Orders</p>
          <h4 class="fw-bold text-white"><?= $data['totalOrders']; ?></h4>
        </div>
      </div>
    </div>

  </div>

  <!-- Sales Chart -->
  <!-- <div class="row mt-5">
    <div class="col-md-12">
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Sales Overview</h5>
          <canvas id="salesChart" height="100"></canvas>
        </div>
      </div>
    </div>
  </div> -->
  
<!-- End -->
</div>
<!-- 
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Sales',
        data: [1200, 1900, 3000, 2500, 3200, 4100, 3800],
        borderColor: '#0d6efd',
        backgroundColor: 'rgba(13, 110, 253, 0.2)',
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#0d6efd',
        pointBorderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script> -->
