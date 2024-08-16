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
    /* Responsive and accessible HTML 5 breadcrumb */

@import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap");

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  color: #191919;
  font-family: "Open Sans", sans-serif;
  line-height: 1.6;
  height: 100vh;
  height: 100svh;
  display: grid;
  place-items: center;
}

a {
  color: #666666;
  text-decoration: none;
  transition: color 0.5s ease;
}

a:hover,
a:focus {
  color: #191919;
}

ol {
  margin: 0;
  padding: 0;
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  border: 1px solid #a7a7a7;
  border-radius: 5px;
  background-color: #c7c7c7;
}

li {
  --arrow-size: 1.4em;
  --arrow-width: 1em;
  position: relative;
  padding: 0.4em 1em;
  line-height: 1.8;
  white-space: nowrap;
}

li::before,
li::after {
  content: " ";
  display: block;
  width: 0;
  height: 0;
  border-top: var(--arrow-size) solid transparent;
  border-bottom: var(--arrow-size) solid transparent;
  border-left: var(--arrow-width) solid var(--arrow-color);
  position: absolute;
  top: 50%;
  margin-top: calc(var(--arrow-size) * -1);
  left: 100%;
}

li::before {
  --arrow-color: #c7c7c7;
  z-index: 2;
}

li::after {
  --arrow-color: #a7a7a7;
  margin-left: 1px;
  z-index: 1;
}

li:first-of-type {
  padding-inline-start: 1.4em;
}

li:last-of-type {
  padding-inline-end: 1.4em;
}

li:last-of-type::before,
li:last-of-type::after {
  display: none;
}

.sr-only {
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}

</style>
<!-- Content Start -->
<div class="content">

    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->
    <div class="container-fluid pt-4 px-4 form_width">

        <nav role="navigation" aria-label="Breadcrumb">
            <ol itemscope itemtype="">
               
                <li itemprop="itemListElement" itemscope itemtype="#">
                    <a href="#" itemprop="item" href="#">
                        <span itemprop="name">{{$form_name->name}}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li itemprop="itemListElement" itemscope itemtype="#">
                    <a href="#" itemprop="item" href="">
                        <span itemprop="name">{{$section->name}}</span>

                    </a>
                    <meta itemprop="position" content="2" />
            </ol>
        </nav>
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
                                    <option value="date">Date</option>
                                    <option value="map">Map</option>
                                    <option value="number">Number</option>
                                    <option value="image">Image</option>
                                    <option value="file">File</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label class="form-label">Placeholder</label>
                                <textarea name="placeholder" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3 col-6 checkbox">
                                <label class="form-label">Parent Options</label>
                                <select name="option_id" class="form-control" id="option_id" onchange="show_related_question()">
                                    <option value="">Select Option</option>
                                    @foreach($Option as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-6 checkbox">
                                <label class="form-label">Question Name</label>
                               <input type="text"  class="form-control" readonly id="question_name_for_show">
                            </div>




                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a onclick="history.back()" class="btn back_button">Go Back</a>
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
                        <div class="col-12 d-flex justify-content-end">
                            <a class="btn btn-danger" id="add_options_0" onclick="add_options(0)">Add Option</a>
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
                                    <option value="number">Number</option>
                                    <option value="image">Image</option>
                                    <option value="file">File</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                            <!-- <div class="mb-3 col-12">
                                <label class="form-label">Placeholder</label>
                                <textarea name="placeholder[]" class="form-control" rows="4"></textarea>
                            </div> -->

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
                        <a onclick="history.back()" class="btn back_button">Go Back</a>
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