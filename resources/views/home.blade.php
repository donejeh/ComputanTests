@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} 
                    <a href="{{ route('user.fetchDataFromAPI') }}" class="btn btn-primary  float-end">API Fetch</a>
                </div>
                <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ \Session::get('success') }}

                        @if (\Session::has('success_viewFetch'))
                        <a href="{{ route('user.viewFetch') }}"> CLICK HERE TO VIEW</a>
                        @endif
                    </div>
                    @endif
                    
                    @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ \Session::get('error') }}
                    </div>
                    @endif
                    
                    
                    <div class="card-body">
                        <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control" required>
                            <br>
                            
                            <button class="btn btn-primary">Import User Data</button>
                            <a href="https://www.mockaroo.com/"> You can gerenate a radom excel file  here</a>
                            
                        </form>
                </div>

                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="5">
                            List Of Users
                            <a class="btn btn-danger float-end" href="{{ route('user.export') }}">Export User Data</a>
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-center">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
