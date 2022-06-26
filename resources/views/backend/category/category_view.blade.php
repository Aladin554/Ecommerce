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
                              <th>Category Icon</th>
                              <th>Category Name English</th>
                              <th>Category Name Bangla</th>
                              <th>Action</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($categorys as $item)
                              
                          <tr>
                            <td><span><i class="{{$item->category_icon}}"></i></span></td>
                              <td>{{$item->category_name_en}}</td>
                              <td>{{$item->category_name_bn}}</td>
                             <td>
                                <a href="{{route('category.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('category.delete',$item->id)}}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></a>
                            </td>
                             
                          </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>Category Name English</th>
                            <th>Category Name Bangla</th>
                            <th>Category Image</th>
                            <th>Action</th>
                            
                          </tr>
                      </tfoot>
                    </table>
                    {{ $categorys->links() }}
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
                 <h3 class="box-title">Add Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="">
                    <form action="{{route('category.store')}}" method="POST">
                      @csrf
                       <div class="row">
                         <div class="col-12">						
                             <div class="row">
  
  
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <h5>Category Name English<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="category_name_en" class="form-control" required=""  data-validation-required-message="This field is required">
                                     </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Category Name Bangla<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="category_name_bn" class="form-control" required=""  data-validation-required-message="This field is required"> </div>
                                  </div>
  
                                  <div class="form-group">
                                      <h5>Category Icon<span class="text-danger">*</span></h5>
                                      <div class="controls">
                                          <input type="text" name="category_icon" class="form-control" required=""  data-validation-required-message="This field is required"> </div>
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