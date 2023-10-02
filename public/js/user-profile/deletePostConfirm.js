document.getElementById('deletePostButton').addEventListener('click', function(){
    let postId = this.getAttribute('data-id');
    event.preventDefault();
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir post!',
        cancelButtonText: 'Não, cancelar!',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Excluído!',
            'Seu post foi excluído.',
            'success')
            setTimeout(function() {
                window.location.href = '/community/post/delete/' + postId;
            }, 2000);
        }
    });
});