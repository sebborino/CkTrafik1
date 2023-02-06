@extends('layout.app')
@section('content')

  <section class="pt-5">
    <div class="container py-5 text-center">
      <h2 class="mt-5">Contact</h2>
      <h3 class="text-black text-center">Where can you find us?</h3>
        <div class="row text-black text-center my-5">
          <div class="col-6">
            <p> Our Adresse <br/> H. C. Ørsteds Vej 66
              1879 Frederiksberg
             </p>
             <p>
              <ul class="list-group" style="list-style-type: none;">
                <h5></h5>
                <li>Mon - Fri: 10:00-16:00</li>
                <li>Weekends: 10:00-15:00</li>
                <li>Holidays: 10:00-15:00</li>
              </ul>
             </p>
          </div>
            <div class="col-6">
              <a href="https://www.google.dk/maps/place/Ck+Trafik+1-+Iraqi+Airways/@55.6839659,12.5491011,17z/data=!3m1!4b1!4m5!3m4!1s0x46525318da8e4c4b:0xf33aa81a526151f6!8m2!3d55.6839629!4d12.5512898">
              <img class="shadow d-block mx-auto" width="500px" src="{{ asset('../img/google_map.png')}}" alt="">
            </a>
            </div>
        </div>
      </div>
    </div>
  </section>

@endsection