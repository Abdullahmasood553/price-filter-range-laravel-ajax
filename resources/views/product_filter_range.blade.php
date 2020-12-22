@php
    $minimum_range = 0;
    $maximum_range = 50;
@endphp

@extends('layouts.master')

@section('content')
    <div class="container">
        <h3 class="text-center">
                Price Range in laravel    
        </h3>  
        <div class="col-md-2">
            <input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range ?>">
        </div>


        <div class="col-md-8">
            <div id="price_range"></div>
        </div>

        <div class="col-md-2">
            <input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range ?>">
        </div>

        <div class="card-lists">
   
            <div class="row" id="load_data">
              
            </div>
        </div>
    </div>
@endsection


@push('scripts')

<script>  
    $(document).ready(function(){  
        
        $("#price_range").slider({
		range: true,
		min: 0,
		max: 50,
		values: [ {{ $minimum_range }}, {{ $maximum_range }} ],
		slide:function(event, ui){
      
		$("#minimum_range").val(ui.values[0]);
		$("#maximum_range").val(ui.values[1]);
			load_product(ui.values[0], ui.values[1]);
		}
    });
    
    load_product({{ $minimum_range }}, {{ $maximum_range }});
        
        function load_product(minimum_range, maximum_range)
        {
            $.ajax({
                url:"{{ route('filter_product') }}",
                method:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                     minimum_range:minimum_range,
                     maximum_range:maximum_range
                    },
                success:function(data)
                {
                    $('#load_data').fadeIn('slow').html(data);
                }
            });
        }
        
    });  
    </script>
@endpush



