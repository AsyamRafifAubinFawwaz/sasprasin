<?php

namespace App\Exports;

use App\Constants\ProgressConst;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AspirationExport implements FromCollection, ShouldAutoSize, WithColumnWidths, WithDrawings, WithHeadings, WithMapping, WithStyles
{
    public function __construct(protected $data) {}

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Nama Siswa',
            'NISN',
            'Lokasi',
            'Kategori',
            'Prioritas',
            'Deskripsi',
            'Gambar Pengaduan',
            'Status',
            'Bukti Selesai',
            'Feedback',
        ];
    }

    public function map($row): array
    {
        $priority = match ((int) $row->priority) {
            3 => 'Tinggi',
            2 => 'Sedang',
            default => 'Rendah',
        };

        $status = match ((int) $row->status) {
            ProgressConst::PENDING => 'Pending',
            ProgressConst::IN_PROGRESS => 'In Progress',
            ProgressConst::DONE => 'Done',
            ProgressConst::REJECT => 'Reject',
            default => 'Pending',
        };

        return [
            $row->id,
            Carbon::parse($row->created_at)->format('d/m/Y H:i'),
            $row->student_name ?? 'N/A',
            $row->nisn ?? 'N/A',
            $row->location,
            $row->category_name,
            $priority,
            $row->description,
            '', 
            $status,
            '', 
            $row->feedback ?? '-',
        ];
    }

    public function drawings(): array
    {
        $drawings = [];
        $rowNumber = 2; 

        foreach ($this->data as $item) {
            if ($item->image && file_exists(public_path($item->image))) {
                try {
                    $drawing = new Drawing();
                    $drawing->setName('Gambar Pengaduan');
                    $drawing->setDescription('Gambar Pengaduan');
                    $drawing->setPath(public_path($item->image));
                    $drawing->setHeight(80);
                    $drawing->setCoordinates('I'.$rowNumber);
                    $drawing->setOffsetX(10);
                    $drawing->setOffsetY(10);
                    $drawings[] = $drawing;
                } catch (\Exception $e) {
                }
            }

            if ($item->aspiration_image && file_exists(public_path($item->aspiration_image))) {
                try {
                    $drawing = new Drawing();
                    $drawing->setName('Bukti Selesai');
                    $drawing->setDescription('Bukti Selesai');
                    $drawing->setPath(public_path($item->aspiration_image));
                    $drawing->setHeight(80);
                    $drawing->setCoordinates('K'.$rowNumber);
                    $drawing->setOffsetX(10);
                    $drawing->setOffsetY(10);
                    $drawings[] = $drawing;
                } catch (\Exception $e) {
                }
            }
            $rowNumber++;
        }

        return $drawings;
    }

    public function columnWidths(): array
    {
        return [
            'I' => 20,
            'K' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $count = count($this->data);
        for ($i = 2; $i <= $count + 1; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(70);
            $sheet->getStyle('A'.$i.':L'.$i)->getAlignment()->setVertical('center');
        }

        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }
}
