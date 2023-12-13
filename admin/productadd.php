<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/brand.php");
include("../classes/category.php");
include("../classes/product.php");
?>
<?php
    $pd = new product();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $insertProduct = $pd->insert_product($_POST,$_FILES);
        if ($insertProduct == 'empty') {
            echo '<script>alert("Field must be not empty!");
                </script>';
        }else if($insertProduct == 'true') {
            echo '<script>alert("Insert Product Successfully.");
            window.location="productlist.php";</script>';
        }else{
            echo '<script>alert("Insert Product Failed.");
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
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                        Add New Product
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="productName" class="col-md-3 col-form-label ">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="productName" id="productName"  placeholder="Enter Product Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label ">Category</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="category">
                                    <option selected>-------Select Category-------</option>
                                    <?php 
                                    $cat = new category();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></option>
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
                                    <option selected>-------Select Brand-------</option>
                                    <?php 
                                    $brand = new brand();
                                    $brandlist = $brand->show_brand();
                                    if($catlist){
                                        while($result = $brandlist->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['brandID']; ?>"><?php echo $result['brandName']; ?></option>
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
                                <textarea name="product_desc" rows="5" class="form-control" id="content1"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-md-3 col-form-label ">Price</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label ">Product Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-3 col-form-label ">Product Type</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option selected>------Select Type------</option>
                                    <option value="1">Featured</option>
                                    <option value="0">Non-Featured</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" class="btn mt-4 text-white form_bg butt" value="Save" name="submit">
                        </div>
                    </div>
                </div>
            </form>
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
</script>
</body>

</html>