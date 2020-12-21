<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
  </head>
  <body>

    <div class="jumbotron">
      <h1 class="text-center">Student List</h1>
    </div>
    <?php
      include 'model/user.php';
      $user = new User();
      $students = $user->getList();
    ?>

    <?php
      include 'classes/session.php';
      $session = new Session();
      if ($session->has('success')) {
        ?>
        <div class="alert alert-success">
          <?php echo $session->get('success'); ?>
        </div>
      <?php } ?>

    <table class="table table-bordered table-hover table-stripped">
      <thead>
        <tr>
          <th>S.No</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($students) { ?>
        <?php $i = 1; ?>
        <?php foreach ($students as $student) { ?>
          <tr>
            <td><?php echo $i; ?>.</td>
            <td><?php echo $student['Firstname']; ?></td>
            <td><?php echo $student['Lastname']; ?></td>
            <td><?php echo $student['Email']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i>
              </a>
              <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger">
                <i class="fa fa-trash"></i>
              </a>
          </tr>
          <?php $i ++; ?>
        <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </body>
</html>
