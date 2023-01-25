
<?php $__env->startSection('content'); ?>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Edit Team (<?php echo e($team->name); ?>)</h2>
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
                            <?php $__currentLoopData = $other_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="member" class="checkkk" value="<?php echo e($other_member->id); ?>">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(<?php echo e(asset('assets/images/person_2.jpg')); ?>);"></div>
						      	<div class="pl-3 email">
                                    <p><?php echo e($other_member->name); ?></p>
						      		<span><?php echo e($other_member->email); ?></span>
						      		<span><?php echo e($other_member->position); ?></span>
						      	</div>
						      </td>
						    </tr>
						    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
						    	<th><?php echo e($team->name); ?> Members</th>
						    </tr>
						  </thead>
						  <tbody>
                            <?php $__currentLoopData = $team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team_member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						    <tr class="alert" role="alert" >
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										  <input type="checkbox" name="member" class="checkkk" value="<?php echo e($team_member->id); ?>">
										  <span class="checkmark"></span>
										</label>
						    	</td>
						      <td class="d-flex align-items-center">
						      	<div class="img" style="background-image: url(<?php echo e(asset('assets/images/person_2.jpg')); ?>);"></div>
						      	<div class="pl-3 email">
                                    <p><?php echo e($team_member->name); ?></p>
						      		<span><?php echo e($team_member->email); ?></span>
						      		<span><?php echo e($team_member->position); ?></span>
						      	</div>
						      </td>
						    </tr>
						    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary" id="update_team"> UPDATE TEAM </button>
                    <a href="<?php echo e(route('index')); ?>" class="btn btn-secondary" id="cancel-form">CANCEL</a> 
                </div>
            </div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
            var team_id = <?php echo e($team->id); ?>;
            var favorite = [];
            $.each($("#member_table input[name='member']"), function(){
                favorite.push($(this).val());
            });
            $.ajax({
                url: "<?php echo e(route('updateTeamMembers')); ?>",
                type:'POST',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "members":favorite,
                    "team_id":team_id
                },
                success: function (response) {
                    var url = '<?php echo e(route("index")); ?>';
                    window.location.href=url;
                },
                error: function (response) {
                    alert('Something went wrong ! , Refresh and try again !')
                }
            });
        });
       
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Test\laravel_test_team_management\resources\views/team.blade.php ENDPATH**/ ?>