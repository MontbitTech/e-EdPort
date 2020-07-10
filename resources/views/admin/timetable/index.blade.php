@extends('layouts.admin.app')

@section('content')

@php

	$class=$ar["class"];
	$section=$ar["sname"];
	$tname=$ar["tname"];
	$subn=$ar["subname"];
	$timing=$ar["timing"];

@endphp
<section class="main-section">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-sm-12">
				<a href="{{ route('reload-timetable') }}" target="_blank">
					Reload today's timetable for
					all teachers
				</a>
				<div class="card card-common mb-3">
					<div class="card-header">
						<span class="topic-heading">Time Table</span>
						<div class="float-right">
							<a type="button" class="btn btn-sm btn-success"
								href="{{ route('admin.timetableimport') }}">
								<svg class="icon icon-font16 icon-mmtop-3 mr-1">
									<use
										xlink:href="{{ asset('images/icons.svg#icon_adduser') }}">
									</use>
								</svg> Import Time Table
							</a>
						</div>
						<div class="float-right  mr-3">
							<a type="button" class="btn btn-sm btn-success"
								href="{{ route('add.extracalss') }}">
								<svg class="icon icon-font16 icon-mmtop-3 mr-1">
									<use
										xlink:href="{{ asset('images/icons.svg#icon_adduser') }}">
									</use>
								</svg> Add ExtraClass
							</a>
						</div>
						<!-- <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{ route('admin.sampleDownload') }}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{ asset('images/icons.svg#icon_adduser') }}"></use></svg> Download Sample File
              </a>
            </div> -->
					</div>
					<div class="card-body pt-3">
						<div class="row justify-content-center">
							<div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
								<span data-dtlist="#teacherlist" class="mb-1">
									<!--  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div> -->
									<a href='' target='_blank' id='download' style='display:none;'>Download/View</a>
								</span>
							</div>
							<div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
								<span data-dtfilter="" class="mb-1">
									<!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
				  <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->

									<select id="txtSerachByClass" name="txtSerachByClass"
										class="form-control form-control-sm" onchange="getData()">
										<option value=''>Select Class</option>
										@if(count($class)>0)
											@foreach($class as $cl)
												<option value='{{ $cl->class_name }}'>{{ $cl->class_name }}
												</option>
											@endforeach
										@endif
									</select>

								</span>

								<span data-dtfilter="" class="mb-1">
									<!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
				  <input type="text"  id="txtSerachBySection" class="form-control form-control-sm" placeholder="Search By Section..." />-->

									<select id="txtSerachBySection" name="txtSerachBySection"
										class="form-control form-control-sm" onchange="getData()">
										<option value=''>Select Section</option>
										@if(count($section)>0)
											@foreach($section as $sl)
												<option value='{{ $sl->section_name }}'>
													{{ $sl->section_name }}
												</option>
											@endforeach
										@endif
									</select>

								</span>


							</div>


							<div class="col-sm-12" id='timetable'>
								<table id="teacherlist" class="table table-sm table-bordered display" style="width:100%"
									data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60"
									data-collast="120" data-filterplaceholder="Search Records ...">
									<thead>
										<tr>
											<th id='classname'></th>
											<th>Time</th>
											<th>Monday</th>
											<th>Tuesday</th>
											<th>Wednesday</th>
											<th>Thursday</th>
											<th>Friday</th>
											<th>Saturday</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="classdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-light d-flex align-items-center">
				<h5 class="modal-title font-weight-bold">Update Timetable</h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<svg class="icon">
						<use xlink:href="{{ asset('images') }}/icons.svg#icon_times2"></use>
					</svg>
				</button>
			</div>
			<div class="modal-body pt-6">

				<form action="{{ route('timetable.edit') }}" method="POST">
					@csrf

					<input type="hidden" name="tid" id="tid" />
					<div class="form-group text-center">
						<label class="text-danger">*Note : This is permanent change in Timetable</label>
						<table class='table text-left'>
							<tr>
								<th>Teacher</th>
								<td><label id='tname'></label></td>
								<td><input type="radio" name="radio" id="tradio" value="tch" checked /></td>
								<td>
									<select id="sel_teacher" name="sel_teacher" class="form-control form-control-sm"
										required>
										<option value=''>Select Teacher</option>
										@if(count($tname)>0)
											@foreach($tname as $tn)
												<option value='{{ $tn->id }}'>{{ $tn->name }}</option>
											@endforeach
										@endif
									</select>
								</td>
							</tr>
							<tr>
								<th>Subject </th>
								<td><label id='subject_name'></label></td>
								<td><input type="radio" name="radio" id="sradio" value="sub" /></td>
								<td>
									<select id="sel_subject" name="sel_subject" class="form-control form-control-sm"
										disabled required>
										<option value=''>Select Subject</option>
										@if(count($subn)>0)
											@foreach($subn as $sn)
												<option value='{{ $sn->id }}'>{{ $sn->subject_name }}</option>
											@endforeach
										@endif
									</select>
								</td>
							</tr>
							<!--		<tr><td>		  <input type="radio" name="temp" id="temp"> Temporary allocation</td>
						<td colspan=2><input type="radio" name="temp" id="perm"> Permanent allocation</td>-->
							</tr>
						</table>


					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-danger px-4">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
	function editTimetable(id, day) {
		//var myday = Object.keys(day)[0];
		//var f = day.details.split('/');
		//alert(day.details);


	}

	$("input[type='radio']").on("click", function () {
		var option = this.value;
		if (option == "sub") {
			$("#sel_subject").attr('disabled', false);
			$("#sel_teacher").attr('disabled', true);
		} else {
			$("#sel_subject").attr('disabled', true);
			$("#sel_teacher").attr('disabled', false);
		}


	});

	$(document).on('click', '[data-deleteModal]', function () {
		var tid = $(this).data('id');
		var tname = $(this).data('tname');
		var sname = $(this).data('subject_name');
		//var tclass = $(this).data('class_day');
		//var timing = $(this).data('timing');

		var tn = document.getElementById('tname');
		var sn = document.getElementById('subject_name');
		//var cd=document.getElementById('class_day');
		//var tm=document.getElementById('timing');
		var td = document.getElementById('tid');

		td.value = tid;
		tn.innerHTML = tname;
		sn.innerHTML = sname;
		//cd.innerHTML =  tclass;
		//tm.innerHTML =  timing;

		/*	$("#tid").text(tid);
			$("#tn").text(tname);
			$("#sn").text(sname);
			$("#cd").text(tclass);
			$("#tm").text(timing);*/

		$('#classdeletModal').modal('show');
	});

	function getData() {
		var cl = document.getElementById("txtSerachByClass");
		var sl = document.getElementById("txtSerachBySection");
		var dl = document.getElementById("download");
		var tt = document.getElementById("timetable");
		var url = "{{ route('list.filtertimetable') }}";

		if (cl.value == "") {
			cl.focus();
			return false;
		} else if (sl.value == "") {
			sl.focus();
			return false;
		} else {
			$.ajax({

				url: url,
				type: "POST",
				data: {
					txtclass: cl.value,
					txtsubject: sl.value
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				/* contentType: false,
				cache: false,
				processData:false, */
				success: function (data) {
					tt.innerHTML = data["html"];
					if (data["data"] != "") {
						dl.href = "{{ url('/dl-timetable') }}" + "/" + cl.value + "_" + sl
							.value + "_timetable.pdf";
						dl.style.display = "block";
					}
				}
			});
		}
	}
</script>

<!--
<script type="text/javascript">
$(document).ready(function() {
		  var table = $('#teacherlist').DataTable({
			  
			    dom: 'Bfrtip',
				
			/* 	lengthMenu: [
						[ 10, 25, 50,100, -1 ],
						[ '10', '25', '50','100', 'all' ]
				], */
				buttons: [
					//'pageLength',
					//'pdf'
				],
				"searching": false,
				
		    /*  initComplete: function(settings, json) {
			  
			  $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
			  
			  $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
			}, */ 
			
		  });
		  $('.dateset').datepicker({
			dateFormat: "yy/mm/dd"
			// showAnim: "slide"
		  })

		  
		// $('#teacherlist').DataTable();
		 
		// #column3_search is a <input type="text"> element
		$('#txtSerachBySection').on( 'keyup', function () {
			table
				.columns( 3 )
				.search( this.value )
				.draw();
		} );

		$('#txtSerachByClass').on( 'keyup', function () {
			table
				.columns( 2 )
				.search( this.value )
				.draw();
		} );

		
		
		
		
});

</script>
-->

@endsection