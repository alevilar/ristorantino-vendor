(function($) {
    var elContainer = document.getElementById("arqueoContainer"),
            $arqSaldo = $("#ArqueoSaldo"),
            $arqInicial = $("#ArqueoImporteInicial"),
            $arqIngreso = $("#ArqueoIngreso"),
            $arqEgreso = $("#ArqueoEgreso"),
            $arqOtrosIngresos = $("#ArqueoOtrosIngresos"),
            $arqOtrosEgresos = $("#ArqueoOtrosEgresos"),
            $arqImporteFinal = $("#ArqueoImporteFinal"),
            classError = 'panel-danger',
            classWarning = 'panel-warning',
            classSuccess = 'panel-success'
            ;


    function $v($el) {
        var val = new Number($el.val());
        return val;
    }


    function toggleClassPorSaldo () {
        var saldo = $arqSaldo.val();
        var $container = $(elContainer);
        if (saldo == 0) {
            $container.removeClass(classWarning);
            $container.removeClass(classError);
            $container.addClass(classSuccess);
        } else {
            if (Math.abs(saldo) < 11) {
                $container.removeClass(classSuccess);
                $container.removeClass(classError);
                $container.addClass(classWarning);
            } else {
                $container.removeClass(classSuccess);
                $container.removeClass(classWarning);
                $container.addClass(classError);
            }
        }
    }
    
    function completarSaldo () {
        var saldo = $v($arqInicial) + $v($arqIngreso) - $v($arqEgreso) + $v($arqOtrosIngresos) - $v($arqOtrosEgresos) - $v($arqImporteFinal);
        $arqSaldo.val(parseInt(saldo*100)/100);
    }

    function calcularSaldo () {
        completarSaldo();
        toggleClassPorSaldo();
    }


    
    

    $(function() {
        
        // imprimir cierre Z en ajax
        $("#btn-imprimir-z").bind('click', function(){
            $.get(this.href);
            return false;
        });
        
        
        // recalcular saldo
        $('input','#ArqueoAddForm').bind('keyup', calcularSaldo);
        
        // si es Nuevo arqueo, poner el valor del saldo en su input
        if ((typeof $('#ArqueoId').val() == 'string') && !$('#ArqueoId').val()) {
            completarSaldo();
        }
        
        
        // el boton esta afuera del formulario
        $('#btn-submit').bind('click', function(){
//           $('#ArqueoAddForm').submit();
        });
        
        
        $('#ArqueoAddForm').bind('submit', function() {
            // para que envie el saldo que esta disabled, lo habilito antes del submit
            $(this).find(':input').removeAttr('disabled');
        });


        $("#ArqueoHacerCierreZeta").change(function() {
            if (this.checked) {
                $('.mostrar_zeta').show('fade');
            } else {
                $('.mostrar_zeta').hide('fade');
            }

        });
        
        $("#ArqueoImporteFinal").bind('focus',function(){
            $("#billetines").show('fade');
        });
        
        $('#ZetaMontoNeto').bind('keyup', function(){
            var valor = new Number(this.value);
            $('#ZetaMontoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        $('#ZetaNotaCreditoNeto').bind('keyup', function(){
            var valor = new Number(this.value);
            $('#ZetaNotaCreditoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        
        function sumarBilletes(){
            var b100 = new Number($('#BilletesB100').val())*100;
            var b50 = new Number($('#BilletesB50').val())*50;
            var b20 = new Number($('#BilletesB20').val())*20;
            var b10 = new Number($('#BilletesB10').val())*10;
            var b5 = new Number($('#BilletesB5').val())*5;
            var b2 = new Number($('#BilletesB2').val())*2;
            var b1 = new Number($('#BilletesB1').val())*1;
            var b0 = new Number($('#BilletesB0').val())*0.5;
            var bA = new Number($('#BilletesBA').val());
            
            $('#ArqueoImporteFinal').val(b100+b50+b20+b10+b5+b2+b1+b0+bA);
            $('#ArqueoImporteFinal').trigger('keyup');
        }
        
        $('#BilletesB100').bind('keyup', sumarBilletes);
        $('#BilletesB50').bind('keyup', sumarBilletes);
        $('#BilletesB20').bind('keyup', sumarBilletes);
        $('#BilletesB10').bind('keyup', sumarBilletes);
        $('#BilletesB5').bind('keyup', sumarBilletes);
        $('#BilletesB2').bind('keyup', sumarBilletes);
        $('#BilletesB1').bind('keyup', sumarBilletes);
        $('#BilletesB0').bind('keyup', sumarBilletes);
        $('#BilletesBA').bind('keyup', sumarBilletes);

    });


})(jQuery);
