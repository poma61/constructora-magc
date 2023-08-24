<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;


class ClienteExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;
    protected $column_names = [];
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return  collect($this->data);
    }

    public function headings(): array
    {
        // Verificar si hay datos en la colección
        if ($this->data->isNotEmpty()) {
            // Obtener el primer modelo en la colección
            $first_data = $this->data->first();
            // Obtener los nombres de las columnas de la tabla
            $column_names = array_keys($first_data->toArray());
            $this->column_names = $column_names;
            return $column_names;
        }
        return [];
    }



    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Verificar si el encabezado tiene al menos una columna y no está vacío
                if ($this->column_names) {
                    $styleArray = [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'color' => ['rgb' => '009BFF'] // Color 
                        ],
                    ];

                    // Aplicar estilo a las celdas de encabezado de columna
                    foreach ($this->column_names as $column_names) {
                        $cellCoordinate = Coordinate::stringFromColumnIndex(array_search($column_names, $this->column_names) + 1) . '1';
                        $event->sheet->getStyle($cellCoordinate)->applyFromArray($styleArray);
                    }
                }
            },
        ];
    }
}
