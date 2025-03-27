<div class="container py-5 mx-auto">
    <h2 class="fw-bold mb-4 text-left">MY CART</h2>
    <div class="d-flex align-items-center mb-3">
        <input type="checkbox" class="form-check-input me-2">
        <span>Select all</span>
    </div>

    <div class="row">
        <div class="col-lg-8">
        <div class="container py-5 mx-auto text-center">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <i class="fas fa-check-circle text-success" style="font-size: 100px;"></i>
        <h2 class="fw-bold mt-3">Bạn đã đặt hàng thành công!</h2>
        <h2 class="fw-bold text-danger mt-2"><?=number_format($total_price)?> VNĐ</h2>
        <p class="text-muted">Cảm ơn bạn đã mua hàng. Đơn hàng của bạn sẽ sớm được xử lý.</p>
        <a href="<?= _WEB_ROOT_ ?>" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
    </div>
</div>

        </div>

        <div class="col-lg-4 align-self-start">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Order Summary</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span> 0 VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>Calculated at next step</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total price</span>
                        <span>0 VNĐ</span>
                    </div>
                    <form method="POST">
                        <button type="submit" class="btn btn-danger w-100 mt-3">CHECK OUT</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>