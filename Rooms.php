<?php
require_once 'models.php';
require_once 'config.php';
class RoomsService
{
    public static function addRoomStore($room)
    {
        global $conn;
        $query = "INSERT INTO Rooms(room_number,store_id) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $room->room_number, $room->store_id);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            $message = "Room $room->room_number of store $room->store_id has been added successfully";
            return $message;
        } else {
            $stmt->close();
            $message = "Something went wrong! check your input!";
            return $message;
        }
    }
    public static function updateRoomStore($room)
    {
        global $conn;
        $query = "UPDATE Rooms SET store_id=? where room_number=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $room->store_id, $room->room_number);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            $message = "Update Successfully!";
            return $message;
        } else {
            $stmt->close();
            $message = "Something went wrong! check your input!";
            return $message;
        }
    }
    public static function getRoomsByStore($room)
    {
        global $conn;
        $query = "SELECT room_number FROM Rooms where store_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $room->store_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $room_number = $row['room_number'];
                $room = new Rooms($room_number);
                $rows[] = $room;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;}
    public static function getRoomsByTeam($room)
    {
        global $conn;
        $query = "SELECT room_number FROM Teams_Rooms where team_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $room->team_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $room_number = $row['room_number'];
                $room = new Teams_Rooms($room_number);
                $rows[] = $room;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
    public static function deleteRoomTeam($room)
    {
        global $conn;
        $query = "DELETE FROM Teams_Rooms WHERE team_id=? AND room_number=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $room->team_id, $room->room_number);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $stmt->close();
            $message = "Deleted Successfully!";
            return $message;
        } else {
            $stmt->close();
            $message = "Something went wrong! check your input!";
            return $message;
        }
    }
    public static function addRoomTeam($room)
    {
        global $conn;
        $query = "INSERT INTO Teams_Rooms(room_number,team_id) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $room->room_number, $room->team_id);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $stmt->close();
            $message = "Added Successfully!";
            return $message;
        } else {
            $stmt->close();
            $message = "Something went wrong! check your input!";
            return $message;
        }
    }
    public static function deleteRoom($room){

        global $conn;
        $query = "DELETE FROM Rooms WHERE room_number=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $room->room_number);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $message = "Deleted Successfully";
            $stmt->close();
            return $message;
        } else {
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }}

        public static function getRooms()
        {
            global $conn;
            $query = "SELECT room_number FROM Rooms";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $room_number = $row['room_number'];
                    $room = new Rooms($room_number);
                    $rows[] = $room;
                }
            } else {
                $rows = [];
            }
            $stmt->close();
            return $rows;}
}
