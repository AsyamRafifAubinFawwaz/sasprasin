<?php

namespace App\Http\Controllers\Admin;

use App\Constants\DatabaseConst;
use App\Constants\ResponseConst;
use App\Exports\AspirationExport;
use App\Http\Controllers\Controller;
use App\Usecase\Admin\AspirationUsecase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AspirationController extends Controller
{
    protected array $page = [
        'route' => 'aspirations',
        'title' => 'Data Aspirasi',
    ];

    public function __construct(
        protected AspirationUsecase $usecase
    ) {}

    public function index(Request $request): View
    {
        $data = $this->usecase->getAll([
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'search' => $request->get('search'),
            'location' => $request->get('location'),
            'facility_category_id' => $request->get('facility_category_id'),
            'date' => $request->get('date'),
        ]);

        $locations = DB::table(DatabaseConst::LOCATION)->get();
        $categories = DB::table(DatabaseConst::FACILITY_CATEGORY)->get();

        return view('_admin.aspirations.index', [
            'page' => $this->page,
            'data' => $data['data']['list'] ?? [],
            'locations' => $locations,
            'categories' => $categories,
        ]);
    }

    public function detail(int $id): View
    {
        $data = $this->usecase->getById($id);

        return view('_admin.aspirations.detail', [
            'page' => $this->page,
            'data' => $data['data']['data'] ?? null,
            'student' => $data['data']['student'] ?? null,
            'toolsmans' => $data['data']['toolsmans'] ?? [],
            'assignment' => $data['data']['assignment'] ?? null,
        ]);
    }

    public function doAssign(Request $request, int $id): RedirectResponse
    {
        $process = $this->usecase->doAssign($request, $id);

        if ($process['success']) {
            return redirect()
                ->back()
                ->with('success', $process['message']);
        }

        return redirect()
            ->back()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function exportPdf(Request $request)
    {
        $data = $this->usecase->getAllForPdf([
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'search' => $request->get('search'),
            'date' => $request->get('date'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'export_all' => $request->get('export_all'),
        ]);

        $pdf = Pdf::loadView('_admin.aspirations.pdf', [
            'data' => $data['data']['list'] ?? [],
            'filters' => [
                'status' => $request->get('status'),
                'priority' => $request->get('priority'),
                'search' => $request->get('search'),
                'date' => $request->get('date'),
                'start_date' => $request->get('start_date'),
                'end_date' => $request->get('end_date'),
                'export_all' => $request->get('export_all'),
            ],
        ]);

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-aspirasi-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->usecase->getAllForExcel([
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'search' => $request->get('search'),
            'date' => $request->get('date'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'export_all' => $request->get('export_all'),
        ]);

        return Excel::download(
            new AspirationExport($data['data']['list'] ?? []),
            'laporan-aspirasi-' . date('Y-m-d') . '.xlsx'
        );
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
