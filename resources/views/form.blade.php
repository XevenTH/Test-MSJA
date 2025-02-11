<x-layout>
    <form class="container" method="POST" action="/form-post">
        @csrf

        @if (request()->is('form-edit/*') && $user->isNotEmpty())
            <h1 class="mb-3 text-center fw-bold">Edit Employee</h1>
        @else
            <h1 class="mb-3 text-center fw-bold">Add Employee</h1>
        @endif
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name *</label>
            @if (request()->is('form-edit/*') && $user->isNotEmpty())
                <input type="text" class="form-control" id="firstname" name="firstname"
                    value="{{ $user->first()->first_name }}" required>
            @else
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            @endif
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            @if (request()->is('form-edit/*') && $user->isNotEmpty())
                <input type="text" class="form-control" id="lastname" name="lastname"
                    value="{{ $user->first()->last_name }}">
            @else
                <input type="text" class="form-control" id="lastname" name="lastname">
            @endif

        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select mb-3 w-50" aria-label="Default select example" name="gender" id="gender"
                required>
                @if (request()->is('form-edit/*'))
                    <option value="male" @selected($user->first()->gender == "male")>Male</option>
                    <option value="female"  @selected($user->first()->gender == "female")>Female</option>
                @else
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                @endif
            </select>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address *</label>
            @if (request()->is('form-edit/*') && $user->isNotEmpty())
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ $user->first()->address }}" required>
            @else
                <input type="text" class="form-control" id="address" name="address" required>
            @endif
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">DOB *</label>
            @if (request()->is('form-edit/*') && $user->isNotEmpty())
                <input type="date" class="form-control" id="dob" name="dob"
                    value="{{ $user->first()->DOB }}" required>
            @else
                <input type="date" class="form-control" id="dob" name="dob" required>
            @endif
        </div>
        <div class="mb-3">
            <label for="departement" class="form-label">Departements *</label>
            <select class="form-select mb-3 w-50" aria-label="Default select example" name="departement"
                id="departement" required>
                @if (request()->is('form-edit/*'))
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}" @selected($user->first()->dept_id == $dept->id)>{{ $dept->name }}</option>
                    @endforeach
                @else
                    @foreach ($data as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select class="form-select mb-3 w-50" aria-label="Default select example" name="status" id="status" required>
                @if (request()->is('form-edit/*'))
                    <option value="cont" @selected($user->first()->status == 'cont')>cont</option>
                    <option value="emp" @selected($user->first()->status == 'emp')>emp</option>
                    <option value="not_act" @selected($user->first()->status == 'not_act')>not_act</option>
                @else
                    <option value="cont">cont</option>
                    <option value="emp">emp</option>
                    <option value="not_act">not_act</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
