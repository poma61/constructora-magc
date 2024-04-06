<?php

namespace App\Exports;

use App\Models\Obra;
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


class ObraExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{

    protected $obra;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
        $this->obra = $this->getObra();
    }

    public function collection()
    {
        return  collect($this->obra);
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        // Verificar si hay datos en la colección
        if ($this->obra->isNotEmpty()) {
            // Obtener el primer modelo en la colección
            $first_data = $this->obra->first();
            // Obtener los nombres de las columnas de la tabla
            return  array_keys($first_data->toArray());
        }
        return [];
    }

    public function getObra()
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
            $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select(
                    'ciudades.city_name as Nombre ciudad',
                    'grupos.grup_number as Grupo',
                    'clientes.nombres as Cliente, nombres',
                    'clientes.apellido_paterno as Cliente, apellido paterno',
                    'clientes.apellido_materno as Cliente, apellido materno',
                    'contratos.n_contrato as N° de contrato',
                    'obras.estado as Estado',
                    'obras.monto_pago_contratista as Monto pago contratista',
                    DB::raw('DATE_FORMAT(obras.fecha_inicio, "%d-%m-%Y") as "Fecha inicio"'),
                    DB::raw('DATE_FORMAT(obras.fecha_finalizacion, "%d-%m-%Y") as "Fecha finalizacion"'),
                    'obras.descripcion as Descripcion',
                )
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('obras.status', true)
                ->where('ciudades.city_name',  $this->request->input('ciudad'))
                ->whereYear('obras.fecha_inicio', $this->request->input('year'))
                ->get();
        } else {
            $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select(
                    'ciudades.city_name as Nombre ciudad',
                    'grupos.grup_number as Grupo',
                    'clientes.nombres as Cliente, nombres',
                    'clientes.apellido_paterno as Cliente, apellido paterno',
                    'clientes.apellido_materno as Cliente, apellido materno',
                    'contratos.n_contrato as N° de contrato',
                    'obras.estado as Estado',
                    'obras.monto_pago_contratista as Monto pago contratista',
                    DB::raw('DATE_FORMAT(obras.fecha_inicio, "%d-%m-%Y") as "Fecha inicio"'),
                    DB::raw('DATE_FORMAT(obras.fecha_finalizacion, "%d-%m-%Y") as "Fecha finalizacion"'),
                    'obras.descripcion as Descripcion',
                )
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('obras.status', true)
                ->where('ciudades.city_name',  $this->request->input('ciudad'))
                ->whereYear('obras.fecha_inicio', $this->request->input('year'))
                ->whereMonth('obras.fecha_inicio', $meses[$this->request->input('month')])
                ->get();
        }

        return $obra;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Agregar un título en la primera fila antes de los datos
                $event->sheet->setCellValue('A1', "Reporte de obras");
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
                $all_cells_range = 'A2:' . Coordinate::stringFromColumnIndex(count($this->headings())) . $this->obra->count() + 2;
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
                        'color' => ['rgb' => "8C00FF"],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],);

                // Definir los colores para las filas intercaladas
                $color_even = 'B565F7';
                $color_odd = 'D5ABF7';

                // Obtener el número total de filas de datos
                $total_rows = $this->obra->count();

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
