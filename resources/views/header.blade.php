<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>WebRTC Demo!</title>
  </head>
  <body>

  <nav class="navbar navbar-dark bg-dark navbar-expand-sm border-bottom border-primary">
        <!-- Logo -->
        <a href="/">
          <i class="fas fa-tachometer-alt"></i>
          <img src="{{ asset('media/logo.jpg') }}" class="mr-5" height="60" />
        </a>



        <!-- Links -->

        <ul class="navbar-nav">
            <li class="nav-item">
                <h5><strong>
                    <a href="/" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" aria-current="page">Dashboard</a>
                </strong></h5>
            </li>

            <li class="nav-item">
                <h5><strong>
                    <a href="/camera" class="nav-link {{ (request()->is('camera')) ? 'active' : '' }}" aria-current="page">Camera</a>
                </strong></h5>
            </li>

            <li class="nav-item">
                <h5><strong>
                    <a href="/mic" class="nav-link {{ (request()->is('mic')) ? 'active' : '' }}" aria-current="page">Mic</a>
                </strong></h5>
            </li>

            <li class="nav-item">
                <h5><strong>
                    <a href="/video" class="nav-link {{ (request()->is('video')) ? 'active' : '' }}" aria-current="page">Video</a>
                </strong></h5>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          <!--
          <li>
            <a class="dropdown-item" href="/users/logout"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              <div class="d-none" aria-hidden="true">
              </div>
            </a>
          </li>
            -->
        </ul>
    </nav>
    <div class="p-3 m-2 border border-success rounded border-thick">
        <h3 class="text-center border-bottom border-thick p-4 mb-4 bg-light text-dark rounded-lg font-weight-bolder">{{ $pageTitle }}</h3>

