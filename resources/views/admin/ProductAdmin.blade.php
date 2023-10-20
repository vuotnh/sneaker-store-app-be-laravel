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
    <link rel="stylesheet" href="../../../public/admin/css/productAdmin.css" />
    <link rel="shortcut icon" type="image/png" href="../../../public/admin/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../../public/admin/assets/css/styles.min.css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../../../public/admin/js/axios.js"></script>
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
                <div class="mb-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="http://mistillas.cl/wp-content/uploads/2018/04/Nike-Epic-React-Flyknit-%E2%80%9CPearl-Pink%E2%80%9D-01.jpg" class="image-preview" />
                                    <div class="list-image 1">
                                        <div class="image-container image-preview-focus" onclick="onFocusPreviewImg(event)">
                                            <img src="https://assets.hermes.com/is/image/hermesproduct/quicker-sneaker--102190ZH09-worn-1-0-0-800-800_g.jpg" class="image-selection" />
                                        </div>
                                        <div class="image-container" onclick="onFocusPreviewImg(event)">
                                            <img src="https://product.hstatic.net/1000284478/product/50crs_3ashce12n_1_5db5d50a37094059a6c75b8f7c2aead7_master.jpg" class="image-selection" />
                                        </div>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <p id="productName">Women's Running Shoe</p>
                                    <h1 id="productTitle">NIKE EPIC REACT FLYKNIT</h1>
                                    <h2>$150</h2>
                                    <p class="desc">The Nike Epic React Flyknit foam cushioning is responsive yet light-weight, durable yet soft. This creates a sensation that not only enhances the feeling of moving forward, but makes running feel fun, too.</p>
                                    <div class="buttons">
                                        <button class="btn btn-secondary"><i class="far fa-eye"></i></button>
                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="http://mistillas.cl/wp-content/uploads/2018/04/Nike-Epic-React-Flyknit-%E2%80%9CPearl-Pink%E2%80%9D-01.jpg" class="image-preview" />
                                    <div class="list-image 2">
                                        <div class="image-container image-preview-focus" onclick="onFocusPreviewImg(event)">
                                            <img src="https://assets.hermes.com/is/image/hermesproduct/quicker-sneaker--102190ZH09-worn-1-0-0-800-800_g.jpg" class="image-selection" />
                                        </div>
                                        <div class="image-container" onclick="onFocusPreviewImg(event)">
                                            <img src="https://product.hstatic.net/1000284478/product/50crs_3ashce12n_1_5db5d50a37094059a6c75b8f7c2aead7_master.jpg" class="image-selection" />
                                        </div>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <p id="productName">Women's Running Shoe</p>
                                    <h1 id="productTitle">NIKE EPIC REACT FLYKNIT</h1>
                                    <h2>$150</h2>
                                    <p class="desc">The Nike Epic React Flyknit foam cushioning is responsive yet light-weight, durable yet soft. This creates a sensation that not only enhances the feeling of moving forward, but makes running feel fun, too.</p>
                                    <div class="buttons">
                                        <button class="btn btn-secondary"><i class="far fa-eye"></i></button>
                                        <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </div>
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