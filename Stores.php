<?php
require_once 'models.php';
require_once 'config.php';
require_once 'Employees.php';
class StoresService
{

    public static function createStore($store)
    {
        if ($store->manager_id) {
            $ids = EmployeesService::getEmployeeIds();
            if (in_array($store->manager_id, $ids)) {

            } else {
                $message = "This manager doesn't exist!";
                return $message;
            }}
        global $conn;
        $query = "INSERT INTO Stores(name,type,manager_id) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $store->name, $store->type, $store->manager_id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            $message = "Store $store->name of type $store->type with id: $lastest_id has been added successfully";
            return $message;
        }
        else{
        $stmt->close();
        $message = "Something went wrong! check your input!";
        return $message;
    }}
    public static function updateStore($store)
    {

        global $conn;
        $query = "UPDATE Stores SET type=?,name=?,manager_id=? where id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $store->type, $store->name, $store->manager_id, $store->id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Updated Successfully";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }

    public static function deleteStore($store)
    {
        $ids = StoresService::getStoresIds();
        if (in_array($store->id, $ids)) {

        } else {
            $message = "This store doesn't exist!";
            return $message;
        }
        global $conn;
        $query = "DELETE FROM Stores WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $store->id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Deleted Successfully";
            $stmt->close();
            return $message;
        }
        else{
        $message = "Something went wrong, try again!";
        $stmt->close();
        return $message;
    }}

    public static function listStore()
    {
        global $conn;
        $query = "SELECT * FROM Stores";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $type = isset($row['type']) ? $row['type'] : 'has no type';
                $manager_id = isset($row['manager_id']) ? $row['manager_id'] : 'has no manager';
                $store = new Stores($id, $name, $type, $manager_id);
                $rows[] = $store;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
    public static function getStore($store)
    {
        global $conn;
        $query = "SELECT * FROM Stores WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $store->id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $type = isset($row['type']) ? $row['type'] : 'has no type';
                $manager_id = isset($row['manager_id']) ? $row['manager_id'] : 'has no manager';
                $store = new Stores($id, $name, $type, $manager_id);
            }
        } else {
            $store = [];
        }
        $stmt->close();
        return $store;
    }

    public static function getStoresIds()
    {
        global $conn;
        $query = "SELECT id FROM Stores";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row['id'];
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }


}
