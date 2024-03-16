<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\ViTriXe;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Slider;
use App\Models\TinTuc;
use App\Models\TinXe;
use App\Models\ThuThap;

class IndexController extends Controller
{
    //
    public function getIndex() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $slider = Slider::select("*")->orderBy('id', 'desc')->get();
        $tinKM = TinTuc::select("*")->where([
            ['loaiTin','=','KM'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->take(4)->get();
        $tinHAGI = TinTuc::select("*")->where([
            ['loaiTin','=','HAGI'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->take(4)->get();
        $tinCS = TinTuc::select("*")->where([
            ['loaiTin','=','KINHNGHIEM'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->take(4)->get();
        $tinRan = TinTuc::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $tinXeRan = TinXe::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $arrTongHop = [];
        foreach($tinRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 1;
            $temp->isTinXe = 0;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        foreach($tinXeRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 0;
            $temp->isTinXe = 1;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        $arrTongHop = Arr::shuffle($arrTongHop);
        return view('client.trangchu', [
            'data' => $data, 
            'xe' => $xe, 
            'menu' => $menu, 
            'slider' => $slider, 
            'tinKM' => $tinKM, 
            'tinHAGI' => $tinHAGI,
            'tinCS' => $tinCS,
            'randomTin' => $arrTongHop
        ]);
    }

    public function getTinCongTy() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $tinRan = TinTuc::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $tinXeRan = TinXe::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $arrTongHop = [];
        foreach($tinRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 1;
            $temp->isTinXe = 0;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        foreach($tinXeRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 0;
            $temp->isTinXe = 1;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        $arrTongHop = Arr::shuffle($arrTongHop);
        $tinHAGI = TinTuc::select("*")->where([
            ['loaiTin','=','HAGI'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->paginate(7);
        return view('client.tintuchagi', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu,
            'tinHAGI' => $tinHAGI,
            'randomTin' => $arrTongHop
        ]);
    }

    public function getTinKhuyenMai() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $tinKM = TinTuc::select("*")->where([
            ['loaiTin','=','KM'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->paginate(7);
        $tinRan = TinTuc::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $tinXeRan = TinXe::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $arrTongHop = [];
        foreach($tinRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 1;
            $temp->isTinXe = 0;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        foreach($tinXeRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 0;
            $temp->isTinXe = 1;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        $arrTongHop = Arr::shuffle($arrTongHop);
        return view('client.tintuckhuyenmai', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu,
            'tinKM' => $tinKM,
            'randomTin' => $arrTongHop
        ]);
    }

    public function getTinTuyenDung() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $tinTD = TinTuc::select("*")->where([
            ['loaiTin','=','KHAC'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->paginate(7);
        $tinRan = TinTuc::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $tinXeRan = TinXe::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $arrTongHop = [];
        foreach($tinRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 1;
            $temp->isTinXe = 0;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        foreach($tinXeRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 0;
            $temp->isTinXe = 1;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        $arrTongHop = Arr::shuffle($arrTongHop);
        return view('client.tintuyendung', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu,
            'tinTD' => $tinTD,
            'randomTin' => $arrTongHop
        ]);
    }

    public function getDangKyLaiThuXe() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        return view('client.dangkylaithu', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu
        ]);
    }

    public function getTinChiaSe() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $tinCS = TinTuc::select("*")->where([
            ['loaiTin','=','KINHNGHIEM'],
            ['show','=',true],
        ])->orderBy('id', 'desc')->paginate(7);
        $tinRan = TinTuc::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $tinXeRan = TinXe::select("*")->where([
            ['quangCaoRamDom','=', true],
        ])->orderBy('id', 'desc')->get();
        $arrTongHop = [];
        foreach($tinRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 1;
            $temp->isTinXe = 0;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        foreach($tinXeRan as $row) {
            $temp = [];
            $temp = (object) $temp;
            $temp->idTin = $row->id;
            $temp->isTinTuc = 0;
            $temp->isTinXe = 1;
            $temp->hinhAnh = $row->hinhAnh;
            $temp->slugName = $row->slugName;
            array_push($arrTongHop, $temp);
        }
        $arrTongHop = Arr::shuffle($arrTongHop);
        return view('client.tintucchiase', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu,
            'tinCS' => $tinCS,
            'randomTin' => $arrTongHop
        ]);
    }

    public function getGopY() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        return view('client.ykienkhachhang', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu
        ]);
    }

    public function getDatHen() {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        return view('client.dathen', [
            'data' => $data,
            'xe' => $xe, 
            'menu' => $menu
        ]);
    }

    public function getChiTietTin($slug) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $loaiTin = TinTuc::where('slugName',$slug)->first()->loaiTin;
        $tinLienQuan = TinTuc::where([
            ['loaiTin','=', $loaiTin],
            ['slugName','!=', $slug],
            ['show','=',true]
        ])->orderBy('id', 'desc')->limit(3)->get();
        $tinKM = TinTuc::where([
            ['loaiTin','=', 'KM'],
            ['show','=',true]
        ])->orderBy('id', 'desc')->limit(3)->get();
        $tinTuc = TinTuc::where('slugName',$slug)->first();
        $randomCar = ViTriXe::inRandomOrder()->limit(5)->get();
        if ($tinTuc)
            return view('client.tintucchitiet', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'tinTuc' => $tinTuc,
                'randomCar' => $randomCar,
                'tinLienQuan' => $tinLienQuan,
                'tinKM' => $tinKM
            ]);
        else
            abort(404);
    }

    public function getTinXe($slug) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $tinXe = TinXe::where('slugName',$slug)->first();
        if ($tinXe)
            return view('client.chitietxe', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'tinXe' => $tinXe
            ]);
        else
            abort(404);
    }

    public function guiThongTin(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen =  $request->hoTen;
        $data->xeYeuCau = $request->chonXe;
        $data->soDienThoai = $request->soDienThoai;
        $data->isOld = false;
        $data->linkReg = $request->nguon;
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Quan tâm xe";
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Cảm ơn quý khách đã gửi thông tin, nhân viên Hyundai An Giang sẽ liên hệ quý khách!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }

    public function dangKyEmail(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen = "Ẩn danh";
        $data->xeYeuCau = "Ẩn danh";
        $data->soDienThoai = "Ẩn danh";
        $data->isOld = false;
        $data->linkReg = $request->nguonNhapEmail;
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Đăng ký địa chỉ email nhận tin khuyến mãi: " . $request->emailReg;
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Hyundai An Giang đã nhận được địa chỉ email của quý khách, xin cảm ơn đã tin tưởng và sử dụng dịch vụ của Hyundai An Giang!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }

    public function guiBaoGia(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen =  $request->hoTenBG;
        $data->xeYeuCau = $request->xeQuanTam;
        $data->soDienThoai = $request->soDienThoaiBG;
        $data->isOld = false;
        $data->linkReg = $request->nguonXinBaoGia;
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Báo giá xe";
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Cảm ơn quý khách đã gửi thông tin, nhân viên Hyundai An Giang sẽ liên hệ quý khách!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }

    public function dangKyLaiThu(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen =  $request->hoTenLaiThu;
        $data->xeYeuCau = $request->xeLaiThu;
        $data->soDienThoai = $request->soDienThoaiLaiThu;
        $data->isOld = false;
        $data->linkReg = $request->nguonDangKyLaiThu;
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Đăng ký lái thử";
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Cảm ơn quý khách đã gửi thông tin, nhân viên Hyundai An Giang sẽ liên hệ quý khách!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }

    public function gopY(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen =  $request->hoTenDongGop;
        $data->xeYeuCau = "";
        $data->soDienThoai = $request->soDienThoaiDongGop;
        $data->isOld = false;
        $data->linkReg = "";
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Góp ý: " . $request->noiDungDongGop;
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Cảm ơn quý khách đã đóng góp ý kiến, Hyundai An Giang trân trọng tiếp thu và ngày càng cải thiện dịch vụ tốt hơn trong thời gian tới!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }

    public function datHen(Request $request) {
        $jsonString = file_get_contents('cauhinh/footer.json');
        $data = json_decode($jsonString, true);   
        $xe = ViTriXe::select("*")->orderBy('id', 'desc')->get();
        $menu = Menu::all();
        $data = new ThuThap();
        $data->hoTen =  $request->hoTenDatHen;
        $data->xeYeuCau = $request->xeDatHen;
        $data->soDienThoai = $request->soDienThoaiDatHen;
        $data->isOld = false;
        $data->linkReg = "";
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
        $data->yeuCauKhachHang = "[".($isMob ? "Điện thoại" : "Máy tính")."] Đặt lịch hẹn sửa chữa - Ngày: " . \HelpFunction::revertDate($request->ngayDatLich) . " - Nội dung đặt hẹn: " . $request->noiDungHen;
        $data->save();
        if ($data)
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu,
                'phanHoi' => "Cảm ơn quý khách đã đặt lịch hẹn sửa chữa, nhân viên Hyundai An Giang sẽ liên hệ quý khách!"
            ]);
        else
            return view('client.phanhoi', [
                'data' => $data,
                'xe' => $xe, 
                'menu' => $menu
            ]);
    }
}
