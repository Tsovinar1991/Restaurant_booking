@extends('voyager::master')

@section('css')

    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

        body{
            user-select: none;
        }

        .new:hover {
            /*background-color: #0081C9;*/
        }

        .mytable .order_show { cursor: pointer; }

        .ordered_products thead th, .ordered_products tbody td { text-align: center; }

        th { font-weight: bold !important; }
        .important th {
            background-color: #5f6e6f !important;
            color:white!important;
        }

        .ordered_products{ display:none; }


        .ordered_products table{ border:3px solid #587086; }

        .ordered_products thead th {
            padding: 10px;
            border-bottom:2px dashed #587086;
        }

        .ordered_products tbody td {
            padding: 10px;
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

@endsection

@section('content')

    <h1 class="page-title">DELIVERY ORDER MANAGEMENT</h1>
    <h4>New Orders</h4>
    <div>
        <table class="table table-condensed  table-hover mytable" style="border-collapse:collapse;">
            <thead>
            <tr class="important">
                <th></th>
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>TOTAL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
            </tr>
            </thead>
            <tbody id="cont">
            </tbody>
        </table>
    </div>

    <h4>Old Orders</h4>
    @if(isset($order))
        <table class="table table-hover  no-footer">
            <thead>
            <tr class="important">
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>TOTAL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $o)
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->name}}</td>
                    <td>{{$o->telephone}}</td>
                    <td>{{$o->address}}</td>
                    <td>{{$o->total}}</td>
                    <td>{{$o->created_at}}</td>
                    @if($o->status === "in progress")
                        <td style="background-color: #69a0b7; color:white; text-align:center">{{$o->status}}</td>
                    @elseif($o->status === "canceled")
                        <td style="background-color: #f19c9c; color:white; text-align:center">{{$o->status}}</td>
                    @else
                        <td style="background-color: #67c18f; color:white; text-align:center">{{$o->status}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $order->links() }}
        <audio id="pop" preload="auto">
            <source src="{{asset('audio/sound.wav')}}" type="audio/mpeg">
        </audio>

    @endif
@stop

@section('javascript')

    <script>
        $(document).ready(function () {

            jQuery.ajax({
                url: "{{ url('admin/getNewOrders') }}",
                method: 'get',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success:  (result) => {
                    console.log(result);

                    $.each(result,  (i, row) => {

                        let products = row.products.reduce((acc, product) => {

                            acc += `<tr style="margin-top:10px; margin-bottom:10px;">`;
                            acc += `<td>${product.id}</td>`;
                            acc += `<td> <div style="margin-top:5px;"><img src="/storage/${product.avatar}" style="width:150px;height:auto;"></div></td>`;
                            acc += `<td>${product.name}</td>`;
                            acc += `<td>${product.price}$</td>`;
                            acc += `<td>${product.count}</td>`;
                            acc += `<td>${product.total}$</td>`;
                            acc += `</tr>`;

                            return acc;
                        }, '')

                        $("#cont").append(
                            `<tr  class="order_info"  data-id="${row.order_info.id}">
                                <td class="order_show"><i class="fa fa-eye"></i></td>
                                <td class="new" >${row.order_info.id}</td>
                                <td class="">${row.order_info.name}</td>
                                <td class="">${row.order_info.telephone}</td>
                                <td class="">${row.order_info.address}</td>
                                <td class="">${row.order_info.total}$</td>
                                <td class="">${row.order_info.created_at}</td>
                                <td>
                                    <select class='form-control choose_status'  id="${row.order_info.id}">
                                    <option selected="true" disabled="disabled">Choose Status</option>
                                    <option>in progress</option>
                                    <option>canceled</option>
                                    </select>
                                <td>
                            </tr>

                            <tr id='product-info-${row.order_info.id}'  class="ordered_products">
                                <td colspan="12">
                                <div>
                                 <table width="80%" style="margin-left:10%; background-color: #e8e6e6;padding:5px;">
                                   <thead>
                                       <tr><th>Product Id</th><th>Product Avatar</th><th>Product Name</th><th>Product Price</th><th>Product Count</th><th>Total</th></tr>
                                   </thead>
                                    <tbody>${products}</tbody>
                                  </table>
                                </div>
                                </td>
                            </tr >`
                        );
                        $("#pop")[0].play();
                    });
                }
            });


            //setInterval

            var ajax_call = () => {
                var order_id = $('.new').last().text();
                jQuery.ajax({
                    url: "{{ url('admin/getNewOrders') }}",
                    method: 'get',
                    data: {o: order_id},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:  (result) => {
                        console.log(result);

                        $.each(result,  (i, row) => {

                            let products = row.products.reduce((acc, product) => {

                                acc += `<tr style="margin-top:10px; margin-bottom:10px;">`;
                                acc += `<td>${product.id}</td>`;
                                acc += `<td> <div style="margin-top:5px;"><img src="/storage/${product.avatar}" style="width:150px;height:auto;"></div></td>`;
                                acc += `<td>${product.name}</td>`;
                                acc += `<td>${product.price}$</td>`;
                                acc += `<td>${product.count}</td>`;
                                acc += `<td>${product.total}$</td>`;
                                acc += `</tr>`;
                                return acc;
                            }, '')

                            $("#cont").append(
                                `<tr  class="order_info"  data-id="${row.order_info.id}">
                                <td class="order_show"><i class="fa fa-eye"></i></td>
                                <td class="new" >${row.order_info.id}</td>
                                <td class="">${row.order_info.name}</td>
                                <td class="">${row.order_info.telephone}</td>
                                <td class="">${row.order_info.address}</td>
                                <td class="">${row.order_info.total}$</td>
                                <td class="">${row.order_info.created_at}</td>
                                <td>
                                    <select class='form-control choose_status'  id="${row.order_info.id}">
                                    <option selected="true" disabled="disabled">Choose Status</option>
                                    <option>in progress</option>
                                    <option>canceled</option>
                                    </select>
                                <td>
                            </tr>

                            <tr id='product-info-${row.order_info.id}'  class="ordered_products">
                                <td colspan="12">
                                <div>
                                 <table width="80%" style="margin-left:10%; background-color: #e8e6e6;padding:5px;">
                                   <thead>
                                       <tr><th>Product Id</th><th>Product Avatar</th><th>Product Name</th><th>Product Price</th><th>Product Count</th><th>Total</th></tr>
                                   </thead>
                                    <tbody>${products}</tbody>
                                  </table>
                                </div>
                                </td>
                            </tr >`
                            );
                            $("#pop")[0].play();
                        });
                    }
                });
            };


            $(document).on('change', '.choose_status', function () {
                let selected = $(this).val();
                let id = $(this).attr('id');
                console.log(selected, id);
                var option = $(this);

                $.ajax({
                    url: "{{ url('admin/setStatus') }}",
                    type: 'post',
                    data: {
                        status: selected,
                        id: id
                    },
                    success: function (resp) {
                        alert(resp);

                        if (selected === "in progress") {
                            option.css("border-color", "#69a0b7");

                        }
                        else {
                            option.css("border-color", "#f19c9c");

                        }
                        // option.parent().parent().remove();

                    }
                })
            });



            var interval = 1000 * 60 * 0.2; // where X is your every X minutes
            setInterval(ajax_call, interval);


            $(document).on('click', ".order_show", function () {
                let id = $(this).parent().attr('data-id');
                $(`#product-info-${id}`).fadeToggle(200);
            })

        });

    </script>


@endsection