
<div class="container-fluid px-4 mt-5">
    <?php include dirname(__DIR__, 3) . '/components/notifications/flash.php'; ?>
    
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0 d-flex justify-content-between align-items-center">
                Admins/Staff
                <a href="?page=admin&action=create" class="btn btn-primary">Add Admin</a>
            </h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Is Ban</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($admins)) : ?>
                            <?php foreach ($admins as $admin) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($admin['id']); ?></td>
                                    <td><?php echo htmlspecialchars($admin['name']); ?></td>
                                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                    <td><?php echo htmlspecialchars($admin['phone']); ?></td>
                                    <td>
                                          <span class="badge <?php echo $admin['is_ban'] == 1 ? 'bg-danger' : 'bg-primary'?>">
                                                <?php echo $admin['is_ban'] == 1 ? 'Banned' : 'Active'?>
                                          </span> 
                                    </td>
                                    <td>
                                        <a href="?page=admin&action=delete&id=<?php echo $admin['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="?page=admin&action=edit&id=<?php echo $admin['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
