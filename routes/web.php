<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DongXeController;
use App\Http\Controllers\TinXeController;
use App\Http\Controllers\XeController;
use App\Http\Controllers\MauXeController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CauHinhController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ThuThapController;
use App\Http\Controllers\TuyenDungController;
use App\Http\Controllers\ViTriXeController;

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

Route::get('/', [IndexController::class, 'getIndex']);

Route::get('/tincongty', [IndexController::class, 'getTinCongTy']);
Route::get('/tinkhuyenmai', [IndexController::class, 'getTinKhuyenMai']);
Route::get('/tin-tuc/{slug}', [IndexController::class, 'getChiTietTin']);
Route::get('/tinchiase', [IndexController::class, 'getTinChiaSe']);
Route::get('/tintuyendung', [IndexController::class, 'getTinTuyenDung']);
Route::get('/dangkylaithuxe', [IndexController::class, 'getDangKyLaiThuXe']);
Route::get('/gopykhachhang', [IndexController::class, 'getGopY']);
Route::get('/datlichhen', [IndexController::class, 'getDatHen']);
Route::get('/san-pham/{slug}', [IndexController::class, 'getTinXe']);
Route::post('/guithongtin', [IndexController::class, 'guiThongTin'])->name('post.data');
Route::post('/dangkyemail', [IndexController::class, 'dangKyEmail'])->name('post.data.email');
Route::post('/guibaogia', [IndexController::class, 'guiBaoGia'])->name('post.data.baogia');
Route::post('/dangkylaithu', [IndexController::class, 'dangKyLaiThu'])->name('post.data.dangkylaithu');
Route::post('/gopy', [IndexController::class, 'gopY'])->name('post.data.gopy');
Route::post('/dathen', [IndexController::class, 'datHen'])->name('post.data.dathen');


Route::get('/admin', function() {
    if (Auth::check())
        return view('server.mainpanel');
    return view('login');
})->name('login_panel');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', function(){
    Auth::logout();
    return view('login');
});

