<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Social;
use App\Models\Account;
use App\Models\AccountBackup;
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

    public function show() {
        //get user's accounts
        $data = $this->getUserAccounts();

        return view('accounts.all', ['accounts' => $data['accounts'],
                                    'platforms' => $data['platforms']]);
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
        $account->details = $request->details;

        $account->save();

        return redirect('/account/show')->with('alert', 'Updated Successfully!');
    }

    public function destroy(Request $request)
    {
        $account = Account::find($request->id);

        $backup = new AccountBackup();
        $backup->id = $account->id;
        $backup->user_id = $account->user_id;
        $backup->social_id = $account->social_id;
        $backup->name = $account->name;
        $backup->password = $account->password;
        $backup->old_passwords = $account->old_passwords;
        $backup->details = $account->details;
        $backup->save();

        $account->delete();

        return back()->with('alert', 'Deleted Successfully!');
    }


    /*
    |-----------------------------------------
    |   Helpers
    |-----------------------------------------
    */

    /*--------| get user accounts in array |--------*/
    private function getUserAccounts() {
        foreach (Social::select('id', 'name')->get() as $key => $social) {
            $allSocials[$social->id] = $social->name;
        }

        $user = Auth()->user();
        //get user's account from databse
        $accountEloquent = $user->accounts()
                        ->select(
                            'id',
                            'social_id',
                            'name',
                            'password',
                            'old_passwords',
                            'details'
                        )
                        ->get();
        //turn user's account into an array
        foreach ($accountEloquent as $key => $account) {
            $social_name = $allSocials[$account->social_id];
            $data['accounts'][$social_name][$key] = [
                'id' => $account->id,
                'email' => $account->name,
                'password' => $account->password,
                'old_passwords' => $account->old_passwords,
                'details' => $account->details,
            ];
        }

        $data['platforms'] = array_keys($data['accounts']);
        return $data;
    }
}
