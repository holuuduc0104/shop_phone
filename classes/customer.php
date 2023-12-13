<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../lib/database.php");
include_once($filepath . "/../lib/session.php");
include_once($filepath . "/../helpers/format.php");
?>
<?php
class customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['fullname']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        $password_md5 = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $phone == "" || $address == "" || $email == "" || $password == "") {
            $alert = '<span class="text-danger">Field must be not empty!</span>';
            return $alert;
        } else {
            $check_email = "SELECT * FROM  tb_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = '<span class="text-danger">Email Already Existed!</span>';
                return $alert;
            } else {
                $query = "INSERT INTO tb_customer(name, phone, address, email, password) VALUES('$name','$phone','$address','$email','$password_md5')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = 'true';
                    return $alert;
                } else {
                    $alert = '<span class="text-danger">Sign Up Failed.</span>';
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, $data['password']);
        $password_md5 = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == "" || $password == "") {
            $alert = '<span class="text-danger">Field must be not empty!</span>';
            return $alert;
        } else {
            $query = "SELECT * FROM  tb_customer WHERE email = '$email' AND password = '$password_md5'";
            $result = $this->db->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:index.php');
            } else {
                $alert = "<span class='text-danger'>Email and Password doesn't match!</span>";
                return $alert;
            }
        }
    }
    public function show_customers($id)
    {
        $query = "SELECT * FROM  tb_customer WHERE id = $id";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order($order_code)
    {
        $query = "SELECT * FROM  tb_order WHERE order_code = '$order_code'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_customer($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $phone == "" || $address == "" || $email == "") {
            $alert = '<span class="text-danger">Field must be not empty!</span>';
            return $alert;
        } else {

            $query = "UPDATE tb_customer SET name = '$name', phone = '$phone', address = '$address', email = '$email' WHERE id = '$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = '<span class="text-success fs-4">Update Successfully.</span>';
                return $alert;
            } else {
                $alert = '<span class="text-danger">Update Failed.</span>';
                return $alert;
            }
        }
    }
}
?>