Route::prefix('management')->middleware(['m_login'])->group(function(){
    Route::view('/mainpanel', 'server.mainpanel');
    Route::prefix('account')->group(function(){
        Route::name('quanlytaikhoan.')->group(function(){
            Route::get('/',[UserController::class, 'index'])->name('panel');
            Route::get('/getdata',[UserController::class, 'loadData']);
            Route::post('/post',[UserController::class, 'postData'])->name('post');
            Route::post('/delete',[UserController::class, 'delete'])->name('delete');
            Route::get('/getedit',[UserController::class, 'getEdit'])->name('getedit');
            Route::post('/postedit',[UserController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('dongxe')->group(function(){
        Route::name('quanlydongxe.')->group(function(){
            Route::get('/',[DongXeController::class, 'index'])->name('panel');
            Route::get('/getdata',[DongXeController::class, 'loadData']);
            Route::post('/post',[DongXeController::class, 'postData'])->name('post');
            Route::post('/delete',[DongXeController::class, 'delete'])->name('delete');
            Route::get('/getedit',[DongXeController::class, 'getEdit'])->name('getedit');
            Route::post('/postedit',[DongXeController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('tinxe')->group(function(){
        Route::name('tinxe.')->group(function(){
            Route::get('/',[TinXeController::class, 'index'])->name('panel');
            Route::get('/getdata',[TinXeController::class, 'loadData']);
            Route::get('/gettinxe',[TinXeController::class, 'getTinXe']);
            Route::get('/themmoi',[TinXeController::class, 'themMoi'])->name('post.themmoi');
            Route::post('/themmoi/post',[TinXeController::class, 'postData'])->name('post');
            Route::post('/delete',[TinXeController::class, 'delete'])->name('delete');
            Route::get('/getedit/{idtinxe}',[TinXeController::class, 'getEdit'])->name('getedit');
            Route::post('/getedit/{idtinxe}/postedit',[TinXeController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('xe')->group(function(){
        Route::name('xe.')->group(function(){
            Route::get('/',[XeController::class, 'index'])->name('panel');
            Route::get('/getdata',[XeController::class, 'loadData']);
            Route::get('/gettinxe',[XeController::class, 'getTinXe']);
            Route::get('/themmoi',[XeController::class, 'themMoi'])->name('post.themmoi');
            Route::post('/themmoi/post',[XeController::class, 'postData'])->name('post');
            Route::post('/delete',[XeController::class, 'delete'])->name('delete');
            Route::get('/getedit/{idxe}',[XeController::class, 'getEdit'])->name('getedit');
            Route::post('/getedit/{idxe}/postedit',[XeController::class, 'postEdit'])->name('postedit');
            Route::post('/postmauxe',[MauXeController::class, 'postMauXe']);
            Route::get('/getmauxe',[MauXeController::class, 'getMauXe']);
            Route::post('/deletemauxe',[MauXeController::class, 'deleteMauXe']);
        });        
    });
    Route::prefix('tintuc')->group(function(){
        Route::name('tintuc.')->group(function(){
            Route::get('/',[TinTucController::class, 'index'])->name('panel');
            Route::get('/getdata',[TinTucController::class, 'loadData']);
            Route::get('/gettintuc',[TinTucController::class, 'getTinTuc']);
            Route::get('/themmoi',[TinTucController::class, 'themMoi'])->name('post.themmoi');
            Route::post('/themmoi/post',[TinTucController::class, 'postData'])->name('post');
            Route::post('/delete',[TinTucController::class, 'delete'])->name('delete');
            Route::get('/getedit/{idtintuc}',[TinTucController::class, 'getEdit'])->name('getedit');
            Route::post('/getedit/{idtintuc}/postedit',[TinTucController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('slider')->group(function(){
        Route::name('slider.')->group(function(){
            Route::get('/',[SliderController::class, 'index'])->name('panel');
            Route::get('/getdata',[SliderController::class, 'loadData']);
            Route::get('/gettin',[SliderController::class, 'getTin']);
            Route::post('/post',[SliderController::class, 'postData'])->name('post');
            Route::post('/delete',[SliderController::class, 'delete'])->name('delete');
            Route::get('/getedit',[SliderController::class, 'getEdit'])->name('getedit');
            Route::post('/postedit',[SliderController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('cauhinh')->group(function(){
        Route::name('cauhinh.')->group(function(){
            Route::get('/',[CauHinhController::class, 'index'])->name('panel');
            Route::post('/post',[CauHinhController::class, 'postData'])->name('post');
        });        
    });
    Route::prefix('menu')->group(function(){
        Route::name('menu.')->group(function(){
            Route::get('/',[MenuController::class, 'index'])->name('panel');
            Route::get('/getdata',[MenuController::class, 'loadData']);
            Route::post('/post',[MenuController::class, 'postData'])->name('post');
            Route::post('/delete',[MenuController::class, 'delete'])->name('delete');
            Route::get('/getedit',[MenuController::class, 'getEdit'])->name('getedit');
            Route::post('/postedit',[MenuController::class, 'postEdit'])->name('postedit');
            // Submenu
            Route::post('/submenu/post',[MenuController::class, 'postDataSubMenu'])->name('submenu.post');
            Route::post('/submenu/delete',[MenuController::class, 'deleteSubMenu'])->name('submenu.delete');
            Route::post('/setoff',[MenuController::class, 'setOff'])->name('setoff');
            Route::post('/seton',[MenuController::class, 'setOn'])->name('seton');
            Route::get('/getedit',[MenuController::class, 'getEdit'])->name('getedit');
            Route::get('/submenu/getedit',[MenuController::class, 'getEditSubMenu'])->name('geteditsubmenu');
            Route::post('/submenu/postedit',[MenuController::class, 'postEditSubMenu'])->name('submenu.postedit');
        });        
    });
    Route::prefix('thuthap')->group(function(){
        Route::name('thuthap.')->group(function(){
            Route::get('/',[ThuThapController::class, 'index'])->name('panel');
            Route::get('/getdata',[ThuThapController::class, 'loadData']);
            // Route::post('/post',[ThuThapController::class, 'postData'])->name('post');
            // Route::post('/delete',[ThuThapController::class, 'delete'])->name('delete');
            // Route::get('/getedit',[ThuThapController::class, 'getEdit'])->name('getedit');
            // Route::post('/postedit',[ThuThapController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('tuyendung')->group(function(){
        Route::name('tuyendung.')->group(function(){
            Route::get('/',[TuyenDungController::class, 'index'])->name('panel');
            Route::get('/getdata',[TuyenDungController::class, 'loadData']);
            // Route::post('/post',[ThuThapController::class, 'postData'])->name('post');
            // Route::post('/delete',[ThuThapController::class, 'delete'])->name('delete');
            // Route::get('/getedit',[ThuThapController::class, 'getEdit'])->name('getedit');
            // Route::post('/postedit',[ThuThapController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('vitrixe')->group(function(){
        Route::name('vitrixe.')->group(function(){
            Route::get('/',[ViTriXeController::class, 'index'])->name('panel');
            Route::get('/getdata',[ViTriXeController::class, 'loadData']);
            Route::post('/post',[ViTriXeController::class, 'postData'])->name('post');
            Route::post('/delete',[ViTriXeController::class, 'delete'])->name('delete');
            Route::get('/getedit',[ViTriXeController::class, 'getEdit'])->name('getedit');
            Route::post('/postedit',[ViTriXeController::class, 'postEdit'])->name('postedit');
        });        
    });
    Route::prefix('luutru')->group(function(){
        Route::name('luutru.')->group(function(){
            Route::view('/', 'server.luutru.luutru')->name('panel');
        });        
    });
});
