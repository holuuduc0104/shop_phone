<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php
class brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($data)
    {
        // $brandName = $this->fm->validation($brandName);
        // $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        // if (empty($brandName)) {
        //     $stt = 'empty';
        //     return $stt;
        // } else {
        //     $query = "INSERT INTO tb_brand(brandName) VALUES('$brandName')";
        //     $result = $this->db->insert($query);
        //     if ($result) {
        //         $stt = 'true';
        //         return $stt;
        //     } else {
        //         $stt = 'false';
        //         return $stt;
        //     }
        // }
        $brandName = mysqli_real_escape_string($this->db->link, $data['brandName']);
        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['brandLogo']['name'];
        $file_size = $_FILES['brandLogo']['size'];
        $file_temp = $_FILES['brandLogo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($brandName == "" || $file_name == "") {
            $stt = 'empty';
            return $stt;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tb_brand(brandName,brandLogo) VALUES('$brandName','$unique_image')";
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

    public function show_brand()
    {
        $query = "SELECT * FROM tb_brand ORDER BY brandID DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getbrandbyId($id)
    {
        $query = "SELECT * FROM tb_brand WHERE brandID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_brand($data, $id)
    {
        // $brandName = $this->fm->validation($brandName);
        // $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        // $id = mysqli_real_escape_string($this->db->link, $id);

        // if (empty($brandName)) {
        //     $stt = 'empty';
        //     return $stt;
        // } else {
        //     $query = "UPDATE tb_brand SET brandName = '$brandName' WHERE brandID='$id'";
        //     $result = $this->db->update($query);
        //     if ($result) {
        //         $stt = 'true';
        //         return $stt;
        //     } else {
        //         $stt = 'false';
        //         return $stt;
        //     }
        // }
        $brandName = $this->fm->validation($data['brandName']);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['brandLogo']['name'];
        $file_size = $_FILES['brandLogo']['size'];
        $file_temp = $_FILES['brandLogo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($brandName == "") {
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
                $query = "UPDATE tb_brand SET brandName = '$brandName', brandLogo = '$unique_image' WHERE brandID = '$id'";
            } else {
                $query = "UPDATE tb_brand SET brandName = '$brandName' WHERE brandID = '$id'";
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
    public function del_brand($id)
    {
        $query = "DELETE FROM tb_brand WHERE brandID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }

    // -----------------END BACKEND-----------------

    public function getbrandbyid_fe($id)
    {
        $query = "SELECT * FROM tb_brand WHERE brandID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>