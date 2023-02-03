@extends('layout.app')
@section('content')
  <section>
  <!-- Jumbotron -->
  <div class=" text-center bg-image rounded-3 w-100" style="
    background-image: url('{{ asset('../img/bg-1.jpg')}}');
    height: 1000px;  background-position: center;
      background-repeat: no-repeat;
      background-size: cover; 
    ">
    <div class="mask" style="background-color: rgba(5, 45, 68, 0.3);height: 1000px;  background-position: center;
      background-repeat: no-repeat;
      background-size: cover; ">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          <h1 class="mb-3" style="font-size:48px;font-weight:bold;">Welcome to</h1>
          <h4 class="mb-3"><i> Ck Trafik 1 GSA for Iraqi Airways in Denmark</i></h4>
        </div>
      </div>
    </div>
  <!-- Jumbotron -->
</section>
<section class="custom-color-bg custom-color">
  <div class="container py-5 text-center">
    <h2>Ck Trafik 1</h2>
    <h3 class="text-black text-center">Travel Angency</h3>
    <div class="card border-0">
      <div class="card-body custom-color-bg text-black text-center">
          <p>Iraqi Airways Copenhagen offers you a convenient, affordable and an easy way to travel to Iraq.
            With years of experience operating cheap flights to the Middle East, we understand what customers are looking for when it comes to travel.
            We are proud of our hospitality, our excellent customer service and our experience in the industry.
            </p>
          
      </div>
    </div>
  </div>
</section>

<section class="py-md-0 mt-md-0 mt-5">
  <div class="container text-center">
   <div class="row"  class="h-sm-auto">
    <div class="col-lg d-none d-lg-block" > 
      <img src="{{ asset('../img/baghdad.jpg')}}"  class="mx-auto d-block" style="max-width: 582px;" alt="">
    </div>
   <div class="col-lg" style="padding:20px;">
 <h3 class="text-center">Travel To Baghdad</h3>
 <div class="card border-0">
   <div class="card-body text-black">
       <p>Baghdad, the capital city of Iraq, is known for its rich history, culture, and diverse communities. Despite facing numerous challenges,
          such as war, violence, and economic struggles, Baghdad still holds many positive aspects that are worth highlighting.
          <br/>
         One of the most notable things about Baghdad is its deep cultural heritage, reflected in the city's numerous museums, monuments, and ancient sites.
         <br/>
          The National Museum of Iraq, for example, is home to some of the world's most important archaeological treasures,
           including artifacts from the ancient civilizations of Sumer, Akkad, Babylon, and Assyria. Additionally,
            the city is also home to numerous historical sites and landmarks, such as the Great Mosque of Al-Mansur,
             the Al-Mustansiriya University, and the Al-Jazeera Palace.
       </p>   
   </div>
 </div>
 </div>

   
 </div>
  </div>
</section>

<section class="bg-black py-5 py-md-0 mt-md-0 mt-5">
  <div class="container text-center">
    <div class="row" style="height:550px;">
      <div class="col-sm" style="padding:25px 36px;"> 
      <h3 class="custom-color">Travel To Erbil</h3>
      <div class="bg-black border-0">
        <div class="custom-color">
            <p>Erbil, also known as Hawler, is the capital city of the Kurdistan Region in northern Iraq. 
              <br/>
            It is one of the oldest continuously inhabited cities in the world, with a history dating back over 6,000 years. 
            Today, Erbil is a thriving metropolis that combines its rich cultural heritage with modern amenities and infrastructure. 
            Here are some of the good things about Erbil:
              <br/>
              Rich Culture and History: Erbil is home to many historic sites and monuments, including the Citadel of Erbil,
                which dates back to the Assyrian era and has been listed as a UNESCO World Heritage Site.
                Visitors can also explore the Bazaar of Erbil, a bustling market that has been in operation for over 2,000 years.
                <br/>
              Natural Beauty: Erbil is surrounded by stunning natural beauty, including parks and gardens, as well as the nearby mountains and lakes.
              The city also boasts several parks and public spaces, providing residents and visitors with ample opportunities to enjoy the great outdoors.
            </p>   
        </div>
      </div>
      </div> 
      <div class="col-sm  d-none d-lg-block overflow-hidden" style="height:550px;"> 
        <img src="{{ asset('../img/erbil.jpg')}}" class="mx-auto d-block" height="550px" width="582px" alt="">
      </div>
        
      </div>
  </div>
</section>

<section>
  <div class="container text-center">
   <div class="row" style="height:500px;">
    <div class="col-md d-none d-lg-block" > 
      <img src="{{ asset('../img/najaf1.jpg')}}"  class="mx-auto d-block" width="582px" alt="">
    </div>
   <div class="col-md" style="height:400px;padding:25px;">
    <h3 class="text-center">Travel To Najaf</h3>
    <div class="card border-0">
      <div class="card-body text-black">
          <p>Najaf is a city in central Iraq that is known for its rich history and cultural heritage.
           <br>
           The city also boasts a thriving local economy, with a range of businesses, from traditional handicrafts to modern industry.
           <br>
            Additionally, Najaf is known for its delicious local cuisine, including dishes such as kubbeh and fattoush.
            <br>
             The people of Najaf are known for their hospitality and generosity, making it a welcoming and enjoyable place to visit for people of all backgrounds.
             <br>
              Overall, Najaf is a city that offers a unique blend of cultural, historical, and economic richness, making it a great place to live, work, and visit.
              <br>
          </p>   
      </div>
    </div>
 </div>

   
 </div>
  </div>
</section>

<hr>

  <div class="container py-5">
    <h2 class="text-center mb-5">Partners</h2>
    <div class="row">

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede1.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede7.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede9.png')}}" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-md img-custom-h"> 
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede4.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede5.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede6.png')}}" alt="">
        </div>
      </div>
      <div class="row">
        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede2.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede8.png')}}" alt="">
        </div>

        <div class="col-md img-custom-h">
          <img width="150px" class="mx-auto d-block" src="{{ asset('../img/patner/Billede3.png')}}" alt="">
        </div>
      </div>

  </div>

@endsection