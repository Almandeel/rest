@extends('layouts.dashboard.app', ['modals' => ['item'], 'datatable' => true])

@section('title')
    تعديل منتج: {{ $item->name }}
@endsection

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['المنتجات', $item->name, 'تعديل'])
        @slot('url', [route('items.index'), route('items.show', $item), '#'])
        @slot('icon', ['th-large', 'plush', 'edit'])
    @endcomponent
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box">
            <div class="box-header">
                <h3 class="box-heading">
                    <i class="fa fa-edit"></i>
                    <span>تعديل منتج: {{ $item->name }}</span>
                </h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label>الاسم</label>
                    <input class="form-control name" required type="text" name="name" value="{{ $item->name }}" placeholder="الاسم">
                </div>
                <div class="form-group">
                    <div class="image-wrapper">
                        <div class="image-previewer" style="background-image: url({{ $item->image_url }});"></div>
                        <label class="btn btn-primary">
                            <i class="fa fa-image"></i>
                            <span>تغيير الصورة</span>
                            <input type="file" name="image" />
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    {{--  <div class="col-xs-12 col-md-6">
                        <label for="stores">المخازن</label>
                        <select class="select2 form-control" name="stores[]" id="stores" multiple>
                            @foreach($item->stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>  --}}
                    <div class="col-xs-12 col-md-6">
                        <h3>المخازن</h3>
                        <table id="stores-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المخزن</th>
                                    <th style="width: 60px; text-align: center;"><i class="fa fa-times"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item->stores as $store)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td class="text-center">
                                            <input type="hidden" name="stores_names[]" value="{{ $store->name }}">
                                            <button type="button" class="btn btn-danger btn-remove-store">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>  
                            <tfoot>
                                <tr>
                                    <th><i class="fa fa-plus"></i></th>
                                    <th>
                                        <select class="form-control new-store-name editable">
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->name }}">{{ $store->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-primary btn-add-store">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </th>
                                </tr>
                            </tfoot>   
                        </table>    
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <h3>الوحدات</h3>
                        <table id="units-table" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الوحدة</th>
                                    <th>السعر</th>
                                    <th style="width: 60px; text-align: center;"><i class="fa fa-times"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item->units as $unit)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="hidden" name="units_names[]" value="{{ $unit->name }}"/>
                                                <input type="number" name="units_prices[]" class="form-control" value="{{ $unit->pivot->price }}" min="0" placeholder="سعر الوحدة">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-remove-unit">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><i class="fa fa-plus"></i></th>
                                    <th>
                                        <select class="form-control new-unit-name editable">
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <input type="number" class="form-control new-unit-price" placeholder="سعر الوحدة">
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-primary btn-add-unit">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </th>
                                </tr>
                            </tfoot> 
                        </table>    
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(function(){
            $('.check-all-stores').change(function(){
                $('.check-all-stores').prop('checked', $(this).prop('checked'))
                $(this).closest('table').find('input.store').prop('checked', $(this).prop('checked'))
            })
            $(document).on('click', 'tr.store-row', function(){
                let store = $(this).find('input.store')
                store.prop('checked', !store.prop('checked'))
            })
            $(document).on('click', '.btn-add-unit', function(){
                let units_table_body = $('#units-table tbody')
                let unit_name = $(this).closest('tfoot').find('input.new-unit-name')
                let unit_price = $(this).closest('tfoot').find('input.new-unit-price')
                if(!unit_name.val()){
                    alert('ادخل اسم الوحدة ')
                    unit_name.focus()
                }
                else if(!unit_price.val()){
                    alert('ادخل سعر الوحدة ')
                    unit_price.focus()
                }else{
                    let row = `
                        <tr>
                            <td>`+ (units_table_body.children().length + 1) +`</td>
                            <td>`+ unit_name.val() +`</td>
                            <td>
                                <div class="input-group">
                                    <input type="hidden" name="units_names[]" value="`+ unit_name.val() +`">
                                    <input type="number" class="form-control" placeholder="سعر الوحدة" name="units_prices[]" min="1" value="`+ unit_price.val() +`">
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-remove-unit">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    units_table_body.append(row)
                    unit_name.val('')
                    unit_price.val('')
                }
            })
            $(document).on('click', '.btn-remove-unit', function(){
                let units_table_body = $('#units-table tbody')
                let confirmed = confirm('سوف يتم حذف الوحدة من القائمة هل انت متأكد؟')
                if(confirmed){
                    $(this).closest('tr').remove()
                    for(let index = 0; index < units_table_body.children().length; index++){
                        let row = $(units_table_body.children()[index])
                        $(row.children()[0]).text((index + 1))
                    }
                }
            })

            $(document).on('click', '.btn-add-store', function(){
                let stores_table_body = $('#stores-table tbody')
                let store_name = $(this).closest('tfoot').find('input.new-store-name')
                if(!store_name.val()){
                    alert('ادخل اسم المخزن')
                    store_name.focus()
                }
                else{
                    let row = `
                        <tr>
                            <td>`+ (stores_table_body.children().length + 1) +`</td>
                            <td>` + store_name.val() + `</td>
                            <td class="text-center">
                                <input type="hidden" name="stores_names[]" value="` + store_name.val() + `">
                                <button type="button" class="btn btn-danger btn-remove-store">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    stores_table_body.append(row)
                    store_name.val('')
                }
            })
            $(document).on('click', '.btn-remove-store', function(){
                let stores_table_body = $('#stores-table tbody')
                let confirmed = confirm('سوف يتم حذف المخزن من القائمة هل انت متأكد؟')
                if(confirmed){
                    $(this).closest('tr').remove()
                    for(let index = 0; index < stores_table_body.children().length; index++){
                        let row = $(stores_table_body.children()[index])
                        $(row.children()[0]).text((index + 1))
                    }
                }
            })
        })
    </script>
@endpush
