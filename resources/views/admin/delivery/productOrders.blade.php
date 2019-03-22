@extends('layouts.admin')

@section('css')
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

        td {
            color: #3e5164;
        }

        select {
            border-width: 2px !important;
        }

        select option {
            background: rgba(0, 0, 0, 0.3) !important;
            color: #fff !important;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4) !important;
        }

        select option[value="in progress"] {
            background: #008080 !important;
        }

        select option[value="canceled"] {
            background: #FF6347 !important;
        }

        select option[value="confirmed"] {
            background: #5ac16f !important;
        }

        table tbody tr td {
            text-align: center !important;
        }

        #responsive_old_delivery_products {
            padding: 0;
        }

        #responsive_old_delivery_products tr {
            padding: 0 !important;
        }

        #responsive_old_delivery_products th {
            width: 4%;
        }


    </style>
@endsection



@section('page', 'Delivery Management')


@section('content')

    <h5 class="heading">New orders</h5>
    <p class="noOrders alert alert-info">There are no new orders.</p>
    <div id="new">
        <table class="no-footer" width="100%">
            <thead>
            <tr class="important">
                <th id="eye"></th>
                <th>ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADDRESS</th>
                <th>TOTAL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
            </tr>
            </thead>
            <tbody id="cont" class="test">
            </tbody>
        </table>
    </div>
    <div>
        <button type="button" class="btn btn-outline-info access btn-sm">Close/Open Other Orders</button>
    </div>
    {{--<i class="fas fa-minus"></i>--}}

    @if(isset($order) && count($order)>0)
        <div id="old">
            <h5 class="heading_old">Other Orders</h5>

            <table class="no-footer" width="100%">
                <thead>
                <tr class="important">
                    <th></th>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PHONE</th>
                    <th>ADDRESS</th>
                    <th>TOTAL</th>
                    <th>CREATED AT</th>
                    <th>CHANGE STATUS</th>
                </tr>
                </thead>
                <tbody id="old_cont">
                @foreach($order as $o)
                    {{--order part--}}
                    <tr data-id={{$o->id}}>
                        <td class="order-other-show" id="order-other-show-{{$o->id}}"><i class="fas fa-plus fa-lg"></i>
                        </td>
                        <td>{{$o->id}}</td>
                        <td>{{$o->name}}</td>
                        <td>{{$o->telephone}}</td>
                        <td>{{$o->address}}</td>
                        <td>{{$o->total}} AMD</td>
                        <td>{{$o->created_at}}</td>
                        <td>
                            <select class='form-control change_status' id="{{$o->id}}">
                                <option selected="true" disabled="disabled">Change Status</option>
                                <option value="in progress"{{$o->status =="in progress"?"selected":""}}>in progress
                                </option>
                                <option value="canceled" {{$o->status=="canceled"?"selected":""}}>canceled</option>
                                <option value="confirmed" {{$o->status=="confirmed"?"selected":""}}>confirmed
                                </option>
                            </select>
                        <td>
                    </tr>
                    {{--product part--}}
                    <tr id='product-other-info-{{$o->id}}' class="ordered_products">
                        <td colspan="12">
                            <div>
                                <table class="table-responsive" id="responsive_old_delivery_products">
                                    <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Avatar</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Count</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($order_list as $key => $products)
                                        @foreach( $products as $prod)
                                            @if($o->id === $key)
                                                <tr class="prod">
                                                    <td>{{$prod['id']}}</td>
                                                    <td>
                                                        <div style="margin-top:5px;">
                                                            <img src="{{$prod['avatar']}}"
                                                                 style="width:150px;height:auto;">
                                                        </div>
                                                    </td>
                                                    <td>{{$prod['name_en']}}</td>
                                                    <td>{{$prod['price']}} AMD</td>
                                                    <td>{{$prod['count']}}</td>
                                                    <td>{{$prod['total']}} AMD</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">Delivery Price: {{$o->delivery_price}} AMD AMD</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div>{{$order->links()}}</div>
        </div>
    @endif
    <audio id="pop" preload="auto">
        <source src="{{asset('audio/sound.mp3')}}" type="audio/mpeg">
    </audio>


@endsection

