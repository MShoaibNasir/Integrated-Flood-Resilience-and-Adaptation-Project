@extends('dashboard.layout.master')
@section('content')

<style>
    .mb-3.col-6.checkbox {
        padding-top: 40px;
    }

    .plus {
        display: flex;
        gap: 3px;
        align-items: center;
        margin: 0;
    }

    .plus_sign {

        font-size: 22px;
    }
</style>
<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->
    <div class="container-fluid pt-4 px-4 form_width">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Question Create</h6>
                    <form method="post" action="{{route('question.store', [$title_id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <input type="hidden" name="section_id" value="{{$title_id}}">
                            <div class="mb-3 col-6">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="text">Text</option>
                                    <option value="text">Date</option>
                                    <option value="text">Map</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">Placeholder</label>
                                <textarea name="placeholder" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3 col-6 checkbox">
                                <label class="form-label">Parent Options</label>
                                <select name="option_id" class="form-control" id="option_id">
                                    <option value="">Select Option</option>
                                    @foreach($Option as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>




                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                 
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="mb-4">Options Create</h6>
                        </div>
                       
                    </div>
                    <form method="post" action="{{route('options.store', [$title_id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 d-flex justify-content-end" >
                            <a class="btn btn-danger" id="add_options_0" onclick="add_options(0)">Add  Option</a>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name[]">
                            </div>
                            <input type="hidden" name="section_id" value="{{$title_id}}">
                            <div class="mb-3 col-6">
                                <label class="form-label">Type</label>
                                <select name="type[]" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="text">Text</option>
                                    <option value="text">Date</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">Placeholder</label>
                                <textarea name="placeholder[]" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3 col-6 checkbox">
                                <label class="form-label">Parent Question</label>
                                <select name="question_id" class="form-control" id="question_id">
                                    <option value="">Select Question</option>
                                    @foreach($question as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="add_more_option_0"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{asset('dashboard\js\question.js')}}"></script>


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