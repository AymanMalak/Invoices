@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">

    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('title')
    تغيير حالة الفاتورة
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغيير حالة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <div class="alert alert-success fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Edit'))
        <div class="alert alert-success fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Delete'))
        <div class="alert alert-success fade show" role="alert">
            <strong>{{ session()->get('Delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Error'))
        <div class="alert alert-danger fade show" role="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif





    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                </div>
                <div class="card-body">

                    <form action="{{ route('Invoices.statusUpdate', ['id' => $invoice->id]) }}" method="post"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="invoice_number" class="control-label">رقم الفاتورة</label>
                                <input type="text" class="form-control" readonly id="invoice_number"
                                    name="invoice_number" title="يرجي ادخال رقم الفاتورة" required
                                    value="{{ $invoice->invoice_number }}">
                            </div>

                            <div class="col mb-3">
                                <label for="invoice_date">تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" readonly id="invoice_date" name="invoice_date"
                                    type="text" value="{{ $invoice->invoice_date }}" required>
                            </div>

                            <div class="col mb-3">
                                <label for="due_date">تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" readonly="on" id="due_date" name="due_date"
                                    placeholder="YYYY-MM-DD" value="{{ $invoice->due_date }}" type="text" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="section" class="control-label">القسم</label>
                                <select readonly name="section" class="form-control " onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="{{ $invoice->section->id }}"> {{ $invoice->section->section_name }}
                                    </option>

                                </select>
                            </div>

                            <div class="col mb-3">
                                <label for="product" class="control-label">المنتج</label>
                                <select id="product" name="product" readonly class="form-control">
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col mb-3">
                                <label for="tahsel" class="control-label">مبلغ التحصيل</label>
                                <input readonly type="text" value="{{ $invoice->amount_collection }}"
                                    class="form-control" id="tahsel" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>

                        {{-- 3 --}}
                        <div class="row">

                            <div class="col mb-3">
                                <label for="amount_commission" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" value="{{ $invoice->amount_commission }}"
                                    class="form-control form-control-lg" id="amount_commission" name="amount_commission"
                                    title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col mb-3">
                                <label for="discount" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="discount"
                                    name="discount" title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    readonly value="{{ $invoice->amount_commission }}">
                            </div>

                            <div class="col mb-3">
                                <label for="rate_vat" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly name="rate_vat" id="rate_vat" class="form-control"
                                    onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="{{ $invoice->rate_vat }}" selected readonly>{{ $invoice->rate_vat }}
                                    </option>

                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="value_vat" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input readonly type="text" value="{{ $invoice->value_vat }}" class="form-control"
                                    id="value_vat" name="value_vat" readonly>
                            </div>

                            <div class="col mb-3">
                                <label for="total" class="control-label">الاجمالي شامل الضريبة</label>
                                <input readonly type="text" value="{{ $invoice->total }}" class="form-control"
                                    id="total" name="total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea readonly class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoice->note }}</textarea>
                            </div>
                        </div>

                        {{-- 6 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="status" class="control-label">حدد حالة الدفع</label>
                                <select name="status" class="form-control ">
                                    <option value="{{ $invoice->status }}" selected> {{ $invoice->status }}</option>
                                    <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                    <option value="مدفوعة">مدفوعة</option>
                                </select>
                                {{ $invoice->status }}
                            </div>


                            <div class="col mb-3">
                                <label for="payment_date">تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" id="payment_date" name="payment_date"
                                    placeholder="YYYY-MM-DD" value="{{ date('Y-m-d') }}" type="text">
                            </div>

                        </div>
                        <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تغيير الحالة</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--/div-->

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>


    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                var SectionId = $(this).val();
                console.log("SectionId", SectionId);
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                console.log("key", key);
                                console.log("value", value);
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        function myFunction() {
            var amount_commission = parseFloat(document.getElementById("amount_commission").value);
            var discount = parseFloat(document.getElementById("discount").value);
            var rate_vat = parseFloat(document.getElementById("rate_vat").value);
            var value_vat = parseFloat(document.getElementById("value_vat").value);
            var amount_commission2 = amount_commission - discount;
            if (typeof amount_commission === 'undefined' || !amount_commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                var intResults = amount_commission2 * rate_vat / 100;
                var intResults2 = parseFloat(intResults + amount_commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("value_vat").value = sumq;
                document.getElementById("total").value = sumt;
            }
        }
    </script>
@endsection
