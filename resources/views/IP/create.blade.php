@extends('dashboard.layout.master')
@section('content')


<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->



    <div class="container-fluid pt-4 px-4 form_width">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Create Implementation Partner</h6>
                    <form method="post" action="{{route('ip_signup')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name">

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                                <input type="hidden" name="role" value="2">
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label">Area</label>
                                <select name="area_id" id="area" class="form-control">
                                    <option value='' selected>Select Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Lot</label>
                                <select name="lot_id" class="form-control" id="lot">
                                    <option value='' selected>Select Lot</option>
                                </select>

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">District</label>
                                <select name="district_id" id="district" class="form-control">
                                    <option value='' selected>Select District</option>
                                </select>

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Tehsil</label>
                                <select name="tehsil_id" id="tehsil" class="form-control">
                                    <option value='' selected>Select Tehsil</option>
                                </select>

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Uc</label>
                                <select name="uc_id" id="uc" class="form-control">
                                    <option value='' selected>Select Uc</option>
                                </select>

                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <a class="btn btn-danger my-2" id="generate_password">Generate Password</a>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{asset('dashboard\js\ip_create.js')}}"></script>
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
        </script>
    @endif
    @endsection