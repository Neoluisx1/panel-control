<?php

namespace App\Traits;

use App\Models\Branch;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Models\Config;
use App\Models\Setting;
use Mike42\Escpos\CapabilityProfile;

trait PrinterTrait
{

    // recibo con logo
    public function PrintTicketTest()
    {
        $nombreImpresora = "EPSON-T20III";
        $connector = new WindowsPrintConnector($nombreImpresora);
        $printer = new Printer($connector);

        //dd(dirname(public_path()));
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo = EscposImage::load("logoo.png");
        $printer->bitImage($logo); //$printer -> graphics($logo);

        $printer->text("\n");
        $printer->setTextSize(3, 3);
        $printer->text("FastFOOD\n");
        $printer->setTextSize(2, 2);
        $printer->text("Comida Express\n\n");

        $printer->text("FastFOOD\n");


        $printer->feed(3);
        $printer->cut();
        $printer->close();

         /*
        $nombreImpresora = "tm20";
        $connector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        $impresora->text("Imprimiendo\n");
        $impresora->text("ticket\n");
        $impresora->text("desde\n");
        $impresora->text("Laravel\n");
        $impresora->setTextSize(1, 1);
        $impresora->text("https://parzibyte.me");
        $impresora->feed(5);
        $impresora->close();
        */
    }


    // imprimir recibo de la venta
    public function printSaleTicket($sale)
    {
        $config = Config::first();

        $nombreImpresora = $config->printer_name;
        $connector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($connector);
        $suc = Branch::latest()->first();

        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        $impresora->text("ZONATURA" . "\n");
        $impresora->setTextSize(1, 1);
        $impresora->text("TIENDA NATURISTA" . "\n");
        $impresora->text("SUCURSAL: $suc->name " . "\n");
        $impresora->text($suc->address  . "\n");
        $impresora->text("HORARIO DE 9AM-9PM LUNES-DOMINGO" . "\n");
        $impresora->text("TEL 4778693759" . "\n\n");

        $impresora->setJustification(Printer::JUSTIFY_LEFT);
        $impresora->text("FOLIO : T" . str_pad($sale->id, 11, "0", STR_PAD_LEFT) . "\n");
        $impresora->text("FECHA : $sale->created_at" . "\n");
        $impresora->text("CAJERO: " . $sale->user->name . "\n\n");



        $maskHead = "%-17s %-5s %-8s";
        $maskRow = "%-.18s %-4s %-5s";

        $headersName = sprintf($maskHead, 'DESCRIPCION', 'CANT', 'PRECIO');
        $impresora->text("********************************" . "\n");
        $impresora->text($headersName . "\n");
        $impresora->text("********************************" . "\n");
        //products
        foreach ($sale->details as $item) {
            $fillSpacesProduct = str_pad($item->product->description, 18, " ", STR_PAD_RIGHT);
            $fillSpacesQty =  number_format(str_pad($item->quantity, 3, " ", STR_PAD_LEFT), 0);
            $fillSpacesImporte = '$' . number_format(str_pad($item->quantity * $item->price, 5, " ", STR_PAD_LEFT), 2);

            $row = sprintf($maskRow,  $fillSpacesProduct, $fillSpacesQty, $fillSpacesImporte);
            $impresora->text($row . "\n");
        }
        $impresora->text("================================" . "\n");
        $impresora->text("CLIENTE: " . $sale->cliente->name . ' ' . $sale->cliente->lastname . "\n\n");

        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->text("NO. DE ARTICULOS $sale->items" . "\n");

        $impresora->setJustification(Printer::JUSTIFY_LEFT);
        $impresora->text("TOTAL.......... Bs." . number_format($sale->total, 2) . "\n");
        $impresora->text("EFECTIVO....... Bs." . number_format($sale->cash, 2) . "\n");
        if (($sale->tcredit + $sale->tdebit) > 0) $impresora->text("TARJETA........ Bs." . number_format($sale->tcredit + $sale->tdebit, 2) . "\n");
        if ($sale->points > 0) $impresora->text("M.USADO........ Bs." . number_format($sale->points, 2) . "\n");
        if ($sale->points_added > 0) $impresora->text("M.DEPOSITADO... Bs." . number_format($sale->points_added, 2) . "\n");
        if (strtoupper($sale->cliente->name) != 'PUBLICO') $impresora->text("SALDO MONEDERO. Bs." . number_format($sale->cliente->points, 2) . "\n");
        $impresora->text("CAMBIO......... Bs." . number_format($sale->change, 2) . "\n");

        $impresora->feed(3);

        //barcode
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->selectPrintMode();
        $impresora->setBarcodeHeight(40);
        $impresora->barcode(str_pad($sale->id, 12, "0", STR_PAD_LEFT), Printer::BARCODE_JAN13);
        //$impresora->barcode('D' . str_pad($sale->id, 12, "0", STR_PAD_LEFT), Printer::BARCODE_CODE128);
        $impresora->feed(2);

        $impresora->text($config->ticket_leyend . "\n");
        $impresora->text("luisfax.com" . "\n");

        $impresora->feed(4);
        $impresora->cut();
        $impresora->close();


    }

