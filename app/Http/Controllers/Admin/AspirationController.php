<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Usecase\Admin\AspirationUsecase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    protected array $page = [
        'route' => 'aspirations',
        'title' => 'Data Aspirasi',
    ];

    public function __construct(
        protected AspirationUsecase $usecase
    ) {
    }

    public function index(Request $request): View
    {
        $data = $this->usecase->getAll([
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'search' => $request->get('search'),
            'date' => $request->get('date'),
        ]);

        return view('_admin.aspirations.index', [
            'page' => $this->page,
            'data' => $data['data']['list'] ?? [],
        ]);
    }

    public function detail(int $id): View
    {
        $data = $this->usecase->getById($id);

        return view('_admin.aspirations.detail', [
            'page' => $this->page,
            'data' => $data['data']['data'] ?? null,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $data = $this->usecase->getAllForPdf([
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'search' => $request->get('search'),
            'date' => $request->get('date'),
        ]);

        $pdf = Pdf::loadView('_admin.aspirations.pdf', [
            'data' => $data['data']['list'] ?? [],
            'filters' => [
                'status' => $request->get('status'),
                'priority' => $request->get('priority'),
                'search' => $request->get('search'),
                'date' => $request->get('date'),
            ],
        ]);

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-aspirasi-' . date('Y-m-d') . '.pdf');
    }

    public function doUpdate(Request $request, int $complaintId): RedirectResponse
    {
        $process = $this->usecase->updateAspiration($request, $complaintId);
        if ($process['success']) {
            return redirect()
                ->route('admin.aspirations.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
        }

        return redirect()
            ->route('admin.aspirations.index')
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }
}
