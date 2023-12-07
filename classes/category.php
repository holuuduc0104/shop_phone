<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/database.php");
include_once($filepath."/../helpers/format.php");
?>
<?php
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            // $alert = "<span style='font-size: 18px; color: red; margin: 5px;'>Category must be not empty!</span>";
            // return $alert;
            $stt = 'empty';
            return $stt;
        } else {
            $query = "INSERT INTO tb_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);
            if ($result) {
                // $alert  = "<span style='font-size: 18px; color: green; margin: 5px;'>Insert Category Successfully</span>";
                // return $alert;
                $stt = 'true';
                return $stt;
            } else {
                // $alert  = "<span style='font-size: 18px; color: red; margin: 5px;'>Insert Category Failed</span>";
                // return $alert;
                $stt = 'false';
                return $stt;
            }
        }
    }
    public function show_category()
    {
        $query = "SELECT * FROM tb_category ORDER BY catID DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatebyId($id)
    {
        $query = "SELECT * FROM tb_category WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            // $alert = "<span style='font-size: 18px; color: red; margin: 5px;'>Category must be not empty!</span>";
            $stt = 'empty';
            return $stt;
        } else {
            $query = "UPDATE tb_category SET catName = '$catName' WHERE catID='$id'";
            $result = $this->db->update($query);
            if ($result) {
                // $alert  = "<span style='font-size: 18px; color: green; margin: 5px;'>Updated Category Successfully.</span>";
                $stt = 'true';
                return $stt;
            } else {
                // $alert  = "<span style='font-size: 18px; color: red; margin: 5px;'>Updated Category Failed.</span>";
                $stt = 'false';
                return $stt;
            }
        }
    }
    public function del_category($id){
        $query = "DELETE FROM tb_category WHERE catID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            // $alert  = "<span style='font-size: 18px; color: green; margin: 5px;'>Updated Category Successfully.</span>";
            $stt = 'true';
            return $stt;
        } else {
            // $alert  = "<span style='font-size: 18px; color: red; margin: 5px;'>Updated Category Failed.</span>";
            $stt = 'false';
            return $stt;
        }
    }
    // -----------------END BACKEND-----------------

    public function show_category_fe()
    {
        $query = "SELECT * FROM tb_category ORDER BY catID DESC";
        $result = $this->db->select($query);
        return $result;
    }
    // public function get_product_by_cat($id){
    //     $query = "SELECT * FROM tb_category WHERE catID = '$id' ORDER BY catID desc LIMIT 8";
    //     $result = $this->db->select($query);
    //     return $result;
    // }
    public function get_brand_by_cat($id){
        $query = "SELECT * FROM tb_category WHERE catID = '$id' ORDER BY catID desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatebyid_fe($id)
    {
        $query = "SELECT * FROM tb_category WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>