<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body class="align-content-center justify-content-center">
<nav class="mb-5">
    <?php include 'nav.php'; ?>
</nav>
<div class="container-xxl justify-content-center">
<div class="glassMorphism p-5">
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <h1>Admin Panel</h1>
            <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!👋</p>
        </div>
    </div>

    <div class="row justify-content-evenly">
        <div class="col-xxl-4 col-lg-5 col-md-6 col-12 mb-4">
            <h2>Users</h2>
            <table class="table table-striped text-start">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                               data-bs-target="#editUserModal<?= $user['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                            <a href="../public/admin?action=deleteUser&id=<?= $user['id'] ?>"
                               class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                        class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1"
                         aria-labelledby="editUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../public/index.php?action=updateUser&id=<?= $user['id'] ?>"
                                      method="POST">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <input type="text" name="username" class="form-control mb-2"
                                               value="<?= htmlspecialchars($user['username']) ?>">
                                        <select name="role" class="form-control mb-2">
                                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User
                                            </option>
                                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>
                                                Admin
                                            </option>
                                        </select>
                                        <input type="password" name="password" class="form-control mb-2"
                                               placeholder="New Password (leave blank to keep current)">
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-xxl-8 col-lg-5 col-md-6 col-12 mb-4">
            <h2>Tasks</h2>
            <table class="table table-striped text-start">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['id']) ?></td>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td><?= htmlspecialchars($task['created_at']) ?></td>
                        <td><?= htmlspecialchars($task['username']) ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                               data-bs-target="#editTaskModal<?= $task['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                            <a href="../public/tasks?action=delete&id=<?= $task['id'] ?>&redirect=../public/admin"
                               class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i
                                        class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editTaskModal<?= $task['id'] ?>" tabindex="-1"
                         aria-labelledby="editTaskModalLabel<?= $task['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="../public/index.php?action=updatetask&id=<?= $task['id'] ?>&redirect=../public/admin"
                                      method="POST">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title">Edit Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                        <input type="text" name="title" class="form-control"
                                               value="<?= htmlspecialchars($task['title']) ?>" required>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
