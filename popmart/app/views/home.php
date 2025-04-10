<div class="banner">
    <div class="banner-carousel">
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1733476322501____pc-1-3____.webp" alt="Image 1" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1733393089582____pc-buy-now____.webp" alt="Image 2" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1733308401289____pc-buy____.webp" alt="Image 3" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1733293253436____pc-1____.webp" alt="Image 3" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1733283625400____pc-buy____.webp" alt="Image 3" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1732775392336____pc-buy-now____.webp" alt="Image 3" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1732774781725____pc-buy-now____.webp" alt="Image 3" class="slide-image">
        </div>
        <div class="banner-slide">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/banner&logo/1732162261427____pc-1-3____.webp" alt="Image 3" class="slide-image">
        </div>
    </div>
    <div class="banner-prev" onclick="changeSlide(-1)">&#10094;</div>
    <div class="banner-next" onclick="changeSlide(1)">&#10095;</div>
</div>
<section class="product-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-danger fw-bold">New Arrivals</h2>
            <a href="#" class="text-decoration-none text-dark">More &gt;</a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($new as $product): ?>
        <div class="col">
            <a href="<?= _WEB_ROOT_ ?>/product/detail/<?= $product['id'] ?>" class="product-link">
                <div class="card h-100 text-center">
                    <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/<?= $product['url_image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <p class="text-muted mb-1">Dec 07 18:30</p>
                        <h6 class="card-title"><?= $product['name'] ?></h6>
                        <p class="text-danger fw-bold"><?=number_format($product['price']) ?> VNĐ</p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

    </div>
</section>
    <div class="container my-5">
        <h3 class="fw-bold mb-4 text-center">Skullpanda Recommendation</h3>
        <div id="skullpandaCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- First Item -->
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-md-4 text-center">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/1708331660539.webp" class="img-fluid" alt="SKULLPANDA Image Of Reality Series Figures">
                            <p class="mt-2">SKULLPANDA Image Of Reality Series Figures</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/1708331725729.webp" class="img-fluid" alt="SKULLPANDA The Ink Plum Blossom Series Figures">
                            <p class="mt-2">SKULLPANDA The Ink Plum Blossom Series Figures</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/1708331784075.webp" class="img-fluid" alt="SKULLPANDA The Warmth Series">
                            <p class="mt-2">SKULLPANDA The Warmth Series</p>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#skullpandaCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#skullpandaCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<section class="recommended-section py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Recommended For You</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="image-container h-100">
                    <img src="<?= _WEB_ROOT_ ?>/app/assets/img/foryou/1714095986079____未标题-1_画板-1____.webp" class="img-fluid w-100 h-100 object-fit-cover" alt="Recommended Image 1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-4 h-100">
                    <div class="col-12">
                        <div class="image-container">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/foryou/1714095999450____未标题-1-03____.webp" class="img-fluid w-100 h-100 object-fit-cover" alt="Recommended Image 2">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="image-container">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/foryou/1714096012324____未标题-1-05____.webp" class="img-fluid w-100 h-100 object-fit-cover" alt="Recommended Image 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="popular-searches py-4">
    <div class="container">
        <h2 class="fw-bold mb-3">Popular Searches</h2>
        <div class="d-flex flex-wrap gap-3">
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">HIRONO</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">Peach Riot</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">Action Figure</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">MEGA Collection</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">NEW ARRIVAL</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">Top Sellings</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">MOLLY</span>
            <span class="badge rounded-pill text-dark bg-light px-3 py-2">
                <span>🔥</span> CRYBABY
            </span>
        </div>
    </div>
</section>
<section class="product-section-top-selling py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-black fw-bold ">TOP SELLINGS</h2>
            <a href="#" class="text-decoration-none text-dark">More &gt;</a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($top as $product): ?>
            <div class="col">
            <a href="<?= _WEB_ROOT_ ?>/product/detail/<?= $product['id'] ?>" class="product-link">
                <div class="card h-100 text-center">
                    <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/<?= $product['url_image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                    <div class="card-body">
                        <p class="text-muted mb-1">Dec 06 17:00</p>
                        <h6 class="card-title"><?= $product['name'] ?></h6>
                        <p class="text-danger fw-bold"><?=number_format($product['price']) ?> VNĐ</p>
                    </div>
                </div>
            </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<button class="view-more">VIEW MORE</button>
  <!-- POP FRIENDS Section -->
  <section class="pop-section container">
    <h2 class="text-start mb-3">POP FRIENDS</h2>
    <hr>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <div class="col">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/ig/CARMEN_97c7d96be2.jpg" alt="Friend 1" class="rounded">
        </div>
        <div class="col">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/ig/TALAY_a36de1b8b2.jpg" alt="Friend 2" class="rounded">
        </div>
        <div class="col">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/ig/FAYA_c138620276.jpg" alt="Friend 3" class="rounded">
        </div>
        <div class="col">
            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/ig/SOLENE_c8c379b082.jpg" alt="Friend 4" class="rounded">
        </div>
    </div>

    <div class="pop-links row mt-4">
        <div class="col-6">
            <a href="#">About POP MART →</a>
        </div>
        <div class="col-6">
            <a href="#">POP News →</a>
        </div>
    </div>
</section>
