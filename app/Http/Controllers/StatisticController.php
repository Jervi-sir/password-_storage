<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        dd("coming soon boiiii, just I have to finish important project, this site is just for me for my account's credentials");
        $user = Auth()->user();
        $accounts = $user->accounts()->get();

        $account_group = $accounts->groupBy('social_id');

        //isolating Socials used by user in array
        $social_used = [];
        foreach ($account_group as $accounts) {
            $social_id = $accounts->first()->social()->first();
            array_push($social_used, $social_id);
        }


        return view('statistic.index', ['socials' => $social_used, 'accounts' => $accounts, 'user' => $user]);
    }
}
