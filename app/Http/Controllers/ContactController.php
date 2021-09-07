<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactMessage;

use Auth;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(){
        $profiles = Contact::latest()->paginate(5);
        return view('admin/contact/profile.index', compact('profiles'));
    }

    public function storeProfile(Request $request){
        $validated = $request->validate([
            'address' => 'required',
            'email'=> 'required|email',
            'phone'=> 'required'
        ]);

        $contact=new Contact;
        $contact->address=$request->address;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->save();

        return Redirect()->back()->with('success', 'New Contact Profile is inserted successfully');
    }


    public function editProfile($id){
        // ORM method
        $contact=Contact::find($id);
        return view('admin/contact/profile.edit', compact('contact'));
    }

    public function updateProfile(Request $request, $id){
        $validated = $request->validate([
            'address' => 'required',
            'email'=> 'required|email',
            'phone'=> 'required'
        ]);

        $contact=Contact::find($id);
        $contact->address=$request->address;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->save();

        return Redirect()->route('contact.profile')->with('success', 'Contact Profile is updated successfully');
    }

    public function deleteProfile($id){
        Contact::find($id)->delete();
        return Redirect()->back()->with('success', 'Contact is deleted successfully');
    }

    public function message(){
        $messages = ContactMessage::latest()->paginate(5);
        // $links = $messages->links();
        return view('admin/contact/msg.index', compact('messages'));
    }
}
