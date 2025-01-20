<nav class="navbar bg-body-tertiary fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PEBA ToDo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="offcanvasNavbarLabel"><?= htmlspecialchars($_SESSION['username']) ?>
                    👋</h2>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../public/tasks">Home</a>
                    </li>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item" id="adminMenu">
                            <a class="nav-link" href="../public/admin">Adminpanel</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <form action="../public/index.php?action=logout" method="POST" class="text-center">
                <button type="submit" class="btn btn-danger m-5 w-75">Logout</button>
            </form>
        </div>
    </div>
</nav>
