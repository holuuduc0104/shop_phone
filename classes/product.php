<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $product_info = mysqli_real_escape_string($this->db->link, $data['product_info']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $product_info == "" || $price == "" || $type == "" || $file_name == "") {
            $stt = 'empty';
            return $stt;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tb_product(productName,brandID,catID,product_desc,product_info,price,type,image) VALUES('$productName','$brand','$category','$product_desc','$product_info','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $stt = 'true';
                return $stt;
            } else {
                $stt = 'false';
                return $stt;
            }
        }
    }
    public function show_product()
    {
        $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName 
        FROM tb_product INNER JOIN tb_category ON tb_product.catID = tb_category.catID 
        INNER JOIN tb_brand ON tb_product.brandID = tb_brand.brandID 
        ORDER BY tb_product.productID DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $file, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $product_info = mysqli_real_escape_string($this->db->link, $data['product_info']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $product_info == "" || $price == "" || $type == "") {
            $stt = 'empty';
            return $stt;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 10240) {
                    $stt = 'bigfile';
                    // $alert = "<span class='success'>Image Size should be less than 10MB!</span>";
                    return $stt;
                } elseif (in_array($file_ext, $permited) === false) {
                    $stt = 'wrongfile';
                    // $alert = "<span class='error'>You can upload only: " . implode(', ', $permited) . "</span>";
                    return $stt;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tb_product SET 
        productName = '$productName', 
        brandID = '$brand', 
        catID = '$category', 
        product_desc = '$product_desc',
        product_info = '$product_info',  
        price = '$price', 
        type = '$type', 
        image = '$unique_image' 
        WHERE productID = '$id'";
            } else {
                $query = "UPDATE tb_product SET 
                productName = '$productName', 
                brandID = '$brand', 
                catID = '$category', 
                product_desc = '$product_desc', 
                product_info = '$product_info', 
                price = '$price', 
                type = '$type ' 
                WHERE productID = '$id'";
            }
        }
        $result = $this->db->update($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function del_product($id)
    {
        $query = "DELETE FROM tb_product WHERE productID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tb_product WHERE productID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_slide($data, $files)
    {
        $slideName = mysqli_real_escape_string($this->db->link, $data['slideName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($slideName == "" || $type == "" || $file_name == "") {
            $stt = 'empty';
            return $stt;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 819200) {
                    $stt = 'bigfile';
                    return $stt;
                } elseif (in_array($file_ext, $permited) === false) {
                    $stt = 'wrongfile';
                    return $stt;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tb_slider(slideName,type,slide_image) VALUES('$slideName','$type','$unique_image')";
                $result = $this->db->insert($query);
                if ($result) {
                    $stt = 'true';
                    return $stt;
                } else {
                    $stt = 'false';
                    return $stt;
                }
            }
        }
    }
    public function show_all_slider()
    {
        $query = "SELECT * FROM tb_slider ORDER BY slideID DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_slider($id)
    {
        $query = "DELETE FROM tb_slider WHERE slideID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function update_type_slider($id, $type)
    {
        $type = mysqli_real_escape_string($this->db->link, $type);
        $query = "UPDATE tb_slider SET type = '$type' WHERE slideID = '$id'";
        $result = $this->db->update($query);
        return $result;
    }
    // -----------------END BACKEND----------------- //

    public function getproduct_featered()
    {
        $query = "SELECT * FROM tb_product WHERE type = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new()
    {
        $query = "SELECT * FROM tb_product ORDER BY productID desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id)
    {
        $query = "SELECT tb_product.*, tb_category.catName, tb_brand.brandName 
        FROM tb_product INNER JOIN tb_category ON tb_product.catID = tb_category.catID 
        INNER JOIN tb_brand ON tb_product.brandID = tb_brand.brandID WHERE tb_product.productID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_brand_by_cat($id)
    {
        $query = "SELECT tb_product.*, tb_brand.brandName 
        FROM tb_product INNER JOIN tb_brand ON tb_product.brandID = tb_brand.brandID WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_brand($brandid, $catid)
    {
        $query = "SELECT * FROM tb_product WHERE brandID = '$brandid' AND catID = '$catid' ORDER BY productID desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat($catid)
    {
        $query = "SELECT * FROM tb_product WHERE catID = '$catid' ORDER BY productID desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function getall_product_by_brand($brandid, $catid)
    {
        $query = "SELECT * FROM tb_product WHERE brandID = '$brandid' AND catID = '$catid' ORDER BY productID";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slider()
    {
        $query = "SELECT * FROM tb_slider WHERE type = '1' ORDER BY slideID DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
?>