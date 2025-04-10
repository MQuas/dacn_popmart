<style>
    .table-dark th {
        background-color: rgb(217, 19, 19) !important;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .table thead th {
        background-color: rgb(217, 19, 19);
        color: #fff;
        text-align: left;
        padding: 12px;
        border: 1px solid #ddd;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table tbody td {
        padding: 12px;
        border: 1px solid #ddd;
        vertical-align: middle;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .table thead th:nth-child(1),
  .table tbody td:nth-child(1) {
    width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
    .table thead th:nth-child(2),
  .table tbody td:nth-child(2) {
    width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
    .table thead th:nth-child(3),
  .table tbody td:nth-child(3) {
    width: 130px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
    .table thead th:nth-child(4),
  .table tbody td:nth-child(4) {
    width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
    .table thead th:nth-child(5),
  .table tbody td:nth-child(5) {
    width: 420px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .table thead th:nth-child(6),
  .table tbody td:nth-child(6) {
    width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table img {
        border-radius: 4px;
        transition: transform 0.2s;
    }

    .table img:hover {
        transform: scale(1.1);
    }

    .variant-row td {
        background-color: #f9f9f9;
        padding-left: 40px;
        font-size: 0.9em;
        color: #555;
        border: 1px solid #ddd;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9em;
    }

    .btn-warning {
        background-color: #f0ad4e;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #ec971f;
    }

    .btn-danger {
        background-color: #d9534f;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c9302c;
    }

    .btn-primary {
        background-color: #0275d8;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #025aa5;
    }

    .container .btn-primary.mb-2 {
        margin-top: 20px;
    }
</style>
<div class="container mt-4">
    <h1 style="color: rgb(217, 19, 19);" class="h3 mb-0 text-gray-800">ORDERS</h1>
    <p class="text-muted">Welcome to the Admin Panel. Here, you can track and manage your website's order data.</p>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>USER ID</th>
                <th>CODE ORDER</th>
                <th>TOTAL PRICE</th>
                <th>ADDRESS</th>
                <th>BY DATE</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $statusOptions = ['Pending', 'Processing', 'Shipped', 'Completed', 'Canceled'];
            foreach ($orders as $order):
                $currentStatus = $order['status'] ?? 'Pending';
            ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['user_id'] ?></td>
                    <td><?= $order['code_order'] ?></td>
                    <td><?= number_format($order['total_price']); ?> VNĐ</td>
                    <td><?= $order['address']; ?></td>
                    <td><?= date('d-m-Y', strtotime($order['by_date'])); ?></td>
                    <td>
                        <form action="<?= _WEB_ROOT_ ?>/admin/order/update/status" method="POST">
                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                            <select name="status" class="form-select"
                                onchange="this.form.submit();"
                                <?= ($currentStatus == 'Completed' || $currentStatus == 'Canceled')
                                    ? 'disabled style="' . ($currentStatus == 'Completed' 
                                        ? 'background-color: #d4edda;' 
                                        : 'background-color: #f8d7da; color: #721c24;') . '"' 
                                    : '' ?>>
                                <?php foreach ($statusOptions as $status): ?>
                                    <option value="<?= $status ?>" <?= ($status == $currentStatus) ? 'selected' : '' ?>>
                                        <?= $status ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </td>
                </tr>
                <!-- duyet detail order -->
                <?php 
                if (!empty($order['details'])):
                    foreach ($order['details'] as $detail):
                ?>
                    <tr class="variant-row">
                        <td colspan="1">
                        --><img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $detail['url_img'] ?>" alt="Product Image" width="50">
                        </td>
                        <td colspan="2">
                            <strong>Product ID:</strong> <?= $detail['pro_id'] ?>
                        </td>
                        <td colspan="2">
                            <strong>Variant:</strong> <?= $detail['variant_name'] ?> |
                            <strong>Quantity:</strong> <?= $detail['quantity'] ?> |
                            <strong>Price:</strong> <?= number_format($detail['price']); ?> VNĐ
                        </td>
                    </tr>
                <?php 
                    endforeach;
                endif;
                ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




