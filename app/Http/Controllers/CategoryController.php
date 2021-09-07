<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function allCategory(){
        // ORM method
        // $categories=Category::all();
        // {{$category->created_at->diffForHumans()}}
        // $categories=Category::latest()->get();
        $categories=Category::latest()->paginate(5);

        // Query builder
        // $categories=DB::table('categories')->latest()->get();
        // kalau pakai query builder pakai disini untuk html
        // {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}

        // untuk yang pagination
        // $categories=DB::table('categories')->latest()->paginate(2);


        // Query builder for join table
        // panggilnya di html $category->name
        // $categories=DB::table('categories')
        //             ->join('users', 'categories.user_id', 'users.id')
        //             ->select('categories.*', 'users.name')
        //             ->latest()->paginate(2);


        // deleted Categories
        $trashCategories= Category::onlyTrashed()->latest()->paginate(3);
        return view('admin/masterdata/category.index', compact('categories', 'trashCategories'));
    }

    public function addCategory(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:63'
        ],
        [
            'category_name.required' => 'Please Fill in Category Name',
            'category_name.max' => 'Cannot have category name more than 63 characters'
        ]);

        // First method ORM
        // Category::insert([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id,
        //     'created_at'=>Carbon::now(),
        // ]);

        // Second method ORM create_at and updated_at di update dengan sendirinya
        $category=new Category;
        $category->category_name=$request->category_name;
        $category->user_id=Auth::user()->id;
        $category->save();

        //query builder create_at and updated_at perlu di spesify sendiri jika ingin masuk
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['user_id']=Auth::user()->id;
        // DB::table('categories')->insert($data);
        

        return Redirect()->back()->with('success', 'New category is inserted successfully');
    }

    public function editCategory($id){
        // ORM method
        // $category=Category::find($id);

        // DB Builder
        $category=DB::table('categories')->where('id', $id)->first();
        return view('admin/masterdata/category.edit', compact('category'));
    }

    public function updateCategory($id, Request $request){
        // First method
        // $category=Category::find($id);
        // $category->category_name=$request->category_name;
        // $category->user_id=Auth::user()->id;
        // $category->save();

        // Second method
        // $category=Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);

        $validated = $request->validate([
            'category_name' => 'required|max:63'
        ],
        [
            'category_name.required' => 'Please Fill in Category Name',
            'category_name.max' => 'Cannot have category name more than 63 characters'
        ]);

        // Query Builder
        $data = array();
        $data['category_name']=$request->category_name;
        $data['user_id']=Auth::user()->id;

        DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('all.category')->with('success', 'Category is updated successfully');
    }

    public function softDeleteCategory($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category is move to trash successfully');
    }

    public function restoreCategory($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category has been restore successfully');
    }

    public function forceDeleteCategory($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category has fully deleted');

    }
}
