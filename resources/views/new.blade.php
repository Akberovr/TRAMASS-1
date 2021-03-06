@extends('layouts.main_layout')

@section('content')


<section id="new_product">

		<div class="row">
			<div class="col-md-6 leftPart">
				<div>
					@if(Session::has('product_name'))
					<img src="uploads/{{Session::get('product_image')}}" alt="">
						@else
							<img src="" alt="">
					@endif

				</div>
			</div>
			<div class="col-md-6 rightPart">
				@if(Session::has('product_name'))
				<p><span class="new_product_name" >{{Session::get('product_name')}}</span> baskete elave olundu</p>
					@else
					<p><span class="new_product_name" ></span> baskete elave olundu</p>
				@endif


			</div>
		</div>
</section>






<section>
	<div class="container-fluid">
		<div class="product_intro">
			<h1>Shop All Products</h1>
		</div>
	</div>
</section>

<div id="left_side_filter">
	<div class="nav-search">
		<div class="">
			<h3>FILTER BY PRICE</h3>
		</div>
	</div>
	<div class="product_category">
		<h3>
			PRODUCT CATEGORIES
		</h3>
		<ul>
			@foreach($product_categories as $product_category)
			<li>
				<span class="product_count_in_category">
					{{ count($product_category->products) }}
				</span>
				<a href="/products/{{$product_category->id}}">{{ $product_category->title }}</a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="active-nav">
		<i class="fa fa-caret-left" aria-hidden="true"></i>
	</div>
</div>
<section id="products">

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="hidden">
				<ul class="nav navbar-nav">
					<li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Default Sorting
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          	<li><a href="#">Default Sorting</a></li>
				          	<li><a href="#">Default Sorting</a></li>
				          	<li><a href="#">Default Sorting</a></li>
				          	<li><a href="#">Lorem ipsum dolor sit </a></li>
				          	<li><a href="#">Lorem ipsum dolor Sorting </a></li>
				        </ul>
				  	</li>
			    </ul>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs leftPage">
				<h4>
					FILTER BY PRICE
				</h4>
				<div class="filter-slider"></div><br>
				<form action="/products" method="get">
					{{ csrf_field() }}
					Qiymet Araligi : <input type="text" name="price_range_from" class="price_range"><br>
					<input type="submit" name="price_filter" class="price_filter" value="FILTER">
					- <input type="text" name="price_range_to" class="price_range">
				</form>

				<hr>
				<div class="hidden-sm hidden-xs product_category">
					<h3>
						PRODUCT CATEGORIES
					</h3>
					<ul>
						@foreach($product_categories as $product_category)
						<li>
							<span class="product_count_in_category">
								{{ count($product_category->products) }}
							</span>
							<a href="/products/{{$product_category->id}}">{{ $product_category->title }}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-10 col-sm-12 col-xs-12 rightPage">
				@if(!count($products))
					<h1>No product was found</h1>
				@endif

					@foreach($products as $product)
						<div class="product">
							<span class="product_id hidden">{{  $product->id }}</span>
							<div class="row product_top">
								<div>
									<a href="/product_single/{{  $product->id }}"> <img  src="/uploads/{{ $product->image }}" alt="{{ $product->title }}"></a>
								</div>
								<div class="quick_view_little">
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span id="quick_view_{{$product->id}}">Quick view</span>
								</div>
								{{-- <div class="date_of_product">
									<span><br></span>
								</div> --}}
							</div>
							<div class="row product_bottom">
								<span>
								 	{{ $product->title }}
								</span><br>
								<span class="price">
									<span>{{ $product->price +25 }} AZN </span> {{ $product->price }} AZN
								</span>

								<div>
									@if(Auth::guest())

										@else
											@if(Auth::user()->type != 1)
											<span>
												<a class="addCart" href="/add_to_basket/{{ $product->id }}">ADD TO CART</a>
												<a class="viewCart hidden" href="/basket">VIEW CART</a>
											</span>
											@else
												<span>Siz sadece saticisiniz</span>
											@endif

									@endif
								</div>
							</div>
						</div>
					@endforeach

			</div>
		</div>
	</div>
</section>
<div class="background_filter"></div>
<section id="quick_view">

	@foreach($products as $product)
			<div id="product_single_quick_view_{{ $product->id }}" class="product_single_quick_view  hidden-sm hidden-xs ">

				<div class="col-md-6 product_single_quick_view_left">

					<div>
						<img  src="/uploads/{{ $product->image }}" alt="{{ $product->title }}">
					</div>
				</div>
				<div class="col-md-6 product_single_quick_view_right">
					<i class="fa fa-times" aria-hidden="true"></i>
					<div class="row">
						<h1>{{ $product->title }}</h1>
					</div>
					<div class="row">
						<span>{{ $product->price }} AZN </span><br>
						<p>{{ $product->description }}</p>
					</div>
					<form action="/addingBasket" method="post">
					{{ csrf_field() }}
						<div class="row">
							<input type="hidden" name="product_id" value="{{$product->id}}">
							<input type="number" name="count" min="1" value="1" max="{{ $product->count }}">
							<span>{{ $product->constant->title }}</span>
						</div>

						<div class="row">
						@if(Auth::guest())
							<button  type="submit" name="submit"><a href="/login">ADD TO CART</a></button>
							@else
								@if(Auth::user()->type != 1)
									<button  type="submit" name="submit">ADD TO CART</button>
								@else
									<span style="color:white">SIZ SADECE SATICISINIZ</span>
								@endif
						@endif

						</div>
					</form>

					</div>
				</div>
				<span class="product_id hidden">{{  $product->id }}</span>

	@endforeach

</section>





@stop

@section('script')


