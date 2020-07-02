<?php
require_once 'models.php';
require_once 'config.php';
class TeamsService
{

    public static function createTeam($team)
    {
        global $conn;
        $query = "INSERT INTO Teams(name,type) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $team->name, $team->type);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            $message = "Team $team->name of type $team->type with id: $lastest_id has been added successfully";
            return $message;
        }
        else{
        $stmt->close();
        $message = "Something went wrong, try again!";
    }
    }
    public static function updateTeam($team)
    {
        global $conn;
        $query = "UPDATE Teams SET name=?, type=? where id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $team->name, $team->type, $team->id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Updated Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }

    public static function deleteTeam($team)
    {
        global $conn;
        $query = "DELETE FROM Teams WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $team->id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Deleted Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "This team doesn't exist!";
            $stmt->close();
            return $message;
        }
    }

    public static function listTeam()
    {
        global $conn;
        $query = "SELECT * FROM Teams";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $type = isset($row['type']) ? $row['type'] : 'has no type';
                $team = new Teams($id,$name, $type);
                $rows[] = $team;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
    public static function getTeam($team)
    {
        global $conn;
        $query = "SELECT * FROM Teams WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $team->id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $type = isset($row['type']) ? $row['type'] : 'has no type';
                $team = new Teams($id, $name, $type);
            }
        } else {
            $team = [];
        }
        $stmt->close();
        return $team;
    }

    public static function insertAdmin($team)
    {
        global $conn;
        $query = "INSERT INTO Team_Admin(employee_id,team_id) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $team->employee_id, $team->team_id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Added Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, check your input and try again!";
            $stmt->close();
            return $message;
        }
    }
    public static function insertEmployee($team)
    {
        global $conn;
        $query = "INSERT INTO Employee_Team(employee_id, team_id) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $team->employee_id, $team->team_id);
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            $message = "Inserted Successfully";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, check you input and try again!";
            $stmt->close();
            return $message;
        }
    }
    public static function getAllTeamEmployees($team)
    {
        global $conn;
        $query = "SELECT * FROM Employees where
        id in (SELECT employee_id FROM Employee_Team WHERE team_id=?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $team->team_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $last_name = isset($row['last_name']) ? $row['last_name'] : 'has no last name';
            $manager_id = isset($row['manager_id']) ? $row['manager_id'] : 'has no manager';
            $email = isset($row['email']) ? $row['email'] : 'has no email';
            $employee = new Employees($id, $name, $last_name, $manager_id, $email);
            $rows[] = $employee;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
    public static function getAdmin($team)
    {
        global $conn;
        $query = "SELECT * FROM Team_Admin WHERE team_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $team->team_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $employee_id = $row['employee_id'];
            }
        } else {
            $stmt->close();
            return "failed";
        }
        $stmt->close();
        return $employee_id;
    }

    public static function getAllTeamsEmployees()
    {
        global $conn;
        $query = "SELECT DISTINCT employee_id FROM Employee_Team";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $rows[] = $row['employee_id'];
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
}
