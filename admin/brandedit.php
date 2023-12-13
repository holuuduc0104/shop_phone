<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/brand.php")
?>
<?php

$brand = new brand();
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location='brandlist.php'</script>";
}else{
    $id = $_GET['brandid'];
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brandName = $_POST['brandName'];
    $updateBrand = $brand->update_brand($brandName,$id);
    if ($updateBrand == 'empty') {
        echo '<script>alert("Brand must be not empty!");
            </script>';
    }else if($updateBrand == 'true') {
        echo '<script>alert("Update Brand Successfully.");
            window.location="brandlist.php";</script>';
    }else{
        echo '<script>alert("Update Brand Failed.");
        window.location="brandlist.php";</script>';
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="card">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                        Edit Brand
                    </div>
                    
                    <?php
                    $get_brand_name = $brand->getbrandbyId($id);
                    if ($get_brand_name) {
                        while ($result = $get_brand_name->fetch_assoc()) {


                    ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brandName">Brand Name</label>
                                    <input type="text" class="form-control" name="brandName" id="brandName" value="<?php echo $result['brandName']; ?>">
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn mt-4 text-white form_bg butt" value="Update" name="submit">
                                </div>
                            </div>
                </div>
            </form>

    <?php
                        }
                    }
    ?>
        </div>
    </div>
</div>
<!-- ----------------------------------------- -->
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#sidebarCollapse").on('click', function() {
            $("#sidebar").toggleClass('active');
        });
    });
</script>
</body>

</html>