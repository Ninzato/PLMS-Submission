<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #report, #report * {
            visibility: visible;
            overflow: visible;
        }
        #report {
            position: absolute;
            left: 0;
            top: 0;
        }
        #print_table
        {
            width: 600px;
            margin:0 auto;
        }
    }
</style>
<div id="report">
<table id="print_table" style="width: 90%;margin: 0 auto">
    <tr>
        <td >
            <img style="width: 40%;margin:0 auto;height: 100px;margin-left: 200px;"
                 src="{!! URL::asset('images/bus.png') !!}">
        </td>
    </tr>
    <tr>
        <td>
            <p style="text-align: center"><?php echo $parking->company_name?></p>
            <p style="text-align: center"><?php echo $parking->address?></p>
        </td>
    </tr>
    <tr>
        <td>
            ------------------------------------------------------------------------------------------------------------
            <h3 style="text-align: center">PARKING RECEIPT</h3>
            ------------------------------------------------------------------------------------------------------------
        </td>
    </tr>
    <tr>
        <td>

            <h3 style="text-align: center">In: <?php echo $parking->time?></h3>
            <h3 style="text-align: center">Out: <?php echo date('h:i:s')?></h3>
            <?php $time_now = new DateTime(date('Y-m-d h:i:s'))?>
            <?php $time_in = strval($parking->date)." ".$parking->time?>
            <?php $duration = $time_now->diff(new DateTime($time_in))?>
            <h3 style="text-align: center">Duration: <?php echo $duration->i?> hours <?php echo $duration->s?> minutes</h3>
        </td>
    </tr>
    <tr>
        <td>

            <p style="text-align: center">
                <?php echo date('d-m-Y',strtotime($parking->date))?>
            </p>
            <p style="text-align: center">Space:
                <?php echo $parking->space?>
            </p>

        </td>
    </tr>
    <tr>
        <td>

            {{-- <h3 style="text-align: center">Paid: <?php echo number_format($parking->price,2)?></h3> --}}

            <?php $total_paid = $duration->i * 2?>
            <h3 style="text-align: center">Paid: RM<?php echo $total_paid?></h3>

        </td>
    </tr>
    <tr>
        <td>
            ------------------------------------------------------------------------------------------------------------
            <h3 style="text-align: center">THANK YOU AND DRIVE SAFETY!</h3>

        </td>
    </tr>
    <tr>
        <td>
            <img style="width: 100%;height: 80px;"
                 src="{!! URL::asset('images/barcode.png') !!}">
        </td>
    </tr>
</table>
</div>
