<?php

namespace App\Http\Controllers;
use App\Models\Article as ArticleModel;
use App\Models\About as AboutModel;
use App\Models\Testimony as TestimonyModel;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAbout = AboutModel::where('publish', 1)->firstOrFail();
        $dataArticle = ArticleModel::where('publish', 1)->orderBy('created_date', 'DESC')
        ->skip(1)->take(3)->get();
        $dataArticleNew = ArticleModel::where('publish', 1)->orderBy('created_date', 'DESC')
        ->take(1)->firstOrFail();
        return view('site/index', 
        [
            'dataAbout'=> $dataAbout,
            'dataArticle'=> $dataArticle,
            'dataArticleNew'=> $dataArticleNew,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        //
        return view('site/gallery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function donation()
    {
        //
        $dataTestimony = TestimonyModel::where('publish', 1)->orderBy('created_date', 'DESC')
        ->take(5)->get();
        return view('site/donation', [
            'dataTestimony' => $dataTestimony
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        //
        $dataAbout = AboutModel::where('publish', 1)->firstOrFail();
        return view('site/about', ['dataAbout' => $dataAbout]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        //
        return view('site/contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function article()
    {
        //
        $data = ArticleModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(5);
        
        return view('site/article-home', ['data'=>$data]);
        // if detail
        //return view('site/detail-article');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dialog()
    {
        //
        return view('site/dialog');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
