@extends('layouts.admin.app')

@section('content')
<!-- Admin-setting-sechool-main  -->
<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-6 ">


        <div class="card ">
          <div class="card-header  text-white main-bg-color">
            My Institution's information
          </div>
          <div class="card-body">
            <form>

              <div class="form-group">
                <label for="new">Academic Year</label>
                <input class="form-control" type="text" id="new" value="{{$settings['year']->value}}" readonly>
              </div>

            </form>
            <form>

              <div class="form-group">
                <label for="new">Institution Name</label>
                <input class="form-control" type="text" id="new" value="{{$settings['schoolname']->value}}" readonly>
              </div>

            </form>
            <form>

              <div class="form-group">
                <label for="new">Institution Address</label>
                <textarea id="new" cols="10" class="form-control w-100" readonly>{{$settings['schooladdress']->value}}</textarea>

              </div>

            </form>

            <form id="year">

              <div class="form-group">
                <label for="new">Institution Domain</label>
                <input class="form-control" type="text" id="new" value="{{$settings['domain']->value}}" readonly>
              </div>

            </form>

            <form>

              <div class="form-group">
                <label for="new">Institution Email</label>
                <input class="form-control" type="text" id="new" value="{{$settings['mailfrom']->value}}" readonly>
              </div>

            </form>

            <form method="post" id="profile_form" action="{{route('admin.school_logo')}}" enctype="multipart/form-data">
              @csrf
              <div class="media">

                <div class="media-body">
                  <div class="custom-file">
                    <label for="uploadphoto" class=" custom-file-label">Institution Logo</label>
                    <input type="file" class="custom-file-input form-control" name="profile_picture" id="uploadphoto" onchange="readURL(this);" accept=".jpg,.jpeg,.png,.gif">
                  </div>
                </div>
                <img src="{{$settings['schoollogo']->value }}" class="align-self-center ml-2" id="img-preview" width="50px">
              </div>

            </form>

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
        <h5 class="modal-title font-weight-bold">Delete setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon">
            <use xlink:href="../images/icons.svg#icon_times2"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form action="{{route('setting.delete')}}" method="POST">
          @csrf
          <input type="hidden" name="txt_setting_id" id="txt_setting_id" />
          <div class="form-group text-center">
            <h4>Are You Sure ! </h4>
            <h4>You want to detele this setting. </h4>
            <p style="color: #bf2d2d;font-size: 13px;">* if you delete this setting, system might not function correctly or visuals may impact</p>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-warning px-4">
              Delete
            </button>
            <button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() {
    $('#teacherlist').DataTable({
      initComplete: function(settings, json) {
        $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
        $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
      }
    });
    $('.dateset').datepicker({
      dateFormat: "yy/mm/dd"
      // showAnim: "slide"
    })
  });

  $(document).on('click', '[data-deleteModal]', function() {
    var val = $(this).data('deletemodal');
    $('#classdeletModal').modal('show');
    $("#txt_setting_id").val(val);

  });

  function readURL(input) {

    $('#profile_form').submit();
  }
</script>
<script>
  $(document).ready(function() {
    $('#year1').keyup(function(event) {
      if (event.which === 13) {
        event.preventDefault();
        $('#year').submit();
      }
    });
  });
</script>
<script>
  // $(document).ready(function() {
  //   $("#year")
  //     .focusout(function() {
  //       $("#year").submit();
  //     });
  // });
</script>
<!-- ./ Admin-sechool-setting-main  -->
@endsection