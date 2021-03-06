# Ayuda para imprimir

## Flujo de los datos para imprimir

Primero llamamos desde algún lugar de nuestro código donde queremos imprimir, al **Printaitor** haciendo 'Printaitor::send($dataToView, $printerName, $viewName)'
$dataToView es un array con todas las variables que podran ser accedidas desde el archivo .ctp correspondiente a esa impresora fiscal
$printerName es el nombre que identifica a la impresora fiscal
$viewName es, básicamente el nombre de lo que yo quiero imprimir


## DRIVER Y MODEL (atributos configurables para cada impresora)
El driver selecciona la View
El Model selecciona el Helper a utilizar

$printerName se basa en el campo $driverName configurado para esa impresora. De acuerdo a ese valor selecciona el /lib/DriverView, o sea, la vista que debe renderizar.
Por el momento el tipo de driver disponible es Fiscal o Receipt, y es facilmente extensible desde la carpeta /lib/DriverView.
Por último tenemos los helpers, que son variantes dentro del un driver para diferentes modelos de impresoras. O sea, por ejemplo, podemos tener una impresora que usa el driver Fiscal y el modelo es Hasa441. Se pueden agregar nuevos modelos desde la carpeta /Lib/DriverView/Helper.
Por lo tanto, cada impresora debe tener configurado un driver y un modelo.


No siempre la variable $viewName va a tener su correspondencia con un archivo .ctp. Se pueden dar ocaciones en las que esa impresora no presente una vista para la acción requerida. En ese caso, no pasa nada, el sistema sigue funcionando y no envia ni excepciones ni nada.

## OUTPUT
La salida, llamada "Output", indica la salida del ticket. Se configura desde el archivo de configuración. Es extensible creando nuevos Outputs en lib/PrinterOutput
 	Las posibilidades son:
    	'Printers.output = Database'. [POR DEFECTO]  manda la salida a la base de datos
    	'Printers.output = File' imprime a un archivo
    	'Printers.output = Cups' manda la salida a una impresora CUPS
	


 /*-/*/-/-*/*/-*/*/-/*- AFIP -*/-*/-*/-*/-*/-*/-*/-*/-*/-*/-*/


Web Service de Autenticación y Autorización (WSAA)


Con respecto al WSAA, recomendamos leer el Manual para el Desarrollador en:

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/Especificacion_Tecnica_WSAA_1.2.0.pdf


Las URLs del WSAA son:
TESTING: https://wsaahomo.afip.gov.ar/ws/services/LoginCms
PRODUCCION: https://wsaa.afip.gov.ar/ws/services/LoginCms


Para poder autenticarse ante el WSAA necesita obtener un certificado digital 
X.509 emitido por la CA (Autoridad Certificante) de AFIP, a tales efectos, 
deberá generar una clave privada y un CSR (Certificate Signing Request). 
Deberá enviar el CSR, en el entorno de Testing a través de correo a la cuenta 
webservices@afip.gov.ar, y en el entorno de Producción a través de nuestro 
portal http://www.afip.gov.ar siguiendo los pasos indicados en los siguientes 
documentos:

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/wsaa_obtener_certificado_produccion_20100507.pdf

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/wsaa_asociar_certificado_a_wsn_produccion_20100507.pdf


Para generar su clave privada y su CSR, recomendamos leer el siguiente howto:

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/cert-req-howto.txt



Tratando de simplificar el desarrollo del cliente consumidor del WSAA, hemos 
contribuido con ejemplos de código fuente abierto, que pueden ser utilizados
tal como están, o bien utilizarse como guía. Hemos contribuido con fuentes en 
VB.Net, en Java y en PHP. Los mismos pueden ser obtenidos desde:

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/ejemplos/

Aclaramos que estas contribuciones son solamente ejemplos, no asumimos ningun 
compromiso en cuanto a su funcionalidad ni incluyen ningun tipo de garantia ni
soporte tecnico.



Herramientas de Análisis / Depuración
Consultar el siguiente link:

http://wswhomo.afip.gov.ar/fiscaldocs/WSAA/HerramientasUtiles.pdf



