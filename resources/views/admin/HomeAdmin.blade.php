<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link rel="shortcut icon" type="image/png" href="admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../../../../public/admin/assets/css/styles.min.css" />
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="../../../../../public/admin/js/axios.js"></script>
  <script src="../../../../../public/admin/js/user.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
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
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Số thứ tự</th>
              <th scope="col">Tên</th>
              <th scope="col">Email</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Hành động</th>
            </tr>
          </thead>
          <tbody id="table-body">

          </tbody>
        </table>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="../../../../../public/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../../../../public/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../../public/admin/assets/js/sidebarmenu.js"></script>
  <script src="../../../../../public/admin/assets/js/app.min.js"></script>
</body>

</html>