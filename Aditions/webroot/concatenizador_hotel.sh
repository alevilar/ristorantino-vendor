#!/bin/sh

SCRIPT_NAME=todos_hotel.js
SCRIPT_MIN_NAME=todos_hotel.min.js

rm $SCRIPT_NAME
rm $SCRIPT_MIN_NAME


cat js/jquery-1.6.4.js >> $SCRIPT_NAME
cat js/jquery.tmpl.min.js >> $SCRIPT_NAME
cat js/knockout-2.0.0.min.js >> $SCRIPT_NAME
cat js/knockout.mapping-2.0.debug.js >> $SCRIPT_NAME
cat js/moment-with-locales.min.js >> $SCRIPT_NAME
cat js/moment-range.js >> $SCRIPT_NAME
cat js/cake_saver.js >> $SCRIPT_NAME
cat js/risto.js >> $SCRIPT_NAME
cat js/adition.package.js >> $SCRIPT_NAME
cat js/mozo.class.js >> $SCRIPT_NAME
cat js/adicion.event_handler.js >> $SCRIPT_NAME
cat js/mesa.estados.class.js >> $SCRIPT_NAME
cat js/mesa.class.js >> $SCRIPT_NAME
cat js/comanda.class.js >> $SCRIPT_NAME
cat js/comanda_fabrica.class.js >> $SCRIPT_NAME
cat js/adicion.class.js >> $SCRIPT_NAME
cat js/producto.js >> $SCRIPT_NAME
cat js/categoria.js >> $SCRIPT_NAME
cat js/sabor.class.js >> $SCRIPT_NAME
cat js/cliente.class.js >> $SCRIPT_NAME
cat js/descuento.class.js >> $SCRIPT_NAME
cat js/pago.class.js >> $SCRIPT_NAME
cat js/detalle_comanda.class.js >> $SCRIPT_NAME
cat js/adicion.grilla.calendar.js >> $SCRIPT_NAME

#hotel
cat js/mesa.hotel.class_extend.js >> $SCRIPT_NAME
cat js/ko_adicion_model.js >> $SCRIPT_NAME

cat js/adition.events.js >> $SCRIPT_NAME
cat js/menu.js >> $SCRIPT_NAME
cat js/jquery.mobile-1.0.1.min.js >> $SCRIPT_NAME


chmod 755 $SCRIPT_NAME



SourceFiles=$SCRIPT_NAME


# Now call Google Closure Compiler to produce a minified version
curl -d output_info=compiled_code -d output_format=text -d compilation_level=SIMPLE_OPTIMIZATIONS --data-urlencode js_code@$SCRIPT_NAME "http://closure-compiler.appspot.com/compile" >> $SCRIPT_MIN_NAME
