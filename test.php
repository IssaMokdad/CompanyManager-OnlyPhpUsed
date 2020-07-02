<?php
require_once 'models.php';
require_once 'Teams.php';
require_once 'Employees.php';
require_once 'Stores.php';
require_once 'Rooms.php';
require_once 'Admins.php';
require_once 'TeamsController.php';

$message = TeamsService::getAllTeamsEmployees();
print_r($message);



// $employee = new Employees(14);
// $emp = EmployeesService::getEmployee($employee);
// print_r($emp);

// $admin = new Admins('issa', 'windows');
// AdminsService::createAdmin($admin);
// TeamsService::createTeam($team);
// StoresService::createStore($store);
// StoresService::deleteStore($store);
// $result = StoresService::getStore($store);
// print_r($result);
// $result = StoresService::getRooms($store);
// print_r($result);
// if($result[0]){
//     echo "success";
// }
// else{
//     echo "not success";
// }
