const buttons = document.querySelectorAll('.show-comments-button');

buttons.forEach(button => {
    button.addEventListener('click', function(event) {
        const postId = event.target.getAttribute('data-post-id');

        const commentsContainer = document.getElementById(`comments-${postId}`);

        if (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') {
            commentsContainer.style.display = 'block';
        } else {
            commentsContainer.style.display = 'none';
        }
    });
});