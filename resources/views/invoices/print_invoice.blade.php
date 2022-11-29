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

    <style>
     @media print{
        #print_button{
            display: none
        }
     }
    </style>
@endsection

@section('title')
    طباعة الفاتورة
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة
                    فواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('edit_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'Invoice Updated Successfully',
                    type: 'primary'
                })
            }
        </script>
    @endif





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
                <div class="card-body " id="print_body">

                    <form action="{{ route('invoices.update') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col mb-3">
                                <label for="invoice_name" class="control-label">رقم الفاتورة</label>
                                <input type="hidden" class="form-control" id="invoice_id" name="invoice_id"
                                    value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="invoice_name"
                                    value="{{ $invoice->invoice_number }}" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col mb-3">
                                <label for="invoice_date">تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" id="invoice_date" name="invoice_date"
                                    placeholder="YYYY-MM-DD" type="text" value="{{ $invoice->invoice_date }}" required>
                            </div>

                            <div class="col mb-3">
                                <label for="due_date">تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" id="due_date" name="due_date"
                                    placeholder="YYYY-MM-DD" type="text" value="{{ $invoice->due_date }}" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                           

                            <div class="col mb-3">
                                <label for="product" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col mb-3">
                                <label for="tahsel" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="tahsel"
                                    value="{{ $invoice->amount_collection }}" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col mb-3">
                                <label for="amount_commission" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg"
                                    value="{{ $invoice->amount_commission }}" id="amount_commission"
                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col mb-3">
                                <label for="discount" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="discount"
                                    name="discount" value="{{ $invoice->discount }}" title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col mb-3">
                                <label for="rate_vat" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="{{ $invoice->rate_vat }}">{{ $invoice->rate_vat }}</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col mb-3">
                                <label for="value_vat" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" value="{{ $invoice->value_vat }}"
                                    id="value_vat" name="value_vat" readonly>
                            </div>

                            <div class="col mb-3">
                                <label for="total" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" value="{{ $invoice->total }}" id="total"
                                    name="total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col mb-3">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoice->note }}</textarea>
                            </div>
                        </div><br>



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" id="print_button" onclick="printDiv()">طباعة</button>
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


<script>
    function printDiv() {
        var printBody =  document.getElementById("print_body").innerHTML;
        var originalContent =  document.body.innerHTML;
        document.body.innerHTML = printBody;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
@endsection
