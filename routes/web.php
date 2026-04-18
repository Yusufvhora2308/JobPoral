<?php


use App\Http\Controllers\Aboutcontroller;
use App\Http\Controllers\AdminApplicantionController;
use App\Http\Controllers\AdminCompanyController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Admindashboard;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\Applicantcontroller;
use App\Http\Controllers\Applynowcontroller;
use App\Http\Controllers\companydashboard;
use App\Http\Controllers\CompanyForgetPasswordController;
use App\Http\Controllers\Companylogincontroller;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DownLoadResumeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Joblistcontroller;
use App\Http\Controllers\JobNotficationController;
use App\Http\Controllers\JobRecommendationController;
use App\Http\Controllers\Managejobcontroller;
use App\Http\Controllers\Postjobcontroller;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Settingcontroller;
use App\Http\Controllers\Userprofilecontroller;

use App\Http\Controllers\EducationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Logincontroller;

use App\Http\Controllers\Homecontroller;

use App\Http\Controllers\SkillController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\JobtitleController;
use App\Http\Controllers\JobtypeController;
use App\Http\Controllers\WorksheduleController;
use App\Http\Controllers\RemoteController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CompanyReivewController;
use App\Http\Controllers\AdminReviewController;

Route::get('/', [Homecontroller::class,'Home']);


Route::middleware('guest')->group(function(){

    Route::get('Register',[Logincontroller::class,'showregister'])->name('register');

    Route::POST('register',[Logincontroller::class,'register'])->name('authregister');

    Route::get('Login',[Logincontroller::class,'showlogin'])->name('login');

    Route::POST('login',[Logincontroller::class,'authlogins'])->name('authlogin');

  Route::get('/forgot-password', [ForgetPasswordController::class, 'showForgot'])
    ->name('forgot.password');

Route::post('/send-otp', [ForgetPasswordController::class, 'sendOtp'])
    ->name('send.otp');

Route::get('/verify-otp', [ForgetPasswordController::class, 'showOtpForm'])
    ->name('verify.otp');

Route::post('/verify-otp', [ForgetPasswordController::class, 'verifyOtp'])
    ->name('verify.otp.post'); // 👈 optional naam change

Route::get('/reset-password', [ForgetPasswordController::class, 'showReset'])
    ->name('reset.password');

Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword'])
    ->name('reset.password.post');


  
    

});

Route::get('Home',[Homecontroller::class,'Home'])->name('user.home');

Route::get('Joblist',[Joblistcontroller::class,'Joblist'])->name('user.joblist');

Route::get('/job/{id}', [Applynowcontroller::class, 'show'])->name('job.show');

Route::get('About',[Aboutcontroller::class,'About'])->name('user.about');




