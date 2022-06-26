@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Data Tables</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            


          <div class="col-9">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Data Table With Full Features</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Brand Name English</th>
                              <th>Brand Name Bangla</th>
                              <th>Brand Image</th>
                              <th>Action</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($brands as $item)
                              
                          <tr>
                              <td>{{$item->brand_name_en}}</td>
                              <td>{{$item->brand_name_bn}}</td>
                              <td><img class="rounded-circle" src="{{ $item->brand_image ?
                                asset('storage/brand_image/' . $item->brand_image) : asset('storage/no_image/no_image.png') }}" style="width:70px; height:40px;"
                                alt=""></td>
                              <td>
                                <a href="{{route('brand.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('brand.delete',$item->id)}}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                            </td>
                             
                          </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>Brand Name English</th>
                            <th>Brand Name Bangla</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                            
                          </tr>
                      </tfoot>
                    </table>
                    {{ $brands->links() }}
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

           
            <!-- /.box -->          
          </div>
          <!-- /.col -->

          <div class="col-3">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="">
                    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                       <div class="row">
                         <div class="col-12">						
                             <div class="row">
  
  
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <h5>Brand Name English<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="brand_name_en" class="form-control" required=""  data-validation-required-message="This field is required">
                                     </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Brand Name Bangla<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="brand_name_bn" class="form-control" required=""  data-validation-required-message="This field is required"> </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Brand Image<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="file" name="brand_image" class="form-control" required=""  data-validation-required-message="This field is required"> </div>
                                  </div>
                              
  
                              
                             
                             
                         <div class="text-xs-right">
                             <button type="submit" class="btn btn-rounded btn-primary mb-5">Add</button>
                         </div>
                      </div>
                     </form>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
 
            
             <!-- /.box -->          
           </div>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>

    
@endsection