<script>
	$(document).ready(function(){


		var _token = $('input[name=_token]')
		var addCartIsClicked = false;;

		$('.addCart').click(function(event){
			event.preventDefault();
			product = $(this).parent().parent().parent().parent();
			product_id = product.find($('.product_id'))
			$this = $(this);
			$.ajax({
				async:true,
				url:'/addingBasket',
				method:'POST',
				dataType:'JSON',
				data:{
					_token:_token.val(),
					product_id:product_id.text(),
				},
				success:function(data)
				{
					$('#new_product').fadeIn();
					$('#new_product .leftPart img').attr('src','uploads/'+data[1].image+'')
					$('.new_product_name').text(data[1].title)
					setTimeout(function(){
						$('#new_product').fadeOut();
					},5000)
					$this.addClass('hidden');
					$this.siblings('.viewCart').removeClass('hidden');
					addCartIsClicked = true;
					basket_count = parseInt($('.fa-cart-plus span').text())
					basket_count += 1;
					$('.fa-cart-plus span').text(basket_count)
				}
			})
		})

		@if(Session::has('product_name'))
			$('#new_product').fadeIn();
			setTimeout(function(){
				$('#new_product').fadeOut();
			},5000)
		@endif


		$('.product_category ul li').hover(function(){
			$(this).find('.product_count_in_category').css({
				border:'1px solid #388E3C',
				backgroundColor:'white'
			})
		},function(){
			$(this).find('.product_count_in_category').css({
				border:'1px solid #F5F5F5',
				backgroundColor:'#F5F5F5'
			});
		});


		$('.price_filter').click(function(event){
			event.preventDefault();
			$.ajax({
				url : '/products',
				type:'POST',
				data:{
					price_range_from:parseInt(price_range_from.val()),
					price_range_to:parseInt(price_range_to.val()),
					_token: _token.val()
				},
				success:function(data)
				{
					$('body').html(data)
				},
				error : function()
				{
					console.log('There is something wrong')
				}
			})
		});


		$('.background_filter').css({
			height : $(window).height()
		})
		// $(window).resize(function() {
	 //  		$('.background_filter').css({
		// 		height : $(window).height()
		// 	})
		// 	if($(window).width() < 780)
		// 	{
		// 		$('.product').css({
		// 			width : $(window).width()/2.5
		// 		});
		// 		isLessThanScreen = true;
		// 	} else {
		// 		$('.product').css({
		// 			width : '170px'
		// 		});
		// 		isLessThanScreen = false;
		// 	}
		// });
		// if($(window).width() < 780)
		// {
		// 	$('.product').css({
		// 		width : $(window).width()/2.5
		// 	});
		// 	isLessThanScreen = true;
		// } else {
		// 	$('.product').css({
		// 		width : '170px'
		// 	});
		// 	isLessThanScreen = false;
		// }




		$('.product').hover(function(){
			$(this).find('.quick_view_little').css({
				'opacity':1
			});
			@if(!Auth::guest())
			$(this).find('.product_bottom span:nth-child(3)').css({
				"transform" : "translateY(-20px)",
				'opacity' : 0
			})

			$(this).find(".product_bottom div").css({
				"transform" : "translateY(-20px)",
				'opacity' : 1
			})
			@endif
		}, function(){
			$(this).find('.quick_view_little').css({
				'opacity':0
			});
			$(this).find('.product_bottom span:nth-child(3)').css({
				"transform" : "translateY(0px)",
				'opacity' : 1
			})
			$(this).find('.product_bottom div').css({
				"transform" : "translateY(0px)",
				'opacity' : 0
			})

		});

		@foreach($products as $product)
		$('#product_single_quick_view_{{ $product->id }}').fadeOut();
		$('.background_filter').fadeOut(400,function(){
				$(this).css({
					zIndex:'-2'
				})
			});
		$('#quick_view_{{$product->id}}').click(function(){
			$('.background_filter').fadeIn(400,function(){
				$(this).css({
					zIndex:'2'
				})
			});
			$('#product_single_quick_view_{{ $product->id }}').fadeIn();
		})
		@endforeach


		function exit()
		{
			$('.fa-times').click(function(){
				$('.background_filter').fadeOut();
				$('.product_single_quick_view').fadeOut()
			});

			$(document).keyup(function(e) {
				if (e.keyCode === 27)   $('.fa-times').click();
			});
		}
		exit()



		$('.fa-times').click(function(){
			$('.background_filter').fadeOut();
			$('.product_single_quick_view').fadeOut()
		});

		$(document).keyup(function(e) {
			if (e.keyCode === 27)   $('.fa-times').click();
		});


		$('.active-nav').click(function(){
			$('#left_side_filter').css({
				transform : 'translateX(0px)'
			});
			$(this).css({
				opacity:0
			});

			$('section:not(#left_side_filter)').css({
				transition:'all 0.4s ease',
				transform : 'translateX(275px)'
			})
		})

		// $('section:not(#left_side_filter)').click(function(){
		// 	$('#left_side_filter').css({
		// 		transform : 'translateX(-275px)'
		// 	});
		// 	$('section:not(#left_side_filter)').css({
		// 		transform : 'translateX(0px)'
		// 	});



		// $('section:not(#left_side_filter)').click(function(){
		// 	// $('#left_side_filter').css({
		// 	// 	transform : 'translateX(-275px)'
		// 	// });
		// 	// $('section:not(#left_side_filter)').css({
		// 	// 	transform : 'translateX(0px)'
		// 	// });

		// 	if(isLessThanScreen)
		// 	{
		// 		$('.active-nav').css({
		// 				opacity:1

		// 		});
		// 		});

		// 	}
		// });




		var isLessThanScreen,
	 	slider = $('.filter-slider'),
		price_range_from = $('input[name=price_range_from]'),
		price_range_to = $('input[name=price_range_to]')
		$(function(){
			slider.slider({
				max:250,
				min:1,
				values : [25,225],
				step:1,
				range:true,
				slide:updateBackground
			})
			function updateBackground(e,ui)
			{
				price_range_from.val(ui.values[0] + ' AZN')
				price_range_to.val(ui.values[1]+ ' AZN')
			}
		})




	})


</script>

@stop