Route::middleware(['auth'])->group(function (){



Route::post('/logout',[Logincontroller::class,'logout'])->name('logout');

Route::get('Profile',[Userprofilecontroller::class,'Userprofile'])->name('user.profile');

Route::get('/job/{id}/apply', [Applynowcontroller::class, 'apply'])->name('job.apply');

Route::post('/job/{id}/apply', [Applynowcontroller::class, 'store'])->name('job.apply.store');

Route::get('/my-applications', [Userprofilecontroller::class, 'myApplications'])->name('user.applications');

Route::post('/jobs/save/{id}', [Joblistcontroller::class,'saveJobs'])->name('job.save');

Route::get('/saved-jobs', [Joblistcontroller::class,'savedJobs'])->name('job.saved');

Route::get('/profile/edit', [Userprofilecontroller::class, 'edit'])->name('profile.edit');

Route::put('/profile/update', [Userprofilecontroller::class, 'update'])->name('profile.update');

Route::post('/ready-toggle',[Userprofilecontroller::class,'readyToggle'])->name('ready.toggle');

Route::post('/profile-photo', [Userprofilecontroller::class,'updatePhoto'])->name('profile.photo');

Route::post('/cover-photo', [Userprofilecontroller::class,'updateCover'])->name('profile.cover');

Route::get('/profile/qualification', [Userprofilecontroller::class, 'qualification'])->name('profile.qualification');

Route::get('/education', [EducationController::class, 'index'])->name('education.index');

Route::post('/education/store', [EducationController::class, 'store'])->name('education.store');

Route::get('/education/edit/{id}', [EducationController::class, 'edit'])->name('education.edit');

Route::post('/education/update/{id}', [EducationController::class, 'update'])->name('education.update');

Route::delete('/education/delete/{id}', [EducationController::class, 'destroy'])->name('');

//skills
Route::get('/profile/skills', [Userprofilecontroller::class, 'qualification'])->name('profile.skills');

Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

Route::post('/skills/store', [SkillController::class, 'store'])->name('skills.store');

Route::post('/skills/update/{id}', [SkillController::class, 'update'])->name('skills.update');

Route::delete('/skills/delete/{id}', [SkillController::class, 'destroy'])->name('skills.delete');
//

/* LANGUAGE */
Route::get('/profile/Language', [Userprofilecontroller::class, 'qualification'])->name('profile.language');

Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');

Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');

Route::post('/languages/update/{id}', [LanguageController::class, 'update'])->name('languages.update');

Route::delete('/languages/delete/{id}', [LanguageController::class, 'destroy'])->name('languages.delete');

//

/* CERTIFICATE */
Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
Route::post('/certificates/store', [CertificateController::class, 'store'])->name('certificates.store');
Route::post('/certificates/update/{id}', [CertificateController::class, 'update'])->name('certificates.update');
Route::delete('/certificates/delete/{id}', [CertificateController::class, 'destroy'])->name('certificates.delete');

/* LICENSE */
Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses.index');
Route::post('/licenses/store', [LicenseController::class, 'store'])->name('licenses.store');
Route::post('/licenses/update/{id}', [LicenseController::class, 'update'])->name('licenses.update');
Route::delete('/licenses/delete/{id}', [LicenseController::class, 'destroy'])->name('licenses.delete');



Route::get('/profile/jobpreferences', [Userprofilecontroller::class, 'jobpreferencs'])->name('profile.jobpreferencs');


Route::get('/jobtitle', [JobTitleController::class, 'index'])->name('jobtitle.index');

Route::post('/jobtitle/store', [JobTitleController::class, 'store'])->name('jobtitle.store');

Route::post('/jobtitle/update/{id}', [JobTitleController::class, 'update'])->name('jobtitle.update');

Route::delete('/jobtitle/delete/{id}', [JobTitleController::class, 'destroy'])->name('jobtitle.delete');

Route::get('/job-types', [JobTypeController::class,'index'])->name('jobtypes.index');

Route::post('/job-types/store', [JobTypeController::class,'store'])->name('jobtypes.store');

Route::post('/job-types/update/{id}', [JobTypeController::class,'update'])->name('jobtypes.update');

Route::delete('/job-types/delete/{id}', [JobTypeController::class,'destroy'])->name('jobtypes.delete');

Route::get('/work-schedules', [WorksheduleController::class,'index'])->name('workschedules.index');

Route::post('/work-schedules/store', [WorksheduleController::class,'store'])->name('workschedules.store');

Route::post('/work-schedules/update/{id}', [WorksheduleController::class,'update'])->name('workschedules.update');

Route::delete('/work-schedules/delete/{id}', [WorksheduleController::class,'destroy'])->name('workschedules.delete');

Route::get('/remotes', [RemoteController::class,'index'])->name('remotes.index');

Route::post('/remotes/store', [RemoteController::class,'store'])->name('remotes.store');

Route::post('/remotes/update/{id}', [RemoteController::class,'update'])->name('remotes.update');

Route::delete('/remotes/delete/{id}', [RemoteController::class,'destroy'])->name('remotes.delete');

Route::get('/pays', [PayController::class,'index'])->name('pays.index');

Route::post('/pays/store', [PayController::class,'store'])->name('pays.store');

Route::post('/pays/update/{id}', [PayController::class,'update'])->name('pays.update');

Route::delete('/pays/delete/{id}', [PayController::class,'destroy'])->name('pays.delete');

Route::get('/experience', [ExperienceController::class, 'index'])->name('profile.experience');

Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');

Route::post('/experience/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');

Route::delete('/experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.delete');

Route::post('/resume/upload', [ResumeController::class,'uploadResume'])->name('resume.upload');

Route::delete('/resume/delete', [ResumeController::class,'deleteResume'])->name('resume.delete');

Route::get('/contact',[FeedbackController::class,'contact'])->name('contact');

Route::post('/contact', [FeedbackController::class,'store'])->name('contact.store');



//Resume Dowonload

Route::get('/resume/download', [DownLoadResumeController::class, 'generate'])
    ->name('resume.download');


Route::get('/recommended-jobs', [JobRecommendationController::class, 'recommendJobs'])
    ->name('recommended.jobs');


// 🔹 Save Notification (optional manual trigger)
Route::post('/store-job-notification', [JobRecommendationController::class, 'storeNotification'])
    ->name('store.job.notification');


// 🔹 View All Notifications Page
Route::get('/notifications', [JobNotficationController::class, 'index'])
    ->name('notifications');


// 🔹 Mark as Read
Route::get('/notification/read/{id}', [JobNotficationController::class, 'markAsRead'])
    ->name('notification.read');



Route::post('/application/withdraw/{id}', [Userprofilecontroller::class, 'withdraw'])
    ->name('application.withdraw');


  Route::get('/job/{id}/reviews', [Joblistcontroller::class, 'rate'])->name('job.ratingshow');
});




