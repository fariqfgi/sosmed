@extends('templates.layout')


@section('content')
<div class="container py-5">



  <div class="row">
    <div class="col-lg-7 mx-auto">
      <div class="bg-white rounded-lg shadow-sm p-5">
       

        <!-- Credit card form content -->
        <div class="tab-content">

          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show active">
            <form role="form" action="/post" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="tulisan">Tulisan</label>
                <input type="text" name="tulisan" placeholder="Tulisan" required class="form-control">
              </div>
              <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" name="caption" placeholder="Caption" required class="form-control">
              </div>
             
              
               <div class="form-group">
                <label for="quote">Quote</label>
                <input type="text" name="quote" placeholder="Quote dong!" required class="form-control">
              </div>

               <div class="custom-file mb-4">
                <input type="file" class="custom-file-input" name="photo">
                <label class="custom-file-label" for="inputGroupFile01" name="photo">Choose Photos</label>
              </div>
            
              <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Post it </button>
            </form>
          </div>
          <!-- End -->

         
        </div>
        

      </div>
    </div>
  </div>
</div>

@endsection