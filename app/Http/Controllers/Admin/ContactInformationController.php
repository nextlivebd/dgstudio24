<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    public function index()
    {
        $contactInfos = ContactInformation::latest()->get();
        return view('admin.contact_informations.index', compact('contactInfos'));
    }

    public function create()
    {
        return view('admin.contact_informations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
        ]);

        $addresses = $this->formatJsonData($request->address_icon, $request->address_text);
        $phones = $this->formatJsonData($request->phone_icon, $request->phone_text);
        $emails = $this->formatJsonData($request->email_icon, $request->email_text);

        ContactInformation::create([
            'office_name' => $request->office_name,
            'addresses' => $addresses,
            'phones' => $phones,
            'emails' => $emails,
            'map_embed' => $request->map_embed,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.contact-informations.index')->with('success', 'Contact Information added successfully.');
    }

    public function edit($id)
    {
        $contactInfo = ContactInformation::findOrFail($id);
        return view('admin.contact_informations.edit', compact('contactInfo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'office_name' => 'required|string|max:255',
        ]);

        $addresses = $this->formatJsonData($request->address_icon, $request->address_text);
        $phones = $this->formatJsonData($request->phone_icon, $request->phone_text);
        $emails = $this->formatJsonData($request->email_icon, $request->email_text);

        $contactInfo = ContactInformation::findOrFail($id);
        $contactInfo->update([
            'office_name' => $request->office_name,
            'addresses' => $addresses,
            'phones' => $phones,
            'emails' => $emails,
            'map_embed' => $request->map_embed,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.contact-informations.index')->with('success', 'Contact Information updated successfully.');
    }

    public function destroy($id)
    {
        $contactInfo = ContactInformation::findOrFail($id);
        $contactInfo->delete();
        return redirect()->route('admin.contact-informations.index')->with('success', 'Contact Information deleted successfully.');
    }

    private function formatJsonData($icons, $texts)
    {
        $data = [];
        if (is_array($texts)) {
            foreach ($texts as $key => $text) {
                if (!empty($text)) {
                    $data[] = [
                        'icon' => $icons[$key] ?? '',
                        'text' => $text
                    ];
                }
            }
        }
        return empty($data) ? null : $data;
    }
}
