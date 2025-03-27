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

  .table thead th:first-child,
  .table tbody td:first-child {
    width: 50px;
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

  .table thead th:nth-child(5),
  .table tbody td:nth-child(5) {
    width: 120px;
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

  .table thead th:nth-child(7),
  .table tbody td:nth-child(7) {
    width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .table thead th:nth-child(8),
  .table tbody td:nth-child(8) {
    width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
  <h1 style="color: rgb(217, 19, 19);" class="h3 mb-0 text-gray-800">PRODUCTS</h1>
  <p class="text-muted">Welcome to the Admin Panel. Here, you can track and manage your website's product data.</p>
  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search for products...">
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>IMAGES</th>
        <th>IMAGES DETAIL</th>
        <th>NAME</th>
        <th>CATEGORY</th>
        <th>PRICE</th>
        <th>DISCOUNT</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody id="productTable">
      <?php foreach ($products as $product):
        $images = explode(',', $product['url_image'] ?? '');
      ?>
        <tr>
          <td><?= $product['id']; ?></td>
          <td>
            <?php if (!empty($images[0])): ?>
              <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $images[0]; ?>" alt="Ảnh sản phẩm" width="50">
            <?php endif; ?>
          </td>
          <td>
            <?php foreach ($images as $image): ?>
              <img src="<?= _WEB_ROOT_ . "/app/assets/img/sanpham/" . $image ?>" class="img-thumbnail" alt="detail" width="50">
            <?php endforeach; ?>
          </td>
       <td class="product-name"><?= $product['name']; ?></td>
          <td><?= $product['category_name']; ?></td>
          <td><?= number_format($product['price']); ?> VNĐ</td>
          <td><?= $product['discount_percent']; ?>%</td>
          <td>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
      AD
    </button>
            <a href="<?= _WEB_ROOT_ ?>/admin/edit/<?= $product['id']; ?>" class="btn btn-warning btn-sm">ED</a>
            <form action="<?= _WEB_ROOT_ ?>/admin/delete/<?= $product['id']; ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display:inline;">
              <button type="submit" class="btn btn-danger btn-sm">DE</button>
            </form>
          </td>
        </tr>
        <?php if (!empty($product['variants'])): ?>
          <?php foreach ($product['variants'] as $variant): ?>
            <tr class="variant-row">
              <td colspan="2"></td>
              <td colspan="6">
                <strong>Variant:</strong> <?= $variant['variant_type']; ?> |
                <strong>Quantity:</strong> <?= $variant['quantity_per_variant']; ?> |
                <strong>Price:</strong> <?= number_format($variant['price_attri']); ?> VNĐ |
                <strong>Stock:</strong> <?= $variant['stock']; ?>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>

    
  </table>
</div>
</body>
<!--add -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?= _WEB_ROOT_ ?>/admin/create" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="cate_id" class="form-label">Category:</label>
            <select id="cate_id" name="cate_id" class="form-select" required>
              <?php foreach ($cates as $cate): ?>
                <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="price" class="form-label">Price (VNĐ):</label>
              <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label for="discount_percent" class="form-label">Discount (%):</label>
              <input type="number" id="discount_percent" name="discount_percent" class="form-control" min="0" max="100">
            </div>
            <div class="col-md-4">
              <label for="sales" class="form-label">Sales Count:</label>
              <input type="number" id="sales" name="sales" class="form-control" min="0">
            </div>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Main Images:</label>
            <input type="file" id="image" name="url_images[]" class="form-control" multiple accept="image/*">
          </div>

          <div id="variant-section" class="mb-3">
            <label class="form-label">Variants:</label>
            <div id="variant-container">
              <div class="variant mb-2 row">
                <div class="col-md-3">
                  <select name="variants[0][variant_type]" class="form-select" required>
                    <option value="Pack">Pack</option>
                    <option value="Box">Box</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <input type="number" name="variants[0][quantity_per_variant]" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="col-md-3">
                  <input type="number" name="variants[0][price_attri]" class="form-control" placeholder="Price" required>
                </div>
                <div class="col-md-3">
                  <input type="number" name="variants[0][stock]" class="form-control" placeholder="Stock" required>
                </div>
              </div>
            </div>
            <button type="button" id="add-variant" class="btn btn-sm btn-secondary">+ Add Variant</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById('add-variant').addEventListener('click', function() {
    const container = document.getElementById('variant-container');
    const index = container.getElementsByClassName('variant').length;
    const variantHtml = `
      <div class="variant mb-2 row">
        <div class="col-md-3">
          <select name="variants[${index}][variant_type]" class="form-select" required>
            <option value="Pack">Pack</option>
            <option value="Box">Box</option>
          </select>
        </div>
        <div class="col-md-3">
          <input type="number" name="variants[${index}][quantity_per_variant]" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="variants[${index}][price_attri]" class="form-control" placeholder="Price" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="variants[${index}][stock]" class="form-control" placeholder="Stock" required>
        </div>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', variantHtml);
  });

  document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#productTable tr:not(.variant-row)'); // Chỉ lấy dòng sản phẩm chính

    rows.forEach(row => {
        let productName = row.querySelector('.product-name')?.textContent.toLowerCase();
        row.style.display = productName.includes(filter) ? '' : 'none';

        // Ẩn luôn biến thể nếu sản phẩm bị ẩn
        if (!productName.includes(filter)) {
            let nextRow = row.nextElementSibling;
            while (nextRow && nextRow.classList.contains('variant-row')) {
                nextRow.style.display = 'none';
                nextRow = nextRow.nextElementSibling;
            }
        }
    });
});

</script>