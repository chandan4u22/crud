<?php
include 'model/user.php';

if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_GET['id'])){
 // echo "<pre>"; print_r($_POST); echo "</pre>"; die;
  $error = [];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  if (strlen(trim($firstname)) < 2 ){
    $error['firstname'] = 'Error: First name should be at least  2 characters!';
  }
  if (strlen(trim($lastname)) < 2){
    $error['lastname'] = 'Error: Lastname should be at least 2 characters!';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error['email'] = 'Error: Enter a valid email id!';
  }

  if (trim($password) != '' && trim($confirm_password) != '') {
    if (strlen(trim($password)) < 4){
      $error['password'] = 'Error: Enter at least 4 characters for password!';
    }

    if (trim($password) != trim($confirm_password)  || strlen((trim($confirm_password))) < 4){
      $error['confirm_password'] = 'Error: Enter confirm password  same as password:';
    }
  }

  if ($error){
    $session = new Session();
    $session->set('errors',$error);

    foreach ($_POST as $key => $post) {
    $session->set($key, $post);
    }
    header('location: edit.php?id=' . $_GET['id']);
  }else{
    include_once 'model/user.php';
  $user = new User();
  $user->setFirstname($_POST['firstname']);
  $user->setLastname($_POST['lastname']);
  $user->setEmail($_POST['email']);
  if ($_POST['password']) {
    $user->setPassword($_POST['password']);
  }
  $user->update($_GET['id']);

  include 'classes/session.php';

  $session = new Session();
  $session->set('success', 'Success: Your data has been upodated!');
  header('location: list.php');
}
}
?>
