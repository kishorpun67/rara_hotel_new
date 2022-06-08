@extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
  use App\Admin\Tent;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
      @error('category_id')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror  
      @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('price')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror   
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Rent  Tent</h3>
              <a href="{{route('admin.add.edit.rent.tent')}}" style="width: auto; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Rent Tent</a>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Number of Customer</th>
                  <th>Tent Type</th>
                  <th>Price (Per\day)</th>
                  <th>Duration (Days)</th>
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Due</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                    ?>
                @forelse($rentTent as  $tent)
                <tr>
                    <td>{{ $i}}</td>
                    <?php 
                  $i++;
                    ?>
                    <td>
                        @if(!empty( $tent->customer->customer_name))
                            {{ $tent->customer->customer_name}}
                        @endif
                    </td>
                    <td>{{ $tent->number_of_customer}}</td>
                    <td>
                      @if(!empty( $tent->tent_id))
                      <?php 
                         $ids = explode(',', $tent->tent_id);
                         $tents = Tent::whereIn('id', $ids)->get();
                         
                      ?>
                      {{-- {{$ids}} --}}
                      @foreach ($tents as $item)
                      {{$item->name}} <br>
                          
                      @endforeach
                       
                      @endif
                    </td>

                    <td>
                      @foreach ($tents as $item)
                        {{$item->price}} <br>
                      @endforeach
                    </td>
                    <td>{{ $tent->duration}}</td>

                    <td>{{ $tent->total}}</td>
                    <td>{{ $tent->paid}}</td>
                    <td>{{ $tent->due}}</td>
                    </td>
                    <td>
                    <a href="{{route('admin.add.edit.rent.tent',  $tent->id)}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record= "tent" rel="{{ $tent->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection