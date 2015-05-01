<form role="form" method="POST" name="addPost">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" 
            placeholder="Enter title..."
            value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title'] ): ''  ?>">
        <em>Maximum size 200 symbols!</em>
    </div>
    <div class="form-group">
        <label for="text">Text:</label>
        <textarea class="col-xs-12" rows="5" name="text" required="required"
                placeholder="Add post text here..."><?= isset($_POST['text']) 
                ? htmlspecialchars($_POST['text']) 
                :  ''  ?>
        </textarea>
        <br/>
        <em>Maximum 1000 symbols are allowed!</em>
    </div>
    <div class="form-group">
        <label>Tags:</label>
        <div class="row">
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag1" required="required"
                    placeholder="Enter some tags"
                    value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag2" required="required"
                    placeholder="Enter some tags"
                    value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag3" required="required"
                    placeholder="Enter some tags"
                    value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag4" required="required"
                    placeholder="Enter some tags"
                    value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="tag5" required="required"
                    placeholder="Enter some tags"
                    value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags'] ): ''  ?>">
            </div>
        </div>
        <em>Only letters are allowed! Maximum size 20 symbols!</em>
    </div>
    <input type="hidden" value="1" name="submitted"/>
    <button type="submit" class="btn btn-default" style="margin-top: 10px">
        Add post
    </button>
</form>
