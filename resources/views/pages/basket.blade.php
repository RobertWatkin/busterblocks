@extends('layouts.app')

@section('content')
<h1 class="float-left text-light">Basket</h1>
<table class="table table-dark">
    <thead>
        <tr class='row bg-dark'>
            <th class='col-sm-2'>Image</th>
            <th class='col-sm-4'>Name</th>
            <th class='col-sm-3'>Quantity</th>
            <th class='col-sm-2'>Price</th>
            <th class='col-sm-1'></th> 
        </tr>
    <thead>
    <tbody>

    @if($basket)
        @if(count($basket) > 0)
            @foreach ($basket as $product)
            @if (is_float($product))
                @php continue; @endphp
            @endif
            <tr class='row bg-dark'>
                <td class='col-sm-2'>
                    <img src="storage/cover_images/{{$product['cover_image']}}" class="img img-thumbnail"/>
                </td>
                <td class='col-sm-4'><a href="/products/{{$product['productId']}}" class="text-light">{{$product['name']}}</td>
                <td class='col-sm-3'>{!! Form::number("quantity", $product['quantity'], ["class" => "quantity col-sm-3", "data-id" => $product["productId"],"step" => "1", "placeholder" => $product['quantity'], "min" => "0"]) !!}</td>
                <td class='col-sm-1'>£{{$product['price'] * $product['quantity']}}</td>
                <td class='col-sm-2'>
                    <a href="#" class="btn btn-danger ml-0">Remove</a>
                </td>
            </tr>

            @endforeach
            <tr class="row bg-dark">
                <td class="col-sm-8"></td>
                <td class="col-sm-1">Total :</td>
                <td class="col-sm-1">£{{$basket['total']}}</td>
                <td class="col-sm-2"></td>
            </tr>
        @else
        
            <tr class="row">
                <td class="col-sm-12 text-center">
                    <h2>There are no products in your basket.</h2>
                </td>
            </tr>
        @endif
    @else
        <tr class="row bg-dark">
            <td class="col-sm-12 text-center">
                <h2>There are no products in your basket.</h2>
            </td>
        </tr>
    @endif
    </tbody>
</table>
<a href="/products/order-details" class="btn btn-success">Checkout</a>

{{-- This section handles the Ajax request for dynamic quantity updates - using axios --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    (function(){
        const classname = document.querySelectorAll('.quantity');

        Array.from(classname).forEach(function(element){
            element.addEventListener('change', function(){
                const id = element.getAttribute('data-id');

                axios.patch(`/basket/${id}`, {
                    quantity: this.value
                })
                .then(function (response) {
                    console.log(response);
                    window.location.href = '{{ route('basket.index') }}';
                })
                .catch(function (error) {
                    console.log(error);
                });
            })
        })
    })();
</script>
@endsection('content')

