$(document).ready(function() {
    $('.edit-comment-btn').click(function() {
        var commentId = $(this).data('comment-id');
        var commentText = $(this).data('comment-text');

        // Define o ID do comment no hidden input.
        $('#comment_id').val(commentId);

        // Preenche o campo de texto do comment no textarea do modal.
        $('#updateCommentModal').find('input[name="text"]').val(commentText);
    });
});