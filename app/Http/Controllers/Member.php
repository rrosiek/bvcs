<?php

namespace App\Http\Controllers;

use App\Member as Model;
use Illuminate\Http\Request;

class Member extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Members';
        $members = Model::orderBy('email')->paginate(25);

        return view('admin.members.index', compact('title', 'members'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Member';
        $member = new Model();
        $member->subscribed = true;

        return view('admin.members.create', compact('title', 'member'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'address' => ['max:255'],
            'email' => ['required', 'email'],
        ]);

        $member = Model::create($attributes);
        $member->subscribed = $request->has('subscribed') ? true : false;
        $member->save();

        return redirect()
            ->route('members.index')
            ->with('successMsg', 'Member has been successfully added.');
    }

    /**
     * @param  \App\Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $member)
    {
        $title = 'Edit Member';

        return view('admin.members.edit', compact('title', 'member'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $member)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'address' => ['max:255'],
            'email' => ['required', 'email'],
        ]);

        $member->fill($attributes);
        $member->subscribed = $request->has('subscribed') ? true : false;
        $member->save();

        return redirect()
            ->route('members.index')
            ->with('successMsg', 'Member has been successfully updated.');
    }

    /**
     * @param  \App\Member
     * @return \Illuminate\Https\Response
     */
    public function destroy(Model $member)
    {
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('successMsg', 'Member has been successfully deleted.');
    }
}
