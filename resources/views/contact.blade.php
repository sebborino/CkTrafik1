@extends('layout.app')
@section('content')

<section class="pt-5">
  <div class="container py-5 text-center">
    <h2 class="mt-5">Contact</h2>
    <h3 class="text-black text-center">Where can you find us?</h3>
    <p></p>
      <div class="row text-black text-center my-5">
        <div class="col-md">
          <div class="border overflow-hidden rounded-circle d-block mx-auto text-center" style="height:75px;width:75px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor" class="bi bi-geo-alt-fill p-2 m-2" viewBox="0 0 16 16">
            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
          </svg>
          </div>
          <ul class="list-group" style="list-style-type: none;">
            <h5 class="mt-4">Location</h5>
            <li> H. C. Ørsteds Vej 66</li>
            <li>1879 Frederiksberg.</li>
            <li><a href="https://www.google.dk/maps/place/Ck+Trafik+1-+Iraqi+Airways/@55.6839659,12.5491011,17z/data=!3m1!4b1!4m5!3m4!1s0x46525318da8e4c4b:0xf33aa81a526151f6!8m2!3d55.6839629!4d12.5512898">
              <img class="shadow d-block mx-auto mt-5" width="250px" src="{{ asset('../img/google_map.png')}}" alt="">
            </a></li>
          </ul>
          
        </div>
        <div class="col-md">
          <div class="border overflow-hidden rounded-circle  d-block mx-auto text-center" style="height:75px;width:75px">
          <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor" class="bi bi-telephone-fill p-2 m-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
          </svg>
        </div>
          <ul class="list-group" style="list-style-type: none;">
            <h5 class="mt-4">Phones</h5>
            <li> +45 55 24 77 33</li>
            <li>You can call us in the opening hours.</li>
          </ul>
        
        </div>
        
        <div class="col-md">
          <div class="border overflow-hidden rounded-circle d-block mx-auto text-center" style="height:75px;width:75px">
          <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor" class="bi bi-envelope-fill p-2 m-2" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
          </svg>
          </div>
          <ul class="list-group" style="list-style-type: none;">
            <h5 class="mt-4">Mail</h5>
            <li> +45 55 24 77 33</li>
            <li>You are welcome to contact us, everytime. We will respond you in our opening hours which are as following.</li>
          </ul>
        </div>
      </div>
  </div>
</section>
  <section class="pt-5 bg-black custom-color">
    <div class="container py-5 text-center">
      <h2 class="mt-5">Opening Hours.</h2>
        <div class="row text-black text-center my-5 d-block mx-auto">
          <ul class="list-group" style="list-style-type: none;">
            <li>Mon - Fri: 10:00-16:00</li>
            <li>Weekends: 10:00-15:00</li>
            <li>Holidays: 10:00-15:00</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

@endsection