<?php

use App\Http\Controllers\Api\Banners\BannersController;
use App\Http\Controllers\Api\Doctors\AuthController as DoctorsAuthController;
use App\Http\Controllers\Api\Users\WishlistController;
use App\Http\Controllers\Api\Users\AuthController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\CallUs\CallUsController;
use App\Http\Controllers\Api\Clinics\AuthController as ClinicsAuthController;
use App\Http\Controllers\Api\Clinics\ClinicController as ClinicsClinicController;
use App\Http\Controllers\Api\Clinics\EditProfileController as ClinicsEditProfileController;
use App\Http\Controllers\Api\Doctors\DoctorController;
use App\Http\Controllers\Api\TermsAndConditions\TermsController;
use App\Http\Controllers\Api\Doctors\EditProfileController as DoctorsEditProfileController;
use App\Http\Controllers\Api\Insurance\InsuranceController;
use App\Http\Controllers\Api\Offers\OffersController;
use App\Http\Controllers\Api\Booking\UserBookingController;
use App\Http\Controllers\Api\Articles\ArticleController;
use App\Http\Controllers\Api\Settings\SettingController;
use App\Http\Controllers\Api\Specializations\SpecializationsController;
use App\Http\Controllers\Api\Users\EditProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Clinics\ResetPasswordController;
use App\Http\Controllers\Api\Clinics\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['namespace' => 'Api','middleware'=>'checkLang'], function () {

    Route::group(['namespace' => 'Users'], function () {
       Route::post('user/register',[AuthController::class,'register']);
       Route::post('user/login',[AuthController::class,'login']);
       Route::get('user/getUserById/{id}',[AuthController::class,'getUserById']);
       Route::post('user/logout',[AuthController::class,'logout']);
       Route::get('user/getUserData',[AuthController::class,'getUserData'])->middleware('checkUser:user-api');
       Route::post('user/edit',[EditProfileController::class,'Editprofile'])->middleware('checkUser:user-api');
       Route::post('user/change_password',[EditProfileController::class,'change_password'])->middleware('checkUser:user-api');
       Route::post('user/password/email',  [ForgotPasswordController::class , 'user_forget']);
       Route::post('user/password/reset', [ResetPasswordController::class, 'user_code']);
       Route::post('all/users', [AuthController::class,'GetAllClients']);
       Route::post('user/otplogin',[AuthController::class,'OTPlogin']);
       Route::post('user/checkotp',[AuthController::class,'CheckCode']);
        Route::post('user/wishlist',[WishlistController::class,'wishlist'])->middleware('checkUser:user-api');
        Route::post('client/fcm/token', [AuthController::class, 'ftoken'])->middleware('checkUser:user-api');
        Route::post('client/notifications', [AuthController::class, 'all_users_notifications'])->middleware('checkUser:user-api');
       Route::post('user/getAllWishlist',[WishlistController::class,'getAllWishlist'])->middleware('checkUser:user-api');
    //    Route::post('user/login',[AuthController::class, 'GetAllClients']);
     });
     Route::post('user/rate/clinic',[RateController::class,'rate_clinic'])->middleware('checkUser:user-api');
       Route::post('user/rate/doctor',[RateController::class,'rate_doctor'])->middleware('checkUser:user-api');
     Route::group(['namespace' => 'Doctors'], function () {
        Route::post('doctor/add', [DoctorsAuthController::class, 'add'])->middleware('CheckClinic:clinic-api');
        // Route::post('doctor/login', [AuthController::class, 'login']);
        // Route::get('doctor/getUserById/{id}', [AuthController::class, 'getUserById']);
        // Route::post('doctor/logout', [AuthController::class, 'logout']);
         
         Route::post('doctor/getDoctorData', [DoctorsAuthController::class, 'getDoctorData']);
           Route::post('clinic/doctors', [DoctorsAuthController::class, 'get_all_doctors_of_clinic'])->middleware('CheckClinic:clinic-api');
         Route::post('doctor/getDoctorByID', [DoctorsAuthController::class, 'getDoctorById']);
         Route::post('doctor/add/appointment', [DoctorsAuthController::class, 'add_appointment']);
        Route::post('doctor/edit', [DoctorsEditProfileController::class, 'Editprofile'])->middleware('CheckClinic:clinic-api');
        Route::post('doctor/delete', [DoctorsEditProfileController::class, 'delete_doctor'])->middleware('CheckClinic:clinic-api');
        Route::post('all/doctors', [DoctorController::class, 'all_doctors']);
        Route::post('doctor/by/id', [DoctorController::class, 'get_doctor_by_id']);
        Route::post('doctor/by/specialization_id', [DoctorController::class, 'get_doctor_by_specialization_id']);
        Route::post('doctor/appointments', [DoctorController::class, 'get_doctor_appointments']);
        Route::post('doctor/add/new/appointment', [DoctorsEditProfileController::class, 'add_appointment'])->middleware('CheckClinic:clinic-api');
        Route::post('doctor/update/appointment', [DoctorsEditProfileController::class, 'change_appointment'])->middleware('CheckClinic:clinic-api');
          Route::post('get/doctor/appointments', [DoctorsEditProfileController::class, 'get_doctor_appointments'])->middleware('CheckClinic:clinic-api');
        Route::post('doctor/delete/appointment', [DoctorsEditProfileController::class, 'delete_appointment']);
        // Route::post('doctor/otplogin', [AuthController::class, 'OTPlogin']);
        // Route::post('doctor/CheckOtp', [AuthController::class, 'CheckCode']);
    });
    Route::group(['namespace' => 'Clinics'], function () {
        Route::post('clinic/register', [ClinicsAuthController::class, 'register']);
        Route::post('clinic/login', [ClinicsAuthController::class, 'login']);
           Route::post('clinic/delete/image', [ClinicsEditProfileController::class, 'delete_image']);
        Route::post('clinic/fcm/token', [ClinicsAuthController::class, 'ftoken'])->middleware('CheckClinic:clinic-api');
        // Route::get('clinic/getUserById/{id}',[ClinicsAuthController::class,'getUserById']);
        Route::post('clinic/logout', [ClinicsAuthController::class, 'logout']);
        Route::get('clinic/getClinicData', [ClinicsAuthController::class, 'getClinicData'])->middleware('CheckClinic:clinic-api');
        Route::post('clinic/edit', [ClinicsEditProfileController::class, 'Editprofile'])->middleware('CheckClinic:clinic-api');
          Route::post('clinic/change_password', [ClinicsEditProfileController::class, 'change_password'])->middleware('CheckClinic:clinic-api');
        Route::post('password/email',  [ForgotPasswordController::class, 'forget']);
        Route::post('password/reset', [ResetPasswordController::class, 'code']);
        Route::post('all/clinics', [ClinicsClinicController::class, 'all_clinics']);
        Route::post('clinic/by/id', [ClinicsClinicController::class, 'get_clinic_by_id']);
          Route::post('clinic/notifications', [ClinicsClinicController::class, 'get_all_notifications_of_clinic'])->middleware('CheckClinic:clinic-api');
        Route::post('clinic/by/specialization/id', [ClinicsClinicController::class, 'get_clincics_by_specialization_id']);
        Route::post('clinic/by/insurance/id', [ClinicsClinicController::class, 'get_clincics_by_insurance_id']);
                Route::post('doctors/clinic/specialization', [ClinicsClinicController::class, 'get_doctors_clinics_specialization']);
          Route::post('clinic/specialization', [ClinicsClinicController::class, 'get_all_specializetions_of_clinic'])->middleware('CheckClinic:clinic-api');
        Route::post('clinic/otplogin', [ClinicsAuthController::class, 'OTPlogin']);
        Route::post('clinic/CheckOtp', [ClinicsAuthController::class, 'CheckCode']);
          Route::post('clinic/search', [ClinicsClinicController::class, 'search']);
          Route::post('clinic/requests', [ClinicsClinicController::class, 'get_all_requests'])->middleware('CheckClinic:clinic-api');
           Route::post('clinic/approved/requests', [ClinicsClinicController::class, 'get_all_approved_requests'])->middleware('CheckClinic:clinic-api');
           Route::post('clinic/accept/request', [ClinicsClinicController::class, 'accept'])->middleware('CheckClinic:clinic-api');
            Route::post('clinic/reject/request', [ClinicsClinicController::class, 'reject'])->middleware('CheckClinic:clinic-api');
            Route::post('clinic/all/booking/list', [ClinicsClinicController::class, 'get_all_booking_list_for_clinic'])->middleware('CheckClinic:clinic-api');
          
    });

    Route::group(['namespace' => 'Insurance'], function () {
        Route::post('insurance/add', [InsuranceController::class, 'add'])->middleware('CheckClinic:clinic-api');
        Route::post('insurance/edit', [InsuranceController::class, 'edit'])->middleware('CheckClinic:clinic-api');
        Route::post('insurance/delete', [InsuranceController::class, 'delete'])->middleware('CheckClinic:clinic-api');
        Route::post('insurance/get/all', [InsuranceController::class, 'get_all']);
        Route::post('insurance/by/id', [InsuranceController::class, 'get_by_id']);
        Route::post('insurance/get/data', [InsuranceController::class, 'get_data']);
    });
     Route::group(['namespace' => 'Offers'], function () {
        Route::post('offer/add', [OffersController::class, 'store'])->middleware('CheckClinic:clinic-api');
        Route::post('offer/edit', [OffersController::class, 'edit'])->middleware('CheckClinic:clinic-api');
        Route::post('offer/delete', [OffersController::class, 'destroy'])->middleware('CheckClinic:clinic-api');
        Route::post('offer', [OffersController::class, 'index']);
        Route::post('offer/by/id', [OffersController::class, 'get_offer_by_id']);
         Route::post('offer/clinic', [OffersController::class, 'get_clinic_offers']);
        
    });
   
    Route::group(['namespace' => 'Specializations'], function () {
        Route::post('specializations', [SpecializationsController::class, 'index']);
        Route::post('filter/specialization', [specializationsController::class, 'get_doctors_by_specializations_id']);

    });
    Route::group(['namespace' => 'Banners'], function () {
        Route::post('banners/all',[BannersController::class,'index']);
        Route::post('ads_banners/all',[BannersController::class,'ads_banners']);

       });
       Route::group(['namespace' => 'Settings'], function () {
        Route::post('settings/about-us',[SettingController::class,'about_us']);
        Route::post('settings/contact-us',[SettingController::class,'contact_us']);
         Route::post('settings/faq',[SettingController::class,'faq']);

      });
      Route::group(['namespace' => 'Articles'], function () {
        Route::post('articles/all',[ArticleController::class,'index']);
         Route::post('articles/is_viewed',[ArticleController::class,'views'])->middleware('checkUser:user-api');



       });
       Route::group(['namespace' => 'Booking'], function () {
        Route::post('available/times',[UserBookingController::class,'available_times']);
         Route::post('user/book/appointment',[UserBookingController::class,'book'])->middleware('checkUser:user-api');
         Route::post('user/booking/list',[UserBookingController::class,'get_my_bookinglist'])->middleware('checkUser:user-api');
         Route::post('user/history/list',[UserBookingController::class,'get_my_history'])->middleware('checkUser:user-api');
         Route::post('get/all/days',[UserBookingController::class,'get_all_days']);
         Route::post('clinic/book/appointment',[UserBookingController::class,'clinic_book_appointment'])->middleware('CheckClinic:clinic-api');
         Route::post('user/book/with/clinic',[UserBookingController::class,'book_with_clinic'])->middleware('checkUser:user-api');



       });
        Route::group(['namespace' => 'CallUs'], function () {
        Route::post('user/callus',[CallUsController::class,'callus'])->middleware('checkUser:user-api');
                Route::post('about/app',[CallUsController::class,'about_app']);




       });


});

