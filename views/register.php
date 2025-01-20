<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body class="container d-flex justify-content-center align-items-center vh-100" data-bs-theme="dark">
<div class="card p-5 text-center glassMorphism" style="width: fit-content; height: fit-content">
    <h1 class="card-title text-center">Register</h1>
    <form action="../public/index.php?action=register" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control glassMorphism" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control glassMorphism" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p class="mt-3 mb-0">Already have an account?</p>
    <a href="../public/login" class="text-decoration-none">Login here</a>
</div>
</body>
</html>
