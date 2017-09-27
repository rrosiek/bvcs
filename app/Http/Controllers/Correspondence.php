<?php

namespace App\Http\Controllers;

use App\Content;
use App\Jobs\ProcessMailing;
use App\Jobs\ProcessNewsletterMailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Correspondence extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'E-mail Members';

        return view('admin.mail.create', compact('title'));
    }

    /**
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        $attributes['replyTo'] = Auth::user()->email;

        dispatch(new ProcessMailing($attributes));

        return redirect()
            ->route('members.index')
            ->with('successMsg', 'Newsletter has been queued successfully for delivery.');
    }

    /**
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function createNewsletter($id)
    {
        $title = 'E-mail Newsletter';
        $newsletter = Content::where('id', $id)->newsletter()->first();

        return view('admin.mail.newsletter', compact('title', 'newsletter'));
    }

    /**
     * @param  \Illuminate\Http\Request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function sendNewsletter(Request $request, $id)
    {
        $newsletter = Content::where('id', $id)->newsletter()->first();

        $attributes = $request->validate([
            'subject' => ['required', 'max:255'],
            'intro' => ['nullable'],
        ]);

        $attributes['replyTo'] = Auth::user()->email;

        dispatch(new ProcessNewsletterMailing(
            $newsletter,
            $attributes
        ));

        return redirect()
            ->route('content.index')
            ->with('successMsg', 'Newsletter has been queued successfully for delivery.');
    }
}
