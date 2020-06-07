@extends('layouts.admin.app')
@section('content')  
  <div class="body-wrapper">    
  <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Edit Student</span>
          </div>
                    <div class="card-body pt-4"> 
                  {!! Form::open(array('route' => ['cms.editlink',encrypt($link[0]->id)],'method'=>'POST','autocomplete'=>'off')) !!}
                   <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Class:</label>
                  <div class="col-md-5">
                 {!! Form::select('class', $data['class'], $link[0]->class,array('class' => 'form-control','required'=>'required')) !!}
                  </div>
                </div>
							
				<div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">Subject:</label>
					<div class="col-md-5">
						<select name='subject' class='form-control'>
							<option value="">Select Subject</option>
							@foreach($subjects as $subject)
							
							<option {{ ($subject->id == $link[0]->subject ? "selected" : "")}} value="{{$subject->id}}">{{$subject->subject_name}}</option>
							@endforeach
						</select>
					</div>
                </div>
				
				<div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">Topic:</label>
					<div class="col-md-5">
                    {!! Form::text('topic', $link[0]->topic, array('placeholder' => 'Topic','class' => 'form-control')) !!}
					</div>
                </div>
				<div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">URL:</label>
					<div class="col-md-5">
                    {!! Form::text('link', $link[0]->link, array('placeholder' => 'URL','class' => 'form-control','required'=>'required')) !!}
					</div>
                </div>
                 
				 <div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">Assignment URL:</label>
					<div class="col-md-5">
                    {!! Form::text('alink', $link[0]->assignment_link , array('placeholder' => 'Assignment URL','class' => 'form-control','required'=>'required')) !!}
					</div>
                </div>
				 
                   <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-w140">Submit</button>
                        <a href="{{route('admincms.listtopics')}}" class="btn btn-danger">Back</a>
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