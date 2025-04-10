<div class="container py-5 mx-auto">
    <h2 class="fw-bold mb-4 text-left">MY CART</h2>
    <div class="d-flex align-items-center mb-3">
        <input type="checkbox" class="form-check-input me-2">
        <span>Select all</span>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php
            usort($cartusers, function ($a, $b) {
                return strcmp($b['variant_name'], $a['variant_name']);
            });

            foreach ($cartusers as $cartuser): ?>
                <div class="card mb-3">
                    <div class="row g-0 align-items-center" style="background-color: #f8f9fa;">
                        <div class="col-md-2 text-center">
                            <input type="checkbox" class="form-check-input">
                        </div>
                        <div class="col-md-3">
                            <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $cartuser['url_img'] ?>" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body <?= ($cartuser['variant_name'] == 'Pack') ? 'bg-light' : 'bg-white' ?>">
                                <h5 class="card-title"><?= $cartuser['product_name'] ?></h5>
                                <p class="card-text text-muted">
                                    <?php if ($cartuser['variant_name'] == 'Pack'): ?>
                                        <span class="badge bg-primary"><i class="fas fa-boxes"></i> Pack</span>
                                    <?php else: ?>
                                        <span class="badge bg-success"><i class="fas fa-cube"></i> Box</span>
                                    <?php endif; ?>
                                    (<?= $cartuser['quantity_per_variant'] ?> items)
                                </p>

                                <p class="card-text fw-bold"><?= number_format($cartuser['variant_price'], 0, ',', '.') ?> VND</p>

                                <form action="<?= _WEB_ROOT_ ?>/cart/update" method="POST">
                                    <input type="hidden" name="cart_id" value="<?= $cartuser['cart_id'] ?>">
                                    <div class="d-flex align-items-center">
                                        <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm me-2">-</button>
                                        <span><?= $cartuser['cart_quantity'] ?></span>
                                        <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm ms-2">+</button>
                                        <a href="<?= _WEB_ROOT_ ?>/cart/remove/<?= $cartuser['cart_id'] ?>" class="text-danger ms-auto">REMOVE</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-4 align-self-start">
    <div class="card shadow-sm border-0">
        <div class="card-body bg-light rounded">
            <h5 class="card-title fw-bold text-center">📦 Order Summary</h5>
            <hr>
            <!---->
            <div class="d-flex justify-content-between">
                <span><i class="fa-solid fa-receipt"></i> Subtotal</span>
                <span><?= number_format($total_price, 0, ',', '.') ?> VNĐ</span>
            </div>
            <!---->
            <div class="d-flex justify-content-between">
                <span><i class="fa-solid fa-truck"></i> Shipping</span>
                <span class="text-danger">Calculated at next step</span>
            </div>
            <hr>
            <!---->
            <div class="d-flex justify-content-between fw-bold">
                <span><i class="fa-solid fa-money-bill-wave"></i> Total price</span>
                <span class="text-success"><?= number_format($total_price, 0, ',', '.') ?> VNĐ</span>
            </div>
            <!---->
            <form action="<?= _WEB_ROOT_ ?>/order/checkout" method="POST" class="mt-3">
                <!---->
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">
                        <i class="fa-solid fa-map-marker-alt"></i> Delivery Address
                    </label>
                    <span name="address" id="address" rows="3" class="form-control"><?= $address?></span>
                </div>
                <!---->
                <div class="mb-3">
                    <label for="payment_method" class="form-label fw-semibold">
                        <i class="fa-solid fa-credit-card"></i> Payment Method
                    </label>
                    <select name="payment_method" id="payment_method" class="form-select">
                        <option value="COD">💰 Thanh toán khi nhận hàng (COD)</option>
                        <option value="VNPay">💳 Thanh toán chuyển khoản</option>
                    </select>
                </div>
                <!---->
                <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                    <i class="fa-solid fa-shopping-cart"></i> CHECK OUT
                </button>
            </form>
        </div>
    </div>
</div>
    </div>
</div>
