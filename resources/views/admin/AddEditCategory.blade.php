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
  <link rel="shortcut icon" type="image/png" href="../../../public/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../../public/admin/assets/css/styles.min.css" />
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="../../../public/admin/js/axios.js"></script>
  <script src="../../../public/admin/js/categoryManager.js"></script>
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
              <h5 class="card-title fw-semibold mb-4">Category Management</h5>
              <div class="card">
                <div class="card-body">
                  @csrf
                  <form class="editForm" action="/admin/category">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                      <label for="code" class="form-label">Code</label>
                      <input type="text" class="form-control" id="code">
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="onSubmit()">Submit</button>
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