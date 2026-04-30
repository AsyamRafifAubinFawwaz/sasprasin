<?php

namespace App\Http\Controllers\Toolsman;

use App\Constants\DatabaseConst;
use App\Http\Controllers\Controller;
use App\Usecase\Toolsman\AspirationUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AspirationController extends Controller
{
    public function __construct(protected AspirationUsecase $usecase) {}

    public function index(Request $request): View
    {
        $response = $this->usecase->getAll([
            'search' => $request->get('search'),
            'keywords' => $request->get('keywords'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'priority' => $request->get('priority'),
            'facility_category_id' => $request->get('facility_category_id'),
            'location' => $request->get('location'),
        ]);

        return view('_toolsman.aspirations.index', [
            'data' => $response['data']['list'] ?? collect(),
            'search' => $request->get('search'),
            'keywords' => $request->get('keywords'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'priority' => $request->get('priority'),
            'facility_category_id' => $request->get('facility_category_id'),
            'location' => $request->get('location'),
            'categories' => DB::table(DatabaseConst::FACILITY_CATEGORY)->get(),
            'locations' => DB::table(DatabaseConst::LOCATION)->get(),
            'priorities' => collect([
                ['id' => 'low', 'name' => 'Low'],
                ['id' => 'medium', 'name' => 'Medium'],
                ['id' => 'high', 'name' => 'High'],
            ]),
        ]);
    }

    public function detail(int $id)
    {
        $response = $this->usecase->getById($id);

        if (!$response['success']) {
            return redirect()->route('toolsman.aspirations.index')->with('error', $response['message']);
        }

        return view('_toolsman.aspirations.detail', $response['data']);
    }

    public function doUpdate(Request $request, int $id)
    {
        $response = $this->usecase->update($request, $id);

        if (!$response['success']) {
            return redirect()->back()->with('error', $response['message'])->withInput();
        }

        return redirect()->back()->with('success', $response['message']);
    }
}
