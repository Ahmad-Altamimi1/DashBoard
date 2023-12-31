<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css%22%3E">
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <!-- <link rel="stylesheet" href="../../"> -->
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../../js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <?php
    require_once("../../db.php");
    $singlePr = [];
    if (isset($_GET['updateid'])) {
        $index = $_GET['updateid'];
        $result = $crudObj->getSingleProduct($index);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $singlePr = $row;
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitUpdate'])) {
        $name = $_POST['name'];
        $product_brife = $_POST['brief'];
        $product_des = $_POST['description'];
        $mainfactor = $_POST['mainfactor'];
        $product_price = $_POST['price'];
        $quantity_product = $_POST['quantity'];
        // $product_img1 = $_POST['picture'];
        if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $picture = $_FILES['picture']['name'];
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($picture);
            move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile);
        } else {
            $uploadFile = $singlePr['product_img1'];
        }
        $crudObj->updateProduct($index, $name, $product_price, $product_brife, $product_des, $singlePr['category_id'], $quantity_product, $uploadFile, $mainfactor);
        header("Location: edit.php?updateid=$index");
        exit();
    }
    ?>

    <?php
    require_once("../../partials/_navbar.php");



    ?>
    <div class="container-fluid page-body-wrapper">
        <?php
        require_once("../../partials/navbar.php");
        ?>

        <div class="container">
            <h2></h2><br>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3 form">
                    <label for="name" class="form-label">Product Name:</label>
                    <input class="form-control" type="text" name="name" placeholder="Name" aria-label="default input example" value="<?php echo $singlePr['product_name'] ?>">
                </div>

                <div class="mb-3 form">
                    <label for="brief" class="form-label">Brief specifications</label>
                    <input class="form-control" type="text" id="brief" name="brief" value="<?php echo $singlePr['product_brife'] ?>">
                    <p style=" color: grey;">ie: mention the storage, processor, ram..</p>
                </div>

                <div class="mb-3 form">
                    <label for="description" class="form-label">Product Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">
                         <?php echo $singlePr['product_des'] ?>
                    </textarea>
                </div>

                <div class="mb-3 form">
                    <label for="price" class="form-label">Product price</label>
                    <input class="form-control" type="text" id="price" name="price" value="<?php echo $singlePr['product_price'] ?>">
                </div>
                <div class=" mb-3 form">
                    <label for="price" class="form-label">Main Factor</label>
                    <input class="form-control" type="text" id="mainfactor" name="mainfactor" value="<?php echo $singlePr['mainfactor'] ?>">
                </div>


                <div class="mb-3 form">
                    <label for="picture" class="form-label">Product picture</label>
                    <input class="form-control" type="file" id="picture" name="picture" value="<?php echo $singlePr['product_img1'] ?>">
                </div>
                <div class="mb-3 form">
                    <label for="picture" class="form-label">quantity product </label>
                    <input class="form-control" type="text" id="quantity" name="quantity" value="<?php echo $singlePr['quantity_product'] ?>">
                </div>

                <div >
                    <img src=" <?php echo trim($singlePr['product_img1']) ?>" alt="" style="width: 126px; margin-bottom: 19px;">
                </div>

                <button type=" submit" class="btn btn-outline-success" name="submitUpdate" value="Add Product">Update product</button>
            </form>

        </div><br><br>
        <script src="../../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../../vendors/chart.js/Chart.min.js"></script>
        <script src="../../vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="../../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="../../js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../../js/off-canvas.js"></script>
        <script src="../../js/hoverable-collapse.js"></script>
        <script src="../../js/template.js"></script>
        <script src="../../js/settings.js"></script>
        <script src="../../js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../../js/dashboard.js"></script>
        <script src="../../js/Chart.roundedBarCharts.js"></script>
        <!-- ___________ 
 -->
        <script src="../../js/product.js"></script>