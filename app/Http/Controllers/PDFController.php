<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\Cliente;
use App\Models\Garantia;
use App\Models\Prestamo;
use App\Models\Pago;
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

        // Genera las páginas para cada imagen del cliente
        $imagenes = [$cliente->foto, $cliente->fotocarnet, $cliente->fotorecibo, $cliente->fotocroquis];
        foreach ($imagenes as $imagen) {
            // Agrega una página al PDF
            $pdf->AddPage();

            // Agrega la imagen del logo al PDF en todas las páginas
            $pdf->Image($logoPath, $logoX, $logoY, $logoWidth, $logoHeight);

            // Agrega la imagen del cliente al PDF en la página actual
            if ($imagen) {
                $pdf->Image($imagen->direccion_imagen, $x, $y, $width, $height, '', '', '', false, 300);
            }
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
    public function generatePDFcliente($cliente_id)
    {
        // Obtén el cliente desde la base de datos
        $cliente = Cliente::findOrFail($cliente_id);

        // Obtén los pagos asociados al cliente
        $pagos = Pago::whereHas('prestamo', function ($query) use ($cliente_id) {
            $query->where('id_cliente', $cliente_id);
        })->get();

        // Calcula la deuda actual para cada pago
        $deudasActuales = [];
        foreach ($pagos as $pago) {
            $prestamoId = $pago->prestamo->id;
            $deudaActual = isset($deudasActuales[$prestamoId]) ? $deudasActuales[$prestamoId] : $pago->prestamo->monto_prestamo;
            $deudaActual -= $pago->monto_pago;
            $deudasActuales[$prestamoId] = $deudaActual;
            $pago->deuda_actual = $deudaActual;
        }

        // Crea una instancia de TCPDF
        $pdf = new TCPDF();

        // Agrega una página al PDF
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetY(80); // Ajusta la posición vertical del texto del cliente
        $pdf->Cell(0, 10, 'Cliente: ' . $cliente->nombre_cliente . ' ' . $cliente->apellido_cliente, 0, 1);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5);

        $logoPath = public_path('logomicrocredito.JPG');
        $logoX = 160;
        $logoY = 30; // Ajusta la posición vertical del logo
        $logoWidth = 40;
        $logoHeight = 40;
        $pdf->Image($logoPath, $logoX, $logoY, $logoWidth, $logoHeight);

        $pdf->SetFont('helvetica', 'B', 10);

        // Calcula la posición vertical inicial de la tabla de pagos
        $tablaPagosY = 95;
        $alturaFila = 7;
        $numeroPagos = count($pagos);
        $tablaAltura = $alturaFila * $numeroPagos;

        // Agrega los títulos de la tabla de pagos
        $pdf->SetY($tablaPagosY);
        $pdf->Cell(30, $alturaFila, 'Prestamo', 1, 0, 'C');
        $pdf->Cell(30, $alturaFila, 'Fecha de pago', 1, 0, 'C');
        $pdf->Cell(30, $alturaFila, 'Monto de pago', 1, 0, 'C');
        $pdf->Cell(30, $alturaFila, 'Deuda actual', 1, 0, 'C');
        $pdf->Cell(60, $alturaFila, 'Descripción', 1, 1, 'C');

        $pdf->SetFont('helvetica', '', 9);
        $posicionVertical = $tablaPagosY + $alturaFila;
        foreach ($pagos as $pago) {
            $pdf->SetY($posicionVertical);
            $pdf->Cell(30, $alturaFila, $pago->prestamo->monto_prestamo, 1, 0, 'C');
            $pdf->Cell(30, $alturaFila, $pago->fecha_pago, 1, 0, 'C');
            $pdf->Cell(30, $alturaFila, $pago->monto_pago, 1, 0, 'C');
            $pdf->Cell(30, $alturaFila, $pago->deuda_actual, 1, 0, 'C');
            $pdf->Cell(60, $alturaFila, $pago->descripcion, 1, 1, 'L');
            $posicionVertical += $alturaFila;
        }

        // Calcula la posición vertical de las líneas de firma
        $lineaFirmaY = $posicionVertical + $alturaFila * 2;

        // Agrega las líneas de firma al PDF
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetY($lineaFirmaY);

        // Línea de firma del cliente
        $pdf->Cell(60, 10, 'Firma del cliente:', 0, 1, 'L');
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 100, $pdf->GetY()); // Línea horizontal de firma

        $pdf->Ln(10); // Espacio entre las líneas de firma

        // Línea de firma de Microcréditos
        $pdf->Cell(80, 10, 'Firma de Microcréditos:', 0, 1, 'L');
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 100, $pdf->GetY()); // Línea horizontal de firma

        ob_end_clean(); // Limpia el búfer de salida antes de generar el PDF

        $pdf->Output('cliente.pdf', 'D'); // Genera el PDF con las líneas de firma

        return $pdf->Output('cliente.pdf', 'D');
    }
}
