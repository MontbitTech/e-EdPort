<table id="subjectlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
  <thead>
    <tr>
      <th>Division</th>
      <th>Section</th>
      <th>Subject</th>
      <th class="text-center">Classroom URL</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @if($getResult)
    @php $i=1; @endphp
    @foreach($getResult as $cls)
    <tr>
      <td>{{$cls->class_name}}</td>
      <td>{{$cls->section_name}}</td>
      <td>{{$cls->studentSubject->subject_name}}</td>
      <td class="text-center"><a href="{{ $cls->g_link }}" target="_blank" class="link-color">Classroom Link </a></td>
      <td class="text-center">
        <a href="javascript:void(0);" data-deleteModal="{{$cls->id}}" class="delete-color">{{ __('Delete') }}</a>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>