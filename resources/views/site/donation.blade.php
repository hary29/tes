@extends('layout/main')

@section('tittle','Donation')
@section('container')
<section class="container-fluid mt-5 mb-3">
    <div class="p-3 bg-white">
        <h2 class="text-center">Donation</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus suscipit quia. Aliquid, quaerat voluptate. Esse consectetur officia, adipisci commodi aut repellat nostrum eius, cumque corrupti ut quia ipsa quo!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis sunt voluptas doloribus provident laboriosam rerum iure necessitatibus laudantium sit magni ducimus aspernatur totam corrupti, temporibus magnam, ad eos autem?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi facere perspiciatis, quasi aliquid exercitationem labore quos magnam consectetur totam debitis minus tempore, fugiat reiciendis culpa consequatur qui at aspernatur asperiores.
        </p>
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center my-5">
                <img  class="w-100" src="{{ url('/resources/img/donate.jpg') }}" alt="donation"> 
            </div>
            <div class="col-lg-6 col-md-6  my-5">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <form>
                        <div class="form-group">
                            <label for="Email">Email address</label>
                            <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="name">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid p-3 my-3">
  <div class="btm-row-index">
    <div class="text-center">
        <h2 class="transbox">Apa kata mereka</h2>
    </div>
    
    @include('layout/sliderTestimonial')
        
    </div>
</div>
@endsection