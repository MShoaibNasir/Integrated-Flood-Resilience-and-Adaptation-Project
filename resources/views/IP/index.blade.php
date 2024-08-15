@extends('dashboard.layout.master')
@section('content')

<style>
    td {
        white-space: nowrap;
    }

    th {
        white-space: nowrap;
    }
</style>
<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->


    <div class="container-fluid pt-4 px-4 form_width">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Implementation  Partner</h6>
                <a href="{{route('ip.create')}}">Create</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">S no</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">area</th>
                            <th scope="col">lot</th>
                            <th scope="col">district</th>
                            <th scope="col">tehsil</th>
                            <th scope="col">uc</th>
                            <th scope="col">Date of register</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->user_email}}</td>
                                <td>{{$item->area_name}}</td>
                                <td>{{$item->lot_name}}</td>
                                <td>{{$item->district_name}}</td>
                                <td>{{$item->tehsil_name}}</td>
                                <td>{{$item->uc_name}}</td>
                                <td>{{$item->date_of_registeration}}</td>
                                <td><a class="btn btn-sm btn-danger" href="{{route('ip.delete', [$item->id])}}">Delete</a>
                                </td>
                                <td><a class="btn btn-sm btn-secondary" href="{{route('ip.block', [$item->id])}}">
                                        {{$item->status == 1 ? "Block" : 'Unblock'}} </a></td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                toast: true,         // This enables the toast mode
                position: 'top-end', // Position of the toast
                showConfirmButton: false, // Hides the confirm button
                timer: 3000          // Time to show the toast in milliseconds
            });
        </script>
    @endif
    @if(session('success'))
        <script>

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
            let table = new DataTable('#myTable');

        </script>
    @endif

    @endsection