<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Copywriting;
use Illuminate\Http\Request;

class CopywritingController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Copywriting;
        }
        return Copywriting::where($filter);
    }
    public function edit($code) {
        $myData = AdminController::me();
        $message = Session::get('message');
        $writing = Copywriting::where('item_code', $code)->first();

        return view('admin.copywriting', [
            'myData' => $myData,
            'message' => $message,
            'writing' => $writing,
        ]);
    }
    public function update(Request $request) {
        $code = $request->code;
        $data = Copywriting::where('item_code', $code);
        $writing = $data->first();
        
        $updateData = $data->update([
            'body' => $request->body,
        ]);

        return redirect()->route('admin.copywriting.edit', $code)->with([
            'message' => "Konten ".ucwords($writing->item_code)." berhasil diubah"
        ]);
    }
}
