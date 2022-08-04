<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Customer;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Coupon;

use App\Product;
use App\Brand;
use App\CategoryProduct;
use App\Statistical;
use Carbon\Carbon;

use PDF;

class OrderController extends Controller
{
    public function manager_order(){
        
        $order = Order::orderby('created_at', 'DESC')->get();
        $customer = Customer::orderby('customer_id', 'DESC')->get();
        

        return view('admin.order.manager_order')->with(compact('order', 'customer'));
    }

    public function view_order($order_code){
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();

        foreach($order as $key => $ord){ 
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
        }
        
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach($order_details_product as $key => $order_d){
			$product_coupon = $order_d->product_coupon;
		}
        
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}

        return view('admin.order.view_order')
		->with(compact('order_details', 'customer', 'shipping', 'order_details_product','coupon_condition','coupon_number', 'order', 'order_status'));
        
    }

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

	public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	
	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();

		$order_date = $order->order_date;
		$statistical = Statistical::where('order_date', $order_date)->get();

		// if($statistical){
		// 	$statistical_count = $statistical->count();
		// } else {
		// 	$statistical_count = 0;
		// }

		if($order->order_status==2){
			// $total_order = 0;
			// $sales = 0;
			// $profit = 0;
			// $quantity = 0;

			foreach($data['order_product_id'] as $key => $product_id){
 				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;

				$product_cost = $product->product_cost;
				$product_price = $product->product_price;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				foreach($data['quantity'] as $key2 => $qty){
					if($key == $key2){
						$pro_remain = $product_quantity - $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold + $qty;
						$product->save();

						// $quantity += $qty;
						// $total_order += 1;
						// $sales += $product_price * $qty;
						// $profit += ($product_price * $qty) - ($product_cost * $qty);
						
					}
				}
			}
			// if($statistical_count > 0){
			// 	$statistical_update = Statistical::where('order_date', $order_date)->first();
			// 	$statistical_update->sales = $statistical_update->sales + $sales;
			// 	$statistical_update->profit = $statistical_update->profit + $profit;
			// 	$statistical_update->quantity = $statistical_update->quantity + $quantity;
			// 	$statistical_update->total_order = $statistical_update->total_order + $total_order;
			// 	$statistical_update->save();
			// } else {
			// 	$statistical_new = new Statistical();
			// 	$statistical_new->order_date = $order_date;
			// 	$statistical_new->sales = $sales;
			// 	$statistical_new->profit = $profit;
			// 	$statistical_new->quantity = $quantity;
			// 	$statistical_new->total_order = $total_order;
			// 	$statistical_new->save();
			// }
		} elseif ($order->order_status!=2 && $order->order_status!=3){
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
					if($key==$key2){
						$pro_remain = $product_quantity + $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold - $qty;
						$product->save();
					}
				}
			}
		}
	}

    public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: Dejavu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}

        .table-styling th{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
		</style>
		<h4><center>Cửa hàng điện thoại MobileShop</center></h4>
		<p>Mã đơn hàng: '.$checkout_code.'</p>
		<p>Người đặt hàng</p>
		<table class="styled-table">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';

		$output.='				
				</tbody>
			
		</table>

		<p>Người nhận hàng</p>
			<table class="styled-table">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Số điện thoại</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>';
						if($shipping->shipping_notes == 'Ghi chú...'){
							$notes = 'Không';
						} else {
							$notes = $shipping->shipping_notes;
						}
						$output .= '<td>'.$notes.'</td>
						
					</tr>';
				
		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="styled-table">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không mã';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}
	
		$output.='				
				</tbody>
			
		</table>';

       
        $output .= '<p>Tổng thanh toán</p>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Chi phí giảm</th>
                            <th>Phí vận chuyển</th>
                            <th>Thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$coupon_echo.' VNĐ</td>
                            <td>'.number_format($product->product_feeship,0,',','.').' VNĐ'.'</td>
                            <td> '.number_format($total_coupon + $product->product_feeship,0,',','.').' VNĐ'.'</td>

                        </tr>
                    </tbody>
                </table>
        ';

		$output .= '<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';
       


		return $output;

	}

	public function history(){
		$brand = Brand::where('brand_status', '1')->orderby('brand_id', 'asc')->get();
		$brand_data = array();
		$brand_data_id = array();
		$brand = Brand::all();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}

		$category = CategoryProduct::where('category_status', '1')->orderby('category_id', 'asc')->get();
		$get_customer = Session::get('customer_id');
		if(!$get_customer){
			return redirect('/login-checkout')->with('message', 'Vui lòng đăng nhập để xem lịch sử!');
		} else {
			$order = Order::where('customer_id', $get_customer)->orderby('order_id', 'DESC')->get();
			return view('pages.history.history')->with(compact('order', 'category', 'brand', 'brand_data', 'brand_data_id'));
			
		}
	}

	public function view_history($order_code){
		$category = CategoryProduct::where('category_status', '1')->orderby('category_id', 'asc')->get();
		
		$brand = Brand::where('brand_status', '1')->orderby('brand_id', 'asc')->get();
		$brand_data = array();
		$brand_data_id = array();
		$brand = Brand::all();
		foreach ($brand as $key => $br) {
			array_push($brand_data, $br->brand_name);
			array_push($brand_data_id, $br->brand_id);
		}


		$get_customer = Session::get('customer_id');
		$own_order = Order::where('order_code', $order_code)->first();
		if(!$get_customer){
			return redirect('/login-checkout')->with('message', 'Vui lòng đăng nhập để xem lịch sử!');
		} 
		elseif($get_customer != $own_order->customer_id) {
			return redirect('/')->with('alert', 'Bạn chỉ có thể xem lịch sử đơn hàng của mình!');
		}
		else {
			$getorder = Order::where('customer_id', $get_customer)->orderby('order_id', 'DESC')->get();
				$order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
			$order = Order::where('order_code', $order_code)->get();

			foreach($order as $key => $ord){ 
				$customer_id = $ord->customer_id;
				$shipping_id = $ord->shipping_id;
				$order_status = $ord->order_status;
			}
			
			$customer = Customer::where('customer_id', $customer_id)->first();
			$shipping = Shipping::where('shipping_id', $shipping_id)->first();

			$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

			foreach($order_details_product as $key => $order_d){
				$product_coupon = $order_d->product_coupon;
			}
			
			if($product_coupon != 'no'){
				$coupon = Coupon::where('coupon_code',$product_coupon)->first();
				$coupon_condition = $coupon->coupon_condition;
				$coupon_number = $coupon->coupon_number;
			}else{
				$coupon_condition = 2;
				$coupon_number = 0;
			}

			return view('pages.history.history_details')
			->with(compact('category', 'brand', 'brand_data', 'brand_data_id',  'order_details', 'customer', 'shipping', 'order_details_product','coupon_condition','coupon_number', 'order', 'order_status'));
		}
	}
}