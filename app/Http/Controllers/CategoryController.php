<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Category;
        }
        return Category::where($filter);
    }
    public function store(Request $request) {
        $saveData = Category::create([
            'name' => $request->name,
            'count' => 0,
        ]);

        return redirect()->route('admin.category')->with(['message' => "Kategori baru berhasil ditambahkan"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Category::where('id', $id);
        $category = $data->first();
        $updateData = $data->update(['name' => $request->name]);
        
        return redirect()->route('admin.category')->with(['message' => "Data ".$category->name." berhasil diubah"]);
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = Category::where('id', $id);
        $category = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.category')->with(['message' => "Data berhasil dihapus"]);
    }
}
