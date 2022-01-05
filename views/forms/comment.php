<?php $current_user = SERMA_POST_COMMENTS_USER::get_current_user()?>
<!-- comment form -->
<div class="mt-6 mb-4">
    <form id="serma-form-container" class="w-full serma-comments-form-container rounded-lg px-12 pt-2">
        <?=SERMA_POST_COMMENTS::$nonce_field?>
        <input type="hidden" name="serma_post_id" value="<?= get_the_ID() ?>">
        <div class="flex flex-wrap -mx-3 mb-6">
            <h2 class="pt-3 pb-2 text-gray-800 text-2xl text-[#A28EEC]">Y tú ¿Qué opinas?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <?php if(!is_user_logged_in()): ?>
                    <div>
                        <input
                            class="text-gray-500 bg-white rounded border border-gray-200 leading-normal resize-none w-full h-12 py-2 px-3 font-medium focus:outline-none focus:bg-white placeholder-[#8D8D8D]"
                            type="text" name="serma_comment_full_name" id="serma_comment_full_name" placeholder="Nombre"
                            required>
                    </div>

                    <div>
                        <input
                            class="text-gray-500 bg-white rounded border border-gray-200 leading-normal resize-none w-full h-12 py-2 px-3 font-medium focus:outline-none focus:bg-white placeholder-[#8D8D8D]"
                            type="email" name="serma_comment_email" id="serma_comment_email"
                            placeholder="Correo electrónico" required>
                    </div>
                <?php else: ?>
                    <div>
                        Actualmente estás conectado como 
                        <span class="primary-text"><?= "{$current_user['user_login']}" ?></span>, 
                        <a href="<?= wp_logout_url(get_permalink()) ?>">
                            <span class="text-red-600">Cerrar sesión</span>
                        </a>
                    </div>
                <?php endif ?>

                <div>
                    <div class="select-wrapper">
                        <div class="select">
                            <div class="select__trigger placeholder-[#8D8D8D]">
                                <div class="d-flex align-center">
                                    <img id="serma_avatar_comment_preview" class="rounded-full hidden mr-2" alt="madre"
                                        src="<?=SERMA_POST_COMMENTS_URL?>/assets/images/avatars/madre.svg?v=<?=SERMA_POST_COMMENTS_VERSION?>"
                                        width="40px" height="40px">
                                    <span>Escoge un avatar</span>
                                </div>
                                <div class="arrow"></div>
                            </div>
                            <div class="custom-options">
                                <input type="hidden" name="serma_avatar" id="serma-avatar" value="">
                                <span class="custom-option" data-value="madre">
                                    <img class="rounded-full" alt="madre"
                                        src="<?=SERMA_POST_COMMENTS_URL?>/assets/images/avatars/madre.svg?v=<?=SERMA_POST_COMMENTS_VERSION?>"
                                        width="50px" height="50px">
                                </span>
                                <span class="custom-option" data-value="padre">
                                    <img class="rounded-full" alt="padre"
                                        src="<?=SERMA_POST_COMMENTS_URL?>/assets/images/avatars/padre.svg?v=<?=SERMA_POST_COMMENTS_VERSION?>"
                                        width="50px" height="50px">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-full mb-2 mt-6">
                <textarea
                    class="bg-white rounded border border-gray-200 leading-normal resize-none w-full py-2 px-4 font-medium placeholder-[#8D8D8D] focus:outline-none focus:bg-white h-[120px]"
                    name="serma_comment" placeholder='Escriba su mensaje aquí...' required></textarea>
            </div>
            <div class="flex justify-end mb-6">
                <button class="rounded bg-[#4AC989] px-6 py-3 white-text font-light" serma-button>
                    <span serma-text>
                        Enviar comentario
                    </span>
                </button>
            </div>
            <div class="mb-6">
                <p serma-message></p>
            </div>
        </div>
    </form>
</div>