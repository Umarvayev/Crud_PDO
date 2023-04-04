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
// Handle Fetch All Users Ajax Request
if (isset($_GET['read'])) {
  $users = $db->read();
  $output = '';
  if ($users) {
    foreach ($users as $row) {
      $output .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['first_name'] . '</td>
                    <td>' . $row['last_name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>
                      <a href="#" id="' . $row['id'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editNewUserModal ">Edit</a>

                      <a href="#" id="' . $row['id'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
                    </td>
                  </tr>';
    }
    echo $output;
  } else {
    echo '<tr>
            <td colspan="6">No Users Found in the Database!</td>
          </tr>';
  }
}

 // Handle Edit User Ajax Request
 if (isset($_GET['edit'])) {
  $id = $_GET['id'];

  $user = $db->readOne($id);
  echo json_encode($user);
}


// Handle Update User Ajax Request
if (isset($_POST['update'])){
  $id = $unit->testInput($_POST['id']); 
  $fname = $unit->testInput($_POST['fname']); 
  $lname = $unit->testInput($_POST['lname']); 
  $email = $unit->testInput($_POST['email']); 
  $phone = $unit->testInput($_POST['phone']); 

  if($db->update($id, $fname, $lname, $email, $phone)){
    echo $unit->showMessage('succes', 'User updated successful!');
  }else{
    echo $unit->showMessage('danger', 'Something went wrong!');
  }
}

//Handle Delete User Ajax Request
if (isset($_GET['delete'])){
  $id = $_GET['id'];
  if ($db->delete($id)){
    echo $unit ->showMessage('info', 'User deleted successful!');
  }else{
    echo $unit->showMessage('danger', 'Something went wrong!');
  }
}
?>