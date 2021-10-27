<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Portfolio;
use App\Models\PortfolioImage as Image;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Portfolio;
        }
        return Portfolio::where($filter);
    }
    public function load(Request $request) {
        $count = $request->count;
        $category = $request->category;
        $filter = [];

        if ($category != "") {
            $filter[] = ['categories', 'LIKE', "%".$category."%"];
        }
        $datas = Portfolio::where($filter)->take($count)->orderBy('created_at', 'DESC')->get();

        return response()->json(['datas' => $datas]);
    }
    public function store(Request $request) {
        $image = $request->file('featured_image');
        $imageFileName = $image->getClientOriginalName();
        $categories = $request->categories;
        $cat = explode(",", $categories);

        $saveData = Portfolio::create([
            'categories' => $categories,
            'title' => $request->title,
            'description' => $request->description,
            'task' => $request->task,
            'featured_image' => $imageFileName,
        ]);

        $saveImage = $image->storeAs('public/portfolio_images/', $imageFileName);

        foreach ($cat as $key => $c) {
            $increaseCounter = CategoryController::get([['name', $c]])->increment('count');
        }

        return redirect()->route('admin.portfolio')->with(['message' => "Portfolio baru berhasil ditambahkan"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $newCategories = $request->categories;

        $data = Portfolio::where('id', $id);
        $portfolio = $data->first();
        $categories = explode(",", $portfolio->categories);

        $toUpdate = [
            'categories' => $newCategories,
            'title' => $request->title,
            'description' => $request->description,
            'task' => $request->task,
        ];

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageFileName = $image->getClientOriginalName();
            $toUpdate['featured_image'] = $imageFileName;
            $deleteOldImage = Storage::delete('public/portfolio_images/'.$portfolio->featured_image);
            $saveNewImage = $image->storeAs('public/portfolio_images', $imageFileName);
        }

        foreach (explode(",", $newCategories) as $key => $cat) {
            if (!in_array($cat, $categories)) {
                $increaseCounter = CategoryController::get([['name', $cat]])->increment('count');
            }
        }
        foreach ($categories as $key => $cat) {
            if (!in_array($cat, explode(",", $newCategories))) {
                $decreaseCounter = CategoryController::get([['name', $cat]])->decrement('count');
            }
        }

        $updateData = $data->update($toUpdate);
        
        return redirect()->route('admin.portfolio')->with(['message' => "Data ".$portfolio->title." berhasil diubah"]);
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = Portfolio::where('id', $id);
        $portfolio = $data->first();
        $deleteData = $data->delete();
        $deleteImage = Storage::delete('public/portfolio_images/'.$portfolio->featured_image);

        return redirect()->route('admin.portfolio')->with(['message' => "Data berhasil dihapus"]);
    }
    public function images($id) {
        $myData = AdminController::me();
        $portfolio = Portfolio::where('id', $id)->first();
        
        return view('admin.portfolio.images', [
            'portfolio' => $portfolio,
            'myData' => $myData,
        ]);
    }
    public function getImages(Request $request) {
        $portfolioID = $request->portfolioID;
        $images = Image::where('portfolio_id', $portfolioID)->get();

        return response()->json($images);
    }
    public function uploadImage(Request $request) {
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();

        $saveImage = Image::create([
            'portfolio_id' => $request->portfolio_id,
            'filename' => $imageFileName
        ]);
        $saveFile = $image->storeAs('public/portfolio_images', $imageFileName);

        return response()->json(['code' => 200]);
    }
    public function deleteImage(Request $request) {
        $id = $request->id;
        $data = Image::where('id', $id);
        $image = $data->first();
        $deleteFile = Storage::delete('public/portfolio_images/'.$image->filename);
        $deleteData = $data->delete();

        return response()->json(['code' => 200]);
    }
}
