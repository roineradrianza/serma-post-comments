<div id="serma_form_comment_container" class="container">
    <?=SERMA_POST_COMMENTS_TEMPLATE::show_template('forms/comment')?>
</div>
<div id="serma_comments_container" class="container">
    <div class="d-flex mb-10">
        <h3 class="text-xl text-black">
            <span class="far fa-comment-alt text-[#4AC989] fa-lg"></span> Comentarios (<?= count($comments) ?>)
        </h3>
    </div>
    <?=SERMA_POST_COMMENTS_TEMPLATE::show_template('loop/comments', ['comments' => $comments])?>
</div>