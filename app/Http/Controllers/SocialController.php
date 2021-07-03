<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function add()
    {
        return view('social.add');
    }

    public function upload(Request $request)
    {
        $lower = strtolower($request->platform);        // all of letter are lower cases
        $upper = ucwords($lower);                       // except the first letter of each word

        $exist = Social::where('code', $lower)->count();

        if ($exist != 0) {
            return back()->with('error', 'Platform Already exists!');
        }

        $social = new Social;
        $social->name = $upper;
        $social->code = $lower;
        $social->save();

        return back()->with('alert', 'Added Successfully!');
    }

    public function all()
    {
        $socials = Social::all();

        return view('social.all', ['socials' => $socials]);
    }


    public function edit(Request $request)
    {
        $social = Social::find($request->id);
        return view('social.edit', ['social' => $social]);
    }

    public function update(Request $request)
    {
        $social = Social::find($request->id);

        $lower = strtolower($request->name);        // all of letter are lower cases
        $upper = ucwords($lower);                   // except the first letter of each word

        $exist = Social::where('code', $lower)->count();

        if ($exist != 0) {
            return redirect('/social/all')->with('error', 'Platform Already exists!');
        }

        $social->name = $upper;
        $social->code = $lower;
        $social->save();

        return redirect('/social/all')->with('alert', 'Updated Successfully!');
    }

    public function destroy(Request $request)
    {
        $social = Social::find($request->id);
        $count_accounts = $social->accounts()->count();
        if ($count_accounts > 0) {
            return back()->with('error', 'There are ' . $count_accounts . ' accounts where this Platform in been used');
        }
        $social->delete();

        return back()->with('alert', 'Deleted Successfully!');
    }
}
