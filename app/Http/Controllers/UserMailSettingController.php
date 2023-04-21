<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserMailSetting;
use Illuminate\Validation\Validator; 
use Illuminate\Support\Facades\Auth;

class UserMailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $userMailSettings = UserMailSetting::all();
      
        return view('user_mail_settings.index', compact('userMailSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('user_email_settings.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'primary_email' => 'required|string|max:255',
            'secondary_email' => 'required|string|max:255',
            'mail_server' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'protocol' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'start_time' => 'required|string|max:100',
            'end_time' => 'required|string|max:100',            
        ]);
        $user = Auth::user();
        //print_r($user);die;
        // Create a new UserMailSetting instance and fill its properties
        $setting = new UserMailSetting;
        $setting->primary_email = $request->input('primary_email');
        $setting->secondary_email = $request->input('secondary_email');
        $setting->mail_server = $request->input('mail_server');
        $setting->port = $request->input('port');
        $setting->protocol = $request->input('protocol');
        $setting->password = $request->input('password');
        $setting->start_time = $request->input('start_time');
        $setting->end_time = $request->input('end_time');

        // Set the user ID
        $setting->user_id = $user->id;

        // Save the new user_mail_setting record
        $setting->save();  
        $setting->id;
        return redirect()->route('user_mail_settings.edit', $setting->id)->with('success', 'User mail setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user_mail_settings.show', compact('userMailSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $mailSetting = UserMailSetting::find($id);
       if(empty($mailSetting)){
            return redirect()->route('user_mail_settings.create')->with('error', 'No data found for the id :'.$id);
       }
        $user = Auth::user();
        if ($user->id != $mailSetting->user_id) {
            return redirect()->route('user_mail_settings.create')->with('error', 'Access denied.');
        }
        return view('user_email_settings.index', compact('mailSetting'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validatedData = $request->validate([
        'primary_email' => 'required|string|max:255',
        'secondary_email' => 'required|string|max:255',
        'mail_server' => 'required|string|max:255',
        'port' => 'required|string|max:255',
        'protocol' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'start_time' => 'required|string|max:100',
        'end_time' => 'required|string|max:100',        
    ]);
    $userMailSetting = UserMailSetting::find($id);
   // dd($userMailSetting->id);
    $userMailSetting->update($validatedData);

    return redirect()->route('user_mail_settings.edit', $id)->with('success', 'User mail setting updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userMailSetting = UserMailSetting::find($id);
        $userMailSetting->delete();
    
        return redirect()->route('user_mail_settings.create')->with('success', 'User mail setting deleted successfully.');
    }
}
