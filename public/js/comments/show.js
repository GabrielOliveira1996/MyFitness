const buttons = document.querySelectorAll('.show-comments-button');

buttons.forEach(button => {
    button.addEventListener('click', function(event) {
        const postId = event.target.getAttribute('data-post-id');

        const commentsContainer = document.getElementById(`comments-${postId}`);
        const commentButtons = document.getElementById(`comment-buttons-${postId}`);
        
        if (commentsContainer.classList.contains('hide-comments')) {
            commentsContainer.classList.remove('hide-comments');
            commentButtons.classList.remove('btn-outline-light');
            commentButtons.classList.add('btn-primary');
        } else {
            commentsContainer.classList.add('hide-comments');
            commentButtons.classList.remove('btn-primary');
            commentButtons.classList.add('btn-outline-light');
        }
    });
});