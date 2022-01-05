let serma_comment_select = document.querySelector('#serma-form-container [name="serma_avatar"]');
let serma_avatar_comment_preview = document.querySelector('#serma_avatar_comment_preview');
let serma_comment_btns = document.querySelectorAll('[serma-comment-btn-delete]');

document.querySelector('.select-wrapper').addEventListener('click', function () {
    this.querySelector('.select').classList.toggle('open');
})

let serma_avatar_options = document.querySelectorAll(".custom-option")

if (serma_avatar_options != null) {
    for (const option of serma_avatar_options) {
        option.addEventListener('click', function () {
            if (!this.classList.contains('selected')) {
                let data_value = this.getAttribute('data-value')
                let class_selected = this.parentNode.querySelector('.custom-option.selected')
                if (class_selected != null) {
                    class_selected.classList.remove('selected');
                }
                this.classList.add('selected');
                this.closest('.select').querySelector('.select__trigger span').textContent = data_value
                serma_comment_select.value = data_value
                serma_avatar_comment_preview.src = serma_post_comments_avatars_url + data_value + '.svg'
                serma_avatar_comment_preview.classList.remove('hidden')
            }
        })
    }

}

window.addEventListener('click', function (e) {
    const select = document.querySelector('.select')
    if (!select.contains(e.target)) {
        select.classList.remove('open');
    }
});

(function ($) {

    $('#serma-form-container').on('submit', (e) => {
        e.preventDefault()
        serma_send_comment({
            form_id: 'serma-form-container'
        })
    })

    if (serma_comment_btns != null) {
        for (const btn of serma_comment_btns) {
            btn.addEventListener('click', function (e) {
                serma_delete_comment({comment_id: btn.getAttribute('serma-comment-id')})
            })
        }

    }

    function serma_send_comment({ form_id = '', button_text_activate = true }) {
        let data = new FormData(document.getElementById(form_id))

        let button = $(`#${form_id} [serma-button]`)
        let button_text = $(`#${form_id} [serma-text]`)
        let message = $(`#${form_id} [serma-message]`)

        message.text('')
        button_text_activate ? button_text.text('Enviando...') : ''
        button.prop('disabled', 'true')

        fetch(serma_root_ajaxurl + 'serma_post_comments_create', {
            method: 'POST',
            body: data
        }).then(response => response.json())
            .then(res => {
                button.removeAttr('disabled')
                button_text_activate ? button_text.text('Enviar comentario') : ''
                switch (res.data.status) {
                    case 'success':
                        message.text('¡Has enviado tu comentario correctamente, será revisado y aprobado en caso de que cumpla con nuestras normativas!')
                        break;

                    default:
                        message.text(res.data.message)
                        break;
                }
            });
    }

    function serma_delete_comment({ comment_id = null }) {
        console.log(comment_id)
        if (comment_id == null) return false
        let comment_container = $(`[serma-comment-id=${comment_id}]`)
        fetch(serma_root_ajaxurl + 'serma_post_comments_delete', {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ comment_id })
        }).then(response => response.json())
            .then(res => {
                switch (res.data.status) {
                    case 'success':
                        comment_container.html('<p>El comentario se ha eliminado satisfactoriamente</p>')
                        break;

                    default:
                        break;
                }
            });
    }

})(jQuery);