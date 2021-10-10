<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Service;
        }
        return Service::where($filter);
    }
    public function store(Request $request) {
        $category_id = $request->category_id;

        $saveData = Service::create([
            'category_id' => $category_id,
            'name' => $request->name,
        ]);

        $increaseCounter = CategoryController::get([['id', $category_id]])->increment('count');

        return redirect()->route('admin.service')->with(['message' => "Data service berhasil ditambahkan"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $category_id = $request->category_id;
        $data = Service::where('id', $id);
        $service = $data->first();
        
        $updateData = $data->update([
            'category_id' => $category_id,
            'name' => $request->name,
        ]);

        $decreaseCounter = CategoryController::get([['id', $service->category_id]])->decrement('count');
        $increaseCounter = CategoryController::get([['id', $category_id]])->increment('count');
        
        return redirect()->route('admin.service')->with(['message' => "Data ".$service->title." berhasil diubah"]);
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = Service::where('id', $id);
        $service = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.service')->with(['message' => "Data berhasil dihapus"]);
    }
}
