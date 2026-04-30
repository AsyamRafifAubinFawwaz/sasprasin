<?php

namespace App\Http\Controllers\Toolsman;

use App\Http\Controllers\Controller;
use App\Usecase\UserUsecase;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(protected UserUsecase $usecase) {}

    public function updateProfile()
    {
        return view('_toolsman.profile.update');
    }

    public function doUpdateProfile(Request $request)
    {
        $response = $this->usecase->updatePersonalInfo($request->all());

        if (!$response['success']) {
            return redirect()->back()->with('error', $response['message'])->withInput();
        }

        return redirect()->back()->with('success', $response['message']);
    }

    public function changePassword()
    {
        return view('_toolsman.profile.change_password');
    }

    public function doChangePassword(Request $request)
    {
        $response = $this->usecase->changePassword($request->all());

        if (!$response['success']) {
            return redirect()->back()->with('error', $response['message'])->withInput();
        }

        return redirect()->back()->with('success', $response['message']);
    }
}
