@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bình luận của khách hàng
            </div>
            <div class="row w3-res-tb">

            </div>
            <div class="table-responsive">
                <?php
                $reply_cmt = Session::get('reply_cmt');
                $error = Session::get('error');
                if ($reply_cmt) {
                    echo '<div class="alert alert-success">' . $reply_cmt . '</div>';
                    Session::put('reply_cmt', null);
                } elseif ($error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                    Session::put('error', null);
                }
                ?>
                <div id="notify-reply-comment"></div>
                <table class="table table-striped b-t b-light custom-table-center">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                STT
                            </th>
                            <th>Tên</th>
                            <th>Bình luận</th>
                            <th>Sản phẩm</th>
                            <th>Trả lời</th>

                            <th style="text-align: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($comment as $key => $cmt)
                            <form>
                                @csrf
                                <tr>
                                    @php
                                        $i++;
                                    @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $cmt->comment_name }}</td>
                                    <td style="text-align: left; ">
                                        {{ $cmt->comment }}
                                        <ul style="list-style-type: decimal">
                                            <p style="color: green">Trả lời:</p>

                                            @foreach ($all_comment as $key => $cmt_rep)
                                                @if ($cmt_rep->comment_parent_id == $cmt->comment_id)
                                                    <li style="margin-left: 20px">{{ $cmt_rep->comment }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>{{ $cmt->product->product_name }}</td>
                                    <td>
                                        <textarea rows="4" cols="20" class="reply-comment-style reply-comment-{{ $cmt->comment_id }}"></textarea>
                                    </td>

                                    <td style="text-align: center">
                                        {{-- <a href="{{ URL::to('/edit-product/' . $pro->product_id) }}" class="btn btn-success"
                                    ui-toggle-class="" title="Sửa sản phẩm">
                                    Sửa
                                </a> --}}
                                        <button data-comment-product-id="{{ $cmt->comment_product_id }}"
                                            class="btn btn-success btn-reply-comment"
                                            data-comment-id="{{ $cmt->comment_id }}">Trả lời</button>
                                        <a href="{{ URL::to('/delete-product/' . $cmt->product_id) }}"
                                            class="btn btn-danger custom-delete-product" ui-toggle-class=""
                                            title="Xóa bình luận"
                                            onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
