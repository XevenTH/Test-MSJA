<?php

use App\Http\Controllers\ProfileController;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $users = User::all();
//     $status = User::FilterStatus()->first();
//     $depts = Departement::all();

//     return view('table', ['users' => $users, 'status' => $status, 'depts' => $depts]);
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $users = User::all();
        $status = User::FilterStatus()->first();
        $depts = Departement::all();

        return view('table', ['users' => $users, 'status' => $status, 'depts' => $depts]);
    })->name('table');

    Route::get('/form', function () {
        if (Auth::user()->position == ! "admin")
            return abort(403);

        $depts = Departement::all();

        return view('form', ['data' => $depts]);
    });

    Route::post("/form-post", function (Request $request) {
        if (Auth::user()->position == ! "admin")
            return abort(403);

        $user = new User;
        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->dob = $request->input('dob');
        $user->dept_id = $request->input('departement');
        $user->status = $request->input('status');
        $user->save();

        return redirect('/');
    });

    Route::delete("/form-delete/{id}", function (int $id) {
        if (Auth::user()->position == ! "admin")
            return abort(403);

        $user = User::find($id);

        $user->delete();

        return back();
    });

    Route::get("/form-edit/{user}", function (User $user) {
        if (Auth::user()->position == ! "admin")
            return abort(403);

        $user = User::find($user);
        $depts = Departement::all();

        return view('form', ['user' => $user, 'depts' => $depts]);
    });

    Route::put("/form-update/{user}", function (Request $request, User $user) {
        if (Auth::user()->position == ! "admin")
            return abort(403);

        $user = User::find($user);

        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        $user->dob = $request->input('dob');
        $user->dept_id = $request->input('departement');
        $user->status = $request->input('status');
        $user->save();

        return redirect('/');
    });
});

require __DIR__ . '/auth.php';
