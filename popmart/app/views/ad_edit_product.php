<style>
    .container_edit {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container_edit .form-label {
        font-weight: 600;
    }

    .container_edit input,
    .container_edit select,
    .container_edit button {
        margin-bottom: 10px;
    }

    .container_edit .row {
        margin-bottom: 15px;
    }

    #current_images img {
        margin-right: 5px;
        border-radius: 5px;
    }

    #edit-variant-container .variant {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        background: #f9f9f9;
    }
</style>
<h1 style="color: rgb(217, 19, 19);" class="h3 mb-0 text-gray-800">EDIT PRODUCTS</h1>
<p class="text-muted">Welcome to the Admin Panel. Here, you can track and manage your website's product data.</p>
<div class="container_edit">
    <form action="<?= _WEB_ROOT_ ?>/admin/update/<?= $product['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="mb-3">
            <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">
                <label for="edit_name" class="form-label">Tên sản phẩm:</label>
                <input type="text" id="edit_name" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="edit_cate_id" class="form-label">Danh mục:</label>
                <select id="edit_cate_id" name="cate_id" class="form-select" required>
                    <?php foreach ($cates as $cate): ?>
                        <option value="<?= $cate['id'] ?>" <?= $cate['id'] == $product['cate_id'] ? 'selected' : '' ?>>
                            <?= $cate['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="edit_price" class="form-label">Giá (VNĐ):</label>
                    <input type="number" id="edit_price" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="edit_discount_percent" class="form-label">Giảm giá (%):</label>
                    <input type="number" id="edit_discount_percent" name="discount_percent" class="form-control" min="0" max="100" value="<?= $product['discount_percent'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="edit_sales" class="form-label">Số lượng bán:</label>
                    <input type="number" id="edit_sales" name="sales" class="form-control" min="0" value="<?= $product['sales'] ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh hiện tại:</label>
                <div id="current_images">
                    <?php
                    $images = is_array($product['url_image']) ? $product['url_image'] : explode(',', $product['url_image'] ?? '');
                    ?>

                    <?php foreach ($images as $image): ?>
                        <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $image ?>" class="img-thumbnail" alt="detail" width="50">
                    <?php endforeach; ?>
                </div>
                <label for="edit_image" class="form-label mt-2">Chọn hình ảnh mới:</label>
                <input type="file" id="edit_image" name="url_images[]" class="form-control" multiple accept="image/*">
            </div>

            <div id="edit-variant-section" class="mb-3">
                <label class="form-label">Biến thể:</label>
                <div id="edit-variant-container">
                    <?php foreach ($variants as $index => $variant): ?>
                        <div class="variant mb-2 row">
                            <div class="col-md-3">
                                <select name="variants[<?= $index ?>][variant_type]" class="form-select" required>
                                    <option value="Pack" <?= $variant['variant_type'] === 'Pack' ? 'selected' : '' ?>>Pack</option>
                                    <option value="Box" <?= $variant['variant_type'] === 'Box' ? 'selected' : '' ?>>Box</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="variants[<?= $index ?>][quantity_per_variant]" class="form-control" placeholder="Quantity" value="<?= $variant['quantity_per_variant'] ?>" required>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="variants[<?= $index ?>][price_attri]" class="form-control" placeholder="Price" value="<?= $variant['price_attri'] ?>" required>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="variants[<?= $index ?>][stock]" class="form-control" placeholder="Stock" value="<?= $variant['stock'] ?>" required>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger btn-sm remove-variant">Xóa</button>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <button type="button" id="add-edit-variant" class="btn btn-sm btn-secondary">+ Thêm biến thể</button>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
</div>
</form>
<script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant')) {
            e.target.closest('.variant').remove();
        }
    });

    document.getElementById('add-edit-variant').addEventListener('click', function() {
        const container = document.getElementById('edit-variant-container');
        const index = container.getElementsByClassName('variant').length;
        const variantHtml = `
      <div class="variant mb-2 row">
        <div class="col-md-3">
          <select name="variants[${index}][variant_type]" class="form-select" required>
            <option value="Pack">Pack</option>
            <option value="Box">Box</option>
          </select>
        </div>
        <div class="col-md-2">
          <input type="number" name="variants[${index}][quantity_per_variant]" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="col-md-2">
          <input type="number" name="variants[${index}][price_attri]" class="form-control" placeholder="Price" required>
        </div>
        <div class="col-md-2">
          <input type="number" name="variants[${index}][stock]" class="form-control" placeholder="Stock" required>
        </div>
        <div class="col-md-3">
          <button type="button" class="btn btn-danger btn-sm remove-variant">Xóa</button>
        </div>
      </div>
    `;
        container.insertAdjacentHTML('beforeend', variantHtml);
    });
</script>