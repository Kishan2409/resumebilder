<?php

use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ExperienceController;
use App\Http\Controllers\User\HeroController;
use App\Http\Controllers\User\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/{name}', [HomeController::class, 'show']);

Route::get('/admin', function () {
    if (auth('admins')->user()) {
        return redirect('admin/dashboard');
    } else {
        return redirect('admin/login');
    }
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
Route::group(['prefix' => 'user'], function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/hero', [HeroController::class, 'index'])->name('user.hero.index');
        Route::post('/hero', [HeroController::class, 'store']);

        Route::get('/about', [AboutController::class, 'index'])->name('user.about.index');
        Route::post('/about', [AboutController::class, 'store']);

        Route::get('getSkillsData',  [AboutController::class, 'getskillsdata'])->name('get.skill.data');
        Route::post('/about/skill', [AboutController::class, 'skillstore'])->name('user.skill.store');
        Route::get('/about/skill/edit/', [AboutController::class, 'edit'])->name('user.skill.edit');
        Route::post('/about/skill/update/', [AboutController::class, 'update'])->name('user.skill.update');
        Route::get('/about/skill/delete', [AboutController::class, 'destroy'])->name('user.skill.destroy');

        Route::get('getEducationsData',  [AboutController::class, 'geteducationdata'])->name('get.education.data');
        Route::post('/about/education', [AboutController::class, 'educationstore'])->name('user.education.store');
        Route::get('/about/education/edit/', [AboutController::class, 'educationedit'])->name('user.education.edit');
        Route::post('/about/education/update/', [AboutController::class, 'educationupdate'])->name('user.education.update');
        Route::get('/about/education/delete', [AboutController::class, 'educationdestroy'])->name('user.education.destroy');

        Route::get('/experience', [ExperienceController::class, 'index'])->name('user.experience.index');
        Route::get('/experience/add', [ExperienceController::class, 'create'])->name('user.experience.create');
        Route::post('/experience/add', [ExperienceController::class, 'store'])->name('user.experience.store');
        Route::get('/experience/edit/{id}', [ExperienceController::class, 'edit'])->name('user.experience.edit');
        Route::post('/experience/edit/{id}', [ExperienceController::class, 'update']);
        Route::get('/experience/show/{id}', [ExperienceController::class, 'show'])->name('user.experience.show');
        Route::get('/experience/delete', [ExperienceController::class, 'destroy'])->name('user.experience.destroy');
        Route::get('/experience/status', [ExperienceController::class, 'status'])->name('user.experience.status');

        Route::get('/service', [ServiceController::class, 'index'])->name('user.service.index');
        Route::get('/service/add', [ServiceController::class, 'create'])->name('user.service.create');
        Route::post('/service/add', [ServiceController::class, 'store'])->name('user.service.store');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('user.service.edit');
        Route::post('/service/edit/{id}', [ServiceController::class, 'update']);
        Route::get('/service/show/{id}', [ServiceController::class, 'show'])->name('user.service.show');
        Route::get('/service/delete', [ServiceController::class, 'destroy'])->name('user.service.destroy');
        Route::get('/service/status', [ServiceController::class, 'status'])->name('user.service.status');
    });
});

Route::group(['prefix' => 'admin'], function () {

    //login
    Route::get('login', [AdminController::class, 'login_form'])->name('login.form');
    Route::post('login-functionality', [AdminController::class, 'login_functionality'])->name('login.functionality');

    Route::group(['middleware' => 'admin'], function () {

        //logout
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

        //dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        //setting
        Route::get('web-setting', [SettingController::class, 'index'])->name('web.index');
        Route::post('web-setting', [SettingController::class, 'store']);

        //profile password
        Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('profile', [AdminController::class, 'updateprofile'])->name('admin.profileupdate');
    });
});

require __DIR__ . '/auth.php';
