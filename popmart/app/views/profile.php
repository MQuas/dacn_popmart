<style>
    .container-box {
        margin: 50px 100px 100px 100px;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
    }

    .sidebar {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
    }

    .sidebar a {
        text-decoration: none;
        color: black;
    }

    .sidebar .active {
        color: red;
        font-weight: bold;
    }

    .order-section {
        padding: 20px;
        width: 100%;
    }

    .order-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .order-status {
        font-weight: bold;
    }

    .table-secondary th {
        background-color: rgb(217, 19, 19) !important;
        color: white;
    }
</style>

<div class="container-box">
    <div class="main-container d-flex">
        <div class="sidebar" style="width: 500px;">
            <div class="text-center mb-3">
                <img src="#" class="rounded-circle" alt="Profile">
                <h6 class="mt-2">minhqua30032005</h6>
                <a href="#">Edit Profile</a> | <a href="#">ACCOUNT SETTINGS</a>
                <p class="mt-2"><span class="badge bg-warning text-dark">+ points</span></p>
            </div>
            <h6 class="fw-bold text-center">POPMART MEMBER</h6>
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="mb-0">50</h5>
                    <small>POINTS</small>
                </div>
                <div>
                    <h5 class="mb-0">0</h5>
                    <small>COUPONS</small>
                </div>
            </div>
            <div class="mt-3 p-2 bg-light text-center rounded">Rewards</div>
            <hr>
            <a href="#" class="d-block py-2 active">📦 My Orders <br><small>Manage your order</small></a>
            <a href="#" class="d-block py-2">📍 Address Book <br><small>Manage your order address</small></a>
            <a href="#" class="d-block py-2">🎁 Earned Rewards <br><small>Manage your earned rewards</small></a>
        </div>

        <!-- Order Section -->
        <div class="order-section">
            <h4 class="fw-bold">My Orders</h4>
            <?php foreach ($orders as $order): ?>
                <div class="order-card d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Order Code: <?= $order['code_order'] ?></h6>
                        <h6 class="mb-1">Address: <?= $order['address'] ?></h6>
                        <h6 class="mb-1"><?= date('d-m-Y', strtotime($order['by_date'])); ?></h6>
                        <p class="order-status <?= $order['status'] === 'Canceled' ? 'text-danger' : 'text-success' ?>">
                        <?= $order['status'] ?>
                        </p>

                        <h6 class="text-danger"><?= number_format($order['total_price']); ?> VNĐ</h6>
                    </div>
                    <div class="text-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#orderDetailModal" onclick="showOrderDetails(<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>)">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- modal ctdh -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="orderDetailLabel" style="color: rgb(217, 19, 19) !important;">ORDER DETAILS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Order Code:</strong> <span id="modalOrderCode"></span></p>
                <p><strong>Address:</strong> <span id="modalAddress"></span></p>
                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Total Price:</strong> <span id="modalTotalPrice"></span> VNĐ</p>
                <!-- spct-->
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th>Image</th>
                            <th>Product ID</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="modalOrderItems"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function showOrderDetails(order) {
        document.getElementById('modalOrderCode').innerText = order.code_order;
        document.getElementById('modalAddress').innerText = order.address;
        document.getElementById('modalDate').innerText = new Date(order.by_date).toLocaleDateString('vi-VN');
        document.getElementById('modalStatus').innerText = order.status;
        document.getElementById('modalTotalPrice').innerText = new Intl.NumberFormat('vi-VN').format(order.total_price);

        let itemsHtml = '';
        order.details.forEach(detail => {
            itemsHtml += `
            <tr>
                <td><img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/${detail.url_img}" width="50" alt="Product Image"></td>
                <td>${detail.pro_id}</td>
                <td>${detail.variant_name}</td>
                <td>${detail.quantity}</td>
                <td>${new Intl.NumberFormat('vi-VN').format(detail.price)} VNĐ</td>
            </tr>
        `;
        });

        document.getElementById('modalOrderItems').innerHTML = itemsHtml;
    }
</script>