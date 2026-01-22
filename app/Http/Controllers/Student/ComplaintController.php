<?php

namespace App\Http\Controllers\Student;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Usecase\Admin\FacilityCategoryUsecase as AdminFacilityCategoryUsecase;
use App\Usecase\Student\ComplaintUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    protected array $page = [
        'route' => 'complaints',
        'title' => 'Keluhan Saya',
    ];

    protected string $baseRedirect;

    public function __construct(
        protected ComplaintUsecase $usecase,
        protected AdminFacilityCategoryUsecase $FacilityCategoryUsecase
    ) {
        $this->baseRedirect = 'student/' . $this->page['route'];
    }

    public function index(Request $request): View|Response
    {
        $student = Auth::user();

        $data = $this->usecase->getByStudentId(studentId: $student->id, filterData: [
            'keywords' => $request->get('keywords'),
            'category_id' => $request->get('category_id'),
            'status' => $request->get('status'),
        ]);


        $facility = $this->FacilityCategoryUsecase->getAll(['no_pagination' => true])['data']['list'] ?? [];

        return view('_student.complaints.index', [
            'data' => $data['data']['list'] ?? [],
            'page' => $this->page,
            'keywords' => $request->get('keywords'),
            'facility_category_id' => $request->get('facility_category_id'),
            'facility' => $facility,
        ]);
    }

    public function add(): View|Response
    {
        $facility = $this->FacilityCategoryUsecase->getAll(['no_pagination' => true]);

        return view('_student.complaints.add', [
            'page' => $this->page,
            'facility' => $facility['data']['list'] ?? [],
        ]);
    }

    public function doCreate(Request $request): RedirectResponse
    {
        $request->merge(['student_id' => Auth::user()->id]);
        $process = $this->usecase->create(data: $request);

        if ($process['success']) {
            return redirect()
                ->route('student.complaints.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_CREATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function detail(int $id): View|RedirectResponse|Response
    {
        $complaint = $this->usecase->getById(id: $id);

        if (empty($complaint['data'])) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        if ($complaint['data']['data']->student_id !== Auth::user()->id) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::ERROR_MESSAGE_UNAUTHORIZED);
        }

        $facility = $this->FacilityCategoryUsecase->getAll(['no_pagination' => true])['data']['list'] ?? [];

        return view('_student.complaints.detail', [
            'page' => $this->page,
            'data' => $complaint['data']['data'],
            'logs' => $complaint['data']['logs'] ?? [],
            'facility' => $facility,
        ]);

    }

    public function update(int $id): View|RedirectResponse|Response
    {
        $complaint = $this->usecase->getById(id: $id);

        if (empty($complaint['data'])) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        if ($complaint['data']['data']->student_id !== Auth::user()->id) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::ERROR_MESSAGE_UNAUTHORIZED);
        }

        $facility = $this->FacilityCategoryUsecase->getAll(['no_pagination' => true])['data']['list'] ?? [];

        return view('_student.complaints.update', [
            'page' => $this->page,
            'data' => $complaint['data']['data'],
            'facility' => $facility,
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
                ->route('student.complaints.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_UPDATED);
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
    }

    public function delete(int $id): RedirectResponse
    {
        $complaint = $this->usecase->getById(id: $id);

        if (empty($complaint['data'])) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::DEFAULT_ERROR_MESSAGE);
        }

        if ($complaint['data']['data']->student_id !== Auth::user()->id) {
            return redirect()->intended($this->baseRedirect)->with('error', ResponseConst::ERROR_MESSAGE_UNAUTHORIZED);
        }

        $process = $this->usecase->delete(id: $id);

        if ($process['success']) {
            return redirect()
                ->route('student.complaints.index')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_DELETED);
        }

        return redirect()
            ->route('student.complaints.index')
            ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
    }
}
