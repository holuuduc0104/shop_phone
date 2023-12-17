<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/product.php")
?>
<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insertSlide = $pd->insert_slide($_POST, $_FILES);
    if ($insertSlide == 'empty') {
        echo '<script>alert("Field must be not empty!");
                </script>';
    } else if ($insertSlide == 'bigfile') {
        echo '<script>alert("Image Size should be less than 800KB!");
           </script>';
    } else if ($insertSlide == 'wrongfile') {
        echo '<script>alert("You can upload only: .jpg, .jpeg, .png, .gif, .webp");
            </script>';
    } else if ($insertSlide == 'true') {
        echo '<script>alert("Update Slide Successfully.");
        window.location="slidelist.php";</script>';
    } else {
        echo '<script>alert("Update Slide Failed.");
        window.location="slidelist.php";</script>';
    }
}

?>

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="slideadd.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                        Add New Slide
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label ">Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="slideName" id="title" placeholder="Enter Slider Title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label ">Slide Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-3 col-form-label ">Type</label>
                            <div class="col-md-9">
                                <select class="form-select" aria-label="Default select example" name="type">
                                    <option selected>------Select Type------</option>
                                    <option value="1">ON</option>
                                    <option value="0">OFF</option>
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
</body>

</html>