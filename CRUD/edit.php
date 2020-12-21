<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  if (!isset($_GET['id'])) {
    header('Location: list.php');
  }
  include 'model/user.php';
  $user = new User();

  $id = $_GET['id'];
  $student = $user->getUser($id);
// echo "<pre>"; print_r($student); echo "</pre>"; die;
  if (!$student) {
    header('location: list.php');
  }

  include_once 'classes/session.php';
  $firstname = '';
  $lastname = '';
  $email = '';
  $password = '';
  $confirm_password = '';
  $errors = [];
  $session = new Session();
  if ($session->has('errors')){
  $errors = $session->get('errors');
  $session->remove('errors');
  }

  if ($session->has('firstname')){
  $firstname = $session->get('firstname');
  $session->remove('firstname');
} elseif ($student['Firstname']) {
  $firstname = $student['Firstname'];
}
if ($session->has('lastname')){
$lastname = $session->get('lastname');
$session->remove('lastname');
} elseif ($student['Lastname']) {
$lastname = $student['Lastname'];
}

if ($session->has('email')){
$email = $session->get('email');
$session->remove('email');
} elseif ($student['Email']) {
$email = $student['Email'];
}

if ($session->has('password')){
$password = $session->get('password');
$session->remove('password');
}


  if ($session->has('confirm_password')){
  $confirm_password = $session->get('confirm_password');
  }
  ?>

<div class="jumbotron jumbotron-fluid">
  <h3 class="text-center">CRUD-OPERATIONS</h3>
</div>
<div class="container">
  <div class="col-sm-6 offset-3">
   <form action="update.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <label for="firstname">Firstname:-</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name"  value="<?php echo $firstname; ?>">
      <?php if (isset($errors['firstname'])){ ?>
        <div class="text-danger">
          <?php echo $errors['firstname']; ?>
      </div>
    <?php  } ?>
  </div>

      <div class="form-group">
        <label for="lastname">Lastname:-</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="<?php echo $lastname; ?>">
        <?php if (isset($errors['lastname'])) { ?>
          <div class="text-danger">
            <?php echo $errors['lastname']; ?>
      </div>
    <?php } ?>
  </div>

      <div class="form-group">
        <label for="email">Email:-</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter  Your Email" value="<?php  echo $email; ?> ">
        <?php  if (isset($errors['email'])) { ?>
          <div class="text-danger">
            <?php echo $errors['email']; ?>
          </div>
        <?php } ?>
      </div>

      <div class="form-group">
        <label for="password">Password:-</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo $password; ?>">
        <?php if (isset($errors['password'])) { ?>
          <div class="text-danger">
            <?php echo $errors['password']; ?>
          </div>
        <?php } ?>
      </div>

      <div class="form-group">
        <label for="confirm-password">Confirm-Password:-</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm-Password" value="<?php echo $confirm_password; ?>">
        <?php if (isset($errors['confirm_password'])) { ?>
          <div class="text-danger">
            <?php echo $errors['confirm_password']; ?>
          </div>
        <?php } ?>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
