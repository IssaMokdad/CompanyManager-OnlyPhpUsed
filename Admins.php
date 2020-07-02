<?php 
require_once 'models.php';
require_once 'config.php';
class AdminsService
{

    public static function createAdmin($admin)
    {
        $admin->password = password_hash("$admin->password", PASSWORD_DEFAULT);
        global $conn;
        $query = "INSERT INTO Admins(username, password) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $admin->username, $admin->password);
        $stmt->execute();
        $stmt->close();
    }

    public static function check($admin)
    {
        global $conn;
        $query = "SELECT password FROM Admins WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $admin->username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
                $password = $row['password'];
                if(password_verify($admin->password, $password)){
                    return true;
                }
                else{
                    return false;
                }
            }
         else {
            return false;
        }
    }

}