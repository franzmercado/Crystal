@extends('layouts.admins')

@section('content')


                <div class="p-3 bg-white border rounded">
                  <div class="row justify-content-center">
                      <div class="col-md-12">
                  <!-- Tab links -->
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'Info')">Personal Info</button>
  <button class="tablinks" onclick="openCity(event, 'Address')">Address</button>
</div>

<!-- Tab content -->
<div id="Info" style="display: block;" class="tabcontent">
  <h3>Profile</h3>
  <div class="col-md-2 offset-5">
    <img style="width:80px; height:100px;   border-radius: 50%;"  src="{{ asset('../dist/img/avatar.png')}}" alt="Profile"/>

  </div>

    <div class="col-md-10 offset-1">
      <label for="">First Name:</label>
      <input type="text" name="" class="form-control " value="Juan"><br>
      <label for="">Middle Name:</label>
      <input type="text" name="" class="form-control" value="Dela"><br>
      <label for="">Last Name:</label>
      <input type="text" name="" class="form-control" value="Cruz"><br>
      <label for="">Birthday:</label>
      <input type="date" name="" class="form-control"value="1997-01-02"><br>
      <label for="">Province:</label>
      <input type="text" name="" class="form-control"value="Metro Manila"><br>
      <label for="">City/Town:</label>
      <input type="text" name="" class="form-control"value="Taguig City"><br>
      <label for="">Baranggay: </label>
      <input type="text" name="" class="form-control"><br>

      <button type="button" name="button" class="btn btn-primary">Save Changes</button>
    </div>
</div>

<div id="Address" class="tabcontent">
  <h4>Store Address</h4>
    <div class="col-md-8 offset-2">
  <label for="">Pick Up Address:</label>
  <input type="text" name="" class="form-control"><br>
  <label for="">Country:</label>
  <select class="form-control" name="">
    <option value="" disabled selected></option>
    <option value="Philippines">Philippines</option>
  </select><br>
  <label for="">Province:</label>
  <select class="form-control" id="province" value="Metro Manila">

  </select><br>
  <label for="">City/Town:</label>
  <select class="form-control" id="city" name="">

  </select><br>

  <label for="">Baranggay: </label>
  <input type="text" name="" class="form-control"><br>

  <button type="button" name="button" class="btn btn-primary">Save Changes</button>

</div>
</div>


                </div>
        </div>
    </div>

@endsection