@section('js')
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
                success: (result) => {
                    //console.log(result);
                    $.each(result, (i, row) => {
                        let products = row.products.reduce((acc, product) => {
                            acc += `<tr class="prod">`;
                            acc += `<td>${product.id}</td>`;
                            acc += `<td> <div style="margin-top:5px;"><img src="${product.avatar}" style="width:150px;height:auto;"></div></td>`;
                            acc += `<td>${product.name_en}</td>`;
                            acc += `<td>${product.price} AMD</td>`;
                            acc += `<td>${product.count}</td>`;
                            acc += `<td>${product.total} AMD</td>`;
                            acc += `</tr>`;
                            return acc;
                        }, '');
                        $("#cont").append(
                            `<tr  class="order_info"  data-id="${row.order_info.id}">
                                <td id="order-show-${row.order_info.id}" class="order_show"><i class="fas fa-plus fa-lg"></i></td>
                                <td class="new" >${row.order_info.id}</td>
                                <td class="">${row.order_info.name}</td>
                                <td class="">${row.order_info.telephone}</td>
                                <td class="">${row.order_info.address}</td>
                                <td class="">${row.order_info.total} AMD</td>
                                <td class="">${row.order_info.created_at}</td>
                                <td>
                                    <select class='form-control choose_status'  id="${row.order_info.id}">
                                    <option selected="true" disabled="disabled">Choose Status</option>
                                    <option value="in progress">in progress</option>
                                    <option value="canceled">canceled</option>
                                    </select>
                                <td>
                            </tr>
                            <tr id='product-info-${row.order_info.id}'  class="ordered_products">
                                <td colspan="12">
                                <div>
                                 <table>
                                   <thead>
                                       <tr><th>Product Id</th><th>Product Avatar</th><th>Product Name</th><th>Product Price</th><th>Product Count</th><th>Total</th></tr>
                                   </thead>
                                    <tbody>${products}
                                    <tr>
                                   <td colspan="6">Delivery Price: ${row.order_info.delivery_price} AMD</td>
                                   </tr>
                                   </tbody>
                                  </table>
                                </div>
                                </td>
                            </tr >`
                        );
                        $("#pop")[0].play();

                    });
                    if ($("#cont").children().length != 0) {
                        $('.noOrders').css("display", "none");
                        $('.heading').css("display", "block");
                        $("#new").css("display", "block");
                    } else {
                        $('.noOrders').css("display", "block");
                    }
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
                    success: (result) => {
                        //console.log(result);
                        $.each(result, (i, row) => {
                            let products = row.products.reduce((acc, product) => {
                                acc += `<tr class="prod">`;
                                acc += `<td>${product.id}</td>`;
                                acc += `<td> <div style="margin-top:5px;"><img src="${product.avatar}" style="width:150px;height:auto;"></div></td>`;
                                acc += `<td>${product.name_en}</td>`;
                                acc += `<td>${product.price} AMD</td>`;
                                acc += `<td>${product.count}</td>`;
                                acc += `<td>${product.total} AMD</td>`;
                                acc += `</tr>`;
                                return acc;
                            }, '');
                            $("#cont").append(
                                `<tr  class="order_info"  data-id="${row.order_info.id}">
                                <td id="order-show-${row.order_info.id}" class="order_show"><i class="fas fa-plus fa-lg"></td>
                                <td class="new" >${row.order_info.id}</td>
                                <td class="">${row.order_info.name}</td>
                                <td class="">${row.order_info.telephone}</td>
                                <td class="">${row.order_info.address}</td>
                                <td class="">${row.order_info.total} AMD</td>
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
                                 <table>
                                   <thead>
                                       <tr><th>Product Id</th><th>Product Avatar</th><th>Product Name</th><th>Product Price</th><th>Product Count</th><th>Total</th></tr>
                                   </thead>
                                    <tbody>${products}
                                     <tr>
                                   <td colspan="6">Delivery Price: ${row.order_info.delivery_price} AMD</td>
                                   </tr>

                               </tbody>
                                  </table>
                                </div>
                                </td>
                            </tr >`
                            );
                            $("#pop")[0].play();
                        });
                        if ($("#cont").children().length != 0) {
                            $('.noOrders').css("display", "none");
                            $('.heading').css("display", "block");
                            $("#new").css("display", "block");
                        } else {
                            $('.noOrders').css("display", "block");
                        }
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
                    type: 'get',
                    data: {
                        status: selected,
                        id: id
                    },
                    success: function (resp) {
                        // alert(resp);
                        if (selected === "in progress") {
                            option.css("border", "2px solid #008080");
                        }
                        else if (selected === "confirmed") {
                            option.css("border", "2px solid #009360 ");
                        }
                        else {
                            option.css("border", "2px solid #FF6347 ");
                        }
                        // option.parent().parent().remove();
                    }
                })
                location.reload();
            });
            $(document).on('change', '.change_status', function () {
                // alert('test');
                let selected = $(this).val();
                let id = $(this).attr('id');
                console.log(selected, id);
                var option = $(this);
                $.ajax({
                    url: "{{ url('admin/setStatus') }}",
                    type: 'get',
                    data: {
                        status: selected,
                        id: id
                    },
                    success: function (resp) {
                        // alert(resp);
                        if (selected === "in progress") {
                            option.css("border", "2px solid #008080");
                        }
                        else if (selected === "confirmed") {
                            option.css("border", "2px solid #009360 ");
                        }
                        else {
                            option.css("border", "2px solid #FF6347 ");
                        }
                        // option.parent().parent().remove();
                    }
                })
            });
            var interval = 1000 * 60 * 0.2; // where X is your every X minutes
            setInterval(ajax_call, interval);
            $(document).on('click', ".order_show", function () {

                let id = $(this).parent().attr('data-id');
                $(`#product-info-${id}`).toggle(
                    'slow', function () {
                        if ($(this).is(':visible')) {
                            $(`#order-show-${id}`).children('i').attr('class', 'fas fa-minus fa-lg');
                        } else {
                            $(`#order-show-${id}`).children('i').attr('class', 'fas fa-plus fa-lg');
                        }
                    }
                );

            });
            $(document).on('click', ".order-other-show", function () {
                let id = $(this).parent().attr('data-id');
                console.log($(`#order-other-show-${id}`));
                $(`#product-other-info-${id}`).toggle(
                    'slow', function () {
                        if ($(this).is(':visible')) {
                            $(`#order-other-show-${id}`).children('i').attr('class', 'fas fa-minus fa-lg');
                        } else {
                            $(`#order-other-show-${id}`).children('i').attr('class', 'fas fa-plus fa-lg');
                        }
                    }
                );
            });
            if ($("#old_cont").children().length != 0) {
                $(document).on('click', ".access", function () {
                    $("#old").fadeToggle(200);
                });
            }
            else {
                $('.access').prop('disabled', true);
                $(".access").css("cursor", "not-allowed");
                $("#old").hide();
            }
        });
    </script>

@endsection