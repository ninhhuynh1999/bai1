@extends('layouts.admin')
@section('title', 'TẠO ĐƠN VỊ VẬN CHUYỂN')
@section('content-header')
    <h1>
        CHỈNH SỬA ĐƠN VỊ VẬN CHUYỂN
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
    <form method="POST" action="{{ route('shippingUnit.update') }}">
        @csrf
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Tên ĐVVC (*)</label>
                    <input type="text" name="name" class="form-control" placeholder="Tên Đơn vị vận chuyển"
                        value="{{ old('name') ? old('name') : $model->name }}">
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
                    <input type="text" name="shortName" class="form-control" placeholder="Tên viết tắt"
                        value="{{ old('shortName') ? old('shortName') : $model->shortName }}">
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
                    <input type="text" name="phoneNumber" class="form-control" placeholder="Số điện thoại"
                        value="{{ old('phoneNumber') ? old('phoneNumber') : $model->phoneNumber }}">
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
                    <input name="taxId" type="text" class="form-control" placeholder="Mã số thuế"
                        value="{{ old('taxId') ? old('taxId') : $model->taxId }}">
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
                    <select name="status_id" class="form-control">
                        {{-- <option>Còn hợp tác</option>
                        <option>Ngừng hợp tác</option> --}}
                        @isset($statusList)
                            @foreach ($statusList as $status)
                                <option value="{{ $status->id }}"
                                    @if (!empty(old('status_id'))) {{ $status->id === old('status_id') ? 'selected' : '' }}
                                    @else
                                    {{ $status->id === $model->status_id ? 'selected' : '' }} @endif>
                                    {{ $status->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Ngày ngừng hợp tác:</label>

                    <div class="input-group">
                        <input type="date" name="dateStopContact"
                            value="{{ old('dateStopContact') ? old('dateStopContact') : $model->dateStopContact }}"
                            class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Tên tài khoàn ngân hàng</label>
                    <input type="text" name="bankName" class="form-control"
                        value="{{ old('bankName') ? old('bankName') : $model->bankName }}"
                        placeholder="Nhập Tên tài khoàn ngân hàng">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Số tài khoản</label>
                    <input type="text" name="bankNumber" class="form-control"
                        value="{{ old('bankNumber') ? old('bankNumber') : $model->bankNumber }}"
                        placeholder="Nhập số tài khoản">
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
                    <input type="text" name="bankAddress" class="form-control"
                        value="{{ old('bankAddress') ? old('bankAddress') : $model->bankAddress }}"
                        placeholder="Nhập nơi mở tài khoản">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" rows="3" value=""
                        placeholder="Nhập địa chỉ">{{ old('address') ? old('address') : $model->address }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Thông tin liên hệ</label>
                    <textarea name="contact" class="form-control" rows="3" value=""
                        placeholder="Nhập thông tin liên hệ">{{ old('contact') ? old('contact') : $model->contact }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="3" value=""
                        placeholder="Nhập ghi chú">{{ old('note') ? old('note') : $model->note }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <a
                    href="@if (url()->previous() == url()->current()) {{ route('shippingUnit.index') }}
                    @else
                    {{ url()->previous() }} @endif">
                    <button type="button" class="btn btn-block btn-warning btn-lg">Trở lại</button>
                </a>
            </div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-block btn-info btn-lg">Lưu</button>
            </div>
            <input type="hidden" name="id" value="{{ $model->id }}">
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('/js/shipping-unit.js') }}"></script>
@endsection
