<?php if($errorMessage != NULL): ?>
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><?= $errorMessage ?></strong>
</div>
<?php endif; ?>

<form role="form" method="POST" name="login">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" 
            placeholder="Enter email"
            value="<?= $_POST['username'] ? $_POST['username'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="password" 
            placeholder="Enter password" 
            value="<?= $_POST['password'] ? $_POST['password'] : ''; ?>">
    </div>
    <button type="submit" class="btn btn-default">Enter</button>
</form>
