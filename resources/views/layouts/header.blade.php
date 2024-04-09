<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Basic -->
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link href="{{asset('frontend/images/logo.png')}}" rel="icon">

  <!-- Site Metas -->
  <meta content="Rentals In Uganda" name="keywords">
  <meta content="Rental Houses And Houses On Sale" name="description">

  <meta property="og:title" content="{{ isset($ogTitle) }}" />
  <meta property="og:url" content="{{ $ogUrl ?? request()->fullUrl() }}" />
  <meta property="og:description" content="{{ isset($ogDescription) }}" />
  <meta property="og:image" itemprop="image" content="{{ isset($ogImage) }}" />
  <meta name="Keywords" content="php, laravel, css, html, javascript">

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles

 
<!-- leaflet.js styles -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<style>
  #social-links ul li{
    display: inline-block;
  }
  #social-link ul li a{
    padding: 20px;
    margin: 2px;
    font-size: 30px;
    color: rgb(46, 41, 114);
    background-color: #ccc;

  }
</style>

