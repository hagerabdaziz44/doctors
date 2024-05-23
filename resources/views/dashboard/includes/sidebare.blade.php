@if(Auth::user()->type =='admin')

<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
       <div class="main-menu-content">
              <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                     <li class="nav-item "><a href="{{route('admin.dashboard')}}"><i class=""></i><span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
                     </li>

                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">العملاء </span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Patient::count()}}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('admin.patients.index')}}" data-i18n="nav.dash.ecommerce">جميع العملاء</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('admin.patients.create')}}" data-i18n="nav.dash.crypto">اضافة عميل
                                          </a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">التخصصات </span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Specialization::count()}}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('specialization.index')}}" data-i18n="nav.dash.ecommerce">جميع التخصصات </a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('specialization.create')}}" data-i18n="nav.dash.crypto">اضافة تخصص جديدة
                                          </a>
                                   </li>
                            </ul>
                     </li>


                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">شركات التأمين</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Insurance::count()}}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('insurance.index')}}" data-i18n="nav.dash.ecommerce">جميع شركات التأمين</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('insurance.create')}}" data-i18n="nav.dash.crypto">
                                                 اضافة شركة تأمين جديدة</a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">العيادات</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Clinic::count()}} </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('clinics.index')}}" data-i18n="nav.dash.ecommerce">جميع العيادات</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('clinics.create')}}" data-i18n="nav.dash.crypto">اضافة عيادة جديدة
                                          </a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الاطباء</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Doctor::count()}} </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('doctors.index')}}" data-i18n="nav.dash.ecommerce">جميع الاطباء</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('doctors.create')}}" data-i18n="nav.dash.crypto">اضافة طبيب جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>
                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">العروض</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Offer::count()}} </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('admin.offers.index')}}" data-i18n="nav.dash.ecommerce">جميع العروض</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('admin.offers.create')}}" data-i18n="nav.dash.crypto">اضافة عرض جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>

                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">المقالات</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{ App\Models\Article::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('admin.articles.index')}}" data-i18n="nav.dash.ecommerce">جميع المقالات</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('admin.articles.create')}}" data-i18n="nav.dash.crypto">اضافة مقال جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>
                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">الاشعارات </span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">{{ App\Models\PushNotification::count() }}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{ route('notifications.index') }}" data-i18n="nav.dash.ecommerce"> جميع الاشعارات </a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{ route('notifications.create') }}" data-i18n="nav.dash.crypto">اضافة اشعار جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>
                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">لوحات اعلانية</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\Banner::count()}} </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('admin.banners.index')}}" data-i18n="nav.dash.ecommerce">جميع اللوحات الاعلانية </a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('admin.banners.create')}}" data-i18n="nav.dash.crypto">اضافة لوحة اعلانية جديدة
                                          </a>
                                   </li>
                            </ul>
                     </li>
                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">تواصل معنا</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">
                                          {{\App\Models\CallUs::count()}} </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{ route('callus.index')}}" data-i18n="nav.dash.ecommerce">اتصل بنا </a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{ route('contact_us.index') }}" data-i18n="nav.dash.ecommerce">تواصل معنا</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{ route('qa.index') }}" data-i18n="nav.dash.crypto">الاسئلة والاجابات
                                          </a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{ route('about_us') }}" data-i18n="nav.dash.crypto">عنا
                                          </a>
                                   </li>

                            </ul>
                     </li>
                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">التاريخ المرضي للعملاء</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\ClientInformation::count()}}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('reception.index')}}" data-i18n="nav.dash.ecommerce">التاريخ المرضي للعملاء</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('reception.create')}}" data-i18n="nav.dash.crypto">اضافة تاريخ مرضي جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>







              </ul>
              </li>










              </ul>
       </div>
</div>
@else
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
       <div class="main-menu-content">
              <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">



                     <li class="nav-item"><a href=""><i class="la la-group"></i>
                                   <span class="menu-title" data-i18n="nav.dash.main">التاريخ المرضي للعملاء</span>
                                   <span class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\ClientInformation::count()}}
                                   </span>
                            </a>
                            <ul class="menu-content">
                                   <li class=""><a class="menu-item" href="{{route('reception.index')}}" data-i18n="nav.dash.ecommerce">التاريخ المرضي للعملاء</a>
                                   </li>
                                   <li class=""><a class="menu-item" href="{{route('reception.create')}}" data-i18n="nav.dash.crypto">اضافة تاريخ مرضي جديد
                                          </a>
                                   </li>
                            </ul>
                     </li>


              </ul>
       </div>
</div>
@endif