<?php if(!empty($posts)): ?>
<?php foreach ($posts as $post) :?>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-8">
                <h3 class="panel-title">
                    <?= $post['title'] ?>
                </h3>
            </div>
            <div class="col-xs-1">
                <span class="badge">
                    <?= $post['user_id']?>
                </span>
            </div>
            <div class="col-xs-1">
                <span class="badge">
                    <?= $post['id']?>
                </span>
            </div>
            <div class="col-xs-2">
                <p>
                    Visits: <?= $post['visits']?>
                </p>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?= $post['text'] ?>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>