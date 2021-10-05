@extends('layout/main')

@section('tittle','Article')
@section('container')

<section class="container my-5 pt-3">
    <div class="text-center pt-3">
      <img  class="" src="{{ $data->getPhoto() }}" alt="" class="w-100" width="500px">   
    </div>
    <h2>{!! $data['title'] !!}</h2>
    <p class="text-secondary">
      Publish at {{\Carbon\Carbon::parse($data['publish_date'])->format('d F Y')}} | by {{ $data->userCreated->name }}
    </p>
    <p class="text-justify">{!! $data['description'] !!}</p>
    
</section>

@endsection