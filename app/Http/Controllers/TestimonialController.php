<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        $validated['is_visible'] = $request->has('is_visible') ? true : false;

        Testimonial::create($validated);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
