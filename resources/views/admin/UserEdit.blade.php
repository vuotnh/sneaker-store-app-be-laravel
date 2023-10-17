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
  <script src="../../../public/admin/js/userManager.js"></script>
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
              <h5 class="card-title fw-semibold mb-4">Edit User</h5>
              <div class="card">
                <div class="card-body">
                  @csrf
                  <form class="editForm" action="/admin/user">
                    <div class="mb-3">
                      <label for="firstName" class="form-label">First name</label>
                      <input type="text" class="form-control" id="firstName">
                    </div>
                    <div class="mb-3">
                      <label for="lastName" class="form-label">Last name</label>
                      <input type="text" class="form-control" id="lastName">
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">Phone</label>
                      <input type="text" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" disabled>
                    </div>
                    <div class="mb-3 avatar-group">
                      <div class="main-img-preview">
                        <img class="thumbnail img-preview" src="" title="Preview Logo" style="max-width: 400px; border-radius: 10px">
                      </div>
                      <div class="input-group" style="margin-top: 10px">
                        <div class="input-group-btn">
                          <div class="fileUpload btn btn-danger fake-shadow">
                            <input id="avatar" name="avatar" type="file" class="attachment_upload" onchange="previewFile(this)">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="onSubmitEdit()">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function previewFile(input) {
      const [file] = input.files;
      const previewTag = document.getElementById('main-img-preview');

      const reader = new FileReader();

      reader.onload = (e) => {
        const img = document.querySelector('div.avatar-group img.img-preview');
        img.src = e.target.result;
      }
      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
  <style>

  </style>
  <script src="../../../public/admin/js/sidebarmenu.js"></script>
  <script src="../../../public/admin/js/app.min.js"></script>
</body>

</html>