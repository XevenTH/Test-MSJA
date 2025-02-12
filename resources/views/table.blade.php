<x-layout>
    <div class="container">

        <h1 class="mb-3 text-center">List Of Employee</h1>
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Dept</th>
                    <th scope="col">Status</th>
                    @if (Auth::user()->position === 'admin')
                        <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $emp)
                    <tr>
                        <th scope="row">{{ $emp->id }}</th>
                        <td>{{ $emp->first_name }}</td>
                        <td>{{ $emp->last_name }}</td>
                        <td>{{ $emp->gender }}</td>
                        <td>{{ $emp->address }}</td>
                        <td>{{ $emp->DOB }}</td>
                        <td>{{ $emp->dept->name }}</td>
                        <td>{{ $emp->status }}</td>
                        @if (Auth::user()->position === 'admin')
                            <td>
                                <a href="/form-edit/{{ $emp->id }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                                <form action="{{ url('/form-delete/' . $emp->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (Auth::user()->position === 'admin')
            <button type="button" class="btn btn-outline-success"><a href="/form"
                    class="text-decoration-none text-black">Add</a></button>
        @endif


        <h1 class="mb-3 text-center">Status Employees</h1>
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Total Employee</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Contract</td>
                    <td>{{ $status->cont }}</td>
                </tr>
                <tr>
                    <td>Employee</td>
                    <td>{{ $status->emp }}</td>
                </tr>
                <tr>
                    <td>Not Active</td>
                    <td>{{ $status->not_act }}</td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td>{{ $status->total }}</td>
                </tr>
            </tbody>
        </table>

        <h1 class="mb-3 text-center">Status Employees</h1>
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Dept</th>
                    <th scope="col">Contract</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Not Active</th>
                    <th scope="col">Grand Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($depts as $dept)
                    <tr>
                        <td>{{ $dept->name }}</td>
                        <td>{{  $users->where('dept_id', $dept->id)->where('status', 'cont')->count() ?: '' }}</td>
                        <td>{{  $users->where('dept_id', $dept->id)->where('status', 'emp')->count() ?: '' }}</td>
                        <td>{{  $users->where('dept_id', $dept->id)->where('status', 'not_act')->count() ?: ''  }}</td>
                        <td>{{  $users->where('dept_id', $dept->id)->count() ?: ''  }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Grand Total</td>
                    <td>{{ $status->cont }}</td>
                    <td>{{ $status->emp }}</td>
                    <td>{{ $status->not_act }}</td>
                    <td>{{ $status->total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
