<form role="form" method="POST" name="login">
    <div class="form-group">
        <?php if(isset($this->fieldsErrors['username'])) :?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $this->fieldsErrors['username']; ?></strong>
        </div>
        <?php endif;?> 
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" 
            placeholder="Enter email"
            value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
    </div>
    <div class="form-group">
        <?php if(isset($this->fieldsErrors['password'])) :?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo $this->fieldsErrors['password']; ?></strong>
        </div>
        <?php endif;?>
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="password" 
            placeholder="Enter password" 
            value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
    </div>
    <input type="hidden" name="submitted" class="btn btn-default" value="1">
    <button type="submit" class="btn btn-default">Enter</button>
</form>
