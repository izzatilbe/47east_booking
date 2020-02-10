@extends('layouts.admin')
@section('content')
@can('accommodation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.accommodations.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.accommodation.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.accommodation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Accommodation">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.short_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.tag') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.capacity') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.amenity') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.accommodation.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accommodations as $key => $accommodation)
                        <tr data-entry-id="{{ $accommodation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $accommodation->id ?? '' }}
                            </td>
                            <td>
                                {{ $accommodation->name ?? '' }}
                            </td>
                            <td>
                                {{ $accommodation->short_description ?? '' }}
                            </td>
                            <td>
                                @foreach($accommodation->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($accommodation->tags as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $accommodation->description ?? '' }}
                            </td>
                            <td>
                                {{ $accommodation->capacity ?? '' }}
                            </td>
                            <td>
                                @foreach($accommodation->amenities as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $accommodation->price ?? '' }}
                            </td>
                            <td>
                                @foreach($accommodation->photo as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('accommodation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.accommodations.show', $accommodation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('accommodation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.accommodations.edit', $accommodation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('accommodation_delete')
                                    <form action="{{ route('admin.accommodations.destroy', $accommodation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('accommodation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.accommodations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Accommodation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection