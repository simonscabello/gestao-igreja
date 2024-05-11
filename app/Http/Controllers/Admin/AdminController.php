<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserInvitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);
        $token = Str::random(60);

        $user = new User([
            'email' => $request->email,
            'invitation_token' => $token,
            'active' => false,
        ]);

        $user->save();

        Notification::route('mail', $request->email)
            ->notify(new UserInvitation($user));

        alert()->success('Convite enviado com sucesso.')->autoclose(3000);

        return redirect()->route('admin.index');
    }

    public function showCompleteRegistrationForm(Request $request): View
    {
        $user = User::where('invitation_token', $request->token)->firstOrFail();

        return view('users.register', ['user' => $user]);
    }

    public function completeRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('invitation_token', $request->invitation_token)->firstOrFail();

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'invitation_token' => null,
            'active' => true,
        ]);

        auth()->login($user);

        alert()->success('Você foi registrado com sucesso. Bem vindo ao nosso sistema.')->autoclose(3000);

        return redirect()->route('dashboard');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        alert()->success('Usuário deletado com sucesso.')->autoclose(3000);

        return redirect()->route('admin.index');
    }
}
