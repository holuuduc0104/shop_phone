<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/brand.php");
include("../classes/category.php");
include("../classes/product.php");
?>
<?php
    $pd = new product();
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>window.location='productlist.php'</script>";
    }else{
        $id = $_GET['productid'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $updateProduct = $pd->update_product($_POST,$_FILES,$id);
        if ($updateProduct == 'empty') {
            echo '<script>alert("Field must be not empty!");
                </script>';   
        }else if($updateProduct == 'bigfile') {
            echo '<script>alert("Image Size should be less than 10MB!");
           </script>';
        }else if($updateProduct == 'wrongfile') {
            echo '<script>alert("You can upload only: .jpg, .jpeg, .png, .gif, .webp");
            </script>';
        }
        else if($updateProduct == 'true') {
            echo '<script>alert("Update Product Successfully.");
            window.location="productlist.php";</script>';
        }else{
            echo '<script>alert("Update Product Failed.");
            window.location="productlist.php";</script>';
        }
    }
?>
<style>
    .ck-editor__editable[role="textbox"] {
        min-height: 150px;
    }
</style>
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <?php
            $get_product_by_id = $pd->getproductbyId($id);
                if($get_product_by_id){
                    while($result_product = $get_product_by_id->fetch_assoc()){

                    
                
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="card">
                    <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                        Add New Product
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="productName" class="col-md-3 col-form-label ">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="productName" id="productName" value="<?php echo $result_product['productName']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label ">Category</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <option>-------Select Category-------</option>
                                    <?php 
                                    $cat = new category();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                    ?>
                                    <option 
                                    <?php
                                    if($result['catID']==$result_product['catID']){ echo 'selected'; }
                                    ?>
                                    value="<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="brand" class="col-md-3 col-form-label">Brand</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="brand">
                                    <option>-------Select Brand-------</option>
                                    <?php 
                                    $brand = new brand();
                                    $brandlist = $brand->show_brand();
                                    if($catlist){
                                        while($result = $brandlist->fetch_assoc()){
                                    ?>
                                    <option 
                                    <?php
                                    if($result['brandID']==$result_product['brandID']){ echo 'selected'; }
                                    ?>
                                    value="<?php echo $result['brandID']; ?>"><?php echo $result['brandName']; ?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="product_desc" class="col-md-3 col-form-label ">Description</label>
                            <div class="col-md-9 text-black">
                                <textarea name="product_desc" rows="5" class="form-control" id="content1"><?php echo $result_product['product_desc'] ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="product_info" class="col-md-3 col-form-label ">Information</label>
                            <div class="col-md-9 text-black">
                                <textarea name="product_info" rows="5" class="form-control" id="content2"><?php echo $result_product['product_info'] ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-3 col-form-label ">Price</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="price" id="price" value="<?php echo $result_product['price']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label ">Upload Image</label>
                            <div class="col-md-9">
                            <img src="uploads/<?php echo $result_product['image']; ?>" width="100px"><br>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-3 col-form-label ">Product Type</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option selected>-------Select Type--------</option>
                                    <?php
                                        if($result_product['type'] == 1){
                                    ?>
                                    <option selected value="1">Featured</option>
                                    <option value="0">Non-Featured</option>
                                    <?php
                                    }else{
                                    ?>
                                    <option value="1">Featured</option>
                                    <option selected value="0">Non-Featured</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" class="btn mt-4 text-white form_bg butt" value="Save" name="submit">
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content1'))
        .catch(error => {
            console.error(error);
        });
        ClassicEditor
        .create(document.querySelector('#content2'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>

</html>