<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/category.php");
include("../classes/brand.php");
include("../classes/product.php");
include_once("../helpers/format.php");
?>
<?php
$pd = new product();
$fm = new Format();
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $delProduct = $pd->del_product($id);
    if ($delProduct == 'true') {
        echo '<script>alert("Delete Product Successfully.");
           </script>';
    } else {
        echo '<script>alert("Delete Product Failed.");
        </script>';
    }
}
?>
<div class="container-fluid mt-0">
    <div class="row justify-content-end">
        <div class="col-md-3 mb-2 mt-0">
        <a href="productadd.php"><button type="button" class="btn btn-info">Add Product</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Product List
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped catlist mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 3%;">ID</th>
                                <th scope="col" style="width: 25%;">Name</th>
                                <th scope="col" style="width: 7%;">Price</th>
                                <th scope="col" style="width: 15%;">Image</th>
                                <th scope="col" style="width: 15%;">Category</th>
                                <th scope="col" style="width: 10%;">Brand</th>
                                <th scope="col" style="width: 15%;">Type</th>
                                <th scope="col" class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pdlist = $pd->show_product();
                            if ($pdlist) {
                                $i = 0;
                                while ($result = $pdlist->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo $i; ?></td>
                                        <td><?php echo $result['productName']; ?></td>
                                        <td><?php echo '$'.$fm->format_currency($result['price']); ?></td>
                                        <td><img src="uploads/<?php echo $result['image']; ?>" width="100px" class="img-fluid"></td>
                                        <td><?php echo $result['catName']; ?></td>
                                        <td><?php echo $result['brandName']; ?></td>
                                        <td><?php
                                            if ($result['type'] == 1) {
                                                echo 'Featured';
                                            } else {
                                                echo 'Non-Featured';
                                            }
                                            ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" style="width: 80px; height:35px;">
                                                <a href="productedit.php?productid=<?php echo $result['productID']; ?>" style="display: block;">Edit</a>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger" style="width: 80px; height:35px;">
                                                <a onclick="return confirm('Do you want to delete?')" href="?delid=<?php echo $result['productID']; ?>" style="display: block;">Delete</a>
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