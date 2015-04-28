<?php if(!empty($posts)): ?>
    <ul class="list-group">
        <?php foreach ($posts as $post) :?>
        <a href="<?= ROOT_URL . 'posts/view/' . $post['id'] ?>">
            <li class="list-group-item">
              <span class="badge">
                #<?= $post['id'] ?>
              </span>
                <span class="post-title"><?= $post['title'] ?></span>
            </li>
        </a>
        <br/>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

