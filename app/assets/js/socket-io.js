var socket = io.connect('http://localhost:3000');

socket.on('connect', function () {
    console.log("Cliente conectado com o servidor");
});

socket.on('disconnect', function () {
    console.log("Cliente desconectado com o servidor.");
});

socket.on('chatMessage', function (data) {
    output(data);
});

socket.on('chatCallback', function (data) {
    if (zWindow.isOpen("chat-" + data.morador.id)) {
        output(data);
        socket.emit('readCallback');
    } else {
        var nome = data.morador.nome;
        nome = nome.substring(0, nome.indexOf(" "));

        $.gritter.add({
            title: data.morador.apartamento + " - " + nome + ' disse: ',
            text: data.mensagem + "<br /><a style='color: white;font-weight: bold' href='javascript:chat.open(" + data.morador.id + ")'>Clique aqui para entrar no chat</a>",
            sticky: false,
            time: (1000 * 10)
        });
    }
});

socket.on('readCallback', function () {
    $("p.checkable").each(function () {
        $(this).html("<img src=\"../img/double-check-green.png\" />");
    });
});

socket.on('deliveryCallback', function (id) {
    $("#ckb_" + id).html("<img src=\"../img/double-check.png\" />");
});


function output(json) {
    var _comment = "<div class=\"msg-time-chat\">";
    _comment += "<a href=\"#\" class=\"message-img\"><img class=\"avatar\" src=\"@AVATAR@\" alt=\"\"></a>";
    _comment += "<div class=\"message-body msg-@INOUT@\">";
    _comment += "<span class=\"arrow\"></span>";
    _comment += "<div class=\"text\">";
    _comment += "<p class=\"attribution\"><a href=\"#\">@NOME@</a> @DATAENVIO@</p>";
    _comment += "<p>@MSG@</p>";
    _comment += "<p class=\"text-right checkable\" id=\"ckb_@ID@\">@CHECK@</p>";
    _comment += "</div>";
    _comment += "</div>";
    _comment += "</div>";

    var comment = _comment;
    if (json.morador === null || json.morador === undefined) {
        comment = comment.replace("@AVATAR@", "../img/ic_launcher.png");
        comment = comment.replace("@NOME@", "Eu");
        comment = comment.replace("@INOUT@", "in");
    } else {
        comment = comment.replace("@AVATAR@", "../img/avatar-mini.jpg");
        comment = comment.replace("@NOME@", json.morador.nome);
        comment = comment.replace("@INOUT@", "out");
    }
    if (json.dataLeitura !== undefined && json.dataLeitura !== null) {
        comment = comment.replace("@CHECK@", "<img src=\"../img/double-check-green.png\" />");
    } else {
        if (json.dataEntrega !== undefined && json.dataEntrega !== null) {
            comment = comment.replace("@CHECK@", "<img src=\"../img/double-check.png\" />");
        } else {
            if (json.dataEnvio !== undefined && json.dataEnvio !== null) {
                comment = comment.replace("@CHECK@", "<i class=\"fa fa-times text-danger\"></i>");
            } else {
                comment = comment.replace("@CHECK@", "<img src=\"../img/check.png\" />");
            }
        }
    }

    comment = comment.replace("@ID@", json.id);
    comment = comment.replace("@DATAENVIO@", textUtils.dateISOFormat(json.dataEnvio, "dd/MM/yyyy HH:mm"));
    comment = comment.replace("@MSG@", json.mensagem);
    $(".timeline-messages").append(comment);

    if (bottomOfChat) {
        $(".timeline-messages").animate({scrollTop: $('.timeline-messages')[0].scrollHeight}, 0);
    }
}

$(function () {
    $(".timeline-messages").niceScroll({styler: "fb", cursorcolor: "#6D6C6C", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled: false, cursorborder: ''});

    $("#message").keyup(function (e) {
        var code = e.which;
        if (code === 13) {
            chat.send();
        }
    });

    if ($(".timeline-messages").length > 0) {
        $('.timeline-messages').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
                bottomOfChat = true;
            } else {
                bottomOfChat = false;
            }
        });
        $(".timeline-messages").animate({scrollTop: $('.timeline-messages')[0].scrollHeight}, 0);
    }
});

var bottomOfChat = false;
var chat = {
    send: function () {
        var msg = $("#message").val();
        if ($.trim(msg) === "")
            return;
        $("#message").val("");

        socket.emit('chatMessage',
                {
                    "mensagem": msg,
                    "morador": {
                        "id": parseInt($("#morador").val(), 10)
                    }
                }
        );
    },
    open: function (id) {
        var _width = 500;
        var _heigth = 600;
        var top = (screen.height - (_heigth + 110)) / 2;
        var left = (screen.width - _width) / 2;
        var parametros = 'width=' + _width + ',height=' + _heigth + ',scrollbars=1,resizable=1,left=' + left + ',screenX=' + left + ',top=' + top + ',screenY=' + top + ',menubar=0,toolbar=0';
        var janela = zWindow.open("openNotificacaoDireta?notificacaoDireta.morador.id=" + id, 'chat-' + id, parametros);
        janela.focus();
    }
};