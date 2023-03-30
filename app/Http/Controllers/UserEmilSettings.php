<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMailsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEmilSettings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if(!User::find(Auth::user()->id)->UserMailSetting){
            return view('user_email_settings.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if(!User::find(Auth::user()->id)->UserMailSetting){
            return view('user_email_settings.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'primary_email' => 'required|email|unique:user_mail_settings',
            'secondary_email' => 'nullable|email',
            'mail_server' => 'required',
            'port' => 'required',
            'protocol' => 'required',
            'password' => 'required',
        ]);

        $setting = new UserMailsetting;
        $setting->primary_email = $request->input('primary_email');
        $setting->secondary_email = $request->input('secondary_email');
        $setting->mail_server = $request->input('mail_server');
        $setting->port = $request->input('port');
        $setting->protocol = $request->input('protocol');
        $setting->password = $request->input('password');
        $setting->user_id = auth()->user()->id; // set the user ID to the currently authenticated user
        $setting->save();
        return redirect()->route('user_mail_settings.index')->with('success', 'Mail settings updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $setting = UserMailSetting::findOrFail($id);
        return view('user_mail_settings.edit', ['setting' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'primary_email' => 'required|email|unique:user_mail_settings,primary_email,'.$id,
            'secondary_email' => 'nullable|email',
            'mail_server' => 'required',
            'port' => 'required',
            'protocol' => 'required',
            'password' => 'nullable',
        ]);

        $setting = UserMailsetting::findOrFail($id);
        $setting->primary_email = $request->input('primary_email');
        $setting->secondary_email = $request->input('secondary_email');
        $setting->mail_server = $request->input('mail_server');
        $setting->port = $request->input('port');
        $setting->protocol = $request->input('protocol');
        if ($request->input('password')) {
            $setting->password = $request->input('password');
        }
        $setting->save();
        return redirect()->route('user_mail_settings.index')->with('success', 'Mail settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = UserMailSetting::findOrFail($id);
        $setting->delete();

        return redirect()->route('user_mail_settings.index')->with('success', 'Mail settings deleted successfully.');
    }
}