Route::prefix('company')->group(function () {

    // GUEST COMPANY
    Route::middleware('company.guest')->group(function () {

        Route::get('companyregister', [Companylogincontroller::class, 'cmpregister'])
            ->name('cregister');

        Route::get('companylogin', [Companylogincontroller::class, 'cmplogin'])
            ->name('clogin');

        Route::post('companyregister', [Companylogincontroller::class, 'store'])
            ->name('register.store');

        Route::post('companylogin', [Companylogincontroller::class, 'authlogin'])
            ->name('companylogin.auth');

               Route::get('/forgot-password', [CompanyForgetPasswordController::class,'showForgot'])->name('company.forgot.password');
    Route::post('/send-otp',[CompanyForgetPasswordController::class, 'sendOtp'])->name('company.send.otp');

    Route::get('/verify-otp', [CompanyForgetPasswordController::class,'showOtpForm'])->name('company.verify.otp');
    Route::post('/verify-otp', [CompanyForgetPasswordController::class,'verifyOtp'])->name('company.verify.otp.post');

    Route::get('/reset-password',[CompanyForgetPasswordController::class, 'showReset'])->name('company.reset.password');
    Route::post('/reset-password', [CompanyForgetPasswordController::class,'resetPassword'])->name('company.reset.password.post');
    });

    // AUTH COMPANY
    Route::middleware('company.auth')->group(function () {

        Route::get('dashboard', [companydashboard::class, 'dashboard'])
            ->name('dashboard');

        Route::post('company-logout', [Companylogincontroller::class, 'logout'])
            ->name('company.logout');

        Route::get('Postjob',[Postjobcontroller::class,'postjob'])->name('postjob');

        Route::Post('store',[Postjobcontroller::class,'store'])->name('postjob.store');
     
        Route::get('Managejob',[Managejobcontroller::class,'managejob'])->name('managejob');

        Route::get('/jobs/{id}/edit', [Managejobcontroller::class, 'edit'])->name('jobs.edit');

        Route::put('/jobs/{id}', [Managejobcontroller::class, 'update'])->name('jobs.update');

        Route::delete('/jobs/{id}',  [Managejobcontroller::class, 'destroy'])->name('jobs.delete');

        Route::patch('/company/jobs/status/{id}',[Managejobcontroller::class,'toggleStatus'])->name('jobs.status');

        Route::get('profile', [CompanyProfileController::class,'profile'])->name('company.profile');
       
        Route::post('/update-cover', [CompanyProfileController::class, 'updateCover'])->name('company.cover.update');

        Route::post('/update-logo', [CompanyProfileController::class, 'updateLogo'])->name('company.logo.update');

        Route::post('/update-info', [CompanyProfileController::class, 'updateInfo'])->name('company.info.update');

        Route::get('settings', [Settingcontroller::class, 'settings']) ->name('company.setting');

        Route::put('settings/update', [Settingcontroller::class, 'updateSettings'])->name('company.settings.update');

        Route::put('settings/email', [Settingcontroller::class,'updateEmail'])->name('company.settings.email');


        Route::get('/applicants', [Applicantcontroller::class, 'index'])->name('company.applicants');

        Route::delete('/applicants/{id}', [Applicantcontroller::class, 'destroy'])->name('company.applicants.delete');

        Route::post( '/company/applicant/status/{id}',  [Applicantcontroller::class, 'updateStatus'])->name('company.applicant.status');

         Route::post('/company/review', [CompanyReivewController::class, 'store'])->name('company.review');

        Route::get('/company/reviews', [CompanyReivewController::class, 'index'])->name('company.reviews');


    });
});



