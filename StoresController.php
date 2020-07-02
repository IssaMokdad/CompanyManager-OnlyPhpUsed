<?php
session_start();
require_once "Stores.php";

class StoresController
{
    public static function createStore($store)
    {
        $message = StoresService::createStore($store);
        $_SESSION['message'] = $message;
        header('Location: storesboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function updateStore($store)
    {
        $message = StoresService::updateStore($store);
        $_SESSION['message'] = $message;
        header('Location: storesboard.php');
    }
    public static function deleteStore($store)
    {
        $message = StoresService::deleteStore($store);
        $_SESSION['message'] = $message;
        header('Location: storesboard.php');
    }
    public static function getStore($storeid)
    {
        $store = new Stores($storeid);
        $message = StoresService::getStore($store);
        $html = "<table class='zui-table'><thead><tr><th>Store ID</th><th>Name</th><th>Type</th>
        <th>Manager ID</th><th>Action</th></tr></thead><tbody>";
        
        if($message){
                $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->type . "</td>
                <td>" . $message->manager_id . "</td><td><div class='employeeservice'><form action='index.php' method='post'>
                <input class='board' type='text' name='section' value='deletestore' required>
                <input class='board' type='number' name='id' value='$message->id' required>
                <button type='submit'><i class='fa fa-close'></i></button></form>
                <form action='index.php' method='post'>
                <input class='board' type='number' name='id' value='$message->id'>
                <input class='board' type='text' name='name' value='$message->name'>
                <input class='board' type='text' name='type' value='$message->type'>
                <input class='board' type='number' name='managerid' value='$message->manager_id'>
                <input class='board' type='text' name='section' value='editstore' required>
                <button type='submit'><i class='fa fa-edit'></i></button></form></div>
                </td></tr>";
        }





        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "storesboard.php";
        header('Location: listall.php');
    }
    
    public static function listStore()
    {
        $message = StoresService::listStore();
        // $_SESSION['list']=$message;
        $html = "<table class='zui-table'><thead><tr><th>Store ID</th><th>Name</th><th>Type</th>
        <th>Manager ID</th><th>Action</th></tr></thead><tbody>";
        
        if($message){foreach ($message as $message) {
                $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->type . "</td>
                <td>" . $message->manager_id . "</td><td><div class='employeeservice'><form action='index.php' method='post'>
                <input class='board' type='text' name='section' value='deletestore' required>
                <input class='board' type='number' name='id' value='$message->id' required>
                <button type='submit'><i class='fa fa-close'></i></button></form>
                <form action='index.php' method='post'>
                <input class='board' type='number' name='id' value='$message->id'>
                <input class='board' type='text' name='name' value='$message->name'>
                <input class='board' type='text' name='type' value='$message->type'>
                <input class='board' type='number' name='managerid' value='$message->manager_id'>
                <input class='board' type='text' name='section' value='editstore' required>
                <button type='submit'><i class='fa fa-edit'></i></button></form></div>
                </td></tr>";
        }}





        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "storesboard.php";
        header('Location: listall.php');
    }

    public static function selectLists()
    {
        $message1 = StoresService::getStoresIds();

        $html1 = "";
        foreach ($message1 as $key) {
            $html1 =$html1 .  "<option value=" . $key. ">$key</option>";
        }




        $message = EmployeesService::getManagersIds();
        $html="";
        foreach ($message as $key) {
            $html =$html .  "<option value=" . $key. ">$key</option>";
    }
        $_SESSION['selectmanagerids'] = $html;
        $_SESSION['selectstoreids'] = $html1;
        header('Location: storesboard.php');
    }
}
