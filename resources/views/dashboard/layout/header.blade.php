<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <style>
        a.nav-link.dropdown-toggle {
            font-size: 14px;
        }

        .sidebar {
            width: 298px !important;
        }

        .form_width {
            padding-left: 3.5rem !important;
        }

        
    </style>
    @include('dashboard.layout.css')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        @if(Auth::user()->role == 1)
            @include('dashboard.layout.admin_sidebar')
        @elseif(Auth::user()->role == 2)   
            @include('dashboard.layout.admin_sidebar')
        @endif
        <!-- Sidebar End -->