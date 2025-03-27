<style>
    .filter-section {
        width: 250px;
        flex-shrink: 0;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        flex-grow: 1;
    }
    .search-container,
    .categories-container {
        max-width: 250px;
        margin: auto;
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }
</style>

<section class="py-5">
    <div class="container">
        <div class="d-flex">
            <!-- Sidebar bộ lọc -->
            <div class="filter-section me-4">
                <!-- Danh mục -->
                <div class="categories-container mb-4">
                    <h5 class="fw-bold">Character</h5>
                    <div>
                        <?php foreach ($cates as $cate): ?>
                            <a href="<?= _WEB_ROOT_ ?>/product/category/<?= $cate['id']; ?>"
                                class="badge bg-danger text-white fs-6 p-1 px-2 m-1"
                                style="border-radius: 0; text-decoration: none; display: inline-block;">
                                <?= htmlspecialchars($cate['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="search-container mb-4">
                    <h5 class="fw-bold">Tìm kiếm</h5>
                    <form action="<?= _WEB_ROOT_ ?>/product/search" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($keyword ?? '') ?>" name="query" placeholder="Nhập tên sản phẩm..." required>
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-grid">
                <?php if (empty($series)): ?>
                    <p class="text-muted">Không tìm thấy sản phẩm nào.</p>
                <?php else: ?>
                    <?php foreach ($series as $serie) : ?>
                        <div class="card">
                            <img src="<?= _WEB_ROOT_ ?>/app/assets/img/sanpham/<?= htmlspecialchars($serie['url_image'] ?? 'no-image.png') ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($serie['name'] ?? 'No Image') ?>">
                            <div class="card-body">
                            <p class="text-muted mb-1">Dec 06 17:00</p>
                                <h5 class="card-title"><?= htmlspecialchars($serie['name']) ?></h5>
                                <p class="card-text text-danger fw-bold"><?= number_format($serie['price'], 0, ',', '.') ?> VNĐ</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
