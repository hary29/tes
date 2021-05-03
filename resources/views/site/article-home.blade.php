@extends('layout/main')

@section('tittle','Article')
@section('container')

<section>
<div class="container my-5 pt-3">
  @forelse($data as $index => $row)
    <div class="row my-2 shadow">
      <div class="col col-lg-3 pb-2">
      <img src="{{$row->getPhoto()}}" class="w-100" alt="">
      </div>
      <div class="col mt-3 pb-2">
        <h2>{!! $row->title !!}</h2>
        <p>{!! $row->short_description !!}</p>
      </div>
    </div>
    @empty
    <div class="py-2 shadow text-center">
        <p>Tidak ada data</p>
    </div>
  @endforelse
</div>

<div class="d-flex justify-content-center">
    {!! $data->links() !!}
</div>
</section>

@endsection