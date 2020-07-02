<?php


class Employees
{
    public $id;
    public $name;
    public $last_name;
    public $manager_id;
    public $email;

    public function __construct($id=null, $name=null, $last_name=null, $manager_id=null, $email=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->manager_id = $manager_id;
        $this->email = $email;}
}

class Stores
{
    public $id;
    public $name;
    public $type;
    public $manager_id;

    public function __construct($id = null, $name=null, $type = null, $manager_id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->manager_id = $manager_id;}
}

class Rooms
{
    public $room_number;
    public $store_id;

    public function __construct($room_number=null, $store_id = null)
    {
        $this->room_number = $room_number;
        $this->store_id = $store_id;}}

class Teams
{
    public $id;
    public $name;
    public $type;

    public function __construct($id = null, $name=null, $type = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;}}

class Employee_Team
{
    public $employee_id;
    public $team_id;

    public function __construct($employee_id, $team_id=null)
    {
        $this->employee_id = $employee_id;
        $this->team_id = $team_id;}}

class Team_Admin
{
    public $employee_id;
    public $team_id;

    public function __construct($employee_id=null, $team_id=null)
    {
        $this->employee_id = $employee_id;
        $this->team_id = $team_id;}}

class Teams_Rooms
{
    public $room_number;
    public $team_id;

    public function __construct($room_number=null, $team_id=null)
    {
        $this->room_number = $room_number;
        $this->team_id = $team_id;}}
class Admins
{
    public $id;
    public $username;
    public $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
}