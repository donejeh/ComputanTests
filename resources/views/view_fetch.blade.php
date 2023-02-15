@extends('layouts.app')
<style>
    h1, h3 {
        text-align: center;
    }
    table {
        border-spacing: 0px;
        table-layout: fixed;
        margin-left:auto;
        margin-right:auto;
    }
    th {
        color: green;
        border: 1px solid black;
    }
    td {
        border: 1px solid black;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Fetch Data') }} 
                    <a href="{{ route('user.fetchDataFromAPI') }}" class="btn btn-primary  float-end">API Fetch</a>
                </div>
                <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ \Session::get('success') }}
                    </div>
                    @endif
                    
                    @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ \Session::get('error') }}
                    </div>
                    @endif
                    
                    
                 
                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="8">
                            List Of Users
                           
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>API</th>
                        <th>Description</th>
                        <th>Auth</th>
                        <th>HTTPS</th>
                        <th>Cors</th>
                        <th>Link</th>
                        <th>Category</th>
                    </tr>

                    
                    @forelse($rows as $row)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$row->API }}</td>
                        <td>{{ $row->Description }}</td>
                        <td>{{ $row->Auth }}</td>
                        <td>{{ $row->HTTPS ? 'true' : 'false'; }}</td>
                        <td>{{ $row->Cors	 }}</td>
                        <td>{{ $row->Link }}</td>
                        <td>{{ $row->Category }}</td>
                    </tr>

                    @empty

                    <td colspan="8">Empty data</td>

                    @endforelse
                </table>
                <div class="d-flex justify-content-center">
                    {!! $rows->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
