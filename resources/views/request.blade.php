@extends('layouts.main_layout')

@section('content')


	<div class="container">
		@foreach($baskets as $basket)
		
			@if($basket->product->user->id == Auth::user()->id)	
				@if($basket->status)					
					<div class="row">
						<div class="pull-left col-md-6">
							
							<h3>{{ $basket->user->name  }} {{ $basket->user->surname  }} adlı istifadəçi {{ $basket->count }} {{ $basket->product->constant->title }} {{ $basket->product->title }} almaq istəyir</h3>
							<img src="uploads/{{ $basket->product->image }}" alt="{{ $basket->product->title }}" style="width:50%">
						</div>
						<div class=" pull-right col-md-6">
							<h3>Toplam qazanc : {{ $basket->count * $basket->price }} AZN</h3>
							<a href="/accept_request/{{ $basket->id }}" class="btn btn-success">QƏBUL ET</a>
							<a href="/reject_request/{{ $basket->id }}" class="btn btn-warning">QƏBUL ETMƏ</a>
						</div>
					</div>
					<hr>
				@endif
				@else 
				<div class="row	">
					<h1>Size her hansi bir teklif gelmiyib</h1>
				</div>
			@endif
		@endforeach
	</div>

@stop