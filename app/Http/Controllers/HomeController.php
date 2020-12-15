<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use stdClass;
use Illuminate\Support\Facades\DB;
use App\Cms;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home_new');
    }

    public function mainpage()
    {
        $content = DB::table('content')
            ->leftJoin('users', 'users.id', '=', 'content.userid')
            ->select('content.*', 'users.name')
            ->get();

        if (count($content) == 0) {
            $content = 'No content uploaded yet.';
        }

        return view('welcome_new', ['content' => $content]);
    }

    public function article($articleId)
    {
        if ($articleId) {
            $content = DB::table('content')
                ->leftJoin('users', 'users.id', '=', 'content.userid')
                ->select('content.*', 'users.name')
                ->where('uuid', $articleId)
                ->first();

            if (!$content) {
                $content = 'No content uploaded with this id.';
            }
            return view('article', ['content' => $content]);
        } else {
            return view('article', ['content' => 'Invalid article id.']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newcontent(Request $request)
    {
        $Cms = new Cms();

        $FormData = $request->post();
        if ($request->hasFile('image')) {
            $path = $request->image->store('public/cms');
            $path = str_replace('public/', '', $path);
            $FormData['image'] = $path;
        }

        $FormData['submissionid'] = substr(md5(rand()), 0, 30);
        $FormData['userid'] = auth()->user()->id;
        unset($FormData['_token']);
        $Contents = $Cms->insertItem($FormData);

        if ($Contents === TRUE) {
            $content = DB::table('content')
                ->leftJoin('users', 'users.id', '=', 'content.userid')
                ->select('content.*', 'users.name')
                ->get();

            if (count($content) == 0) {
                $content = 'No content uploaded yet.';
            }

            return view('welcome_new', ['content' => $content]);
        } else {
            return view('home_new');
        }
    }
}
