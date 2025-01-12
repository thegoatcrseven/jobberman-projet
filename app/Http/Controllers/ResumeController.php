<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $resumes = Auth::user()->resumes()->get();
        return view('resumes.index', compact('resumes'));
    }

    public function create(): View
    {
        $this->authorize('create', Resume::class);
        return view('resumes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Resume::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'summary' => 'nullable|string',
            'education' => 'nullable|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',
            'education.*.field' => 'required|string',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date',
            'experience' => 'nullable|array',
            'experience.*.company' => 'required|string',
            'experience.*.position' => 'required|string',
            'experience.*.description' => 'required|string',
            'experience.*.start_date' => 'required|date',
            'experience.*.end_date' => 'nullable|date',
            'skills' => 'nullable|string',
            'languages' => 'nullable|array',
            'languages.*' => 'required|string',
            'certifications' => 'nullable|string',
            'template' => 'required|string|in:modern,classic,minimal'
        ]);

        // Convertir les chaînes de compétences et certifications en tableaux
        if (!empty($validated['skills'])) {
            $validated['skills'] = array_map('trim', explode(',', $validated['skills']));
        }
        
        if (!empty($validated['certifications'])) {
            $validated['certifications'] = array_map('trim', explode(',', $validated['certifications']));
        }

        $resume = Auth::user()->resumes()->create($validated);

        return redirect()->route('resumes.show', $resume)
            ->with('success', 'CV créé avec succès !');
    }

    public function show(Resume $resume): View
    {
        $this->authorize('view', $resume);
        return view('resumes.show', compact('resume'));
    }

    public function edit(Resume $resume): View
    {
        $this->authorize('update', $resume);
        return view('resumes.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume)
    {
        $this->authorize('update', $resume);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'summary' => 'nullable|string',
            'education' => 'nullable|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',
            'education.*.field' => 'required|string',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date',
            'experience' => 'nullable|array',
            'experience.*.company' => 'required|string',
            'experience.*.position' => 'required|string',
            'experience.*.description' => 'required|string',
            'experience.*.start_date' => 'required|date',
            'experience.*.end_date' => 'nullable|date',
            'skills' => 'nullable|string',
            'languages' => 'nullable|array',
            'languages.*' => 'required|string',
            'certifications' => 'nullable|string',
            'template' => 'required|string|in:modern,classic,minimal'
        ]);

        // Convertir les chaînes de compétences et certifications en tableaux
        if (!empty($validated['skills'])) {
            $validated['skills'] = array_map('trim', explode(',', $validated['skills']));
        }
        
        if (!empty($validated['certifications'])) {
            $validated['certifications'] = array_map('trim', explode(',', $validated['certifications']));
        }

        $resume->update($validated);

        return redirect()->route('resumes.show', $resume)
            ->with('success', 'CV mis à jour avec succès !');
    }

    public function destroy(Resume $resume)
    {
        $this->authorize('delete', $resume);
        $resume->delete();
        return redirect()->route('resumes.index')
            ->with('success', 'CV supprimé avec succès !');
    }

    public function download(Resume $resume)
    {
        $this->authorize('view', $resume);
        
        $pdf = PDF::loadView('resumes.templates.' . $resume->template, compact('resume'));
        return $pdf->download($resume->title . '.pdf');
    }
}
