<?php

App::uses('Helper', 'View');
App::uses('FiscalPrinter', 'Printers.FiscalPrinter');




/**
 * Helps printing files in CUPS server
 * 
 * Implements one of the Printers Engines
 * It handles the logif of select what Engine to Use
 * based on configurations or methods that allow to change the current one
 * 
 * It work calling the send function
 *  Printaitor::send(array(
 *              'items' => array(
 *                          'prod1' => array('price' => 2.3),
 *                          'prod2' => array('price' => 5),
 *                  ),
 *              'client' => 'Robert Plant',
 *      ), 'theprinter', 'ticket') 
 * 
 * it builds the ticket.ctp view for the Fiscal Printer "theprinter" and renders the array into the view
 * Sends the view output to de PrinterOutput, by default is a CUPS server
 * 
 *
 * @author alejandro
 */
class Printaitor
{
  
    static $isLoad = false;


    /**
    *
    *   Objeto PrinterOutput
    *
    **/
    static $Output;
  
  /*  
    public static function setup( Model $printer , $id = null)
    {                
        
        if ( !self::$isLoad ) {
            if ( empty($outputEngine ) ) {
                $outputEngine = Configure::read('Printers.output');
            }
            // loads PrinterOutput Engine
            $po = $outputEngine;
            $po = empty( $po ) ? self::$defaultOutput : $po;
            self::_loadPrinterOutput( $po );

             // loads Fiscal Printer
            self::_loadFiscalPrinter();

            // loads Receipt Printers
            self::_loadReceiptPrinters();
        }
        
        self::$isLoad = true;
        
    }
    */

    
    /**
     * Fiscal close "X" (partial) or "Z" (daily close)
     * @param char $type 
     */
    public static function  close( $type = 'X', $printer = null) {
        $type = strtoupper($type);
        if ( $type == "X" || $type == "Z" ) {
            throw new NotImplementedException("Cierre $type fiscal sin implementar");    
        } else {
            throw new Exception("Cierre no válido. Los valores solo pueden ser o X o Z, se pasó $type como parámetro");
        }
    }
    
    
/**
 * Perform printing to the output creating the view and using the $PrinterOutput object
 *
 *  Ej:
 *  Printaitor::send(array(
 *              'items' => array(
 *                          'prod1' => array('price' => 2.3),
 *                          'prod2' => array('price' => 5),
 *                  ),
 *              'client' => 'Robert Plant',
 *      ), 'theprinterName', 'ticketViewName') 
 * 
 * 
 * @param Model $Model con la Model incializada a un ID especifico
 * @param string $printer_id or Id printer Key name to use with self::$ReceiptPrinters
 * @param string $viewName view file name like "ticket" from ticket.ctp
 * @return boolean returns the $PrinterOutput->send value
 */  
    public static function send( Model $Model = null, $printer_id, $viewName) {
        $outRes = false;
        App::uses('PrintaitorViewObj', 'Printers.Utility');

        // instanctia %this->Output
        self::__createOutput( $printer_id ); 

        // inicializa PrintaitorViewObj
        $printViewObj = new  PrintaitorViewObj( $Model, $printer_id, $viewName );        
        
        // callback antes de generar la vista
        self::$Output->beforeRender( $printViewObj ); 
       
        // genera la vista
        $genView = $printViewObj->getView();
        if ( $genView ) {            
            // ejecuta la salida del resultado de la vista
            $outRes = self::__sendOutput( $printViewObj );
        } else {
            throw new CakeException("La vista vino vacia");
        }
        return $outRes; 
    }
    

    

/**
 * Gets the name of the printer engine
 * 
 * @return string
 */    
    public static function getEngineName() {
        return self::$PrinterOutput->name;
    }    


    public static function __createOutput ( $printerId  ) {
        // cargar datos de la impresora
        $Printer = ClassRegistry::init("Printers.Printer");
        $Printer->recursive = -1;
        $printer = $Printer->read(null, $printerId);
        $outputName = $printer['Printer']['output'] . 'PrinterOutput';


        // cargar la Salida correspondiente segun la configuracion de la impresora
        App::uses($outputName, 'Printers.Lib/PrinterOutput');
        self::$Output = new $outputName;
    }
    

    /**
    *
    *   @param PrintaitorViewObj $PrintViewObj
    *
    **/
    public static function __sendOutput ( $printViewObj ) {
        
        return self::$Output->send( $printViewObj ); 
    }
 
    
    
/**
 * Instanciates an Engine for change Output Printing
 * 
 * @param string $outputType
 *              Actualmente pueden ser la opciones: "cups" o "file"
 * @return PrinterOutput or false
 */
    public static function _loadPrinterOutput( $outputType ) {
        $outputType = ucfirst(strtolower( $outputType ));
        $printerOutputName = $outputType."PrinterOutput";
                
        App::uses($printerOutputName, "Printers.PrinterOutput");
        self::$PrinterOutput = new $printerOutputName();
    }
    
  
    
        
/**
 * Logic for creating the view rendered.
 * 
 * @param array $data all vars that will be accesible into the view
 * @param string $printer_id name of the printer
 * @param string $templateName name of the view
 */    
    public static function getView( $printViewObj ) { 
        $data = $printViewObj->dataToView;
        $printer_id = $printViewObj->printerId;
        $templateName = $printViewObj->viewName;

        if (empty($printer_id)) {
            return -1;
        }

        
        $pluginPath = App::path('Lib', 'Printers');


        $driverName = $printViewObj->printer['Printer']['driver'];
        $driverModelName = $printViewObj->printer['Printer']['driver_model'];

        App::build(array('View' => array( $pluginPath[0] . '/DriverView')));

        $viewName = $driverName."Printer/$templateName";
        $View = new View();
        $View->set($data);
   
        $helperName = $driverModelName . $driverName.'Helper'    ;
        App::uses($helperName, 'Printers.Lib/DriverView/Helper');

        if (!class_exists($helperName)) {
            throw new MissingHelperException(array(
                'class' => $helperName,
                'plugin' => substr('Printers', 0, -1)
            ));
        }

        $View->PE = new $helperName($View);
        
        $View->printaitorObj = $printViewObj;

        try {
            $view = $View->render( $viewName, false );
            return $view;
        } catch (Exception $e) {
            if ($e->getCode() == 500 ) {
                CakeLog::write('error', 'No se pudo encontrar la View: '.$viewName . ' '.$e->getMessage());
                return false;
            } else {
                throw $e;
            }
        }
        
        return true;
    }
        
 
    
}
