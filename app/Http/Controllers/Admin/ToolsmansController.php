<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Usecase\Admin\ToolsmansUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ToolsmansController extends Controller
{
    protected array $page = [
        'route' => 'toolsmans',
        'title' => 'Manajemen Petugas',
    ];

    protected string $baseRedirect;

    public function __construct(
        protected ToolsmansUsecase $usecase,
    ) {
        $this->baseRedirect = 'admin/' . $this->page['route'];
    }

    public function index(Request $request): View|Response
    {
        $data = $this->usecase->getAll([
            'keywords' => $request->get('keywords'),
        ]);

        return view('_admin.toolsmans.index', [
            'data' => $data['data']['list'] ?? [],
            'page' => $this->page,
            'keywords' => $request->get('keywords'),
        ]);
    }

    public function add(): View|Response
    {
        return view('_admin.toolsmans.add', [
            'page' => $this->page,
        ]);
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $process = $this->usecase->create(data: $request);


        if ($process['success']) {
            return redirect()
                ->route('admin.toolsmans.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function detail(int $id): View|RedirectResponse|Response
    {
        $toolsman = $this->usecase->getById(id: $id);
        if (empty($toolsman['data'])) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        return view('_admin.toolsmans.detail', [
            'page' => $this->page,
            'data' => $toolsman['data']['data'],
            'tasks' => $toolsman['data']['tasks'] ?? [],
        ]);
    }

    public function update(int $id): View|RedirectResponse|Response
    {
        $toolsman = $this->usecase->getById(id: $id);
        if (empty($toolsman['data'])) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        return view('_admin.toolsmans.update', [
            'page' => $this->page,
            'data' => $toolsman['data']['data'],
            'tasks' => $toolsman['data']['tasks'] ?? [],
        ]);
    }

    public function doUpdate(int $id, Request $request): RedirectResponse
    {
        $process = $this->usecase->update(id: $id, data: $request);

        if ($process['success']) {
            return redirect()
                ->route('admin.toolsmans.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function delete(int $id): RedirectResponse
    {
        $process = $this->usecase->delete(id: $id);

        if ($process['success']) {
            return redirect()
                ->route('admin.toolsmans.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
        }

        return redirect()
            ->route('admin.toolsmans.index')
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }


    public function doResetPassword(int $id, Request $request): RedirectResponse
    {
        $process = $this->usecase->resetPassword(id: $id);

        if ($process['success']) {
            return redirect()
                ->route('admin.toolsmans.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_RESET_PASSWORD);
        }

        return redirect()
            ->back()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }
}
