<?php

use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\BannersController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\ClinicController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PrivacyController;
use App\Http\Controllers\Dashboard\CallUsController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PushNotificationController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\OffersController;
use App\Http\Controllers\Dashboard\SpecializationsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
   Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('guest');
    Route::group(['namespace' => 'Auth','middleware'=>'guest'], function () {
        Route::get('/login/{type}', [LoginController::class, 'log'])->name('login.show');
        Route::get('/login',  [LoginController::class, 'logs'])->name('logs');
        Route::post('/login',  [LoginController::class, 'login'])->name('login');
        Route::get('/logout/{type}',  [LoginController::class, 'logout'])->name('logout')->withoutMiddleware('guest');
    });
    Route::group(['middleware' => ['auth:web']], function () {
            // // index page
            Route::get('/dashboard',  [HomeController::class, 'dashboard'])->name('admin.dashboard');
           Route::get('/export/pdf',  [HomeController::class,'export_pdf'])->name('export_pdf');


    });
Route::group(['namespace'=>'Dashboard','middleware'=>'auth:web', 'prefix' => 'dashboard'],function(){

    Route::group(['prefix' => 'specializations'], function () {
        Route::get('/', [SpecializationsController::class, 'index'])->name('specialization.index');
        Route::get('create', [SpecializationsController::class, 'create'])->name('specialization.create');
        Route::post('store', [SpecializationsController::class, 'store'])->name('specialization.store');
        Route::get('edit/{id}', [SpecializationsController::class, 'edit'])->name('specialization.edit');
        Route::post('update/{id}', [SpecializationsController::class, 'update'])->name('specialization.update');
        Route::get('delete/{id}', [SpecializationsController::class, 'delete'])->name('specialization.delete');

    });
     Route::group(['prefix' => 'insurance'], function () {
        Route::get('/', [InsuranceController::class, 'index'])->name('insurance.index');
        Route::get('create', [InsuranceController::class, 'create'])->name('insurance.create');
        Route::post('store', [InsuranceController::class, 'store'])->name('insurance.store');
        Route::get('edit/{id}', [InsuranceController::class, 'edit'])->name('insurance.edit');
        Route::post('update/{id}', [InsuranceController::class, 'update'])->name('insurance.update');
        Route::get('delete/{id}', [InsuranceController::class, 'delete'])->name('insurance.delete');

    });


    Route::group(['prefix' => 'patients'], function () {
        Route::get('/', [PatientController::class,'index'])->name('admin.patients.index');
        Route::get('create', [PatientController::class,'create'])->name('admin.patients.create');
        Route::post('store', [PatientController::class,'store'])->name('admin.patients.store');
        Route::get('edit/{id}', [PatientController::class,'edit'])->name('admin.patients.edit');
        Route::post('update/{id}', [PatientController::class,'update'])->name('admin.patients.update');
        Route::get('delete/{id}', [PatientController::class,'delete'])->name('admin.patients.delete');
        Route::get('clinics', [PatientController::class,'clinics'])->name('admin.patients.lete');
    });
        Route::get('get/all/booking', [DoctorController::class, 'get_all_booking'])->name('get_all_booking');
        Route::group(['prefix' => 'doctors'], function () {
        Route::get('/', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::post('store', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('appointment_list/{id}', [DoctorController::class, 'doctor_appointments'])->name('doctors.appointments');
        Route::get('edit/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
        Route::post('update/{id}', [DoctorController::class, 'update'])->name('doctors.update');
        Route::get('delete/{id}', [DoctorController::class, 'delete'])->name('doctors.delete');
        Route::get('appointment/delete/{id}', [DoctorController::class, 'delete_appointment'])->name('appointments.delete');
        Route::get('appointment/add/{id}', [DoctorController::class, 'add_appointment'])->name('appointments.add');
        Route::post('appointment/store/{id}', [DoctorController::class, 'store_appointment'])->name('appointment.store');

    });
    Route::group(['prefix' =>'banners'], function(){
        Route::get('/', [BannersController::class,'index'])->name('admin.banners.index');
        Route::get('create', [BannersController::class,'create'])->name('admin.banners.create');
        Route::post('store',[BannersController::class,'store'])->name('admin.banners.store');

        Route::get('delete/{id}', [BannersController::class,'delete'])->name('admin.banners.delete');


       });
       Route::group(['prefix' => 'clinics'], function () {
        Route::get('/', [ClinicController::class, 'index'])->name('clinics.index');
        Route::get('create', [ClinicController::class, 'create'])->name('clinics.create');
        Route::post('store', [ClinicController::class, 'store'])->name('clinics.store');
        Route::get('edit/{id}', [ClinicController::class, 'edit'])->name('clinics.edit');
        Route::post('update/{id}', [ClinicController::class, 'update'])->name('clinics.update');
        Route::get('delete/{id}', [ClinicController::class, 'delete'])->name('clinics.delete');
         Route::get('images/{id}', [ClinicController::class, 'images'])->name('clinics.images');
          Route::get('images/delete/{id}', [ClinicController::class, 'delete_image'])->name('clinics.images.delete');
          Route::get('clinics/appointments/{id}', [ClinicController::class, 'get_all_appointments'])->name('clinics.appointments');

    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::post('send', [PushNotificationController::class, 'bulksend'])->name('bulksend');
        Route::get('/', [PushNotificationController::class, 'index'])->name('notifications.index');
        Route::get('create', [PushNotificationController::class, 'create'])->name('notifications.create');
        Route::get('delete/{id}', [PushNotificationController::class, 'delete'])->name('notifications.delete');
    });
    Route::group(['prefix'=>'settings'],function(){
        Route::get('about-us',[SettingsController::class,'about_us'])->name('about_us');
        Route::post('about-us/store',[SettingsController::class,'about_us_store'])->name('about_us_store');
        Route::get('contact-us',[SettingsController::class,'contact_us_index'])->name('contact_us.index');
        Route::get('contact-us/create',[SettingsController::class,'contact_us_create'])->name('contact_us.create');
        Route::post('contact-us/store',[SettingsController::class,'contact_us_store'])->name('contact_us.store');
        Route::get('contact-us/update/{id}',[SettingsController::class,'contact_us_update'])->name('contact_us.update');
        Route::post('contact-us/edit/{id}',[SettingsController::class,'ContactUs_edit'])->name('contactus.edit');
        Route::post('about-us/edit',[SettingsController::class,'about_us_edit'])->name('contact_us.edit');
        Route::get('/delete/{id}',[SettingsController::class,'destroy'])->name('settings.destroy');
        Route::post('/delete', [SettingsController::class, "bulkdelete"])->name('settings.delete');
        Route::get('qa',[SettingsController::class,'qa_index'])->name('qa.index');
        Route::get('qa/create',[SettingsController::class,'qa_create'])->name('qa.create');
        Route::post('qa/store',[SettingsController::class,'qa_store'])->name('qa.store');
        Route::get('qa/update/{id}',[SettingsController::class,'qa_update'])->name('qa.update');
        Route::post('qa/edit',[SettingsController::class,'qa_edit'])->name('qa.edit');


});
 Route::group(['prefix' => 'callus'], function () {
   
        Route::get('/', [ CallUsController::class, 'index'])->name('callus.index');
    
    });
         Route::group(['prefix' =>'articles'], function(){
    Route::get('/', [ArticlesController::class,'index'])->name('admin.articles.index');
    Route::get('create', [ArticlesController::class,'create'])->name('admin.articles.create');
    Route::post('store',[ArticlesController::class,'store'])->name('admin.articles.store');
       Route::get('edit/{article}', [ArticlesController::class,'edit'])->name('admin.articles.edit');
    Route::post('update/{article}', [ArticlesController::class,'update'])->name('admin.articles.update');
    Route::get('delete/{article}', [ArticlesController::class,'destroy'])->name('admin.articles.delete');
   });
    Route::group(['prefix' =>'offers'], function(){
    Route::get('/', [OffersController::class,'index'])->name('admin.offers.index');
    Route::get('create', [OffersController::class,'create'])->name('admin.offers.create');
    Route::post('store',[OffersController::class,'store'])->name('admin.offers.store');
       Route::get('edit/{offer}', [OffersController::class,'edit'])->name('admin.offers.edit');
    Route::post('update/{offer}', [OffersController::class,'update'])->name('admin.offers.update');
    Route::get('delete/{offer}', [OffersController::class,'destroy'])->name('admin.offers.delete');
   });

   Route::group(['prefix' =>'terms'], function(){
    Route::get('/', [TermsAndConditionsController::class,'index'])->name('admin.terms.index');
    Route::get('create', [TermsAndConditionsController::class,'create'])->name('admin.terms.create');
    Route::post('store',[TermsAndConditionsController::class,'store'])->name('admin.terms.store');
       Route::get('edit/{Term}', [TermsAndConditionsController::class,'edit'])->name('admin.terms.edit');
    Route::post('update/{Term}', [TermsAndConditionsController::class,'update'])->name('admin.terms.update');
    Route::get('delete/{Term}', [TermsAndConditionsController::class,'destroy'])->name('admin.terms.delete');
    
   });

   Route::group(['prefix' =>'privacy'], function(){
    Route::get('/', [PrivacyController::class,'index'])->name('admin.privacy.index');
    Route::get('create', [PrivacyController::class,'create'])->name('admin.privacy.create');
    Route::post('store',[PrivacyController::class,'store'])->name('admin.privacy.store');
       Route::get('edit/{Privacy}', [PrivacyController::class,'edit'])->name('admin.privacy.edit');
    Route::post('update/{Privacy}', [PrivacyController::class,'update'])->name('admin.privacy.update');
    Route::get('delete/{Privacy}', [PrivacyController::class,'destroy'])->name('admin.privacy.delete');
    
   });




});
Route::get('/all/patients', [WebController::class, 'index'])->name('web.index');
Route::get('delete/{id}', [WebController::class, 'destroy'])->name('web.delete');
Route::get('create', [WebController::class, 'create'])->name('web.create');
Route::post('check', [WebController::class, 'store'])->name('patient.check');
});