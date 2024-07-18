<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('projects.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'team_id' => 'required|exists:teams,id'
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->team_id = $request->team_id;
        $project->save();

        $this->sendNotification("Proyek baru dibuat: {$project->name}");

        return redirect()->route('projects.index')
                        ->with('success', 'Proyek berhasil dibuat.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $teams = Team::all();
        return view('projects.edit', compact('project', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'team_id' => 'required|exists:teams,id'
        ]);

        $project->update($request->all());

        $this->sendNotification("Project updated: {$project->name}");

        return redirect()->route('projects.index')
                         ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        $this->sendNotification("Project deleted: {$project->name}");

        return redirect()->route('projects.index')
                         ->with('success', 'Project deleted successfully.');
    }

    private function sendNotification($message)
    {
        $telegramUrl = "https://api.telegram.org/bot<YOUR_TELEGRAM_BOT_TOKEN>/sendMessage";
        $discordUrl = "https://discord.com/api/webhooks/<YOUR_DISCORD_WEBHOOK_ID>";

        // Send to Telegram
        Http::post($telegramUrl, [
            'chat_id' => '<YOUR_TELEGRAM_CHAT_ID>',
            'text' => $message
        ]);

        // Send to Discord
        Http::post($discordUrl, [
            'content' => $message
        ]);
    }
}
