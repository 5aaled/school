@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
my classes
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
               add class 
            </button>
           
            <button type="button" class="button x-small" id="btn_delete_all">
              delete all 
            </button>
            <br><br>
            <form action="{{ route('Filter_Classes') }}" method="POST">
                {{ csrf_field() }}
                <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                        onchange="this.form.submit()">
                    <option value="" selected disabled>search by the grade </option>
                    @foreach ($Grades as $Grade)
                        <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                    @endforeach
                </select>
            </form>


            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>class </th>
                            <th>grade </th>
                            <th>process</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if (isset($Search)) 

                        <?php $Classes = $Search; ?>
                    @else

                        <?php $Classes = $Classes; ?>
                    @endif 
                        <?php $i = 0; ?>
                        @foreach ($Classes as $My_Class)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $My_Class->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $My_Class->name }}</td>
                                <td>{{ $My_Class->Grade->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="edit"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="delete"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                         
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                              edit class room 
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <!-- edit_form -->
                                           <form action="{{ route('classrooms.update', 'test') }}" method="post">
                                               {{ method_field('patch') }}
                                               @csrf
                                               <div class="row">
                                                   <div class="col">
                                                       <label for="name"
                                                              class="mr-sm-2">class name 
                                                           :</label>
                                                       <input id="name" type="text" name="name"
                                                              class="form-control"
                                                              value="{{ $My_Class->name}}"
                                                              required>
                                                       <input id="id" type="hidden" name="id" class="form-control"
                                                              value="{{ $My_Class->id }}">
                                                   </div>
                                                
                                               </div><br>
                                               <div class="form-group">
                                                   <label
                                                       for="exampleFormControlTextarea1">grades
                                                       :</label>
                                                   <select class="form-control form-control-lg"
                                                           id="exampleFormControlSelect1" name="Grade_id">
                                                       <option value="{{ $My_Class->Grade->id }}">
                                                           {{ $My_Class->Grade->name }}
                                                       </option>
                                                       @foreach ($Grades as $Grade)
                                                           <option value="{{ $Grade->id }}">
                                                               {{ $Grade->name }}
                                                           </option>
                                                       @endforeach
                                                   </select>

                                               </div>
                                               <br><br>

                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">close</button>
                                                   <button type="submit"
                                                           class="btn btn-success">submit</button>
                                               </div>
                                           </form>

                                       </div>
                                   </div>
                               </div>
                           </div>


                           <!-- delete_modal_Grade -->
                           <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                             delete
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <form action="{{ route('classrooms.destroy', 'test') }}"
                                                 method="post">
                                               {{ method_field('Delete') }}
                                               @csrf
                                          are u sure u want to delete 
                                               <input id="id" type="hidden" name="id" class="form-control"
                                                      value="{{ $My_Class->id }}">
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">close</button>
                                                   <button type="submit"
                                                           class="btn btn-danger">submit</button>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            
                           
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    add class 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">class name 
                                                :</label>
                                            <input class="form-control" type="text" name="name" />
                                        </div>

                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">the  name of the grade 
                                                :</label>

                                            <div class="box">

                                                <select class="fancyselect" name="Grade_id">
                                            

                                                    @foreach ($Grades as $Grade)
                                                        <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="name"
                                                class="mr-sm-2">process
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="delete" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="add row"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">close</button>
                                <button type="submit"
                                    class="btn btn-success">submit</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
</div>
</div>
<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   delete the rows 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    are u sure u want to delete all 
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-danger">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

@endsection