Route::prefix('admin')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [Admincontroller::class, 'showLogin'])->name('adminlogin');
        Route::post('/login', [Admincontroller::class, 'login'])->name('admin.store');
    });

    Route::middleware(['admin.auth'])->group(function () {

        Route::get('/dashboard', [Admindashboard::class,'dashboard'])->name('admin.dashboard');

        Route::post('/admin-logout', [Admincontroller::class, 'logout'])->name('adminlogout');

        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');

        Route::post('/users/status/{id}', [AdminUserController::class, 'toggleStatus'])->name('admin.users.status');

        Route::get('/companies', [AdminCompanyController::class, 'index'])->name('admin.companies');
        
        Route::post('/companies/status/{id}', [AdminCompanyController::class, 'toggleStatus'])->name('admin.companies.status');

          // Job Management
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs');

        Route::post('/jobs/{id}/approve', [AdminJobController::class, 'approve'])->name('admin.jobs.approve');
       
        Route::post('/jobs/{id}/reject', [AdminJobController::class, 'reject'])->name('admin.jobs.reject');

        Route::get('/jobs/{id}/edit', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');

        Route::PUT('/jobs/{id}/update', [AdminJobController::class, 'update'])->name('admin.jobs.update');

        Route::post('/admin/jobs/{id}/toggle', [AdminJobController::class, 'toggleStatus'])->name('admin.jobs.toggle');

        Route::delete('/jobs/{id}', [AdminJobController::class, 'delete'])->name('admin.jobs.delete');

        Route::post('/jobs/expire-auto', [AdminJobController::class, 'autoExpire'])->name('admin.jobs.expire');

            Route::get('/applications', [AdminApplicantionController::class, 'index'])->name('admin.applications');

    Route::get('/applications/{id}', [AdminApplicantionController::class, 'show'])->name('admin.applications.show');

    Route::post('/applications/status/{id}', [AdminApplicantionController::class, 'updateStatus'])->name('admin.applications.status');

    Route::delete('/applications/{id}', [AdminApplicantionController::class, 'destroy'])->name('admin.applications.delete');

     Route::get('/settings', [AdminSettingController::class, 'settings'])
        ->name('admin.settings');

    Route::post('/settings/update', [AdminSettingController::class, 'updateSettings'])->name('admin.settings.update');

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');

    Route::post('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews');
    });
});
