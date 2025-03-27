<div class="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active text-danger" href="<?= _WEB_ROOT_?>/admin">DASHBOARD</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-danger" href="<?= _WEB_ROOT_?>/admin/product">PRODUCTS</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-danger" href="<?= _WEB_ROOT_?>/admin/category">CATEGORIES</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-danger" href="<?= _WEB_ROOT_?>/admin/order">ORDERS</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active text-danger" href="<?= _WEB_ROOT_?>/admin/user">USERS</a>
    </li>
  </ul>
<!--admin-->
  <ul class="nav flex-column mt-auto">
    <?php if (isset($_SESSION['user'])): ?>
      <li class="nav-item">
        <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/profile">
          HELLO, <b><?= $_SESSION['user']['name']; ?></b>!
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-danger" href="<?= _WEB_ROOT_ ?>/logout">
          LOG OUT
        </a>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link active" href="<?= _WEB_ROOT_ ?>/verify">My Account</a>
      </li>
    <?php endif; ?>
  </ul>
</div>

<style>
  .sidebar{
      background-color: #f8f9fa !important;
      display: flex;
      flex-direction: column;
      height: 100%;
  }
  .sidebar a{
    color: rgb(217, 19, 19);
  }
  .sidebar a:hover{
      background-color: rgb(217, 19, 19);
      color: white !important;
  }
  .sidebar ul.mt-auto {
      margin-top: auto;
  }
</style>
