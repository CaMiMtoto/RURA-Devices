<?php

namespace App\Livewire\Assets;

use App\Exports\ConfirmedAssetsExportQuery;
use App\Services\AssetService;
use Exception;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ConfirmedAssets extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortCol = 'created_at';
    public string $dir = 'desc';
    public int $perPage = 10;
    public string $startDate = '';
    public string $endDate = '';
    private AssetService $assetService;

    public function __construct()
    {
        $this->assetService = new AssetService();
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'sortCol' => ['except' => 'created_at'],
        'dir' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'startDate' => ['except' => ''],
        'endDate' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function updatingStartDate(): void
    {
        $this->resetPage();
    }

    public function updatingEndDate(): void
    {
        $this->resetPage();
    }

    public function handleSort(string $col): void
    {
        if ($this->sortCol === $col) {
            $this->dir = $this->dir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortCol = $col;
            $this->dir = 'asc';
        }
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportToExcel(): BinaryFileResponse
    {
        $filters = [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'search' => $this->search,
        ];

        return Excel::download(new ConfirmedAssetsExportQuery($filters), 'confirmed_assets.xlsx');
    }

    public function render(): \Illuminate\Contracts\View\View|Application|View
    {
        $assets = $this->assetService
            ->getConfirmedAssetsBuilder([
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
                'search' => $this->search,
            ], $this->sortCol, $this->dir)
            ->paginate($this->perPage);
        return view('livewire.assets.confirmed-assets', [
            'assets' => $assets,
        ]);
    }
}
