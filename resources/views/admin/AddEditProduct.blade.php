<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="../../../public/admin/css/addEditProduct.css" />
  <link rel="shortcut icon" type="image/png" href="../../../public/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
  <link rel="stylesheet" href="../../../public/admin/assets/css/styles.min.css" />
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="../../../public/admin/js/axios.js"></script>
  <script>
    $(document).ready(function() {
      $('#summernote').summernote();
    });
  </script>
  <script src="../../../public/admin/js/productManager.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('admin.Sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Product Management</h5>
              <div class="card">
                <div class="card-body">
                  @csrf
                  <form class="formProduct" action="/admin/category">
                    <div class="mb-3">
                      <label for="productName" class="form-label">Product Name</label>
                      <input type="text" class="form-control" id="productName">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Desciption</label>
                      <div>
                        <textarea id="summernote" name="productDesciption" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-5">
                          <label for="description" class="form-label">Category</label>
                          <div class="category">
                            <select class="form-select category-select" aria-label="Default select example">
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <label for="productPrice" class="form-label">Price</label>
                          <div class="input-group">
                            <input type="number" class="form-control" id="productPrice">
                            <div class="input-group-append">
                              <span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0">Đồng</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <label for="discount" class="form-label">Discount</label>
                          <div class="input-group">
                            <input type="number" class="form-control" id="discountRate">
                            <div class="input-group-append">
                              <span class="input-group-text" style="border-top-left-radius: 0; border-bottom-left-radius: 0">%</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="productPrice" class="form-label">Image</label>
                      <div class="list-image">
                        <div class="image-container">
                          <div class="overlay">
                            <a href="#" class="icon" title="User Profile" onclick="removeThis(this)">
                              <i class="fa-solid fa-xmark"></i>
                            </a>
                          </div>
                          <img src="https://plus.unsplash.com/premium_photo-1675896084254-dcb626387e1e?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1870" alt="1" class="image-card">
                        </div>
                        <div class="image-add-button">
                          <button type="button" class="button-add-file btn btn-primary " onclick="clickButton()">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                            <input type="file" class="newFileField" onchange="addNewFile(this)" />
                          </button>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="onSubmitNewProduct()">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>

  </style>
  <script src="../../../public/admin/js/sidebarmenu.js"></script>
  <script src="../../../public/admin/js/app.min.js"></script>
</body>

</html>