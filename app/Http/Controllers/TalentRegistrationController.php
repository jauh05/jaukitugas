<?php

namespace App\Http\Controllers;

use App\Models\TalentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TalentRegistrationController extends Controller
{
    /**
     * Display the talent registration form.
     */
    public function create()
    {
        return view('talent_register');
    }

    /**
     * Store a newly created talent registration in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instagram' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'asal_univ' => 'required|string|max:255',
            'program_study_semester' => 'required|string|max:255',
            'keahlian' => 'required|array',
            'file_pdf' => 'required|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        $data = $request->except('file_pdf');

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            // Save to storage/app/public/talent_files
            $path = $file->store('talent_files', 'public');
            $data['file_pdf'] = $path;
        }

        TalentRegistration::create($data);

        return redirect()->back()->with('success', 'Pendaftaran Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function index()
    {
        $registrations = TalentRegistration::orderBy('created_at', 'desc')->get();
        return view('admin.talent_index', compact('registrations'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $talent = TalentRegistration::findOrFail($id);
        return view('admin.talent_show', compact('talent'));
    }

    /**
     * View the uploaded PDF file.
     */
    public function viewFile($id)
    {
        $talent = TalentRegistration::findOrFail($id);

        if (!Storage::disk('public')->exists($talent->file_pdf)) {
            return abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->response($talent->file_pdf);
    }

    /**
     * Update the status of the registration.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
        ]);

        $talent = TalentRegistration::findOrFail($id);
        $talent->status = $request->status;
        $talent->save();

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $talent = TalentRegistration::findOrFail($id);
        if ($talent->file_pdf) {
            Storage::disk('public')->delete($talent->file_pdf);
        }
        $talent->delete();

        return redirect()->route('admin.talent.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
