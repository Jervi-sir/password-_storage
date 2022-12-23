<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectAccount;

class ProjectController extends Controller
{
    public function add()
    {
        return view('projects.add');
    }

    public function upload(Request $request)
    {
        $user = Auth()->user();
        $user_id = $user->id;
        $project = new Project;
        $project->user_id = $user_id;
        $project->project_name = $request->project_name;
        $project->client_name = $request->client_name;
        $project->details = $request->project_details;
        $project->save();

        return back()->with('alert', 'Added Successfully!');
    }

    public function all()
    {
        $user = Auth()->user();

        $projects = $user->projects()->get();

        return view('projects.all', ['projects' => $projects]);
    }

    public function edit(Request $request)
    {
        $project = Project::find($request->id);

        return view('projects.edit', ['project' => $project]);
    }

    public function update(Request $request)
    {
        $project = Project::find($request->id);
        $project->project_name = $request->project_name ;
        $project->client_name = $request->client_name ;
        $project->details = $request->project_details ;
        $project->save();

        return redirect('/project/all')->with('alert', 'Updated Successfully!');
    }


    public function accountEdit(Request $request)
    {
        $account = ProjectAccount::find($request->id);

        return view('projects.accountEdit', ['account' => $account]);
    }

    public function accountAdd(Request $request)
    {
        $project = Project::find($request->id);
        $socials = Social::all();

        return view('projects.accountAdd', ['project' => $project, 'socials' => $socials]);
    }

    public function accountUpload(Request $request)
    {
        $social_input = strtolower($request->social);
        $social_id = Social::where('code', $social_input)->first()->id;

        //check if email already exist
        $user =  Auth()->user();
        $exist = ProjectAccount::where('user_id', $user->id)->where('social_id', $social_id)->where('name', $request->email)->count();

        if ($exist != 0) {
            return back()->with('error', 'Account Already exists!');
        }

        $account = new ProjectAccount;
        $account->user_id = Auth()->user()->id;
        $account->social_id = $social_id;
        $account->project_id = $request->project_id;

        $account->name = $request->email;
        $account->password = $request->password;

        $account->save();

        return back()->with('alert', 'Added Successfully!');
    }

    public function accountUpdate(Request $request)
    {
        $account = ProjectAccount::find($request->id);
        $current_password = $account->password;
        $old_passwords = $account->old_passwords;

        $account->name = $request->email;
        if ($account->password != $request->password) {
            $account->old_passwords = $current_password . ', ' . $old_passwords;
        }
        $account->password = $request->password;
        $account->details = $request->description;
        $account->save();

        return redirect('/project/all')->with('alert', 'Updated Successfully!');
    }

    public function accountDestroy(Request $request)
    {   
        $account = ProjectAccount::find($request->id);
        $account->delete();

        return back()->with('alert', 'Deleted Successfully!');
    }
}
