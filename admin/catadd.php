<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/category.php")
?>
<?php
    $cat = new category();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $catName = $_POST['catName'];
        $insertCat = $cat->insert_category($catName);
        if ($insertCat == 'empty') {
            echo '<script>alert("Category must be not empty!");
                </script>';
        }else if($insertCat == 'true') {
            echo '<script>alert("Insert Category Successfully.");
                window.location="catlist.php";</script>';
        }else{
            echo '<script>alert("Insert Category Failed.");
            window.location="catlist.php";</script>';
        }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="catadd.php" method="post">
                <div class="card">
                <div class="card-header text-white form_bg" style="font-weight:bolder;">
                        Add New Category
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label for="catName">Category Name</label>
                            <input type="text" class="form-control" name="catName" id="catName">
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
</body>

</html>