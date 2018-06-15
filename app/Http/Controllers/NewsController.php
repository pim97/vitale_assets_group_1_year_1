<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use Auth;
use App\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsposts = News::orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view("news.index", compact('newsposts', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsCategories = NewsCategory::all();
        return view("news.create", compact('newsCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = Auth::user()->id;

        $this->validate(request(), [
            'title'=>'required|min:3|max:255',
            'message'=>'required|min:3|max:255',
            'news_category_id'=>'required|integer',
        ]);

        News::create([
            'title'=>request('title'),
            'message'=>request('message'),
            'user_id'=>$user,
            'news_category_id'=>request('news_category_id'),
        ]);

        session()->flash('message', 'Nieuwsbericht is aangemaakt.');
        return redirect('/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $newspost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newspost = News::find($id);
        $newsCategories = NewsCategory::all();
        return view("news.edit", compact('newspost', 'newsCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'title'=>'required|min:3|max:255',
            'message'=>'required|min:3|max:255',
            'news_category_id'=>'required|integer',
        ]);

        News::where('id', $id)->update([
            'title'=>request('title'),
            'message'=>request('message'),
            'news_category_id'=>request('news_category_id'),
        ]);

        session()->flash('message', 'Nieuwsbericht is gewijzigd.');
        return redirect('/news');
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $newspost = News::find($id);
        return view("news.delete")->with('newspost', $newspost);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newspost = News::find($id);
        News::where('id', $id)->delete();

        session()->flash('message', 'Nieuwsbericht "' . $newspost->title . '" is verwijderd.');
        return redirect('/news');
    }
}
