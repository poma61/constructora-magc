<?php

namespace App\Exports;

use App\Models\Contrato;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class ContratoExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{

    protected $contrato;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
        $this->contrato = $this->getContrato();
    }

    public function collection()
    {
        return  collect($this->contrato);
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        // Verificar si hay datos en la colección
        if ($this->contrato->isNotEmpty()) {
            // Obtener el primer modelo en la colección
            $first_data = $this->contrato->first();
            // Obtener los nombres de las columnas de la tabla
            return  array_keys($first_data->toArray());
        }
        return [];
    }

    public function getContrato()
    {
        $meses = [
            'enero' => '01',
            'febrero' => '02',
            'marzo' => '03',
            'abril' => '04',
            'mayo' => '05',
            'junio' => '06',
            'julio' => '07',
            'agosto' => '08',
            'septiembre' => '09',
            'octubre' => '10',
            'noviembre' => '11',
            'diciembre' => '12',
        ];

        if ($this->request->input('month') == 'todos') {
            $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select(
                    'ciudades.city_name as Nombre ciudad',
                    'grupos.grup_number as Grupo',
                    'clientes.nombres as Nombres',
                    'clientes.apellido_paterno as Apellido paterno',
                    'clientes.apellido_materno as Apellido materno',
                    'contratos.n_contrato as N° de contrato',
                    DB::raw('DATE_FORMAT(contratos.fecha_firma_contrato,"%d-%m-%Y") as "Fecha de firma de contrato"'),
                    'contratos.monto_total_construccion as Monto total construccion',
                    'contratos.couta_inicial as Couta inicial',
                    'contratos.couta_mensual  as Couta mensual',
                    DB::raw('DATE_FORMAT(contratos.fecha_pago_couta_mensual, "%d-%m-%Y") as "Fecha de pago de couta mensual"'),
                    'contratos.descripcion',
                )
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('ciudades.city_name',  $this->request->input('ciudad'))
                ->whereYear('contratos.fecha_firma_contrato', $this->request->input('year'))
                ->get();
        } else {
            $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select(
                    'ciudades.city_name as Nombre ciudad',
                    'grupos.grup_number as Grupo',
                    'clientes.nombres as Nombres',
                    'clientes.apellido_paterno as Apellido paterno',
                    'clientes.apellido_materno as Apellido materno',
                    'contratos.n_contrato as N° de contrato',
                    DB::raw('DATE_FORMAT(contratos.fecha_firma_contrato,"%d-%m-%Y") as "Fecha de firma de contrato"'),
                    'contratos.monto_total_construccion as Monto total construccion',
                    'contratos.couta_inicial as Couta inicial',
                    'contratos.couta_mensual  as Couta mensual',
                    DB::raw('DATE_FORMAT(contratos.fecha_pago_couta_mensual, "%d-%m-%Y") as "Fecha de pago de couta mensual"'),
                    'contratos.descripcion',
                )
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('ciudades.city_name',  $this->request->input('ciudad'))
                ->whereYear('contratos.fecha_firma_contrato', $this->request->input('year'))
                ->whereMonth('contratos.fecha_firma_contrato', $meses[$this->request->input('month')])
                ->get();
        }

        return $contrato;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Agregar un título en la primera fila antes de los datos
                $event->sheet->setCellValue('A1', "Reporte de contratos");
                $event->sheet->setCellValue('B1', "Año= {$this->request->input('year')}");
                $event->sheet->setCellValue('C1', "Mes= {$this->request->input('month')}");
                // Estilo para el título
                $event->sheet->getStyle('A1:C1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                ]);

                // Aplicar el estilo de bordes a todas las celdas (incluido el encabezado)
                $all_cells_range = 'A2:' . Coordinate::stringFromColumnIndex(count($this->headings())) . $this->contrato->count() + 2;
                $event->sheet->getStyle($all_cells_range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN, // Estilo de borde delgado,// Estilo de borde delgado
                            'color' => ['rgb' => '000000'], // Color del borde (negro)
                        ],
                    ],
                    'font' => [
                        'size' => 12, // Tamaño de la fuente (en puntos)                   
                    ],
                ]);

                //aplicar estilo al encabezado
                $header_range = 'A2:' . Coordinate::stringFromColumnIndex(count($this->headings())) . '2';
                $event->sheet->getStyle($header_range)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => "2D58FF"],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],);

                // Definir los colores para las filas intercaladas
                $color_even = '5F80FF';
                $color_odd = 'A1B5FF';

                // Obtener el número total de filas de datos
                $total_rows = $this->contrato->count();

                for ($row_index = 3; $row_index <= $total_rows + 2; $row_index++) {
                    // Definir el color en función de si el índice de fila es par o impar
                    $color = ($row_index % 2 == 0) ? $color_even : $color_odd;

                    // Definir el rango de celdas para la fila actual
                    $data_range = 'A' . $row_index . ':' . Coordinate::stringFromColumnIndex(count($this->headings())) . $row_index;
                    // Aplicar el estilo al rango de celdas de la fila actual
                    $event->sheet->getStyle($data_range)->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'color' => ['rgb' => $color],
                        ],
                    ]);
                } //for


            }, //AfterSheet
        ];
    }
}
