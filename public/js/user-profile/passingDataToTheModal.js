$(document).ready(function() {
    $('.edit-post-btn').click(function() {
        var postId = $(this).data('post-id');
        var postText = $(this).data('post-text');

        // Define o ID do post no hidden input.
        $('#post_id').val(postId);

        // Preenche o campo de texto do post no textarea do modal.
        $('#updatePostModal').find('input[name="text"]').val(postText);
    });
});