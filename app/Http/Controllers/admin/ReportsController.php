<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('task')->get();

        // dd($reports);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat laporan baru
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data laporan yang disubmit
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'report_detail' => 'required|string',
        ]);

        // Simpan laporan baru ke dalam database
        Report::create([
            'task_id' => $request->task_id,
            'user_id' => auth()->id(),
            'report_detail' => $request->report_detail,
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */ public function show(string $id)
    {
        $report = Report::findOrFail($id);

        $task = $report->task;

        return view('admin.reports.show', compact('report', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan laporan berdasarkan ID untuk diedit
        $report = Report::findOrFail($id);
        return view('admin.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data laporan yang diupdate
        $request->validate([
            'report_detail' => 'required|string',
        ]);

        // Temukan laporan berdasarkan ID dan update datanya
        $report = Report::findOrFail($id);
        $report->report_detail = $request->report_detail;
        $report->save();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan laporan berdasarkan ID dan hapus
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
