@extends('layouts.admin')
@section('title', 'TẠO ĐƠN VỊ VẬN CHUYỂN')

@section('content-header')
    <h1>
        THÊM ĐƠN VỊ VẬN CHUYỂN
        {{-- <small>TẠO MỚI</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Dashboard</li>
    </ol>
    </section>

@endsection

@section('content')

<div class="div-message">

    @if (session()->has('success'))
        <h3 class="success-message">
            {{ session()->get('success') }}
        </h3>
    @endif

</div>

    <h3>THÔNG TIN ĐƠN VỊ VẬN CHUYỂN </h3>
    <form method="POST" action="{{ route('shippingUnit.store') }}">
        @csrf
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tên ĐVVC (*)</label>
                    <input type="text" name="name" class="form-control" placeholder="Tên Đơn vị vận chuyển" value="{{ old('name') }}">
                    <span class="text-error">
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tên viết tắt (*)</label>
                    <input type="text" name="shortName" class="form-control" placeholder="Tên viết tắt" value="{{ old('shortName') }}">
                    <span class="text-error">
                        @if ($errors->has('shortName'))
                            {{ $errors->first('shortName') }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phoneNumber" class="form-control" placeholder="Số điện thoại" value="{{ old('phoneNumber') }}">
                    <span class="text-error">
                        @if ($errors->has('phoneNumber'))
                            {{ $errors->first('phoneNumber') }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Mã số thuế</label>
                    <input name="taxId" type="text" class="form-control" placeholder="Mã số thuế" value="{{ old('taxId') }}">
                    <span class="text-error">
                        @if ($errors->has('taxId'))
                            {{ $errors->first('taxId') }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label>Trạng thái ĐVVC</label>
                    <select name="status_id" value="{{ old('status_id') }}" class="form-control">
                        {{-- <option>Còn hợp tác</option>
                        <option>Ngừng hợp tác</option> --}}
                        @isset($statusList)
                            @foreach ($statusList as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Ngày ngừng hợp tác:</label>

                    <div class="input-group">
                        <input type="date" name="dateStopContact" value="{{ old('dateStopContact') }}" class="form-control"
                            data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tên tài khoàn ngân hàng</label>
                    <input type="text" name="bankName" class="form-control" value="{{ old('bankName') }}" placeholder="Nhập Tên tài khoàn ngân hàng">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Số tài khoản</label>
                    <input type="text" name="bankNumber" class="form-control" value="{{ old('bankNumber') }}" placeholder="Nhập số tài khoản">
                    <span class="text-error">
                        @if ($errors->has('bankNumber'))
                            {{ $errors->first('bankNumber') }}
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Mở tại ngân hàng</label>
                    <input type="text" name="bankAddress" class="form-control" value="{{ old('bankAddress') }}" placeholder="Nhập nơi mở tài khoản">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" rows="3" value="{{ old('address') }}" placeholder="Nhập địa chỉ"></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Thông tin liên hệ</label>
                    <textarea name="contact" class="form-control" rows="3" value="{{ old('contact') }}" placeholder="Nhập thông tin liên hệ"></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="3" value="{{ old('note') }}" placeholder="Nhập ghi chú"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <a href="{{  url()->previous() }}">
                    <button type="button" class="btn btn-block btn-warning btn-lg">Trở lại</button>
                </a>

            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-info btn-lg">Lưu</button>
            </div>
        </div>
    </form>

@endsection

@section('js')
<script src="{{ asset('/js/shipping-unit.js') }}"></script>
@endsection