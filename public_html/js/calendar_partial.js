$("#date_filter_view").datepicker({
    dateFormat: "DD, d 'de' MM, yy",
    showOn: "button",
    buttonImage: "/img/eventos_calendar_icon.png",
    buttonImageOnly: true,
    //setDate:defaultDate,
    //altField: "#d",
    //altFormat: "@",
    showAnim: 'slideDown',
    onSelect : function(dateText, inst)
    {
        var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

        $('#d').val(epoch);
        $('#form_busca_eventos').submit();
    },
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
        ],
    dayNamesMin: [
    'D','S','T','Q','Q','S','S','D'
    ],
    dayNamesShort: [
    'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
    ],
    monthNames: [  'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
    'Outubro','Novembro','Dezembro'
    ],
    monthNamesShort: [
    'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
    'Out','Nov','Dez'
    ],
    nextText: 'Próximo',
    prevText: 'Anterior'
});