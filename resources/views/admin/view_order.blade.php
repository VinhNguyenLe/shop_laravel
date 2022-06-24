@extends('admin_layout')
@section('admin_content')
{{-- Thông tin khách đặt hàng --}}
   @foreach ($order_by_id as $key => $order_value)
   <div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
		  Người dùng đặt hàng
		</div>
		<div class="row w3-res-tb">
			<div class="col-sm-5 m-b-xs">
				
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<div class="alert alert-success">
									  <strong>Thông báo:</strong> ' .
					$message .
					'
									</div>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th>Người dùng</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$order_value->customer_name}}</td>
						<td>{{$order_value->customer_phone}}</td>
						<td>{{$order_value->customer_email}}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
<br />

{{-- Thông tin vận chuyển --}}
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Thông tin người nhận hàng 
		</div>
		<div class="row w3-res-tb">
			<div class="col-sm-5 m-b-xs">
				
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<div class="alert alert-success">
									  <strong>Thông báo:</strong> ' .
					$message .
					'
									</div>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th>Người nhận hàng</th>
						<th>Địa chỉ nhận hàng</th>
						<th>Số điện thoại</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$order_value->shipping_name}}</td>
						<td>{{$order_value->shipping_address}}</td>
						<td>{{$order_value->shipping_phone}}</td>

					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
<br />
{{-- Đơn hàng --}}
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			Đơn hàng
		</div>
		<div class="row w3-res-tb">
			<div class="col-sm-5 m-b-xs">
				
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<div class="table-responsive">
			<?php
			$message = Session::get('message');
			if ($message) {
				echo '<div class="alert alert-success">
									  <strong>Thông báo:</strong> ' .
					$message .
					'
									</div>';
				Session::put('message', null);
			}
			?>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá</th>
						<th>Tổng tiền (Bao gồm thuế)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$order_value->product_name}}</td>
						<td>{{$order_value->product_sales_quantity}}</td>
						<td>{{number_format($order_value->product_price, 0, ',', '.')}} VNĐ</td>
						<td ><span class="customer-total-money">{{$order_value->order_total}}</span> VNĐ</td>
						
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
<br />
   @endforeach
   
@endsection
