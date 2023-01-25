@extends('layouts.app')
@section('content')

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Edit Team ({{$team->name}})</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="table-wrap">
						<table class="table table-responsive-xl dataTable" id="all_member_table">
						  <thead>
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>Organization</th>
						    </tr>
						  </thead>
						  <tbody>
                            @foreach($other_members as $other_member)
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="member" class="checkkk" value="{{$other_member->id}}">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url({{asset('assets/images/person_2.jpg')}});"></div>
						      	<div class="pl-3 email">
                                    <p>{{$other_member->name}}</p>
						      		<span>{{$other_member->email}}</span>
						      		<span>{{$other_member->position}}</span>
						      	</div>
						      </td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
					</div>
				</div>
                <div class="col-md-2 text-center">
                    <button class="btn btn-success add-button"> ADD <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    <button class="btn btn-danger mt-2 remove-button"><i class="fa fa-arrow-left" aria-hidden="true"></i> REMOVE</button>
                </div>
                <div class="col-md-5">
					<div class="table-wrap">
						<table class="table table-responsive-xl dataTable" id="member_table">
						  <thead>
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>{{$team->name}} Members</th>
						    </tr>
						  </thead>
						  <tbody>
                            @foreach($team_members as $team_member)
						    <tr class="alert" role="alert" >
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="member" class="checkkk" value="{{$team_member->id}}">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url({{asset('assets/images/person_2.jpg')}});"></div>
						      	<div class="pl-3 email">
                                    <p>{{$team_member->name}}</p>
						      		<span>{{$team_member->email}}</span>
						      		<span>{{$team_member->position}}</span>
						      	</div>
						      </td>
						    </tr>
						    @endforeach
						  </tbody>
						</table>
					</div>
				</div>
			</div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary" id="update_team"> UPDATE TEAM </button>
                    <a href="{{ route('index') }}" class="btn btn-secondary" id="cancel-form">CANCEL</a> 
                </div>
            </div>
		</div>
	</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(".add-button").click(function () {
            $.each($("#all_member_table input[name='member']:checked"), function(){
                var tr = $(this).closest("tr").remove().clone();
                tr.find('.checkkk').prop('checked', false);
                $("#member_table tbody").prepend(tr);
            });
            
        });
        
        $(".remove-button").click(function () {
            var favorite = [];
            $.each($("#member_table input[name='member']:checked"), function(){
                favorite.push($(this).val());
                var tr = $(this).closest("tr").remove().clone();
                tr.find('.checkkk').prop('checked', false);
                $("#all_member_table tbody").prepend(tr);
            });
        });
        
        $("#update_team").click(function () {
            $('#update_team').prop('disabled', true);
            var team_id = {{$team->id}};
            var favorite = [];
            $.each($("#member_table input[name='member']"), function(){
                favorite.push($(this).val());
            });
            $.ajax({
                url: "{{ route('updateTeamMembers') }}",
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "members":favorite,
                    "team_id":team_id
                },
                success: function (response) {
                    var url = '{{ route("index") }}';
                    window.location.href=url;
                },
                error: function (response) {
                    alert('Something went wrong ! , Refresh and try again !')
                }
            });
        });
       
    });

</script>
@endsection