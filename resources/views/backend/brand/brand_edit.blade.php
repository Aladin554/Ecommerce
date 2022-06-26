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
            


         
          <!-- /.col -->

          <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                    <form action="{{route('brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                       <div class="row">
                         <div class="col-12">						
                             <div class="row">
  
  
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <h5>Brand Name English<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="brand_name_en" value="{{$brand->brand_name_en}}" class="form-control" required=""  data-validation-required-message="This field is required">
                                     </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Brand Name Bangla<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="brand_name_bn" value="{{$brand->brand_name_bn}}" class="form-control" required=""  data-validation-required-message="This field is required"> </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Brand Image<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="file" name="brand_image" value="{{$brand->brand_image}}"class="form-control" required=""  data-validation-required-message="This field is required"> </div>
                                  </div>
                              
  
                              
                             
                             
                         <div class="text-xs-right">
                             <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
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