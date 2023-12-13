<?php
include("inc/header.php");
include("inc/sidebar.php");
include("../classes/product.php");
?>
<?php
$pd = new product();
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $delSlider = $pd->del_slider($delid);
    if ($delSlider == 'true') {
        echo '<script>alert("Delete Slide Successfully.");
           </script>';
    } else {
        echo '<script>alert("Delete Slide Failed.");
        </script>';
    }
}

if (isset($_GET['slideid']) && isset($_GET['type'])) {
    $id = $_GET['slideid'];
    $type = $_GET['type'];
    $delSlider = $pd->update_type_slider($id, $type);
}
?>
<div class="container-fluid mt-0">
    <div class="row justify-content-end">
        <div class="col-md-3 mb-2 mt-0">
            <a href="slideadd.php"><button type="button" class="btn btn-info">Add Slider</button></a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white form_bg fs-4" style="font-weight:bolder;">
                    Slider List
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped catlist mb-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;">No.</th>
                                <th scope="col" style="width: 30%;">Slider Title</th>
                                <th scope="col" style="width: 25%;">Slider Image</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $slider_list = $pd->show_all_slider();
                            if ($slider_list) {
                                $i = 0;
                                while ($result = $slider_list->fetch_assoc()) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td scope="row"><?php echo $i; ?></td>
                                        <td><?php echo $result['slideName']; ?></td>
                                        <td><img src="uploads/<?php echo $result['slide_image']; ?>" width="100px" class="img-fluid"></td>
                                        <td><?php
                                            if ($result['type'] == 1) {
                                            ?>
                                                <a href="?slideid=<?php echo $result['slideID']; ?>&&type=0" class="fw-bold text-primary">ON</a>

                                            <?php
                                            } else {
                                            ?>
                                                <a href="?slideid=<?php echo $result['slideID']; ?>&&type=1" class="fw-bold text-primary">OFF</a>
                                            <?php
                                            }
                                            ?>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger" style="width: 80px; height:35px;">
                                                <a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['slideID']; ?>" style="display: block;">Delete</a>
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