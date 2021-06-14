<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parking Ticket</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
<a href="{{ __('dashboard') }}">Home</a>

<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header bg-primary">
                <p>Receipt</p>
            </div>
            <div class="card-body">

                <div id="print_receipt_area">

                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header bg-primary">
                <p></p>
            </div>
            <div class="card-body">

                <form id="print_receipt_save">
                    {{csrf_field()}}

                    <table style="width: 60%;margin: 0 auto">
                        <tr>
                        <tr>
                            <td>Company Name</td>
                            <td>
                               <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name">
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                            </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>
                                <input type="text" class="form-control" name="date" id="date" value="<?php echo date('d-m-Y')?>" placeholder="Enter Date">
                            </td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>
                                <input readonly type="text" class="form-control" name="time" id="time" value="<?php echo date('h:i:s')?>" placeholder="Enter Time">
                            </td>
                        </tr>

                        <tr>
                            <td>
                               Space
                            </td>
                            <td>
                                <?php
                                $next_parking_slot= DB::table('parking')->count();

                                $next_parking_slot =str_pad($next_parking_slot + 1, 5, '0', STR_PAD_LEFT);
                                ?>
                                <input type="text" readonly class="form-control"
                                       name="space" value="<?php echo $next_parking_slot?>" id="space">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Price
                            </td>
                            <td>
                                <input type="number"  placeholder="Enter Price"  class="form-control"
                                       name="price" id="price">
                            </td>
                        </tr>

                        <tr>

                            <td>
                                <input id="slot_booking_save_button" type="button" value="Print Receipt"
                                       onclick="print_receipt_save()"
                                       class="btn btn-success">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
    </div>

</div>

<script>

    function print_receipt_save() {
        $('#slot_booking_save_button').prop("disabled", true);
        var company_name = $('#company_name').val();
        var address = $('#address').val();
        var date = $('#date').val();
        var time = $('#time').val();
        var space = $('#space').val();
        var price = $('#price').val();
        if (company_name == '') {
            $('#slot_booking_save_button').prop("disabled", false);
            alert('Please Enter Company Name!');
            $('#company_name').focus();
        } else if (address == '') {
            $('#slot_booking_save_button').prop("disabled", false);
            alert('Please Enter Address!');
            $('#address').focus();
        } else if (date == '') {
            $('#slot_booking_save_button').prop("disabled", false);
            alert('Please Enter Date!');
            $('#date').focus();
        } else if (time == '') {
            $('#slot_booking_save_button').prop("disabled", false);
            alert('Please Enter Time!');
            $('#time').focus();
        } else if (price == '') {
            $('#slot_booking_save_button').prop("disabled", false);
            alert('Please Enter price!');
            $('#price').focus();
        }
        else {
            var formData = new FormData(document.getElementById('print_receipt_save'));
            $.ajax({
                type: "POST",
                url: '{{ __('dashboard') }}',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    $('#slot_booking_save_button').prop("disabled", false);
                    $('#company_name').val('');
                    $('#price').val('');
                    $('#address').val('');
                    document.getElementById("print_receipt_area").innerHTML = result;

            }
        }
    );
    }

    }

</script>
</body>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
