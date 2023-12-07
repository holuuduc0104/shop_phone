<?php
$filepath = realpath(dirname(__FILE__));
include($filepath."/../lib/session.php");
Session::checkLogin();
include_once($filepath."/../lib/database.php");
include_once($filepath."/../helpers/format.php");
?>
<?php
class adminLogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $alert = "<span class='text-danger'>User and Pass must be not empty!</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tb_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";

            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login', true);
                Session::set('adminID', $value['adminID']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                $alert = '';
                header('Location:index.php');
            } else {
                $alert = "<span class='text-danger'>User and Pass not match!</span>";
                return $alert;
            }
        }
    }
}
?>