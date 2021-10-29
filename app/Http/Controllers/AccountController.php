<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function add()
    {
        $socials = Social::all();

        return view('accounts.add', ['socials' => $socials]);
    }

    public function upload(Request $request)
    {
        $social_input = strtolower($request->social);
        $social_id = Social::where('code', $social_input)->first()->id;

        //check if email already exist
        $user =  Auth()->user();
        $exist = Account::where('user_id', $user->id)->where('social_id', $social_id)->where('name', $request->email)->count();

        if ($exist != 0) {
            return back()->with('error', 'Account Already exists!');
        }

        $account = new Account;
        $account->user_id = Auth()->user()->id;
        $account->social_id = $social_id;
        $account->name = $request->email;
        $account->password = $request->password;
        $account->details = $request->details;
        $account->save();
        return back()->with('alert', 'Added Successfully!');
    }

    public function show()
    {
        $user = Auth()->user();
        $accounts = $user->accounts()->get();

        $account_group = $accounts->groupBy('social_id');
        //$test = $account_group->first()->first()->social()->first()->name;
        $account_sorted = $user->accounts()->orderBy('social_id', 'asc')->get();

        //isolating Socials used by user in array
        $social_used = [];
        foreach ($account_group as $accounts) {
            $social_id = $accounts->first()->social()->first();
            array_push($social_used, $social_id);
        }

        return view('accounts.all', ['social_used' => $social_used, 'account_group' => $account_group, 'account_sorted' => $account_sorted]);
    }

    public function edit(Request $request)
    {
        $account = Account::find($request->id);
        //create Object here

        return view('accounts.edit', ['account' => $account]);
    }

    public function update(Request $request)
    {
        $account = Account::find($request->id);
        $current_password = $account->password;
        $old_passwords = $account->old_passwords;

        $account->name = $request->email;
        if ($account->password != $request->password) {
            $account->old_passwords = $current_password . ', ' . $old_passwords;
        }
        $account->password = $request->password;
        $account->details = $request->description;
        $account->save();

        return redirect('/account/show')->with('alert', 'Updated Successfully!');
    }

    public function destroy(Request $request)
    {
        $account = Account::find($request->id);
        $account->delete();

        return back()->with('alert', 'Deleted Successfully!');
    }
}
