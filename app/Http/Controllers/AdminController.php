<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function me() {
        $myData = Auth::guard('admin')->user();
        if ($myData != "") {
            $name = explode(" ", $myData->name);
            $myData->first_name = $name[0];
            if (array_key_exists(1, $name)) {
                $myData->initial = $myData->first_name[0].$name[1][0];
            } else {
                $myData->initial = $myData->first_name[0];
            }

            $myData->copywritings = CopywritingController::get()->get();
        }
        return $myData;
    }
    public function loginPage(Request $request) {
        $message = Session::get('message');
        return view('admin.login', [
            'message' => $message,
            'request' => $request
        ]);
    }
    public function login(Request $request) {
        $r = $request->r;
        
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$loggingIn) {
            return redirect()->route('admin.loginPage', ['r' => $r])->withErrors(['Kombinasi email dan kata sandi tidak tepat']);
        }

        $redirectTo = $r != "" ? $r : "admin.dashboard";
        return redirect()->route($redirectTo);
    }
    public function logout() {
        $loggingOut = Auth::guard('admin')->logout();
        return redirect()->route('admin.loginPage')->with(['message' => "Berhasil logout"]);
    }
    public function dashboard() {
        $myData = self::me();
        
        return view('admin.dashboard', [
            'myData' => $myData
        ]);
    }
    public function service() {
        $myData = self::me();
        $message = Session::get('message');
        $services = ServiceController::get()->orderBy('updated_at', 'DESC')->get();
        $categories = CategoryController::get()->get();
        
        return view('admin.service', [
            'myData' => $myData,
            'message' => $message,
            'services' => $services,
            'categories' => $categories,
        ]);
    }
    public function portfolio() {
        $myData = self::me();
        $message = Session::get('message');
        $portfolios = PortfolioController::get()->paginate(10);
        $categories = CategoryController::get()->get();
        
        return view('admin.portfolio', [
            'myData' => $myData,
            'message' => $message,
            'portfolios' => $portfolios,
            'categories' => $categories,
        ]);
    }
    public function category() {
        $myData = self::me();
        $message = Session::get('message');
        $categories = CategoryController::get()->get();
        
        return view('admin.category', [
            'myData' => $myData,
            'message' => $message,
            'categories' => $categories,
        ]);
    }
    public function copywriting() {
        $myData = self::me();
        $message = Session::get('message');
        $writings = CopywritingController::get()->get();

        return view('admin.copywriting', [
            'myData' => $myData,
            'message' => $message,
            'writings' => $writings,
        ]);
    }

    public function admin() {
        $myData = self::me();
        $message = Session::get('message');
        $admins = Admin::all();

        return view('admin.admin', [
            'myData' => $myData,
            'message' => $message,
            'admins' => $admins,
        ]);
    }
    public function store(Request $request) {
        $saveData = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.admin')->with(['message' => "Admin baru berhasil ditambahkan"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Admin::where('id', $id);
        $admin = $data->first();

        $toUpdate = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password != "") {
            $toUpdate['password'] = bcrypt($request->password);
        }

        $updateData = $data->update($toUpdate);
        
        return redirect()->route('admin.admin')->with(['message' => "Data admin ".$admin->name." berhasil diubah"]);
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = Admin::where('id', $id);
        $admin = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.admin')->with(['message' => "Admin ".$admin->name." berhasil dihapus"]);
    }
    public function profile() {
        $myData = self::me();
        $message = Session::get('message');

        return view('admin.profile', [
            'myData' => $myData,
            'message' => $message
        ]);
    }
    public function updateProfile(Request $request) {
        $myData = self::me();
        $data = Admin::where('id', $myData->id);
        $updateData = $data->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.profile')->with(['message' => "Profil berhasil diubah"]);
    }
    public function updatePassword(Request $request) {
        $myData = self::me();
        $data = Admin::where('id', $myData->id);
        $updateData = $data->update([
            'password' => bcrypt($request->password)
        ]);

        $loggingOut = Auth::guard('admin')->logout();

        return redirect()->route('admin.loginPage')->with(['message' => "Password berhasil diubah, silakan login kembali dengan password baru"]);
    }
}
