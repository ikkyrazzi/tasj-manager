<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('users')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $users = User::all();
        return view('teams.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_ids' => 'required|array',
        ]);

        $team = Team::create([
            'name' => $request->name,
        ]);

        $team->users()->attach($request->user_ids);

        return redirect()->route('teams.index')
                        ->with('success', 'Team created successfully.');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $users = User::all();
        return view('teams.edit', compact('team', 'users'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'user_ids' => 'required|array',
        ]);

        $team->update([
            'name' => $request->name,
        ]);

        $team->users()->sync($request->user_ids);

        return redirect()->route('teams.index')
                        ->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')
                         ->with('success', 'Team deleted successfully.');
    }
}
