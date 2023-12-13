<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/brand.php")
?>
<?php
$brand = new brand();
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $delBrand = $brand->del_brand($id);
    if ($delBrand == 'true') {
        echo '<script>alert("Delete Brand Successfully.");
           </script>';
    } else {
        echo '<script>alert("Delete Brand Failed.");
        </script>';
    }
}

?>

<div class="container-fluid mt-0">
    <div class="row justify-content-end">
        <div class="col-md-3 mb-2 mt-0">
        <a href="brandadd.php"><button type="button" class="btn btn-info">Add Brand</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Brand List
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped brandlist mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">#</th>
                                <th scope="col" style="width: 70%;">Brand Name</th>
                                <th scope="col" style="width: 20%;" class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $show_brand = $brand->show_brand();
                            if ($show_brand) {
                                $i = 0;
                                while ($result = $show_brand->fetch_assoc()) {
                                    $i++;

                            ?>
                                    <tr>
                                        <td scope="row"><?php echo $i; ?></td>
                                        <td><?php echo $result['brandName']; ?></td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" style="width: 100px; height:35px;">
                                                <a href="brandedit.php?brandid=<?php echo $result['brandID']; ?>" style="display: block;">Edit</a>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger" style="width: 100px; height:35px;">
                                                <a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['brandID']; ?>" style="display: block;">Delete</a>
                                            </button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

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