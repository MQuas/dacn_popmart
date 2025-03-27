<style>
    a {
        color: black;
    }

    .product-section {
        margin-bottom: 10px;
    }

    .product-container {
        max-width: 800px;
        margin: auto;
    }

    .thumbnail-images img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border: 0;
    }

    .main-image img {
        max-height: 300px;
        object-fit: contain;
    }

    .btn-quantity {
        width: 30px;
        height: 30px;
    }

    .product-container {
        text-align: center;
        padding: 30px;
    }

    .product-image {
        max-width: 100%;
        border-radius: 15px;
    }

    .product-title {
        font-weight: bold;
        margin-top: 20px;
        font-size: 24px;
    }

    .product-caption {
        font-size: 16px;
        color: #555;
        margin-top: 10px;
    }
</style>

<div class="container mt-5 product-container">
    <div class="row">
        <div class="col-md-6">
            <div class="main-image mb-3 text-center">
                <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $product['url_image'][0] ?>" class="image-fluid" alt="Main Product Image">
            </div>
            <div class="d-flex justify-content-center gap-2 thumbnail-images">
                <?php foreach ($images as $image): ?>
                    <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $image ?>" class="img-thumbnail" alt="Thumbnail">
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <span class="badge bg-warning text-dark text-uppercase">New</span>
            </div>
            <h5><?= $product['name'] ?></h5>
            <h4 class="text-danger mb-3" id="productPrice">
                <?= number_format($product['price'], 0, ',', '.') ?> VNĐ
            </h4>

            <form action="<?= _WEB_ROOT_ ?>/cart/add" method="POST">
                <div class="mb-3">
                    <label for="variantSelect" class="form-label">Choose Variant:</label>
                    <select class="form-select" id="variantSelect" name="variant_id">
                        <?php foreach ($variants as $variant): ?>
                            <option value="<?= $variant['id'] ?>" data-price="<?= $variant['price_attri'] ?>">
                                <?= ucfirst(str_replace('_', ' ', $variant['variant_type'])) ?>
                                (<?= number_format($variant['price_attri'], 0, ',', '.') ?> VNĐ) - <?= $variant['quantity_per_variant']  ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <label for="quantity" class="me-2">Quantity:</label>
                    <div class="input-group input-group-sm" style="max-width: 120px;">
                        <input type="hidden" name="pro_id" value="<?= $product['id'] ?>">
                        <input type="number" class="form-control text-center form-control-sm" name="quantity" value="1" min="1">
                    </div>
                </div>

                <p class="text-muted mb-4">Max 1(set) per person</p>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error_message']; ?></div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <button type="submit" class="btn btn-dark w-100 mb-3">Add to Cart</button>
            </form>

            <button class="btn btn-outline-secondary w-100">Notify Me When Available</button>

            <hr>

            <h6 class="text-uppercase">Details</h6>
            <ul class="list-unstyled mt-3">
                <li><strong>Brand:</strong> POP MART</li>
                <li><strong>Material:</strong> PVC/ABS</li>
            </ul>

            <hr>

            <h6 class="text-uppercase">Terms of Service</h6>
            <div class="accordion mt-3" id="shippingAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            SHIPPING & AFTER-SALES SERVICE
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#shippingAccordion">
                        <div class="accordion-body">
                            1. Shipping: Standard Shipping (15-30 working days), Expedited Shipping (3-7 working days).<br>
                            2. Defects: Contact support@popmart.com with the order number and unpacking video within 5 days.<br>
                            3. Tax fees: International shipments may incur Customs Duty.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Show -->
<div class="container product-container">
    <h1 class="product-title">Product Show</h1>
    <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/show/" . $product['show_images'] ?>" alt="Product Image" class="product-image">
    <p class="product-caption">The figurine and chair can be separated and placed individually.</p>
</div>

<!-- You May Also Like -->
<section class="product-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text fw-bold">You May Also Like</h2>
            <a href="#" class="text-decoration-none text-dark">More &gt;</a>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col">
                <a href="product-detail.html" class="product-link">
                    <div class="card h-100 text-center">
                        <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/20241204_133450_346641____1_____1200x1200.jpg" class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title">MEGA SPACE MOLLY 1000% Stitch</h6>
                            <p class="text-danger fw-bold">€1,116.00</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('variantSelect').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let newPrice = selectedOption.getAttribute('data-price');
        document.getElementById('productPrice').innerText = new Intl.NumberFormat('vi-VN').format(newPrice) + ' VNĐ';
    });
</script>