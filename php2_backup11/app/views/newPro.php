<form action="<?= _WEB_ROOT_ ?>/product/add" method="POST" enctype="multipart/form-data">
    <div>
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="cate_id">Category:</label>
        <select id="cate_id" name="cate_id" required>
            <?php foreach ($cates as $cate): ?>
                <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="price">Price (VNĐ):</label>
        <input type="number" id="price" name="price" required>
    </div>

    <div>
        <label for="discount_percent">Discount (%):</label>
        <input type="number" id="discount_percent" name="discount_percent" min="0" max="100">
    </div>

    <div>
        <label for="sales">Sales Count:</label>
        <input type="number" id="sales" name="sales" min="0">
    </div>

    <div>
        <label for="image">Main Images:</label>
        <input type="file" id="image" name="url_images[]" multiple accept="image/*">
    </div>

    <div>
        <label for="show_image">Show Image:</label>
        <input type="file" id="show_image" name="show_image" accept="image/*">
    </div>

    <div id="variant-section">
        <label>Variants:</label>
        <div id="variant-container">
            <div class="variant">
                <select name="variants[0][variant_type]" required>
                    <option value="Pack">Pack</option>
                    <option value="Box">Box</option>
                </select>
                <input type="number" name="variants[0][quantity_per_variant]" placeholder="Quantity" required>
                <input type="number" name="variants[0][price_attri]" placeholder="Price" required>
                <input type="number" name="variants[0][stock]" placeholder="Stock" required>
            </div>
        </div>
        <button type="button" id="add-variant">+ Add Variant</button>
    </div>

    <button type="submit">Add Product</button>
</form>
<script>
    document.getElementById('add-variant').addEventListener('click', function() {
        let container = document.getElementById('variant-container');
        let index = container.getElementsByClassName('variant').length;
        let variantHtml = `
        <div class="variant">
           <select name="variants[0][variant_type]" required>
                    <option value="Pack">Pack</option>
                    <option value="Box">Box</option>
                </select>
            <input type="number" name="variants[\${index}][quantity_per_variant]" placeholder="Quantity" required>
            <input type="number" name="variants[\${index}][price_attri]" placeholder="Price" required>
            <input type="number" name="variants[\${index}][stock]" placeholder="Stock" required>
        </div>
    `;
        container.insertAdjacentHTML('beforeend', variantHtml);
    });
</script>