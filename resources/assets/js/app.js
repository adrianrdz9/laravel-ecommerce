


$(document).ready(function(){
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.ajaxOptions = {type: 'PUT'};

    $(".set-guide-number").editable();

    $(".set-status").editable({
        source:[
            {value:"creado", text:"Creado"},
            {value:"enviado", text:"Enviado"},
            {value:"recibido", text:"Recibido"}
        ]
    });

    $(".add-to-cart").on("submit", function(ev){
        ev.preventDefault();

        var $form = $(this);
        var $button = $form.find("[type='submit']");

        //Peticion AJAX

        $.ajax({
            url: $form.attr("action"),
            method: $form.attr("method"),
            data: $form.serialize(),
            beforeSend: function(){
                $button.val("Cargando...");
            },
            success: function(data){
                $button.css("background-color", "#00c853").val("Agregado");

                setTimeout(function(){
                    restartButton($button)
                }, 1500);

                $(".circle-shopping-cart").html("( "+data.products_count+" )").addClass("highlight");
            },
            error: function(){
                $button.css("background-color", "#d50000").val("Hubo un error");

                setTimeout(function(){
                    restartButton($button)
                }, 1500);
            }
        });

        function restartButton($button){
            $button.val("Agregar al carrito").attr("style", "");
            $(".circle-shopping-cart").removeClass("highlight");
        }

        return false;
    });


});
