<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Hr;
use PDF;

class HrRouteController extends Controller
{

    public function index() : View
    {
        return view('hr.index');
    }

    public function create(): View
    {
        return view('hr.create');
    }
    
    public function edit(string $id): View
    {
        $hr = Hr::findOrFail($id);
        return view('hr.edit', compact('hr'));
    }

    public function pdf()
    {
        $hr = Hr::latest()->get();
        $data = [
            'hr' => $hr,
        ];
        $pdf = PDF::loadView('hr.pdf', $data);
        return $pdf->download('myPDFfile.pdf');
    }
}