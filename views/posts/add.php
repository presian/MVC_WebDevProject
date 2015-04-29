<form role="form" method="POST" name="addPost">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" 
            placeholder="Enter username..."
            value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title'] ): ''  ?>">
    </div>
    <div class="form-group">
        <label for="tags">Tags:</label>
        <input type="tags" class="form-control" id="tags" name="tags" required="required"
            placeholder="Enter some tags"
            value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
        <em>Only words separated with comas are allowed!</em>
    </div>
    <div class="form-group">
        <label for="text">Text:</label>
        <textarea class="col-xs-12" rows="5" name="text" 
                placeholder="Add post text here..."><?= isset($_POST['text']) 
                ? htmlspecialchars($_POST['text']) 
                :  ''  ?></textarea>
    </div>
    <input type="hidden" value="1" name="submitted"/>
    <button type="submit" class="btn btn-default" style="margin-top: 10px">
        Add post
    </button>
</form>
