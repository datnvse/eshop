@extends('layouts.index')
@section('content')
  	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="">Trang chủ</a></li>
				<li class="active">Thanh toán</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			@if (count($errors) >0)
				@foreach ($errors->all() as $err)
					<div class="alert alert-danger">
						{{ $err }}   
					</div>
				@endforeach
			@endif
			@if (session('success'))
				<div class="alert alert-success" id="success">
					{{session('success')}}
				</div>
					
			@endif
			@if (session('danger'))
			<div class="alert alert-danger" id="danger">
					{{session('danger')}}
				</div>
			@endif
			<div class="row">
				<form id="checkout-form" class="clearfix" method="POST" action="checkout">
					<div class="col-md-6">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Chi tiết đơn hàng</h3>
              </div>
              @php
                $user = Auth::user();
              @endphp
							<div class="form-group">
									<input class="input" type="text" name="name" placeholder="Name" value="{{$user->name}}">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" value="{{$user->email}}">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address" value="{{$user->address}}">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Telephone" value="0{{$user->phone}}">
							</div>
							<div class="form-group">
								<textarea name="description" cols="84" rows="5" placeholder="Thêm thông tin cần thiết"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
                <h3 class="title">Đơn hàng</h3>
							</div>
                <h4>Mã đơn hàng: @php
                    $order_code = str_random(6);
                  echo $order_code;
                @endphp</h4>
								<input type="hidden" name="order_code" value="{{$order_code}}">
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th></th>
										<th class="text-center">Giá</th>
										<th class="text-center">Số Lượng</th>
										<th class="text-center">Thành tiền</th>
									</tr>
								</thead>
								<tbody>
                  @php
                      $subtotal = 0;
                  @endphp

                  @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                      @php
                        $subtotal += $details['quantity'] *$details['promotionprice'];
                      @endphp
                      <tr>
                        <td class="thumb"><img src="upload/images/{{$details['image']}}" alt=""></td>
                        <td class="details">
                          <a href="products/{{$id}}/show">{{$details['name']}}</a>
                        </td>
                        <td class="price text-center"><strong>{{$details['promotionprice']}} VNĐ</strong><br><del class="font-weak"><small>{{$details['price']}} VNĐ</small></del></td>
                        <td class="qty text-center"><input class="input quantity" type="number" value="{{$details['quantity']}}" readonly></td>
                        <td class="total text-center"><strong class="primary-color">${{$details['promotionprice'] * $details['quantity']}}</strong></td>
                      </tr>      
                    @endforeach
                  @endif
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Tổng tiền</th>
										<th colspan="2" class="total">{{$subtotal}} VNĐ</th>
									</tr>
								</tfoot>
							</table>
							<div class="pull-right">
								<button class="primary-btn" type="submit">Đặt hàng</button>
              </div>
              <div class="pull-left">
                  <a href="cart" class="primary-btn">Trở về giỏ hàng</a>
                </div>
						</div>

					</div>
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<input type="hidden" name="subtotal" value="{{$subtotal}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
@endsection