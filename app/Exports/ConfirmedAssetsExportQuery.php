<?php

namespace App\Exports;

use App\Services\AssetService;
use Exception;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConfirmedAssetsExportQuery implements FromQuery, WithMapping, WithHeadings, WithChunkReading, ShouldAutoSize, WithTitle, WithStyles, WithEvents
{
    use Exportable;

    protected array $filters;
    private AssetService $assetService;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        $this->assetService = new AssetService();
    }

    public function query()
    {
        return $this->assetService->getConfirmedAssetsBuilder($this->filters, 'created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            ['List of Confirmed Assets'], // Title row
            [
                'Confirmed At',
                'Asset Name',
                'Tag Number',
                'Status',
                'Comment',
                'Confirmed By',
                'Email'
            ]
        ];
    }

    public function map($row): array
    {
        return [
            $row->created_at?->toDateTimeString() ?? 'N/A',
            $row->asset?->name ?? 'N/A',
            $row->asset?->tag_number ?? 'N/A',
            $row->real_status ?? 'N/A',
            $row->comment ?? 'N/A',
            $row->confirmedBy?->name ?? 'N/A',
            $row->asset?->email ?? 'N/A',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function title(): string
    {
        return 'Confirmed Assets';
    }

    /**
     * @throws Exception
     */
    public function styles(Worksheet $sheet): array
    {
        // Merge and center the title
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Bold title and header
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A2:G2')->getFont()->setBold(true);

        // Align "Confirmed By" column (Column F) to the left for data rows
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle("F3:F{$highestRow}")
            ->getAlignment()
            ->setHorizontal('left');

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $row = 3; // Start from first data row
                while (true) {
                    $status = $sheet->getCell("D{$row}")->getValue(); // Column D = Status

                    if ($status === null) {
                        break; // Exit when data ends
                    }

                    if (strtolower($status) === 'received') {
                        $sheet->getStyle("D{$row}")
                            ->getFont()
                            ->getColor()
                            ->setRGB('008000'); // green
                    } elseif (strtolower($status) === 'not received') {
                        $sheet->getStyle("D{$row}")
                            ->getFont()
                            ->getColor()
                            ->setRGB('FF0000'); // red
                    }

                    $row++;
                }
            },
        ];
    }
}
