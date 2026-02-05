<?php

namespace App\Http\Controllers\Student;

use App\Constants\ResponseConst;
use App\Http\Controllers\Controller;
use App\Usecase\UserUsecase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected UserUsecase $usecase
    ) {}

    public function changePassword(): View
    {
        return view('_student.profile.change_password');
    }

    public function doChangePassword(Request $request): RedirectResponse
    {
        $process = $this->usecase->changePassword($request->all());

        if ($process['success']) {
            return redirect()
                ->route('student.dashboard')
                ->with('success', ResponseConst::SUCCESS_MESSAGE_RESET_PASSWORD);
        } else {
            return redirect()
                ->route('student.dashboard')
                ->withInput()
                ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
        }
    }

    public function updateProfile(): View
    {
        return view('_student.profile.update');
    }

    public function doUpdateProfile(Request $request): RedirectResponse
    {
        $process = $this->usecase->updatePersonalInfo($request->all());

        if ($process['success']) {
            return redirect()
                ->back()
                ->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $process['message'] ?? ResponseConst::DEFAULT_ERROR_MESSAGE);
        }
    }
}
