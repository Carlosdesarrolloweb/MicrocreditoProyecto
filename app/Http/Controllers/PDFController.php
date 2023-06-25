<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Cliente;
use App\Models\Garantia;
use App\Models\Prestamo;
/* use App\Models\User; */

class PDFController extends Controller
{
    public function generatePDF($cliente_id)
    {
        // Crea una instancia de TCPDF
        $pdf = new TCPDF();

        // Define el formato y las propiedades del PDF
        $pdf->SetCreator('Tu aplicación Laravel');
        $pdf->SetAuthor('Tu nombre');
        $pdf->SetTitle('PDF con imágenes');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);

        // Agrega una página al PDF
        $pdf->AddPage();

        // Obtiene el cliente con sus imágenes desde la base de datos
        $cliente = Cliente::findOrFail($cliente_id);

        // Establece las coordenadas y el tamaño de cada imagen en el PDF
        $x = 25;
        $y = 60;
        $width = 150;
        $height = 150;

          // Ruta de la imagen del logo
        $logoPath = public_path('logomicrocredito.JPG');

          // Coordenadas y tamaño de la imagen del logo
        $logoX = 160;  // Ajusta la posición X de la imagen del logo
        $logoY = 15;   // Ajusta la posición Y de la imagen del logo
        $logoWidth = 40;   // Ajusta el ancho de la imagen del logo
        $logoHeight = 40;  // Ajusta la altura de la imagen del logo

          // Agrega la imagen del logo al PDF
        $pdf->Image($logoPath, $logoX, $logoY, $logoWidth, $logoHeight);

        // Agrega las imágenes del cliente al PDF
        if ($cliente->foto) {
            $imagen = $cliente->foto->direccion_imagen;
            $pdf->Image($imagen, $x, $y, $width, $height);
        }

        if ($cliente->fotocarnet) {
            $imagen = $cliente->fotocarnet->direccion_imagen;
            $pdf->Image($imagen, $x, $y + $height + 10, $width, $height);
        }

        if ($cliente->fotorecibo) {
            $imagen = $cliente->fotorecibo->direccion_imagen;
            $pdf->Image($imagen, $x, $y + ($height + 10) * 2, $width, $height);
        }

        if ($cliente->fotocroquis) {
            $imagen = $cliente->fotocroquis->direccion_imagen;
            $pdf->Image($imagen, $x, $y + ($height + 10) * 3, $width, $height);
        }

        // Genera el contenido del PDF y lo devuelve como una respuesta de descarga
        return $pdf->Output('imagenes.pdf', 'D');
    }

    public function generatePDFgarantia($garantia_id)
    {
        // Crea una instancia de TCPDF
        $pdf = new TCPDF();

        // Define el formato y las propiedades del PDF
        $pdf->SetCreator('Tu aplicación Laravel');
        $pdf->SetAuthor('Tu nombre');
        $pdf->SetTitle('PDF con imágenes y datos de garantía');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);

        // Agrega una página al PDF
        $pdf->AddPage();

        // Obtiene la garantía desde la base de datos
        $garantia = Garantia::findOrFail($garantia_id);

        // Obtiene los datos adicionales de la garantía
        $cliente = Cliente::findOrFail($garantia->id_cliente);
        $prestamo = Prestamo::findOrFail($garantia->id_prestamo);

        // Establece las coordenadas y el tamaño de la imagen en el PDF
        $x = 25;
        $y = 60;
        $width = 150;
        $height = 150;

        // Ruta de la imagen del logo
        $logoPath = public_path('logomicrocredito.JPG');

        // Coordenadas y tamaño de la imagen del logo
        $logoX = 160;  // Ajusta la posición X de la imagen del logo
        $logoY = 15;   // Ajusta la posición Y de la imagen del logo
        $logoWidth = 40;   // Ajusta el ancho de la imagen del logo
        $logoHeight = 40;  // Ajusta la altura de la imagen del logo

        // Agrega la imagen del logo al PDF
        $pdf->Image($logoPath, $logoX, $logoY, $logoWidth, $logoHeight);

        // Agrega los datos de la garantía al PDF
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Garantía: ' . $garantia->garantia, 0, 1);
        $pdf->Cell(0, 10, 'Valor Prenda: Bs.' . $garantia->Valor_Prenda, 0, 1);
        $pdf->Cell(0, 10, 'Detalle Prenda: ' . $garantia->Detalle_Prenda, 0, 1);
        $pdf->Cell(0, 10, 'Estado: ' . $garantia->estado, 0, 1);
        $pdf->Cell(0, 10, 'Fecha de Entrega: ' . $garantia->fecha_entrega, 0, 1);
        $pdf->Cell(0, 10, 'Cliente: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente, 0, 1);
        $pdf->Cell(0, 10, 'Préstamo: Bs.' . $prestamo->monto_prestamo . ' - Plazo en meses: ' . $prestamo->duracion_prestamo, 0, 1);
/*         $usuario = $garantia->usuario;
        $pdf->Cell(0, 10, 'Usuario: ' . $usuario->name, 0, 1); */

        // Agrega la imagen de la garantía al PDF
        if ($garantia->foto) {
            $imagen = $garantia->foto->direccion_imagen;
            $pdf->Image($imagen, $x, $y + 30, $width, $height);
        }

        // Genera el contenido del PDF y lo devuelve como una respuesta de descarga
        return $pdf->Output('garantia.pdf', 'D');
    }
}
