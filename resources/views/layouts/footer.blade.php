@php
    $company = App\Company::first();
@endphp
<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">
  
      <!-- Footer links -->
      <div class="row text-center text-md-left mt-3 pb-3">
  
        <!-- Grid column -->
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">{{$company->name}}</h6>
          <p>{{$company->alamat}}</p>
        </div>
  
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
          <p>
            <i class="fa fa-home mr-3"></i> {{$company->kota}}</p>
          <p>
            <i class="fa fa-envelope mr-3"></i>{{$company->email}}</p>
          <p>
            <i class="fa fa-phone mr-3"></i> {{$company->telp}}</p>

        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Footer links -->
  
      <hr>
  
      <!-- Grid row -->
      <div class="row d-flex align-items-center">
  
        <!-- Grid column -->
        <div class="col-md-12 col-lg-12">
  
          <!--Copyright-->
          <p class="text-center text-md-center">© {{date('Y')}} Copyright:
            <a href="#">
              <strong> Ramelan eko pamuji</strong>
            </a>
          </p>
  
        </div>
        <!-- Grid column -->
  
  
      </div>
      <!-- Grid row -->
  
    </div>
    <!-- Footer Links -->
  
  </footer>
  <!-- Footer -->