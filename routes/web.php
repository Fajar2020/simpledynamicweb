<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\ChangePassController;

use App\Models\User;
use App\Models\Category;
use App\Models\portfolio;
use App\Models\Contact;
use App\Models\ContactMessage;

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $services = DB::table('services')->get();
    $categories = Category::latest()->get();
    $portfolios = portfolio::latest()->get();
    $about = DB::table('home_abouts')->latest('updated_at')->first();

    transformPortfolio($categories, $portfolios);

    foreach($services as $key=>$service){
        $modulo=$key%6;
        if($modulo == 0){
            $service->style="icon-box iconbox-blue";
        }else if($modulo == 1){
            $service->style="icon-box iconbox-orange";
        }else if($modulo == 2){
            $service->style="icon-box iconbox-pink";
        }else if($modulo == 3){
            $service->style="icon-box iconbox-yellow";
        }else if($modulo == 4){
            $service->style="icon-box iconbox-red";
        }else{
            $service->style="icon-box iconbox-teal";
        }
    }
    
    return view('home', compact('brands', 'about', 'services', 'categories', 'portfolios'));
});

function transformPortfolio($categories, $portfolios){
    foreach($categories as $category){
        $category->style=str_replace(' ', '', $category->category_name);
    }

    foreach($portfolios as $portfolio){
        $portfolio->style=str_replace(' ', '', $portfolio->category->category_name);
    }

}

Route::get('/portfolio', function(){
    $categories = Category::latest()->get();
    $portfolios = portfolio::latest()->get();
    transformPortfolio($categories, $portfolios);
    
    return view('pages/portfolio', compact('categories', 'portfolios'));
})->name('portfolio');

Route::get('/contact', function(){
    $contacts = Contact::all();
    return view('pages/contact', compact('contacts'));
})->name('contact');

Route::post('/contact/message/store', function(Request $request){
    $contact=new ContactMessage;
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->subject=$request->subject;
    $contact->message=$request->message;
    $contact->save();

    return Redirect()->route('contact')->with('success', 'Message has been send successfully');
})->name('contact.message');


Route::get('/about', function () {
    return view('about');
});



// User Register Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//logout
Route::get('/user/logout', [ChangePassController::class, 'logout'])->name('user.logout');
Route::get('/user/changepassword', [ChangePassController::class, 'changePassword'])->name('change.password');
Route::post('/password/update', [ChangePassController::class, 'updatePassword'])->name('password.update');

// User Profile
Route::get('/user/profile', [ChangePassController::class, 'profileEdit'])->name('profile.edit');
Route::post('/profile/update', [ChangePassController::class, 'profileUpdate'])->name('profile.update');

//Home

//Brand
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);

//Slider
Route::get('/slider/all', [SliderController::class, 'allSlider'])->name('all.slider');
Route::get('/slider/add', [SliderController::class, 'addSlider'])->name('add.slider');
Route::post('/slider/store', [SliderController::class, 'storeSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'editSlider']);
Route::post('/slider/update/{id}', [SliderController::class, 'updateSlider']);
Route::get('/slider/delete/{id}', [SliderController::class, 'deleteSlider']);

//About
Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/home/about/add', [HomeController::class, 'addAbout'])->name('add.home.about');
Route::post('/home/about/store', [HomeController::class, 'storeAbout'])->name('store.home.about');
Route::get('/home/about/edit/{id}', [HomeController::class, 'editAbout']);
Route::post('/home/about/update/{id}', [HomeController::class, 'updateAbout']);
Route::get('/home/about/delete/{id}', [HomeController::class, 'deleteAbout']);

//Services
Route::get('/home/service', [HomeController::class, 'allService'])->name('home.service');
Route::post('/home/service/store', [HomeController::class, 'storeService'])->name('store.home.service');
Route::get('/home/service/edit/{id}', [HomeController::class, 'editService']);
Route::post('/home/service/update/{id}', [HomeController::class, 'updateService']);
Route::get('/home/service/delete/{id}', [HomeController::class, 'deleteService']);

//Portfolio
Route::get('/home/portfolio', [HomeController::class, 'portfolio'])->name('home.portfolio');
Route::post('/home/portfolio/add', [HomeController::class, 'addPortfolio'])->name('store.home.portfolio');
Route::get('/home/portfolio/delete/{id}', [HomeController::class, 'deletePortfolio']);


//Contact
Route::get('/contact/profile', [ContactController::class, 'profile'])->name('contact.profile');
Route::post('/contact/profile/store', [ContactController::class, 'storeProfile'])->name('store.contact.profile');
Route::get('/contact/profile/edit/{id}', [ContactController::class, 'editProfile']);
Route::post('/contact/profile/update/{id}', [ContactController::class, 'updateProfile']);
Route::get('/contact/profile/delete/{id}', [ContactController::class, 'deleteProfile']);

Route::get('/contact/message', [ContactController::class, 'message'])->name('contact.message');

//Category
Route::get('/category/all', [CategoryController::class, 'allCategory'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::get('/category/softDelete/{id}', [CategoryController::class, 'softDeleteCategory']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'forceDeleteCategory']);

//Icon
Route::get('/icon/all', [IconController::class, 'allIcon'])->name('all.icon');
Route::post('/icon/store', [IconController::class, 'storeIcon'])->name('store.icon');
Route::get('/icon/edit/{id}', [IconController::class, 'editIcon']);
Route::post('/icon/update/{id}', [IconController::class, 'updateIcon']);
Route::get('/icon/delete/{id}', [IconController::class, 'deleteIcon']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // ORM method
    // $users= User::all();
    // Query Builder
    // $users = DB::table('users')->get();
    // return view('dashboard', compact('users'));
    return view('admin.index');
})->name('dashboard');

//Multi Image
Route::get('/multi/image', [BrandController::class, 'multiImage'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'addMultiImage'])->name('store.image');
