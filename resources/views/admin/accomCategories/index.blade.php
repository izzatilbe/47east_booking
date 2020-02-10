@extends('layouts.admin')
@section('content')
@can('accom_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.accom-categories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.accomCategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.accomCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AccomCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.accomCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.accomCategory.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.accomCategory.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.accomCategory.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accomCategories as $key => $accomCategory)
                        <tr data-entry-id="{{ $accomCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $accomCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $accomCategory->name ?? '' }}
                            </td>
                            <td>
                                {{ $accomCategory->description ?? '' }}
                            </td>
                            <td>
                                @if($accomCategory->photo)
                                    <a href="{{ $accomCategory->photo->getUrl() }}" target="_blank">
                                        <img src="{{ $accomCategory->photo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('accom_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.accom-categories.show', $accomCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('accom_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.accom-categories.edit', $accomCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('accom_category_delete')
                                    <form action="{{ route('admin.accom-categories.destroy', $accomCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('accom_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.accom-categories.massDestroy') }}",
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
  $('.datatable-AccomCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection