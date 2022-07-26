<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SubSectorController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\InvestmentRangeController;
use App\Http\Controllers\DealTypeController;
use App\Http\Controllers\PartnershipTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectStageController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\ProjectContactUsController;
use App\Http\Controllers\ProjectFinancialController;
use App\Http\Controllers\ProjectTeamController;
use App\Http\Controllers\ProjectMediaController;
use App\Http\Controllers\PotentialLocationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\InvestorIntrestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\UserExpertiseController;
use App\Http\Controllers\InvestorSectorController;
use App\Http\Controllers\ProjectInvestorController;
use App\Http\Controllers\ProjectMentorController;
use App\Http\Controllers\ProjectDocumentController;
use App\Http\Controllers\SustainableDevelopmentGoalController;
use App\Http\Controllers\ProjectSdgController;
use App\Http\Controllers\CompanyEntrepreneurController;




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


Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('auth.login');
    }
});


Route::group(['middleware' => ['auth','verified']], function () {


    Route::get('/dashboard', [ProjectController::class, 'getInvestorDashboard'])->name('dashboard');

    Route::resources(['blogs' => BlogController::class]);
    Route::resources(['users' => UserController::class]);
    Route::resources(['user-details' => UserDetailController::class]);
    Route::resources(['user-types' => UserTypeController::class]);
    Route::resources(['user-expertises' => UserExpertiseController::class]);
    Route::resources(['countries' => CountryController::class]);
    Route::resources(['cities' => CityController::class]);
    Route::resources(['sectors' => SectorController::class]);
    Route::resources(['sub-sectors' => SubSectorController::class]);
    Route::resources(['expertises' => ExpertiseController::class]);
    Route::resources(['investment-ranges' => InvestmentRangeController::class]);
    Route::resources(['deal-types' => DealTypeController::class]);
    Route::resources(['partnership-types' => PartnershipTypeController::class]);
    Route::resources(['shareholders' => InvestorController::class]);
    Route::resources(['investors-sectors' => InvestorSectorController::class]);
    Route::resources(['sustainable-development-goals' => SustainableDevelopmentGoalController::class]);



    Route::get('investors-project-list', [ProjectMentorController::class, 'getProjectDetail'])->name('investors-project-list');  

    Route::get('archived-investors', [InvestorController::class, 'archivedInvestors'])->name('archived-investors');
    Route::get('archived-staff', [UserController::class, 'archivedstaff'])->name('archived-staff');
    Route::get('archived-volunteer', [UserController::class, 'archivedVolunteer'])->name('archived-volunteer');



    Route::resources(['interests' => InvestorIntrestController::class]);
    Route::resources(['entrepreneurs' => EntrepreneurController::class]);
    Route::resources(['entrepreneur-companies' => CompanyEntrepreneurController::class]);
    Route::resources(['staff' => StaffController::class]);
    Route::resources(['volunteers' => VolunteerController::class]);


    Route::resources(['projects' => ProjectController::class]);
    Route::resources(['project-stages' => ProjectStageController::class]);
    Route::resources(['project-contact-us' => ProjectContactUsController::class]);
    Route::resources(['project-financials' => ProjectFinancialController::class]);
    Route::resources(['project-teams' => ProjectTeamController::class]);
    Route::resources(['project-media' => ProjectMediaController::class]);
    Route::resources(['project-potential-location' => PotentialLocationController::class]);
    Route::get('project-locations', [PotentialLocationController::class, 'listProjectLocations'])->name('project-locations');
    Route::resources(['project-investors' => ProjectInvestorController::class]);
    Route::resources(['project-mentors' => ProjectMentorController::class]);
    Route::resources(['project-sdgs' => ProjectSdgController::class]);
    Route::resources(['project-documents' => ProjectDocumentController::class]);
    
    Route::get('/list-subsectors', [ProjectController::class, 'listSubSectors'])->name('list-subsectors');
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['permissions' => PermissionController::class]);
    Route::get('/roles-permission-assignment-list', [UserController::class, 'userRolesPermissionList'])->name('roles-permission-assignment-list');
    Route::get('edit-with-role-permissions/{id}', [UserController::class, 'editUserRolesPermissions'])->name('edit-with-role-permissions');
    Route::post('assign-role-permissions/{id}', [UserController::class, 'updateUserRolesPermissions'])->name('assign-role-permissions');

    Route::post('crop-image-upload', [UserController::class, 'uploadCropImage'])->name('crop-image-upload');
    Route::post('crop-logo-upload', [ProjectContactUsController::class, 'uploadCropImage'])->name('crop-logo-upload');

    Route::post('crop-blog-image-upload', [BlogController::class, 'uploadCropImage'])->name('crop-blog-image-upload');
    
    Route::get('restore-archive-user/{id}', [UserController::class, 'restoreArchiveUser'])->name('restore-archive-user');

    Route::get('restore-archive-staff/{id}', [UserController::class, 'restoreArchiveStaff'])->name('restore-archive-staff');
    Route::get('restore-archive-volunteer/{id}', [UserController::class, 'restoreArchiveVolunteer'])->name('restore-archive-volunteer');

    Route::get('/getimages', [ProjectMediaController::class, 'getImages'])->name('getimages');
    Route::post('image-delete', [ProjectMediaController::class, 'trashImage'])->name('image-delete');
    Route::post('mark-featured', [ProjectMediaController::class, 'markFeatured'])->name('mark-featured');

});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';
