@extends('layout')

@section('title')
    <title>Liên hệ</title>
@endsection

@section('content')
    <div class="col-md-12 custom-color-dark-pp custom-contact-content">
        <h3>Thông tin cửa hàng</h3>
        @foreach ($contact as $key => $contact)
            <div class="custom-contact-line">
                <p>{{ $contact->contact_title }}: <span>{{ $contact->contact_content }}</span></p>
            </div>
        @endforeach
    </div>
@endsection
