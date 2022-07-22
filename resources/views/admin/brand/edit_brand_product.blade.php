@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                	<?php 
                        $message = Session::get('message');
                        if($message){
                            echo '<div class="alert alert-success">
                          <strong>Thông báo:</strong> '.$message.'
                        </div>';
                            Session::put('message', null);
                        }
                    ?>
                    @foreach($edit_brand_product as $key => $edit_value)
                    <div class="position-center">
                    	
                        <form role="form" method="post" action="{{(URL::to('/update-brand-product/'.$edit_value->brand_id))}}">
                        	{{csrf_field()}}
                        <div class="form-group">
                            <label for="brand-product-name">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="brand-product-name" placeholder="Nhập tên thương hiệu..." name="brand_product_name" value="{{$edit_value->brand_name}}">
                        </div>
                        <div class="form-group">
                        	<label for="brand-product-desc">Mô tả thương hiệu</label>
                        	<textarea style="resize: none;" rows="5" class="form-control" id="brand-product-desc" placeholder="Nhập mô tả thương hiệu..." name="brand_product_desc">{{$edit_value->brand_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị?</label>
                            <select class="form-control input-sm m-bot15" name="brand_product_status">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-info" name="update_brand_product">Cập nhật thương hiệu</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
</div>
@endsection