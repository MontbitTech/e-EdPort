@extends('layouts.admin.app')
@section('content')
<?php

$value =  "teachername@" . $domain->value;

?>

<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-common mb-3 mt-5">
          <div class="card-header">
            <span class="topic-heading">Add New Teacher</span>
          </div>
          <div class="card-body pt-4">
            {!! Form::open(array('route' => ['teacher.add'],'method'=>'POST','autocomplete'=>'off')) !!}
            <div class="form-group row">
              <label for="colFormLabel" class="col-md-4 col-form-label">Teacher Name:</label>
              <div class="col-md-6">
                {!! Form::text('fname', null, array('placeholder' => "Teacher's Name",'class' => 'form-control','required'=>'required')) !!}
              </div>
            </div>

            <!--<div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Last Name:</label>
                  <div class="col-md-5">
                      {!! Form::text('lname', null, array('placeholder' => 'Last Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!}
                  </div>
                </div> -->

            <div class="form-group row">
              <label for="colFormLabel" class="col-md-4 col-form-label">Email:</label>
              <div class="col-md-6">
                {!! Form::email('email', null, array('placeholder' => $value,'class' => 'form-control','required'=>'required')) !!}
              </div>

            </div>

            <div class="form-group row">
              <label for="colFormLabel" class="col-md-4 col-form-label">Phone:</label>
              <div class="col-md-6">
                {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control','required'=>'required','pattern'=>'[0-9]+')) !!}
              </div>
            </div>

            <!-- <div class="form-group row">
						<label for="colFormLabel" class="col-md-4 col-form-label">Pin:</label>
					  <div class="col-md-5">
						{!! Form::text('pin', 0, array('class' => 'form-control','readonly'=>'readonly')) !!}
					</div>
					</div>       -->
            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn submit-btn btn-w140">Submit</button>
                <a href="{{route('admin.dashboard')}}" class="btn btn-back ml-3"> <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection