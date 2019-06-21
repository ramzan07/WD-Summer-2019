@extends('layout.master')

@section('page_styles')
<!--Table-->
<style type="text/css">
	.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
</style>
@endsection

@section('page_scripts')

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Feeds</h2>
    <a href="contact.html"><i class="icon-envelope"></i></a>
</div>
@endsection

@section('content')
    <table class="table table-striped custab">
    <thead>
    <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Parent ID</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
            <tr>
                <td>1</td>
                <td>News</td>
                <td>News Cate</td>
                <td class="text-center"><a class='btn btn-info btn-xs btn btn-primary btn-sm hidden-xs' href="#" data-toggle="collapse" data-target="#feature-1"><span class="icon-eye"></span> Edit</a></td>
         	</tr>
            <tr>
            	<td id="" colspan="5"><p>Testtttttttttttttttttttttt</p></td>
            	<!--<td id="feature-1" class="collapse out" width="200" colspan="5">
	                <table class="table table-bordered">
		             <tbody>
			     
                     <tr>
				      <td><b>Skills</b></td>
				      <td>HTML5 / CSS3 / JAVASCRIPT</td>
			         </tr>
                  
                     <tr>
				      <td><b>Duration</b></td>
				      <td>20 Days</td>
			         </tr>
			
                     <tr>
				      <td><b>Cost</b></td>
				      <td>$5000</td>
			         </tr>
            
                     <tr>
				      <td><b>Url</b></td>
				      <td><a href="http://www.uipasta.com" title="uipasta">Rolling</a></td>
			         </tr>
            
                     <tr>
				      <td><b>About Project</b></td>
				      <td>Lorem ipsum dolor sit amet consectetur adipiscing elit Vivamus feugiat facilisis dignissim Etiam scelerisque ultricies euismod.</td>
			         </tr>
		          </tbody>
	            </table>                                               
				</td>-->
            </tr>
    </table>

<!-- !>
	Collapse menue
	>-->
@endsection