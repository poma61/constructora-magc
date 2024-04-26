<?php

namespace App\Exports;

use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Grupo;
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


class ClienteExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    protected $cliente;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
        $this->cliente = $this->getCliente();
    }

    public function collection()
    {
        return  collect($this->cliente);
    }

    public function startCell(): string
    {
        return 'A2';
    }


    public function headings(): array
    {
        // Verificar si hay datos en la colección
        if ($this->cliente->isNotEmpty()) {
            // Obtener el primer modelo en la colección
            $first_data = $this->cliente->first();
            // Obtener los nombres de las columnas de la tabla
           return  array_keys($first_data->toArray());
        }
        return [];
    }

    public function getCliente()
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

        $ciudad = Ciudad::where('city_name', $this->request->input('ciudad'))->first();
        //Podriamos haber sacado el id del grupo del Auth::user()->onPersonal()
        //pero  se hace mas extenso el codigo ya que a que validar... si e administrador...
        //si administra los todos los grupos, entonces hagaramos directamente de la url
        //y los middleware protegen las rutas..segun el grupo que le corresponda al personal y segun el role que es      
        //en sintesis los middleware solo dejan acceder a las rutas que el personal tiene acceso  segun la ciudad y el grupo   
        $grupo = Grupo::where('id_ciudad', $ciudad->id)->where('grup_number', $this->request->input('grupo'))->first();

        if ($this->request->input('month') == 'todos') {
            $cliente =  Cliente::join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->where('clientes.status', true)
                ->where('clientes.id_grupo', $grupo->id)
                ->whereYear('clientes.fecha_reunion', $this->request->input('year'))
                ->select(
                    'grupos.grup_number as Grupo',
                    'ciudades.city_name as Ciudad',
                    'clientes.nombres as Nombres',
                    'clientes.apellido_paterno as Apellido paterno',
                    'clientes.apellido_materno as Apellido materno',
                    'clientes.n_de_contacto as N° de contacto',
                    'clientes.estado as Estado',
                    'clientes.descripcion as Descripcion',
                    'clientes.monto_inicial as Monto inicial',
                    // Formatear la fecha, solo funciona para mysql DATE_FORMAT
                    //si el sistema tiene otro motor de base de datos puede buscar el equivalente de DATE_FORMAT
                    DB::raw('DATE_FORMAT(clientes.fecha_reunion, "%d-%m-%Y") as "Fecha de reunion"'), 
                    'clientes.hora_reunion as Hora de reunion',
                    'clientes.seguimiento as Seguimiento',
                )
                ->get();
        } else {
            $cliente =  Cliente::join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->where('clientes.status', true)
                ->where('clientes.id_grupo', $grupo->id)
                ->whereYear('clientes.fecha_reunion', $this->request->input('year'))
                ->whereMonth('clientes.fecha_reunion', $meses[$this->request->input('month')])
                ->select(
                    'grupos.grup_number as Grupo',
                    'ciudades.city_name as Ciudad',
                    'clientes.nombres as Nombres',
                    'clientes.apellido_paterno as Apellido paterno',
                    'clientes.apellido_materno as Apellido materno',
                    'clientes.n_de_contacto as N° de contacto',
                    'clientes.estado as Estado',
                    'clientes.descripcion as Descripcion',
                    'clientes.monto_inicial as Monto inicial',
                     // Formatear la fecha, solo funciona para mysql DATE_FORMAT
                     //si el sistema tiene otro motor de base de datos puede buscar el equivalente de DATE_FORMAT
                    DB::raw('DATE_FORMAT(clientes.fecha_reunion, "%d-%m-%Y") as "Fecha de reunion"'), // Formatear la fecha
                    'clientes.hora_reunion as Hora de reunion',
                    'clientes.seguimiento as Seguimiento',
                )
                ->get();
        }

        return $cliente;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Agregar un título en la primera fila antes de los datos
                $event->sheet->setCellValue('A1', "Reporte de clientes");
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
                $allCells_range = 'A2:' . Coordinate::stringFromColumnIndex(count($this->headings())) . ($this->cliente->count() + 2);
                $event->sheet->getStyle($allCells_range)->applyFromArray([
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
                        'color' => ['rgb' => "FF8800"],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],);

                // Definir los colores para las filas intercaladas
                $color_even = 'FFAC4C';
                $color_odd = 'FFCD94';

                // Obtener el número total de filas de datos
                $total_rows = $this->cliente->count();

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
