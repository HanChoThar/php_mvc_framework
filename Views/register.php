<h2>Create an account</h2>

<form action="" method="POST">
    <label>First Name</label>
    <input type="text" name="fname" value="<?php echo $model->fname ?>">
    <?php echo $model->getFirstError('fname') ?>
    <br>
    <label>Last Name</label>
    <input type="text" name="lname">
    <?php echo $model->getFirstError('lname') ?>
    <br>
    <label>Email</label>
    <input type="text" name="email" autocomplete="off">
    <?php echo $model->getFirstError('email') ?>
    <br>
    <label>Password</label>
    <input type="password" name="password" autocomplete="off">
    <?php echo $model->getFirstError('password') ?>
    <br>
    <label>Confirm Password</label>
    <input type="password" name="confirm_password">
    <?php echo $model->getFirstError('password') ?>
    <br>
    <button type="submit">Submit</button>
</form>