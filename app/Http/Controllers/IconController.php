<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;
use Auth;

class IconController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function allIcon(){
        $icons=Icon::latest()->paginate(2);
        return view('admin/masterdata/icon.index', compact('icons'));
    }

    public function storeIcon(Request $request){
        $validated = $request->validate([
            'icon_name' => 'required',
            'icon_img'=>'required'
        ]);
        $icon=new Icon;
        $icon->icon_name=$request->icon_name;
        $icon->icon_img=$request->icon_img;
        $icon->save();
        return Redirect()->route('all.icon')->with('success', 'New Icon is inserted successfully');
    }

    public function editIcon($id){
        // ORM method
        $icon=Icon::find($id);
        return view('admin/masterdata/icon.edit', compact('icon'));
    }

    public function updateIcon(Request $request, $id){
        $validated = $request->validate([
            'icon_name' => 'required',
            'icon_img'=>'required'
        ]);
        $icon=Icon::find($id);
        $icon->icon_name=$request->icon_name;
        $icon->icon_img=$request->icon_img;
        $icon->save();
        return Redirect()->route('all.icon')->with('success', 'Icon is updated successfully');
    }

    public function deleteIcon($id){
        Icon::find($id)->delete();
        return Redirect()->route('all.icon')->with('success', 'Icon is deleted successfully');
    }
}
