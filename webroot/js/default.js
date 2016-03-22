
//jQuery for page scrolling feature - requires jQuery Easing plugin
$(document).ready(function(){

    /* Rolagem da barra de navegação */
    $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    /* File Input bootstrap style */
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' arquivos selecionados' : label;
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    });

   //plugin de data
	$('.datepicker').datetimepicker({
        locale: 'pt-br',
        format: 'DD/MM/YYYY'
    });

    //Carrega os itens do Select em cascata
    $('.cascade').change( function(){
        var d = $(this).attr('data-destino');
        var u = $(this).attr('data-url');
        var v = $(this).val();
        $(d).attr('disabled', false);
        $(d).load(u+v);
    });

    //Carrega os dados do paciente quando se digita o CPF
    $('.getCPF').blur( function(){
        var u = $(this).attr('data-url');
        var v = $(this).val();

        $.getJSON({
          url: 'getPaciente/'+v
        }).done(function(data) {
            $.each(data, function(k,v) {
                if(k=='TP_SEXO' || k=='TP_SANGUINEO'){
                    $("option[value='"+v+"']").prop('selected', true);
                } else if(k=='DT_NASCIMENTO') {
                    v = new Date(v.substr(0, 10));
                    $('input[name='+k+']').val((v.getDate()+1) + '/' + (v.getMonth() + 1) + '/' + v.getFullYear());
                } else {
                    $('input[name='+k+']').val(v);
                }
            })
        });
    });

    $("#cirurgia1").autocomplete({
        minLength: 3,
        source: function(request, response) {
            $.getJSON("getCirurgia/"+$("#cirurgia1").val() +"/"+$("#sexo").val(), { },  response);
        },
        select: function( event, ui ) {
            $('#listaCirurgia1').html('<div class="alert alert-info" role="alert" style="padding:5px 8px; margin:8px 0 0 0;"><span class="pull-right" style="cursor:pointer;" onclick="this.parentElement.remove();"><i class="fa fa-close "></i> Excluir</span>'+ui.item.label+'<input type="hidden" name="CD_CIRURGIA" value="'+ui.item.value+'"></div>');
            $(this).val('');
            event.preventDefault();
        }
    });

    $("#cirurgia2").autocomplete({
        minLength: 3,
        source: function(request, response) {
            $.getJSON("getCirurgia/"+$("#cirurgia2").val() +"/"+$("#sexo").val(), { },  response);
        },
        select: function( event, ui ) {
            $('#listaCirurgia2').append('<div class="alert alert-warning" role="alert" style="padding:5px 8px; margin:8px 0 0 0; "><span class="pull-right" style="cursor:pointer;" onclick="this.parentElement.remove();"><i class="fa fa-close "></i> Excluir</span>'+ui.item.label+'<input type="hidden" name="CD_CIRURGIA_EXTRA[]" value="'+ui.item.value+'"></div>');
            $(this).val('');
            event.preventDefault();
        }
    });

});

$(window).load(function(){

});

/* File Input bootstrap style */
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
