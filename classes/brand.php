<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../lib/database.php");
include_once($filepath."/../helpers/format.php");
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
    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $stt = 'empty';
            return $stt;
        } else {
            $query = "INSERT INTO tb_brand(brandName) VALUES('$brandName')";
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
    public function update_brand($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $stt = 'empty';
            return $stt;
        } else {
            $query = "UPDATE tb_brand SET brandName = '$brandName' WHERE brandID='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $stt = 'true';
                return $stt;
            } else {
                $stt = 'false';
                return $stt;
            }
        }
    }
    public function del_brand($id){
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