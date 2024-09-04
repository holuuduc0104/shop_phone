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

        if ($result_check) {
            $stt = "added";
            return $stt;
        } else {
            $query_insert = "INSERT INTO tb_cart(productID,quantity,customer_id,image,price,productName) VALUES('$id','10','$customer_id','$image','$price','$productName')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                $stt = 'true';
                return $stt;
            }
        }
    }
    public function add_to_favorite($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $customer_id = Session::get('customer_id');

        $query = "SELECT * FROM tb_product WHERE productID = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        $price = $result['price'];
        $productName = $result['productName'];

        $check_fav = "SELECT * FROM tb_favorite WHERE productID = '$id' AND customer_id = '$customer_id'";
        $result_check = $this->db->select($check_fav);

        if ($result_check) {
            $stt = "added";
            return $stt;
        } else {
            $query_insert = "INSERT INTO tb_favorite(productID,customer_id,image,price,productName) VALUES('$id','$customer_id','$image','$price','$productName')";
            $insert_fav = $this->db->insert($query_insert);
        }
    }
    public function check_favorite($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $customer_id = Session::get('customer_id');

        $check_fav = "SELECT * FROM tb_favorite WHERE productID = '$id' AND customer_id = '$customer_id'";
        $result_check = $this->db->select($check_fav);

        if ($result_check) {
            return 'true';
        } else {
            return 'false';
        }
    }
    public function del_favorite($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $customer_id = Session::get('customer_id');

        $query = "DELETE FROM tb_favorite WHERE productID = '$id' AND customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function del_favorite_byid($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tb_favorite WHERE favoriteID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function get_product_favorite()
    {
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_favorite WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function check_empty_favorite()
    {
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_favorite WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_cart()
    {
        // $sID = session_id();
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_cart WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_order_history($customer_id)
    {
        $query = "SELECT * FROM tb_placed,tb_customer WHERE tb_placed.customer_id='$customer_id' AND tb_placed.customer_id=tb_customer.id ORDER BY date_created";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function update_quantity_cart($quantity, $cartID)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartID = mysqli_real_escape_string($this->db->link, $cartID);
        $query = "UPDATE tb_cart SET quantity = '$quantity' WHERE cartID = '$cartID'";
        $result = $this->db->update($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function del_product_cart($cartid)
    {
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
    public function check_cart()
    {
        // $sID = session_id();
        $customer_id = Session::get('customer_id');
        $query = "SELECT * FROM tb_cart WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function check_order($customer_id)
    {
        $query = "SELECT * FROM tb_placed WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insertOrder($customer_id)
    {
        $order_code = rand(0000, 9999);
        $query_placed = "INSERT INTO tb_placed(customer_id,order_code,status) VALUE('$customer_id','$order_code','0')";
        $insert_placed = $this->db->insert($query_placed);
        if (!$insert_placed) {
            return false;
        }
        $query = "SELECT * FROM tb_cart WHERE customer_id = '$customer_id'";
        $get_product = $this->db->select($query);
        if (!$get_product) {
            return false;
        }
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productID = $result['productID'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $query_order = "INSERT INTO tb_order(order_code,productID,quantity,customer_id,image,price,productName) VALUES('$order_code','$productID','$quantity','$customer_id','$image','$price','$productName')";
                $insert_order = $this->db->insert($query_order);
                if (!$insert_order) {
                    return false;
                }
            }
        }

        return true;
    }
    public function del_all_product_cart($customer_id)
    {
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
        $query = "DELETE FROM tb_cart WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function getAmounPrice($customer_id)
    {
        $query = "SELECT price FROM tb_order WHERE customer_id = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }
    public function get_cart_ordered($customer_id)
    {
        $query = "SELECT * FROM tb_order WHERE customer_id = '$customer_id'";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
    }
    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tb_placed,tb_customer WHERE tb_placed.customer_id=tb_customer.id ORDER BY date_created";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }
    public function shifted($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tb_placed SET status = '1' WHERE order_code = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function confirm_received($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "UPDATE tb_placed SET status = '2' WHERE order_code = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function del_shifted($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tb_placed WHERE order_code = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
    public function shifted_confirm($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tb_order SET status = '2' WHERE customer_id = '$id' AND date_order = '$time' AND price = '$price'";
        $result = $this->db->delete($query);
        if ($result) {
            $stt = 'true';
            return $stt;
        } else {
            $stt = 'false';
            return $stt;
        }
    }
}
?>