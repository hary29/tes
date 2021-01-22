  @extends('layout/main')

  @section('tittle','Index')
  @section('container')
  
<section class="container-fluid mt-5 mb-3">
  <div class="p-3 bg-white">
    <div class="row">
      <div class="col-lg-6 col-md-6 text-center my-5">
        <h2 class="title quicksand">Apa itu Patungan Sedekah ? </h2>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, explicabo consectetur debitis facilis natus rem nemo quidem ipsam cum. Similique odio non velit minus a, eum reiciendis dolorem vitae autem.
      </div>
      <div class="col-lg-6 col-md-6 text-center my-5">
        <img  class="w-75" src="{{ asset('img/ps-logo/ps419x200-01.png') }}" alt="thinking"> 
      </div>
    </div>
  </div>
</section>

<div class="container-fluid">
  @include('layout/sliderHome')
</div>

<div class="container-fluid my-3 py-2">
  <div class="text-center pb-4">
    <h2 class="my-2">Latest News</h2>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
          <img  class="my-1 px-4 w-100" src="{{ asset('img/ps-logo/ps-171x80.png') }}" alt=""> 
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="javascript:void(0)" class="btn btn-primary modalMd" value="" title="Show Data" target="dialog" >Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
          <img  class="my-1 px-4 w-100" src="{{ asset('img/ps-logo/ps-171x80.png') }}" alt=""> 
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
          <img  class="my-1 px-4 w-100" src="{{ asset('img/ps-logo/ps-171x80.png') }}" alt=""> 
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
          <img  class="my-1 px-4 w-100" src="{{ asset('img/ps-logo/ps-171x80.png') }}" alt=""> 
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container p-3 bg-white">
  <h1 style="text-align: center;" class="pb-4">coba aja dulu</h1>
  <div class="row">
    <div class="col">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, explicabo consectetur debitis facilis natus rem nemo quidem ipsam cum. Similique odio non velit minus a, eum reiciendis dolorem vitae autem.
    </div>
    <div class="col">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis officiis magnam provident praesentium fugit quis dolor, pariatur non eligendi doloremque cum repudiandae minima ducimus quam. Voluptatum quas temporibus eius quidem.
    </div>
  </div>
</div> 

<div class="container-fluid p-3 my-3">
  <div class="row btm-row-index">
    <div class="col-sm">
      <h2>Lorem ipsum</h2>
      <ul>
        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nisi ipsam numquam, qui quis debitis architecto, nobis ex hic ipsa, iste magni assumenda obcaecati itaque ad est nostrum eos fuga.</li>
        <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus magnam consequuntur officiis corporis impedit quisquam incidunt laboriosam quasi quae, eius culpa, excepturi labore! Temporibus cum dolorum recusandae sunt quod similique.</li>
      </ul>
    </div>
    <div class="col-sm embed-responsive embed-responsive-16by9">
      <iframe width="560" height="315" class="py-3" src="https://www.youtube.com/embed/tgbNymZ7vqY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
      </iframe>
    </div>
  </div>
</div>

  @endsection

  <script>
    
  // alert('tess')
  //     console.log('tess');
  </script>