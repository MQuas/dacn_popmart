<style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .main {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            flex-shrink: 0;
        }
        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .hidden-menu {
  visibility: hidden;
}

    </style>
<body>
<div class="wrapper">
<div class="container-fluid nav-home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a href="<?=_WEB_ROOT_?>/"><img class="navbar-brand" src="<?=_WEB_ROOT_?>/app/assets/img/banner&logo/logo.png" alt="Logo" width="50" height="50"></a>    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav hidden-menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">New & Featured</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/series">Series</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Mega</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Accessories</a>
                    </li>
                </ul>

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