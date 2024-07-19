<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.audits')->only('index');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $audits = Audit::with('user')
                ->where('id', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $audits = Audit::with('user')->paginate(10);
        }
    
        $userEvents = Audit::with('user')
            ->get()
            ->groupBy('user.name')
            ->map(function ($audits) {
                return [
                    'created' => $audits->where('event', 'created')->count(),
                    'updated' => $audits->where('event', 'updated')->count(),
                    'deleted' => $audits->where('event', 'deleted')->count(),
                ];
            });
    
        return view('audits.index', compact('audits', 'userEvents'));
    }
    



    public function exportPdf()
    {
        $audits = Audit::all();
        $pdf = PDF::loadView('audits.pdf', compact('audits'));
        $currentDate = Carbon::now()->format('d-m-Y'); // Formato de fecha: dd-mm-yyyy
        $filename = 'Auditorías-' . $currentDate . '.pdf';
        return $pdf->download($filename);
    }
}
