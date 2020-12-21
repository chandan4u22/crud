<?php
include_once 'model/user.php';

if (isset($_GET['id'])){

  include_once 'classes/session.php';
  $user = new user();
  $user->delete($_GET['id']);
  $session = new Session();
  $session->set('success', 'Success: Your data has been deleted!');
  header('location: list.php');
}
