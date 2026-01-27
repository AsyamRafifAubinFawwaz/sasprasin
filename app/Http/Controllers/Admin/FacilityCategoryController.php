<?php

namespace App\Http\Controllers\Admin;

use App\Constants\PriorityConst;
use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Usecase\Admin\FacilityCategoryUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FacilityCategoryController extends Controller
{
    protected array $page = [
        'route' => 'facility-categories',
        'title' => 'Manajemen Kategori Fasilitas',
    ];

    protected string $baseRedirect;

    public function __construct(
        protected FacilityCategoryUsecase $usecase,
    ) {
        $this->baseRedirect = 'admin/'.$this->page['route'];
    }

    public function index(Request $request): View|Response
    {
        $data = $this->usecase->getAll([
            'keywords' => $request->get('keywords'),
            'priority_level' => $request->get('priority_level'),
            'example_items' => $request->get('example_items'),
        ]);
        $data = $data['data']['list'] ?? [];

        $categories = $this->usecase->getAll(['no_pagination' => true]);
        $categories = $categories['data']['list'] ?? [];

        return view('_admin.facility_category.index', [
            'data' => $data,
            'page' => $this->page,
            'keywords' => $request->get('keywords'),
            'priority_level' => $request->get('priority_level'),
            'example_items' => $request->get('example_items'),
            'priority' => PriorityConst::getList(),
        ]);
    }

    public function add(): View|Response
    {
        return view('_admin.facility_category.add', [
            'page' => $this->page,
            'priority' => PriorityConst::getList(),
        ]);
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $process = $this->usecase->create(
            data: $request,
        );

        if ($process['success']) {
            return redirect()
                ->route('admin.facility-categories.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function update(int $id): View|RedirectResponse|Response
    {
        $data = $this->usecase->getByID($id);

        if (empty($data['data'])) {
            return redirect()
                ->intended($this->baseRedirect)
                ->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        return view('_admin.facility_category.update', [
            'data' => $data['data']['data'],
            'priority' => PriorityConst::getList(),
            'id' => $id,
            'page' => $this->page,
        ]);
    }

    public function doUpdate(int $id, Request $request): RedirectResponse
    {
        $process = $this->usecase->update(
            data: $request,
            id: $id,
        );

        if ($process['success']) {
            return redirect()
                ->route('admin.facility-categories.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function delete(int $id): RedirectResponse
    {
        $process = $this->usecase->delete(id: $id);

        if ($process['success']) {
            return redirect()
                ->route('admin.facility-categories.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
        }

        return redirect()
            ->route('admin.facility-categories.index')
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }
}
