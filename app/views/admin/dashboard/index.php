<?php // include '../layouts/header.php'; ?>
 
      <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Dashboard</li>
                  <!-- <form action="index.php" method="POST" enctype="multipart/form-data">
                        <input hidden name="page" value="admin">
                        <input type="file" name="image">
                        <input type="submit" value="submit">
                  </form> -->
                  <?php 
                        // var_dump($_FILES['image'] ?? '');

                        // if(!empty($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                        //       $file = $_FILES['image'];

                        //       if($file['error'] !== UPLOAD_ERR_OK) {
                        //             echo $error = 'Failed to upload';
                        //       } else {
                        //             // echo $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE;
                        //             $filename = basename($file['name'] ?? '');
                        //             $fileExtention = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        //             $fileTmp = $file['tmp_name'];
                        //             echo $fileExtention . '<br>';
                        //             echo mime_content_type($fileTmp);
                        //       }
                        // }
                  
                  ?>
            </ol>
            <div class="row">
                  <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                              <div class="card-body">Primary Card</div>
                              <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                              </div>
                        </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                              <div class="card-body">Warning Card</div>
                              <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

<?php // include '../layouts/footer.php'; ?>
