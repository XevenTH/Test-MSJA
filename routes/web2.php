<?php

use App\Models\Departement;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $users = User::all();
    $status = User::FilterStatus()->first();
    $depts = Departement::all();

    return view('table', ['users' => $users, 'status' => $status, 'depts' => $depts]);
});

Route::get('/form', function () {
    $depts = Departement::all();

    return view('form', ['data' => $depts]);
});

Route::post("/form-post", function (Request $request) {
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
    $user = User::find($id);

    $user->delete();

    return back();
});

Route::get("/form-edit/{user}", function(User $user) {
    $user = User::find($user);
    $depts = Departement::all();

    return view('form', ['user' => $user, 'depts' => $depts]);
});

Route::put("/form-update/{user}", function(Request $request, User $user) {
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
