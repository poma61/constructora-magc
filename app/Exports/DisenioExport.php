<?php

namespace App\Exports;

use App\Models\Disenio;
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


class DisenioExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{

    protected $disenio;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
        $this->disenio = $this->getDisenio();
    }

    public function collection()
    {
        return  collect($this->disenio);
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        // Verificar si hay datos en la colección
        if ($this->disenio->isNotEmpty()) {
            // Obtener el primer modelo en la colección
            $first_data = $this->disenio->first();
            // Obtener los nombres de las columnas de la tabla
            return  array_keys($first_data->toArray());
        }
        return [];
    }

    public function getDisenio()
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
            $disenio = Disenio::join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select(
                    'clientes.nombres as Cliente, nombres',
                    'clientes.apellido_paterno as Cliente, apellido paterno',
                    'clientes.apellido_materno as Cliente, apellido materno',
                    'disenios.requerimiento as Requerimiento',
                     // Formatear la fecha, solo funciona para mysql DATE_FORMAT
                     //si el sistema tiene otro motor de base de datos puede buscar el equivalente de DATE_FORMAT
                    DB::raw('DATE_FORMAT(disenios.fecha, "%d-%m-%Y") as "Fecha"'),
                    'disenios.arquitecto as Arquitecto',
                )
                ->where('clientes.status', true)
                ->where('disenios.status', true)
                ->whereYear('disenios.fecha', $this->request->input('year'))
                ->get();
        } else {
            $disenio = Disenio::join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select(
                    'clientes.nombres as Cliente, nombres',
                    'clientes.apellido_paterno as Cliente, apellido paterno',
                    'clientes.apellido_materno as Cliente, apellido materno',
                    'disenios.requerimiento as Requerimiento',
                     // Formatear la fecha, solo funciona para mysql DATE_FORMAT
                     //si el sistema tiene otro motor de base de datos puede buscar el equivalente de DATE_FORMAT
                    DB::raw('DATE_FORMAT(disenios.fecha, "%d-%m-%Y") as "Fecha"'),
                    'disenios.arquitecto as Arquitecto',
                )
                ->where('clientes.status', true)
                ->where('disenios.status', true)
                ->whereYear('disenios.fecha', $this->request->input('year'))
                ->whereMonth('disenios.fecha', $meses[$this->request->input('month')])
                ->get();
        }

        return $disenio;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Agregar un título en la primera fila antes de los datos
                $event->sheet->setCellValue('A1', "Reporte de diseños");
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
                $all_cells_range = 'A2:' . Coordinate::stringFromColumnIndex(count($this->headings())) . $this->disenio->count() + 2;
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
                        'color' => ['rgb' => "006F8E"],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],);

                // Definir los colores para las filas intercaladas
                $color_even = '49D8FF';
                $color_odd = 'A6E0F0';

                // Obtener el número total de filas de datos
                $total_rows = $this->disenio->count();

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
