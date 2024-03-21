<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Basic -->
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- <meta property="og:title" content="Rentals & Apartments in Uganda and House Property On Sale" />
  <meta property="og:description" content="Best House Property On Sale and Rentals/Apartments in Uganda" />
  <meta property="og:image" content="https://yorentos.stardena.com/frontend/images/logo.png" /> -->

  <!-- Favicon -->
  <link href="{{asset('frontend/images/logo.png')}}" rel="icon">

  <!-- Site Metas -->
  <meta content="Rentals In Uganda" name="keywords">
  <meta content="Rental Houses Available" name="description">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet" />


  <!-- jetstream helpers -->
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles

 
<!-- leaflet.js styles -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />


