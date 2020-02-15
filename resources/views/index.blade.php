@extends('layouts.app')
<style>
#mute {
      position: absolute;
    }
    #mute.on {
      opacity: 0.7;
      z-index: 1000;
      background: white;
      height: 100%;
      width: 100%;
    }
</style>
@section('content')
<div class="container">
    <div id="mute"></div>
    <div class="row justify-content-center">
        <app-component></app-component>
    </div>
</div>
@endsection
