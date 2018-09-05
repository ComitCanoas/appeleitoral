function CalculaDistancia() {

    $('#resposta_cidade_saida').attr('href', 'eleicoes/' + $("#cidade_saida option:selected").val() + '/cidade');
    $('#resposta_cidade_destino').attr('href', 'eleicoes/' + $("#cidade_destino option:selected").val() + '/cidade');

    $.get('cidade/saida/' + $("#cidade_saida option:selected").val(), function (cidade_saida) {

        var cidade_saida_pesquisa = cidade_saida.nome + " " + cidade_saida.estado_id.nome;

        var populacao_saida = cidade_saida.populacao;
        var eleitores_saida = cidade_saida.numero_eleitores;

        $('#cidade_saida_populacao').text(populacao_saida.toLocaleString());
        $('#cidade_saida_eleitores').text(eleitores_saida.toLocaleString());
        $(".esconder_cidade_saida").show();
        $(".esconder_cidade_destino").show();

        $.get('cidade/destino/' + $("#cidade_destino option:selected").val(), function (cidade_destino) {
            var cidade_destino_pesquisa = cidade_destino.nome + " " + cidade_destino.estado_id.nome;

            var populacao_destino = cidade_destino.populacao;
            var eleitores_destino = cidade_destino.numero_eleitores;

            $('#cidade_destino_populacao').text(populacao_destino.toLocaleString());
            $('#cidade_destino_eleitores').text(eleitores_destino.toLocaleString());

            $("#mostra_resultado_carregamento").show(); // Mostra o "aguarde".
            $('#resultado_carregamento').removeClass('alert-danger').addClass('alert-success').html('Aguarde...');


            // Instancia o DistanceMatrixService.
            var service = new google.maps.DistanceMatrixService();
            // Executa o DistanceMatrixService.
            service.getDistanceMatrix({
                origins: [cidade_saida_pesquisa],
                destinations: [cidade_destino_pesquisa], // Destino
                travelMode: google.maps.TravelMode.DRIVING, // Modo (DRIVING | WALKING | BICYCLING)
                unitSystem: google.maps.UnitSystem.METRIC // Sistema de medida (METRIC | IMPERIAL)
            }, callback); // Vai chamar o callback
            ;

        });
    });
}

function calculaCidadeAoCarregarPagina(cidade){
    // Instancia o DistanceMatrixService.
    var service = new google.maps.DistanceMatrixService();
    // Executa o DistanceMatrixService.
    service.getDistanceMatrix({
        origins: [cidade],
        destinations: [cidade], // Destino
        travelMode: google.maps.TravelMode.DRIVING, // Modo (DRIVING | WALKING | BICYCLING)
        unitSystem: google.maps.UnitSystem.METRIC // Sistema de medida (METRIC | IMPERIAL)
    }, callback); // Vai chamar o callback
    ;
}

// Tratar o retorno do DistanceMatrixService
function callback(response, status) {
    // Verificar o status.
    if (status != google.maps.DistanceMatrixStatus.OK) { // Se o status não for "OK".
        $("#mostra_resultado_carregamento").show();
        $("#resultado_carregamento").removeClass('alert-success').addClass('alert-danger').html(status);
    } else { // Se o status for "OK".
        $("#mostra_resultado_carregamento").hide(); // Remove o "aguarde".
        $("#resultado_cidades").show(); // Mostra o resultado das cidades.

        // Popula os campos.
        $("#resposta_cidade_saida").text(response.originAddresses);
        $("#resposta_cidade_destino").text(response.destinationAddresses);
        $("#resposta_distancia").text(response.rows[0].elements[0].distance.text);
        var tempo = response.rows[0].elements[0].duration.text;
        tempo = tempo.replace("day", "dia").replace("hour", "hora").replace("mins", "minutos");
        $("#resposta_tempo").text(tempo);

        //Atualizar o mapa.
        $("#map").attr("src", "https://maps.google.com/maps?key=AIzaSyAUYQ2SVSeO93ffaGQ2gEcwjozEYPaSOgk&saddr=" + response.originAddresses + "&daddr=" + response.destinationAddresses + "&output=embed");
    }
}