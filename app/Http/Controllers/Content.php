<?php

namespace App\Http\Controllers;

use App\Content as Model;
use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Content extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        $title = 'Home';
        $events = Event::list(4);
        $news = Model::news()
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('home', compact('news', 'events', 'title'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function newsletter()
    {
        $title = 'Newsletters';
        $newsletters = Model::newsletter()
            ->orderBy('posted_at', 'desc')
            ->get();

        return view('newsletters', compact('title', 'newsletters'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Site Content';
        $content = Model::orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.content.index', compact('title', 'content'));
    }
    
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Content';
        $content = new Model();

        return view('admin.content.create', compact('title', 'content'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', 'alpha_dash', 'unique:content'],
            'type' => ['required', 'in:news,newsletter,page'],
            'posted_at' => ['nullable', 'date', 'required_if:type,newsletter'],
            'body' => ['required'],
        ]);

        $attributes['posted_at'] = new Carbon($attributes['posted_at']);
        Model::create($attributes);

        return redirect()
            ->route('content.index')
            ->with('successMsg', 'Content has been successfully added.');
    }

    /**
     * @param  \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $content)
    {
        $title = 'Edit Content';

        return view('admin.content.edit', compact('title', 'content'));
    }
    
    /**
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Model::findOrFail($id);
        $title = $content->title;

        return view('content', compact('title', 'content'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $content)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', 'alpha_dash', 'unique:content,slug,' . $content->id],
            'type' => ['required', 'in:news,newsletter,page'],
            'posted_at' => ['nullable', 'date', 'required_if:type,newsletter'],
            'body' => ['required'],
        ]);

        $content->posted_at = new Carbon(array_pull($attributes, 'posted_at'));
        $content->fill($attributes);
        $content->save();

        return redirect()
            ->route('content.index')
            ->with('successMsg', 'Content has been successfully updated.');
    }

    /**
     * @param  \App\Content
     * @return \Illuminate\Https\Response
     */
    public function destroy(Model $content)
    {
        $content->delete();

        return redirect()
            ->route('content.index')
            ->with('successMsg', 'Content has been successfully deleted.');
    }
}
