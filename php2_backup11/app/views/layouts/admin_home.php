  <link rel="stylesheet" href="<?= _WEB_ROOT_?>/app/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= _WEB_ROOT_?>/app/assets/css/style.css">
  <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/font-awesome/css/all.min.css">
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
      color: #fff;
      padding: 20px;
      flex-shrink: 0;
    }
    .content {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      background: #f8f9fa;
    }
    .footer {
      background: #343a40;
      color: #fff;
      text-align: center;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <?php $this->render('partials/ad_header'); ?>

    <div class="main">
      <?php $this->render('partials/ad_sidebar'); ?>

      <div class="content">
        <?php $this->render($content, $sub_content); ?>
      </div>
    </div>

    <?php $this->render('partials/ad_footer'); ?>
  </div>
  <script src="<?= _WEB_ROOT_ ?>/app/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= _WEB_ROOT_ ?>/app/assets/js/script.js"></script>
</body>
</html>
