@extends('layouts.app')
@section('content')
<style>
.avatar {
  vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
</style>
<section class="ftco-section">
		<div class="container">.
            <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Teams and Members</h2>
				</div>
			</div>
			<div class="row">
                <div class="col-md-4">
                    <h2>Teams</h2>
                </div>
                <div class="col-md-8">
                    <h2>List of team members</h2>
                </div>
            </div>
            <div class="row">
				<div class="col-md-4">
                    <div class="list-group">
                     <?php $i =1;  ?>
                      @foreach($teams as $team)
                          <a href="#" class="list-group-item list-group-item-action @if($i==1) active @endif team-list" aria-current="true" data-id="{{$team->id}}">
                            {{$team->name}}
                          </a>
                         <?php $i++;  ?>
                      @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" id="member-list">
                      @if(count($members)>0)
                      @foreach($members as $member)
                      <div class="col-sm-4 mt-2">
                        <div class="card">
                          <div class="card-body">
                            <center><img src="{{asset('assets/images/person_2.jpg')}}" alt="Avatar" class="avatar"></center>
                            <h5 class="card-title">{{$member->name}}</h5>
                            <p class="card-text">{{$member->email}}</p>
                            <span>{{$member->position}}</span>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      @else
                        <div class="col-md-12 text-center">
                            <span>No members in this group , add by clicking on Edit members</span>
                        </div>
                      @endif
                      
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary mt-3" id="edit_members">EDIT MEMBERS</button>
                </div>
            </div>
        </div>
</section>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
             $(".team-list").click(function () {
                 var team_id = $(this).data('id');
                 $(".team-list").removeClass("active");
                 $(this).addClass('active');
                 $.ajax({
                    url: "{{ route('getMembers') }}",
                    type:'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "team_id":team_id
                    },
                    success: function (response) {
                        if(response['status']=='sucess'){
                            var code = "";
                            $.each(response['data'],function (k,v) {
                                code += '<div class="col-sm-4 mt-2"><div class="card"><div class="card-body"><center><img src="{{asset('assets/images/person_2.jpg')}}" alt="Avatar" class="avatar"></center><h5 class="card-title">'+v.name+'</h5><p class="card-text">'+v.email+'</p><span>'+v.position+'</span></div></div></div>';
//                                 code += '<li>'+ v + '</li>';
                            });
                            $('#member-list').html(code);
                        }else{
                            $('#member-list').html('<div class="col-md-12 text-center"><span>No members in this group , add by clicking on Edit members</span></div>');
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
             });
            
            $("#edit_members").click(function () {
                var id = $('.active').data('id');
                var url = '{{ route("teamDetail", ":slug") }}';
                url = url.replace(':slug', id);
                window.location.href=url;
            });
            
        });
        
        
    </script>       
@endsection