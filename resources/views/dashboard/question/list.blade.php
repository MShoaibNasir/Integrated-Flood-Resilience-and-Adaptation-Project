@extends('dashboard.layout.master')
@section('content')

<style>
    td {
        white-space: nowrap;
    }

    th {
        white-space: nowrap;
    }
    a.options {
    background: #005aff82;
    color: white;
    padding: 9px 12px;
    border-radius: 8px;
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
                <a href="{{route('question.create',[$title_id])}}">Create Questions</a>
                <a href="{{route('options.list',[$title_id])}}" class="options">Options</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="myTable">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">S no</th>
                            <th scope="col">Question id</th>
                            <th scope="col">Selected Options</th>
                            <th scope="col">Question Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Placeholder</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                 
                        @foreach($question as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$item->id }}</td>
                                <td>{{$item->option_id ? $item->option_id : 'N/A'}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->placeholder}}</td>
                              
                                <td><a class="btn btn-sm btn-success" href="">Edit</a>
                                <a class="btn btn-sm btn-danger" href="{{route('question.delete', [$item->id])}}">Delete</a></td>
                                
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
        </script>
    @endif

    @endsection