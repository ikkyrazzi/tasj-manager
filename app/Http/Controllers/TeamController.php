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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('team_photos', 'public');
        }

        $team = Team::create([
            'name' => $request->name,
            'photo' => $photoPath, // Simpan path foto
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);

        $photoPath = $team->photo;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($photoPath && \Storage::disk('public')->exists($photoPath)) {
                \Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('team_photos', 'public');
        }

        $team->update([
            'name' => $request->name,
            'photo' => $photoPath, // Perbarui path foto
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
