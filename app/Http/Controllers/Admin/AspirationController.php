<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Usecase\Admin\AspirationUsecase;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
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

    public function update(Request $request, int $complaintId): RedirectResponse
    {
        $process = $this->usecase->updateAspiration($request, $complaintId);

        return redirect()
            ->back()
            ->with(
                $process['success'] ? 'success' : 'error',
                $process['message']
            );
    }
}
