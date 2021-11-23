function anotherDevice() {
    $.ajax({
        method: "GET",
        url: `${CI.base_url}Login/logoutAjax`,
        dataType: "json"
    }).done(function (data) {
        console.log(data);
        if (data.logout) {
            swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Conta acessada em outro dispositivo, sessão expirada!',
                showConfirmButton: false,
                timer: 3000
            }).then(function () {
                location.reload();
            });
        }
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