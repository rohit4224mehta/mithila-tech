<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Show the contact form page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact'); // Make sure 'resources/views/contact.blade.php' exists
    }

    /**
     * Handle contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'consent' => 'required|in:1',
        ], [
            'consent.required' => 'You must agree to our privacy policy to send this message.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save the contact message
        $contact = Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'consent' => true,
            'status'  => 'pending',
        ]);

        // Optional: Send admin email notification (uncomment if mail setup is ready)
        // \Mail::to(env('ADMIN_EMAIL', 'admin@example.com'))
        //      ->send(new \App\Mail\ContactNotification($contact));

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting Mithila Tech! We’ll get back to you shortly.'
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for contacting Mithila Tech! We’ll get back to you soon.');
    }

    /**
     * Admin: Show all contact messages (paginated).
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Admin: Mark a contact message as responded.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markResponded($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'responded']);

        return redirect()->back()->with('success', 'Message marked as responded.');
    }
}