    public function PrintTicket($orderId)
    {
        $settings = Setting::first();

        if(!$settings) return; // si no hay settings cancelamos la impresión

        // "EPSON-T20III";
        $connector = new WindowsPrintConnector($settings->printer);
        $printer = new Printer($connector);


        /* Name of shop */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo = EscposImage::load($settings->logo);
        $printer->graphics($logo, Printer::IMG_DOUBLE_WIDTH);

        $printer->setTextSize(1, 1);
        $printer->text("$settings->name \n");
        $printer->selectPrintMode();
        $printer->text("$settings->address \n");
        $printer->text("$settings->phone \n\n");
        $printer->feed();


        /* Title of receipt */
        $printer->setEmphasis(true);
        $printer->text("Comprobante de Pago\n");
        $printer->setEmphasis(false);

        // headers
        $order = Order::find($orderId);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Pedido: $order->ticket \n");
        $printer->text("Fecha: " . Carbon::parse($order->created_at)->format('d/m/Y h:i:s A') ."\n");
        $printer->text("Cliente: ". $order->customer->name . "\n");



        /* Information for the receipt */
        $items = array();
        foreach($order->details as $detail){
            array_push($items, new item($detail->product->name .' x'.$detail->quantity, $detail->price));
        }

        $itemsQty = new item('Articulos', $order->items);
        $cash = new item('Efectivo', $order->cash, true);
        $total = new item('Total', $order->total, true);
        $change = new item('Cambio', number_format(($order->cash - $order->total),2), true);



        /* Items */
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("===============================================\n");
        $printer->setEmphasis(true);
        $concepts = new item('DESCRIPCION', 'IMPORTE', false);
        $printer->text($concepts->getAsString());
        $printer->setEmphasis(false);
        $printer->text("===============================================\n");
        foreach ($items as $item) {
            $printer->text($item->getAsString()); // for 58mm Font A / 32
        }
        $printer->text("-----------------------------------------------\n");
        $printer->text("\n");

        /* change */
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text($itemsQty->getAsString());
        //$printer->feed();


        /* cash and total */
        $printer->text($cash->getAsString());
        $printer->setEmphasis(true);
        $printer->text($total->getAsString());
        $printer->setEmphasis(false);
        //$printer->feed();

        /* change */
        $printer->text($change->getAsString());
        $printer->selectPrintMode();
        //$printer->feed();


        /* Footer */
    //  $date = "Monday 6th of April 2015 02:56:25 PM";
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("$settings->leyend \n");
        $printer->text("luisfax.com\n");
        $printer->feed(1);



        // Barcode
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $folio = str_pad($order->id, 7, "0", STR_PAD_LEFT);
        $printer->setBarcodeHeight(60); //altura del barcode
        $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
        $printer->barcode($folio, Printer::BARCODE_CODE39); //especificamos el estándar code39 (7 dígitos)
        $printer->feed(); // generamos 2 espacios/saltos de linea en papel





    //$printer->text($date . "\n");

        /* Barcode Default look */

    //$printer->barcode("ABC", Printer::BARCODE_CODE39);
    //$printer->feed();
    //$printer->feed();


/*
    $printer = new Printer($connector); // dirty printer profile hack !!
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->qrCode("https://luisfax.com/cupon", Printer::QR_ECLEVEL_M, 5);
    $printer->text("cupon\n");
    $printer->setJustification();
    $printer->feed();
    */


    /* Cut the receipt and open the cash drawer */
    $printer->cut();
    $printer->close();


}


}
class item
{

    // propiedades
    private $name;
    private $price;
    private $dollarSign;

    // constructor
    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->dollarSign = $dollarSign;
    }

    public function getAsString()
    {
        // string str_pad($string, $length, $pad_string, $pad_type)

        $rightCols = 10;
        $leftCols  = 36;

        if ($this->dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);


        $sign = ($this->dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);


        return "$left$right\n";
    }

    // método mágico / todos deben declararse como públicos
    public function __toString()
    {
        return $this->getAsString();
    }

}
