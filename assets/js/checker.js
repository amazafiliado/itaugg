    let iniciar = new Audio('assets/sound/iniciar.mp3')
    let live = new Audio('assets/sound/live.mp3')
    let finalizar = new Audio('assets/sound/finalizar.mp3')
    $(document).ready(function () {
        $('#start').attr('disabled', null)
        $('#start').click(function () {
            $('#start').attr('disabled', 'disabled')
            var line = $('#lista').val().replace(',', '').split('\n')
            
            var total = line.length
            var apr = 0
            var rpv = 0
            var progresso = 0
            var porcentagem = 100/ total
            if(total >= 99999) {//controla o limite de db aqui
                   $.notify("Limite de linhas 5000.  🤢 🤣");
        arrowSize: 10;
                            return false;
                        }
            $('#status_checker').html("Iniciado.")
            $('#total').html(total);
            $("#lista").val(line.join("\n"));
            $('#stop').attr('disabled', null);
            line.forEach(function (value){
                
            if($("#lista").val() == "" || $("#lista").val() == null) {
                finalizar.play()
                $.notify("Por favor, coloque alguns e-mails e senha.")
                $('#start').attr('disabled', null)
                $('#stop').attr('disabled', 'disable')
                $('#clear').attr('disabled', 'disable')
                return false;
            }

            let NotificarLive = (msg) => {
                if (window.Notification && Notification.permission !== "denied") {
                    Notification.requestPermission(function(status) {
                        let n = new Notification(
                            'BlackSpace :)', 
                            {
                                body: msg,
                                icon: 'assets/img/alien.png'
                        })
                    })
                }
            }

            var ajaxCall = $.ajax({
                url: 'api.php',
                type: 'GET',
                data: 'lista=' + value ,
                success: function (data) {
                    var status = data.includes("Aprovada")

                    if (status) {
                        live.play()
                        removelinha()
                        NotificarLive("Se liga +1 Aprovada!")
                        $.notify("+1 Aprovada :)", "success")
                        $('#status_checker').html("Aprovada!")
                        document.querySelector("#aprovadas").innerHTML += data + "<br>"
                        apr++;
                        $('#aprovadas_cont').html(apr);
                    }
                    else
                    {
                        removelinha();
                        $('#status_checker').html("Reprovada!");
                        document.querySelector("#reprovadas").innerHTML += data + "<br>"
                        rpv++;
                        $('#reprovadas_cont').html(rpv);
                    }
                    progresso += porcentagem;
                    $("#progress-bar").width(progresso + "%");
                    $("#progresso").text(Math.round(progresso) + "%");
                    var fila = Number(apr) + Number(rpv);
                    if (fila === total) {
                        finalizar.play()
                        NotificarLive("Teste finalizado!")
                        $('#status_checker').html("Finalizado!")
                        openModal()
                        $('#start').attr('disabled', null);
                        $('#stop').attr('disabled', 'disabled');
                        
                    }
            }
        })
                $('#stop').click(function () {
                    ajaxCall.abort()
                    $('#start').attr('disabled', null);
                    $('#stop').attr('disabled', 'disabled')
                        var st = 'Parado!'
                    $('#status_checker').html(st)
                })
            })
        })
    })

    const removelinha = () => {
        let lines = $("#lista").val().split('\n')
        lines.splice(0, 1)
        $("#lista").val(lines.join("\n"))
    }
    
    const limpar = () => {
        if ($("#lista").val() === "") {
            iniciar.play()
            $.notify("Não tem nada pra limpar ae!")
            $('#start').attr('disabled', null)

        } else {
            $.notify("Lista limpa!")
            document.querySelector("#lista").value = ""
        }
    }

    const openModal = () => {
        Swal.fire({
            title: "<h1 style='color: white'> Teste finalizado! </h1>",
            html: '<h1 style="color: white; font: 20px Arial"> :) <h1>',
            background: '#202940',
            confirmButtonColor: '#716aca',
            buttons: {
                confirm: {
                    text: "Continuar",
                    value: true,
                    visible: true,
                    className: "btn btn-success",
                    closeModal: true
                }
            },
            imageUrl: 'assets/images/alien38.gif',
            imageWidth: 200,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }