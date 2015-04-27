<?php if(!empty($posts)): ?>
<?php foreach ($posts as $post) :?>
<a href="<?= ROOT_URL . 'posts/view/' . $post['id'] ?>">
    <div class="panel panel-info" onclick="">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8">
                    <h3 class="panel-title">
                        <?= $post['title'] ?>
                    </h3>
                </div>
                <div class="col-xs-2 text-right">
                    <span class="badge">
                        <?= $post['user_id']?>
                    </span>
                </div>
                <div class="col-xs-2">
                    <p class="text-right">
                        Visits: <?= $post['visits']?>
                    </p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $post['text'] ?>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-3 text-left">
                    <span >Date: <?= $post['date']?></span>
                </div>
                <div class="col-xs-9 text-right">
                    <span >Post#: <?= $post['id']?></span>
                </div>
            </div>
        </div>
    </div>
</a>

<?php endforeach; ?>
<?php endif; ?>