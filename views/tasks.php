<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>

<body>
<nav>
<?php include 'nav.php'; ?>
</nav>
<div class="container glassMorphism vh-90" id="task_bg_position">

    <h1 class="">Dashboard</h1>
    <p>Welcome back, <?= htmlspecialchars($_SESSION['username']) ?>!👋</p>

    <form action="../public/index.php?action=createtask" method="POST" class="mb-3">
        <div class="input-group glassMorphism">
            <input type="text" name="title" class="form-control glassMorphism" placeholder="Add a new task"
                   maxlength="50" required>
            <button type="submit" class="btn"><i class="bi bi-plus-lg"></i></button>
        </div>
    </form>
    <?php if (!empty($_SESSION['tasks'])): ?>
        <?php foreach ($_SESSION['tasks'] as $task): ?>
            <div class="card mb-2 glassMorphism">
                <div class="card-body d-inline-flex justify-content-between">
                    <div>
                        <?= htmlspecialchars($task['title']) ?>
                    </div>
                    <div class="d-inline-flex align-items-center">
                        <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                           data-bs-target="#staticBackdrop"><i class="bi bi-card-text"></i></a>
                        <a href="../public/tasks?action=delete&id=<?= $task['id'] ?>"
                           class="btn btn-danger btn-sm ms-3"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../public/index.php?action=updatetask&id=<?= $task['id'] ?>" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <input type="text" name="title" class="form-control"
                                       placeholder="<?= htmlspecialchars($task['title']) ?>" required>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tasks found. Add a new one!</p>
    <?php endif; ?>
</div>


<script src="../public/assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>
