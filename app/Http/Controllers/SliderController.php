<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Auth;

class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function allSlider(){
        $sliders=Slider::latest()->paginate(5);
        return view('admin/home/slider.index', compact('sliders'));
    }

    public function addSlider(){
        return view('admin/home/slider.create');
    }

    public function storeSlider(Request $request){
        $slider_image=$request->file('slider_image');
        $name_gen=hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        $last_img='images/slider/'.$name_gen;
        Image::make($slider_image)->resize(1920, 1088)->save($last_img);

        $slider=new Slider;
        $slider->title=$request->slider_title;
        $slider->description=$request->slider_description;
        $slider->image=$last_img;
        $slider->save();

        return Redirect()->route('all.slider')->with('success', 'New Slider is inserted successfully');
    }

    public function editSlider($id){
        // ORM method
        $slider=Slider::find($id);
        return view('admin/home/slider.edit', compact('slider'));
    }

    public function updateSlider(Request $request, $id){
        $old_image=$request->old_image;
        $slider_image=$request->file('slider_image');
        $last_img=$old_image;
        if($slider_image){
            $name_gen=hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            $last_img='images/slider/'.$name_gen;
            Image::make($slider_image)->resize(1920, 1088)->save($last_img);
    
            unlink($old_image);    
        }

        $slider=Slider::find($id);
        $slider->title=$request->slider_title;
        $slider->description=$request->slider_description;
        $slider->image=$last_img;
        $slider->save();

        return Redirect()->route('all.slider')->with('success', 'Slider is updated successfully');
    }

    public function deleteSlider($id){
        $slider=Slider::find($id);
        $old_image=$slider->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->route('all.slider')->with('success', 'Slider is deleted successfully');
    }
}
