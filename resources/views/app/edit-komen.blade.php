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
            <form role="form" action="/comment/{{ $komentar->id }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="komentar">Komentar</label>
                <input type="text" name="komentar" placeholder="komentar" required class="form-control" value="{{ $komentar->isi }}">
              </div>
              <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Edit Komen </button>
            </form>
          </div>
          <!-- End -->

         
        </div>
        

      </div>
    </div>
  </div>
</div>

@endsection