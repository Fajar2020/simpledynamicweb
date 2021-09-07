<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function allBrand(){
        $brands=Brand::latest()->paginate(5);
        return view('admin/home/brand.index', compact('brands'));
    }

    public function addBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image'=> 'required|mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Please Fill in Brand Name',
            'brand_name.min' => 'Brand name at least four characters',
            'brand_image.required' => 'Please Choose suitable image for brand image',
            'brand_image.mimes' => 'Please choose file with type jpg, jpeg, or png',
        ]);

        $brand_image=$request->file('brand_image');

        // $name_gen=hexdec(uniqid());
        // $img_ext=strtolower($brand_image->getClientOriginalExtension());
        // $img_name=$name_gen.'.'.$img_ext;
        // $up_location='images/brand/';
        // $last_img=$up_location.$img_name;

        // $brand_image->move($up_location,$img_name);

        $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img='images/brand/'.$name_gen;
        Image::make($brand_image)->resize(300, 200)->save($last_img);

        $brand=new Brand;
        $brand->brand_name=$request->brand_name;
        $brand->brand_image=$last_img;
        $brand->save();

        $notification=array(
            'message'=>'New brand is inserted successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function editBrand($id){
        // ORM method
        $brand=Brand::find($id);
        return view('admin/home/brand.edit', compact('brand'));
    }

    public function updateBrand(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
            'brand_image'=> 'mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Please Fill in Brand Name',
            'brand_name.min' => 'Brand name at least four characters',
            'brand_image.mimes' => 'Please choose file with type jpg, jpeg, or png',
        ]);

        $old_image=$request->old_image;
        $brand_image=$request->file('brand_image');
        $last_img=$old_image;
        if($brand_image){
            // $name_gen=hexdec(uniqid());
            // $img_ext=strtolower($brand_image->getClientOriginalExtension());
            // $img_name=$name_gen.'.'.$img_ext;
            // $up_location='images/brand/';
            // $last_img=$up_location.$img_name;
    
            // $brand_image->move($up_location,$img_name);
            $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            $last_img='images/brand/'.$name_gen;
            Image::make($brand_image)->resize(300, 200)->save($last_img);
    
            unlink($old_image);    
        }

        $brand=Brand::find($id);
        $brand->brand_name=$request->brand_name;
        $brand->brand_image=$last_img;
        $brand->save();

        return Redirect()->route('all.brand')->with('success', 'Brand is updated successfully');
    }

    public function deleteBrand($id){
        $brand=Brand::find($id);
        $old_image=$brand->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->route('all.brand')->with('success', 'Brand is deleted successfully');
    }

    //multi image
    public function multiImage(){
        $images = Multipic::all();
        return view('admin/multipic.index', compact('images'));
    }

    public function addMultiImage(Request $request){
        $images=$request->file('image');

        if($images){
            foreach($images as $image){
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $last_img='images/multi/'.$name_gen;
                Image::make($image)->resize(300, 300)->save($last_img);
        
                $multi=new Multipic;
                $multi->image=$last_img;
                $multi->save();
            }
            return Redirect()->back()->with('success', 'Images are inserted successfully');
        }else{
            return Redirect()->back();
        }
        
    }

}
