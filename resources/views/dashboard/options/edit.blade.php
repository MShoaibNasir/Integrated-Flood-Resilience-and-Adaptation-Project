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

                    <h6 class="mb-4">Edit Option</h6>
                    <form method="post" action="{{route('options.update', [$options->id, $title_id])}}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input type="hidden" name="" value>
                                <input type="text" class="form-control" value="{{$options->name}}" name="name">
                            </div>
                            @php
                                $types = ['radio' => 'Radio Button', 'text' => 'Text', 'date' => 'Date'];
                            @endphp
                            <div class="mb-3 col-6">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">Select Type</option>
                                    @foreach($types as $Key => $type)
                                        <option value="{{$Key}}" {{$Key == $options->type ? 'selected' : ''}}>{{$type}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6 checkbox">
                                <label class="form-label">Parent Question</label>
                                <select name="question_id" class="form-control" id="question_id">
                                    <option value="">Select Question</option>
                                    @foreach($question as $item)
                                        <option value="{{$item->id}}"  {{$item->id==$options->question_id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a onclick="history.back()" class="btn back_button">Go Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

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