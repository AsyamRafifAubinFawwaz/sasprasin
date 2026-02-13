<?php

namespace App\Http\Controllers;

use App\Usecase\LandingUsecase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LandingController extends Controller
{
    public function __construct(protected LandingUsecase $usecase) {}

    public function index()
    {
        $aspirations = $this->usecase->getLatestAspirations();
        return view('_landing.index', [
            'aspirations' => $aspirations['data']['list'] ?? []
        ]);
    }

    public function aspirations(Request $request)
    {
        $data = $this->usecase->getAllAspirations($request->all());
        return view('_landing.aspirations.index', [
            'aspirations' => $data['data']['list'] ?? []
        ]);
    }

    public function show(int $id)
    {
        $data = $this->usecase->getById($id);
        if (!$data['success']) {
            abort(404);
        }

        return view('_landing.aspirations.show', [
            'aspiration' => $data['data']['data'],
            'logs' => $data['data']['logs'] ?? []
        ]);
    }
}
