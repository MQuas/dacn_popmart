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
.table thead th:nth-child(3),
  .table tbody td:nth-child(3) {
    width: 180px;
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
  <h1 style="color: rgb(217, 19, 19);" class="h3 mb-0 text-gray-800">CATEGORIES</h1>
  <p class="text-muted">Welcome to the Admin Panel. Here, you can track and manage your website's category data.</p>

  
  <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>CATEGORIES NAME</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cates as $cate): ?>
        <tr>
          <td><?= $cate['id'] ?></td>
          <td><?= $cate['name'] ?></td>
          <td>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    AD
  </button>
          <a href="javascript:void(0)" 
               class="btn btn-warning btn-sm edit-category" 
               data-id="<?= $cate['id']; ?>" 
               data-name="<?= $cate['name']; ?>">
              ED
            </a>
            <form action="<?= _WEB_ROOT_ ?>/admin/category/delete/<?= $cate['id']; ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display:inline;">
              <button type="submit" class="btn btn-danger btn-sm">DE</button>
            </form>
          </td>
         
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!--add -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= _WEB_ROOT_ ?>/admin/category/add" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">New Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
      </form>
    </div>
  </div>
</div>
      <!--edit-->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= _WEB_ROOT_ ?>/admin/category/update/<?= $cate['id']; ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-category-id">
          <div class="mb-3">
            <label for="edit-category-name" class="form-label">Category Name</label>
            <input type="text" id="edit-category-name" name="name" class="form-control" placeholder="Enter category name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-category');
    editButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var name = this.getAttribute('data-name');

        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-category-name').value = name;

        var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        myModal.show();
      });
    });
  });
</script>

