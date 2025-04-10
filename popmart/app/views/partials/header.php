<body>
<div class="container-fluid nav-home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a href="<?=_WEB_ROOT_?>/"><img class="navbar-brand" src="<?=_WEB_ROOT_?>/app/assets/img/banner&logo/logo.png" alt="Logo" width="50" height="50"></a>    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/series">Series</a>
                    </li>
                </ul>
                <div class="action-user">
                    <ul class="navbar-nav ml-auto">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                            <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/profile/<?= $_SESSION['user']['id'] ?>">
                                    Xin chào, <b><?= $_SESSION['user']['name']; ?></b>!
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-danger" href="<?= _WEB_ROOT_ ?>/logout">
                                    Đăng xuất
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/verify">My Account</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/cart">
                                <i class="fa fa-cart-shopping" style="color: #000000;"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Ô tìm kiếm -->
                <div class="InputContainer">
                    <input placeholder="Search" id="input" class="input" name="text" type="text" />
                    <label class="labelforsearch" for="input">
                        <svg class="searchIcon" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </div>
    </nav>
</div>
