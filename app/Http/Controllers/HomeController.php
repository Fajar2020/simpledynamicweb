<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Service;
use App\Models\Icon;
use App\Models\Category;
use App\Models\portfolio;
use Image;
use Auth;


class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function about(){
        $homeAbouts=HomeAbout::latest()->paginate(5);
        return view('admin/home/about.index', compact('homeAbouts'));
    }

    public function addAbout(){
        return view('admin/home/about.create');
    }

    public function storeAbout(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'short_desc'=>'required',
            'long_desc'=>'required'
        ]);
        $about=new HomeAbout;
        $about->title=$request->title;
        $about->short_desc=$request->short_desc;
        $about->long_desc=$request->long_desc;
        $about->save();
        return Redirect()->route('home.about')->with('success', 'New About is inserted successfully');
    }

    public function editAbout($id){
        // ORM method
        $about=HomeAbout::find($id);
        return view('admin/home/about.edit', compact('about'));
    }

    public function updateAbout(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required',
            'short_desc'=>'required',
            'long_desc'=>'required'
        ]);
        $about=HomeAbout::find($id);
        $about->title=$request->title;
        $about->short_desc=$request->short_desc;
        $about->long_desc=$request->long_desc;
        $about->save();
        return Redirect()->route('home.about')->with('success', 'About is updated successfully');
    }

    public function deleteAbout($id){
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About is deleted successfully');
    }

    //Services
    public function allService(){
        $icons=Icon::all();
        $services=Service::latest()->paginate(5);
        return view('admin/home/service.index', compact('icons', 'services'));
    }

    public function storeService(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'description'=>'required'
        ]);
        $service=new Service;
        $service->name=$request->name;
        $service->description=$request->description;
        $service->icon=$request->icon;
        $service->save();
        return Redirect()->back()->with('success', 'New Service is inserted successfully');
    }

    public function editService($id){
        // ORM method
        $icons=Icon::all();
        $service=Service::find($id);
        return view('admin/home/service.edit', compact('service', 'icons'));
    }

    public function updateService(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'description'=>'required'
        ]);
        $service=Service::find($id);
        $service->name=$request->name;
        $service->description=$request->description;
        $service->icon=$request->icon;
        $service->save();
        return Redirect()->route('home.service')->with('success', 'Service is updated successfully');
    }

    public function deleteService($id){
        Service::find($id)->delete();
        return Redirect()->back()->with('success', 'About is deleted successfully');
    }

    //Portfolio
    public function portfolio(){
        $portfolios=portfolio::latest()->paginate(5);
        $categories=Category::latest()->get();
        return view('admin/home/portfolio.index', compact('portfolios', 'categories'));
    }

    public function addPortfolio(Request $request){
        $validated = $request->validate([
            'folio_name' => 'required',
            'short_desc'=>'required',
            'image'=>'required'
        ]);
        
        $images=$request->file('image');

        if($images){
            foreach($images as $image){
                // $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                // $last_img='images/portfolio/'.$name_gen;
                // Image::make($image)->resize(300, 300)->save($last_img);

                $name_gen=hexdec(uniqid());
                $img_ext=strtolower($image->getClientOriginalExtension());
                $img_name=$name_gen.'.'.$img_ext;
                $up_location='images/portfolio/';
                $last_img=$up_location.$img_name;

                $image->move($up_location,$img_name);
        
                $portfolio=new portfolio;
                $portfolio->folio_name=$request->folio_name;
                $portfolio->short_desc=$request->short_desc;
                $portfolio->category_id=$request->category_id;
                $portfolio->image=$last_img;
                $portfolio->save();
            }
            return Redirect()->back()->with('success', 'Portfolio are inserted successfully');
        }else{
            return Redirect()->back();
        }
        
    }

    public function deletePortfolio($id){
        portfolio::find($id)->delete();
        return Redirect()->back()->with('success', 'Portfolio is deleted successfully');
    }


}
