<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use Illuminate\Http\Request;
use App\Mail\OrderService;

class UserController extends Controller
{
    public $writings = [];

    public function __construct() {
        $copywritings = CopywritingController::get()
        ->get();

        foreach ($copywritings as $writing) {
            $this->writings[$writing->item_code] = $writing->body;
        }
    }
    public function index() {
        $categories = CategoryController::get()->with('services')->get()->map(function ($query) {
            $query->setRelation('services', $query->services->take(3));
            return $query;
        });
        $portfolios = PortfolioController::get()->orderBy('created_at', 'DESC')->paginate(4);

        return view('index', [
            'writings' => $this->writings,
            'portfolios' => $portfolios,
            'categories' => $categories
        ]);
    }
    public function about() {
        return view('about', [
            'writings' => $this->writings
        ]);
    }
    public function portfolio(Request $request) {
        $filter = [];
        if ($request->category != "") {
            $filter = [
                ['categories', "LIKE", "%".$request->category."%"]
            ];
        }

        $categories = CategoryController::get()->get();
        $portfolios = PortfolioController::get($filter)->orderBy('created_at', 'DESC')->get();

        foreach ($portfolios as $porto) {
            $cats = explode(",", $porto->categories);
            foreach ($categories as $cat) {
                if (in_array($cat->name, $cats)) {
                    $cat->portfolio_count += 1;
                }
            }
        }

        return view('portfolio', [
            'writings' => $this->writings,
            'portfolios' => $portfolios,
            'categories' => $categories,
            'request' => $request,
        ]);
    }
    public function portfolioDetail($id) {
        $portfolio = PortfolioController::get([['id', $id]])->with('images')->first();
        
        return view('portfolioDetail', [
            'writings' => $this->writings,
            'portfolio' => $portfolio,
        ]);
    }
    public function service() {
        $message = Session::get('message');
        $categories = CategoryController::get()->with('services')->get();
        $services = ServiceController::get()->orderBy('name', 'ASC')->get();

        return view('service', [
            'writings' => $this->writings,
            'categories' => $categories,
            'services' => $services,
            'message' => $message,
        ]);
    }
    public function contact() {
        return view('contact', [
            'writings' => $this->writings,
        ]);
    }
    public function sendMessage(Request $request) {
        $sendMail = Mail::to(env('MAIL_TO'))->send(new OrderService([
            'services' => $request->services,
            'alacartes' => $request->alacartes,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'company' => $request->company,
            'industry_field' => $request->industry_field,
        ]));
        
        $message = "Terima kasih telah menghubungi ".env('APP_NAME').". Kami akan segera menghubungi Anda kembali";

        return redirect()->route('user.service')->with(['message' => $message]);
    }
}
