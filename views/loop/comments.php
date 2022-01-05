<?php foreach ($comments as $comment): ?>

<div class="px-3 py-2 flex flex-col justify-center md:items-start mb-4 border-b-2 border-neutral-300"
    serma-comment-id="<?= $comment->comment_ID ?>">
    <div class="w-full flex flex-row justify-center md:justify-start mr-2 mb-6">
        <img alt="avatar" width="50" height="50" class="rounded-full w-15 h-15 mr-4 mb-4"
            onerror="this.onerror=null; this.src='<?=SERMA_POST_COMMENTS_URL?>/assets/images/avatars/default.svg?v=<?=SERMA_POST_COMMENTS_VERSION?>'"
            src="<?=SERMA_POST_COMMENTS_URL?>/assets/images/avatars/<?= get_comment_meta($comment->comment_ID, 'serma_avatar', true) ?>.svg?v=<?=SERMA_POST_COMMENTS_VERSION?>">
        <div class="w-full">
            <h4 class="text-black text-primary font-semibold text-lg">
                <?= $comment->comment_author ?>
                <?php if(is_user_logged_in() && current_user_can('administrator')) : ?>
                <button class="float-right" serma-comment-id="<?= $comment->comment_ID ?>" serma-comment-btn-delete>
                    <span class="fas fa-times text-gray-400"></span>
                </button>
                <?php endif ?>
                <br>
            </h4>
            <p class="text-gray-500 font-light capitalize mb-4">
                <?= get_comment_date('F j, Y \•\ g:i a', $comment) ?>
            </p>
            <p class="text-black mr-2"><?= $comment->comment_content ?></p>
        </div>

    </div>

</div>

<?php endforeach ?>