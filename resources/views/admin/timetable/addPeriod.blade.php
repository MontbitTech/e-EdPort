@extends('layouts.admin.app')
@section('content')  
<?php 


?>

 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Create Extra Class</span>
          </div>
			<div class="card-body pt-4">
				  {!! Form::open(array('route' => ['add.extracalss'],'method'=>'POST','autocomplete'=>'off')) !!}
				<div class="row">
		
			
				<div class="col-md-12">	
					
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Class Name:</label>
						  <div class="col-md-4">
					 
						 <select name="class_id" id="class_id" class="form-control" required>
						  <option value=""> Select Class </option>
							<?php 
							  foreach($data['classData'] as $row){
								  ?>
								 
								  <option value="<?= $row->id; ?>"> <?= 'Class '.$row->class_name.' - '.$row->section_name.' - '.$row->subject_name; ?></option>
								  <?php 
							  }
							  
							  ?>
								</select>
						 </div>
						</div>
						
							<div class="form-group row">
							  <label for="colFormLabel" class="col-md-4 col-form-label">Select Teacher:</label>
							  <div class="col-md-4">
								  {!! Form::select('teacher',$data['teacher'], null,array('class' => 'form-control','required'=>'required')) !!}
							  </div>
							</div>
						
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Select Date:</label>
						  <div class="col-md-4">
							<!--  {!! Form::select('days', $days, null,array('class' => 'form-control','required'=>'required')) !!} -->
							  {!! Form::text('class_date', null, array('placeholder' => 'DD MM YYYY','class' => 'form-control ac-datepicker','required'=>'required',"onkeydown"=>"return false;")) !!}
							  
						  </div>
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Start Time :</label>
							<div class="col-md-4">
							{!! Form::text('start_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
							</div>
							
						</div>
						
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">End Time:</label>
							<div class="col-md-4">
							{!! Form::text('end_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
							</div>
						</div>
						
					<!--	<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Is Lunch:</label>
							<div class="col-md-8">
							{!! Form::checkbox('islunch',1,null, array('class' => 'form-control')) !!}
							</div>
						</div>
						 -->
						
						
					</div>
				</div>
				<div class="row">
			
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary btn-w140">Submit</button>
								<a href="{{route('list.timetable')}}" class="btn btn-danger">Back</a>
						   </div>
						 </div>
					</div>
				</div>
	
			{!! Form::close() !!}  
				  
			</div>
		  
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">

  
$(document).ready(function(){
  $('.ac-datepicker').datepicker({
    dateFormat: 'd M yy',
	minDate: 0, // 0 days offset = today
   // maxDate: 'today',
  });
  $('.ac-time').timepicker({
    controlType: 'select',
    oneLine: true,
    timeFormat: 'hh:mm tt'
  });
}); 

</script> 
@endsection