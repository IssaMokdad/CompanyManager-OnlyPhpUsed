<?php
session_start();
require_once "Rooms.php";

class RoomsController
{

    public static function addRoomTeam($room)
    {
        $message = RoomsService::addRoomTeam($room);
        $_SESSION['message'] = $message;
        header('Location: roomsboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function createRoom($room)
    {
        $message = RoomsService::addRoomStore($room);
        $_SESSION['message'] = $message;
        header('Location: roomsboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function updateRoom($room)
    {
        $message = RoomsService::updateRoomStore($room);
        $_SESSION['message'] = $message;
        header('Location: roomsboard.php');
    }
    public static function deleteRoom($room)
    {
        $message = RoomsService::deleteRoom($room);
        $_SESSION['message'] = $message;
        header('Location: roomsboard.php');
    }

    
    public static function listRoom()
    {
        $message = RoomsService::getRooms();
        // $_SESSION['list']=$message;
        $html = "<table class='zui-table'><thead><tr><th>Room Number</th>
                </tr></thead><tbody>";
        foreach ($message as $key) {
            $html = $html . "<tr><td>" . $key->room_number . "</td></tr>";
        }
        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "roomsboard.php";
        header('Location: listall.php');
    }
    public static function deleteRoomTeam($room)
    {
        $message = RoomsService::deleteRoomTeam($room);
        $_SESSION['message'] = $message;
        header('Location: roomsboard.php');
    }

    

}
