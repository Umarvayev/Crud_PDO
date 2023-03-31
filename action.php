<?php 

require_once 'db.php';
require_once 'unit.php';
$db = new Database;
$unit = new Unit;

//Handle Add New User Ajax Request 
if(isset($_POST['add'])){
  $fname = $unit -> testInput($_POST['fname']);
  $lname = $unit -> testInput($_POST['lname']);
  $email = $unit -> testInput($_POST['email']);
  $phone = $unit -> testInput($_POST['phone']);

  if($db->insert($fname, $lname, $email, $phone)){
    echo $unit->showMessage('success',' User inserted successfully!');
  }else{
    echo $unit->showMessage('danger', 'Something went wrong!');
  }
}

?>