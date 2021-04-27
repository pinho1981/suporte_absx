jQuery(document).ready(function() {
    $(document).on('click', '.edit', function() {
        $('#id_form').val($(this).data('id'));
        $('#id_assunto').val($(this).data('assunto'));
        var desc = $(this).data('descricao');
        console.log(desc);      

        $('#id_descricao').text(desc);       

        $('#id_status').val($(this).data('status'));

        var data = $(this).data('created_at');
        var dataFormatada = data.replace(/(\d*)-(\d*)-(\d*).*/, '$3-$2-$1');

        $('#id_created_at').val(dataFormatada);
    });
    
    $(document).on('click', '.delete', function() {
        $('#id_form_delet').val($(this).data('id'));
        $('.email_user_delet').text($(this).data('email'));
    });


    $('[data-toggle="tooltip"]').tooltip();


    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});