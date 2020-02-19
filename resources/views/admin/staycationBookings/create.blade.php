@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.staycationBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.staycation-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="booked_by_id">{{ trans('cruds.staycationBooking.fields.booked_by') }}</label>
                <select class="form-control select2 {{ $errors->has('booked_by') ? 'is-invalid' : '' }}" name="booked_by_id" id="booked_by_id">
                    <option selected="selected" value="">Please Select</option>
                    @foreach($booked_bies as $customer)
                        <option value="{{ $customer->id }}">{{$customer->first_name}} {{$customer->last_name}} ({{$customer->email}})</option>
                    @endforeach

                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.booked_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="accom_id">{{ trans('cruds.staycationBooking.fields.accom') }}</label>
                <select class="form-control select2 {{ $errors->has('accom') ? 'is-invalid' : '' }}" name="accom_id" id="accom_id" required>
                    @foreach($accoms as $id => $accom)
                        <option value="{{ $id }}" {{ old('accom_id') == $id ? 'selected' : '' }}>{{ $accom }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.accom_helper') }}</span>
            </div>
            <div class="row">                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="check_in">{{ trans('cruds.staycationBooking.fields.check_in') }}</label>
                        <input class="form-control {{ $errors->has('check_in') ? 'is-invalid' : '' }}" type="text" name="check_in" id="check_in" value="{{ old('check_in') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.staycationBooking.fields.check_in_helper') }}</span>
                    </div>
                </div>            
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="check_out">{{ trans('cruds.staycationBooking.fields.check_out') }}</label>
                        <input class="form-control {{ $errors->has('check_out') ? 'is-invalid' : '' }}" type="text" name="check_out" id="check_out" value="{{ old('check_out') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.staycationBooking.fields.check_out_helper') }}</span>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="hidden" name="duration" id="duration" value="{{ old('duration') }}" step="1">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.staycationBooking.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="1" step="1" min=1 oninput="validity.valid||(value='');">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="room_charge">{{ trans('cruds.staycationBooking.fields.room_charge') }}</label>
                <input class="form-control {{ $errors->has('room_charge') ? 'is-invalid' : '' }}" type="number" name="room_charge" id="room_charge" value="{{ old('room_charge') }}" step="0.01" readonly="readonly">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.room_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misc_charge">{{ trans('cruds.staycationBooking.fields.misc_charge') }}</label>
                <input class="form-control {{ $errors->has('misc_charge') ? 'is-invalid' : '' }}" type="number" name="misc_charge" id="misc_charge" min=0 disabled>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.misc_charge_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="total_charge" id="total_charge_label">{{ trans('cruds.staycationBooking.fields.total_charge') }}</label>
                <input class="form-control {{ $errors->has('total_charge') ? 'is-invalid' : '' }}" type="hidden" name="total_charge" id="total_charge" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.total_charge_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.staycationBooking.fields.package') }}</label>
                @foreach(App\StaycationBooking::PACKAGE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('package') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="package_{{ $key }}" name="package" value="{{ $key }}" {{ old('package', 'no') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="package_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.package_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.staycationBooking.fields.booking_status') }}</label>
                @foreach(App\StaycationBooking::BOOKING_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_status_{{ $key }}" name="booking_status" value="{{ $key }}" {{ old('booking_status', 'confirmed') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.staycationBooking.fields.booking_status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>
    var nowDate = new Date();
    var maxLimitDate = new Date(nowDate.getFullYear(), nowDate.getMonth() + 6, nowDate.getDate(), 0, 0, 0, 0);

    $(function() {
      $('input[name="check_in"],input[name="check_out"]').daterangepicker({
        locale: {
            format: 'M/DD/YYYY'
        },
        "autoApply": true,
        "minDate": new Date(),
        "maxDate": maxLimitDate,
        "opens": 'left',
        "autoUpdateInput": false
      }, function(start, end, label) {
        var selectedStartDate = start.format('M/DD/YYYY'); // selected start
        var selectedEndDate = end.format('M/DD/YYYY'); // selected end
                
        var startDate = moment(selectedStartDate,"M/DD/YYYY");
        var endDate = moment(selectedEndDate,"M/DD/YYYY");
       
        var checkinInput = $('input[name="check_in"]');
        var checkoutInput = $('input[name="check_out"]');

        var checkInPicker = checkinInput.data('daterangepicker');
        var checkOutPicker = checkoutInput.data('daterangepicker');  

        var stayDays = endDate.diff(startDate, 'days');
        if (stayDays == 0){
            stayDays = 1;
            checkoutInput.val(moment(endDate).add(1, 'days').format('M/D/YYYY'));
            checkOutPicker.setEndDate(moment(endDate).add(1, 'days'));
            checkInPicker.setEndDate(moment(endDate).add(1, 'days'));
        } else {
            checkoutInput.val(moment(endDate).format('M/D/YYYY'));
            checkOutPicker.setEndDate(endDate);
            checkInPicker.setEndDate(endDate);
        }
              
        $('input[name="duration"]').val(stayDays);
        checkinInput.val(moment(startDate).format('M/D/YYYY'));
        checkOutPicker.setStartDate(selectedStartDate);
        checkInPicker.setStartDate(selectedStartDate); 
      });
    });

    $("#accom_id").change(function() {
        var _price_list = {!! json_encode($price_list->toArray(), JSON_HEX_TAG) !!};
        var room_charge_price = _price_list[this.value];
        $("#room_charge").val(room_charge_price);
        $("#total_charge_label").text("Total Charge: ₱" + room_charge_price);
        $("#total_charge").val(room_charge_price);

        console.log("room charge on accom change");
        console.log($("#room_charge").val());

        console.log("total charge on accom change");
        console.log($("#total_charge").val());

        if(this.value > 0) {
            $("#misc_charge").prop( "disabled", false );
            $("#misc_charge").val(0);
        } else {
            $("#misc_charge").prop( "disabled", true );
            $("#misc_charge").val("");
        }
    });

    $("#misc_charge").on("propertychange change keyup paste input", function() { 
        if($("#misc_charge").val() == "") {
            $("#misc_charge").val(0);
        }
        var total = (parseFloat($("#room_charge").val()) + parseFloat($("#misc_charge").val())).toFixed(2);        
        $("#total_charge_label").text("Total Charge: ₱" + total);

        $("#total_charge").val(total);

        console.log("total charge on misc change");
        console.log($("#total_charge").val());
    });

    $("#misc_charge").click(function() {
        $(this).val("");
    });

    $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
    });

    $('form').on('blur', 'input[type=number]', function (e) {
        $(this).off('wheel.disableScroll')
    });

</script>

@endsection