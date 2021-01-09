@extends('layout/main')

@section('tittle','Donation')
@section('container')
<section class="container-fluid mt-5 mb-3">
    <div class="p-3 bg-white">
        <h2 class="text-center">Donation</h2>
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center my-5">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus suscipit quia. Aliquid, quaerat voluptate. Esse consectetur officia, adipisci commodi aut repellat nostrum eius, cumque corrupti ut quia ipsa quo!
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis sunt voluptas doloribus provident laboriosam rerum iure necessitatibus laudantium sit magni ducimus aspernatur totam corrupti, temporibus magnam, ad eos autem?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi facere perspiciatis, quasi aliquid exercitationem labore quos magnam consectetur totam debitis minus tempore, fugiat reiciendis culpa consequatur qui at aspernatur asperiores.
                </p>
                <a href="javascript:void(0)" id="btnDonation" class="btn btn-success rounded-pill">Mulai Donasi</a>
            </div>
            <div class="col-lg-6 col-md-6 text-center my-5">
                <img src="{{ asset('/img/donation.jpg')}}" class="w-100" alt="donation">
            </div>
        </div>
        <h2 class="text-center">Metode Pembayaran</h2>
        <div class="row mt-5" id="transType">
            <div class="col-sm-3">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <a href="javascript:void(0)" class="modalMd" value="" title="Bank Transfer" page="dialog" ><img src="{{ asset('/img/icon/payment.jpg')}}" class="w-100" alt="payment"></a>

                        <h5 class="card-title text-center">Bank Transfer</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <a href="javascript:void(0)" class="modalMd" value="" title="Go pay" page="dialog" ><img src="{{ asset('/img/icon/payment.jpg')}}" class="w-100" alt="payment"></a>

                        <h5 class="card-title text-center">Go pay</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <a href="javascript:void(0)" class="modalMd" value="" title="OVO" page="dialog" ><img src="{{ asset('/img/icon/payment.jpg')}}" class="w-100" alt="payment"></a>

                        <h5 class="card-title text-center">OVO</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <a href="javascript:void(0)" class="modalMd" value="" title="Shopee Pay" page="dialog" ><img src="{{ asset('/img/icon/payment.jpg')}}" class="w-100" alt="payment"></a>

                        <h5 class="card-title text-center">Shopee Pay</h5>
                    </div>
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