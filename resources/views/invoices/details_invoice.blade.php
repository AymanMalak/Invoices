@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection





@section('content')
    @if (session()->has('Delete'))
        <div class="alert alert-success fade show" role="alert">
            <strong>{{ session()->get('Delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="panel panel-primary tabs-style-2">
        <div class=" tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class="tab-pane active" id="tab4">

                    <div class="col-xl-12">
                        <div class="card mg-b-20">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr class=" text-right">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ الفاتورة</th>
                                                <th class="border-bottom-0">تاريخ الاتسحقاق</th>
                                                <th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0">المنتج</th>
                                                <th class="border-bottom-0">مبلغ التحصيل</th>
                                                <th class="border-bottom-0">مبلغ العمولة</th>
                                                <th class="border-bottom-0">الخصم</th>
                                                <th class="border-bottom-0">نسبة الضريبة</th>
                                                <th class="border-bottom-0">قيمة الضريبة</th>
                                                <th class="border-bottom-0">الاجمالي</th>
                                                <th class="border-bottom-0">ملاحطات</th>
                                                <th class="border-bottom-0">الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class=" text-center">
                                                <td class="text-right">1</td>
                                                <td class="text-right">{{ $invoice->invoice_number }}</td>
                                                <td class="text-right">{{ $invoice->invoice_date }}</td>
                                                <td class="text-right">{{ $invoice->due_date }}</td>
                                                <td class="text-right">{{ $invoice->section->section_name }}</td>
                                                <td class="text-right">{{ $invoice->product }}</td>
                                                <td class="text-right">{{ $invoice->amount_collection }}</td>
                                                <td class="text-right">{{ $invoice->amount_commission }}</td>
                                                <td class="text-right">{{ $invoice->discount }}</td>
                                                <td class="text-right">{{ $invoice->rate_vat }}</td>
                                                <td class="text-right">{{ $invoice->value_vat }}</td>
                                                <td class="text-right">{{ $invoice->total }}</td>
                                                <td class="text-right">{{ $invoice->note }}</td>
                                                <td class="text-right">
                                                    @if ($invoice->value_status == 1)
                                                        <span
                                                            class="text-white px-1 bg-success">{{ $invoice->status }}</span>
                                                    @elseif ($invoice->value_status == 2)
                                                        <span
                                                            class="text-white px-1 bg-warning">{{ $invoice->status }}</span>
                                                    @else
                                                        <span
                                                            class="text-white px-1 bg-danger">{{ $invoice->status }}</span>
                                                    @endif
                                                </td>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab5">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr class=" text-right">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0">المنتج</th>
                                                <th class="border-bottom-0">ملاحطات</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0">المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($inv_details as $inv_d)
                                                <tr class=" text-center">


                                                    <td class="text-right">{{ $x++ }}</td>
                                                    <td class="text-right">{{ $inv_d->invoice_number }}</td>
                                                    <td class="text-right">{{ $invoice->section->section_name }}</td>
                                                    <td class="text-right">{{ $inv_d->product }}</td>
                                                    <td class="text-right">{{ $inv_d->note }}</td>
                                                    <td class="text-right">
                                                        @if ($inv_d->value_status == 1)
                                                            <span
                                                                class="text-white px-1 bg-success">{{ $inv_d->status }}</span>
                                                        @elseif ($inv_d->value_status == 2)
                                                            <span
                                                                class="text-white px-1 bg-warning">{{ $inv_d->status }}</span>
                                                        @else
                                                            <span
                                                                class="text-white px-1 bg-danger">{{ $inv_d->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{ $inv_d->user }}</td>



                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab6">
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header">

                                <div class="col-12 ">

                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-2">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }} <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button></li>
                                                @endforeach
                                            </ul>
                                        </div>
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

                                </div>
                                <form action="{{ route('invoiceAttachments.store') }}" method="post"
                                    enctype="multipart/form-data" autocomplete="off">
                                    {{ csrf_field() }}
                                    {{-- 1 --}}
                                    <div class="card-body">
                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                        <h5 class="card-title">المرفقات</h5>

                                        <div class="col-sm-12 col-md-12">
                                            <input type="file" name="file_name" id="custom_file" class="dropify"
                                                accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                        </div><br>

                                        <input type="hidden" name="invoice_number" id=""
                                            value="{{ $invoice->invoice_number }}">
                                        <input type="hidden" name="invoice_id" id=""
                                            value="{{ $invoice->id }}">

                                        <div class="d-flex justify-content-right ">
                                            <button type="submit" class="btn btn-primary btn-sm">اضافة المرفق</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table key-buttons text-md-nowrap">
                                        <thead>
                                            <tr class=" text-right">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم الملف</th>
                                                <th class="border-bottom-0">قام بالاضافة</th>
                                                <th class="border-bottom-0">تاريخ الاضافة</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($inv_attatchments as $attachment)
                                                <tr class=" text-center">


                                                    <td class="text-right">{{ $i++ }}</td>
                                                    <td class="text-right">{{ $attachment->file_name }}</td>
                                                    <td class="text-right">{{ $attachment->created_by }}</td>
                                                    <td class="text-right">{{ $attachment->created_at }}</td>
                                                    <td class="text-right" colspan="2">


                                                        <a class=" btn btn-outline-success  btn-sm"
                                                            data-effect="effect-scale" role="button"
                                                            href="{{ url('view_file') }}/{{ $attachment->invoice_number }}/{{ $attachment->file_name }}"
                                                            title="عرض">عرض</a>

                                                        <a class=" btn btn-outline-info  btn-sm"
                                                            data-effect="effect-scale" role="button"
                                                            href="{{ url('download_file') }}/{{ $attachment->invoice_number }}/{{ $attachment->file_name }}"
                                                            title="تحميل">تحميل</a>



                                                        <a class="btn-outline-danger btn btn-sm"
                                                            data-effect="effect-scale" data-toggle="modal" title="حذف"
                                                            data-target="#delete_file" data-id="{{ $attachment->id }}"
                                                            data-invoice_number="{{ $attachment->invoice_number }}"
                                                            data-file_name="{{ $attachment->file_name }}">حذف</a>





                                                    </td>



                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- delete section --}}
    <div class="modal fade" id="delete_file" role="effect-flip-horizontal" style="display: none;" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">


                <div class="modal-header">
                    <h6 class="modal-title">حذف المرفق</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('delete_file') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <p>
                        <h1 class="text-danger">هل انت متاكد من حذف المرفق؟</h1>
                        </p>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="file_name" name="file_name">
                            <input type="hidden" class="form-control" id="invoice_number" name="invoice_number">

                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-danger" type="submit">حذف</button>
                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- delete section --}}
@endsection

@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>




    <script>
        $('#delete_file').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var file_name = button.data('file_name');
            var invoice_number = button.data('invoice_number');
            var modal = $(this);
            console.log("file_name", file_name);
            console.log("invoice_number", invoice_number);

            modal.find(".modal-body #id").val(id);
            modal.find(".modal-body #file_name").val(file_name);
            modal.find(".modal-body #invoice_number").val(invoice_number);
        })
    </script>
@endsection
