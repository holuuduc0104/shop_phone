<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../helpers/format.php");
include_once($filepath . "/../lib/session.php");
?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        // $sID = session_id();
        $customer_id = Session::get('customer_id');


        $query = "SELECT * FROM tb_product WHERE productID = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        $price = $result['price'];
        $productName = $result['productName'];

        $check_cart = "SELECT * FROM tb_cart WHERE productID = '$id' AND customer_id = '$customer_id'";
        $result_check = $this->db->select($check_cart);

        if($result_check){
            $stt = "added";
            return $stt;
        }else{
            $query_insert = "INSERT INTO tb_cart(productID,quantity,customer_id,image,price,productName) VALUES('$id','$quantity','$customer_id','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                $stt = 'true';
                return $stt;
            } else {
                header('Location:404.php');
            }
        }
    }
    public function get_product_cart(){
        // $sID = session_id();
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_cart WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity, $cartID){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartID = mysqli_real_escape_string($this->db->link, $cartID);
        $query = "UPDATE tb_cart SET quantity = '$quantity' WHERE cartID = '$cartID'";
        $result = $this->db->update($query);
        if($result){
            $stt = 'true';
                return $stt;
        }else{
            $stt = 'false';
                return $stt;
        }
    }
    public function del_product_cart($cartid){
        $cartid = mysqli_real_escape_string($this->db->link, $cartid);
        $query = "DELETE FROM tb_cart WHERE cartID = '$cartid'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function check_cart(){
        // $sID = session_id();
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_cart WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    // public function del_all_data_cart(){
    //     $sID = session_id();
    //     $query = "DELETE FROM tb_cart WHERE sID = '$sID'";
    //     $result = $this->db->delete($query);
    //     return $result;
    // }
}
?>