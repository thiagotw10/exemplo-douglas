function removeRegister(id) {
    $.ajax({
        method: "GET",
        url: `${CI.base_url}Usuario/remove`,
        data: {
            "id": id
        },
        dataType: "json"
    }).done(function (data) {
        swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Excluído!',
            showConfirmButton: false,
            timer: 1500
        })
        .then(function() {
                location.reload();
            });
    }).fail(function () {
        swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Erro!',
            text: 'Impossível estabelecer conexão com o servidor',
            showConfirmButton: false,
            timer: 1500
        });
    });
}