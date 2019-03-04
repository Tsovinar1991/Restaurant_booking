@extends('layouts.admin')

@section('css')
    <style>


    </style>
@endsection


@section('page', 'Gallery '.$category)
@section('content')


    @if(isset($images) && count($images)>0)
        <div class="col-md-12 d-flex justify-content-around mb-5 flex-wrap ">
         @foreach($images as $i)
            <!-- Grid column -->
                <div class="mb-3 pics animation all 2">
                    <div>
                        <img data-toggle="modal" data-target=".myModal" class="img-thumbnail gallery-image"
                             src="/storage/restaurant_images/{{$i->name}}" alt="Gallery Image">
                    </div>
                </div>
                <!-- Grid column -->

            @endforeach
        </div>
        <div>
        {{ $images->links() }}
        </div>
        <!-- Grid column -->
    @endif


    {{--gallery modal--}}
    <div class="myModal modal fade col-md-12" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="img-responsive w-100 gallery_modal_image"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('img').on('click', function () {
                var image = $(this).attr('src');
                $('.myModal').on('show.bs.modal', function () {
                    $(".img-responsive").attr("src", image);
                });
            });
        });
    </script>
@endsection