			<?php
				$this->lang->load('ps', 'english');
			?>
			<ul class="breadcrumb">
				<li><a href="<?php echo site_url() . "/dashboard";?>"><?php echo $this->lang->line('dashboard_label')?></a> <span class="divider"></span></li>
				<li><?php echo $this->lang->line('feed_list_label')?></li>
			</ul>
			
			<div class='row'>
				<div class='col-sm-9'>
					<?php
					$attributes = array('class' => 'form-inline');
					echo form_open(site_url('feeds/search'), $attributes);
					?>
						<div class="form-group">

					   		<?php echo form_input(array(
					   			'name' => 'searchterm',
					   			'value' => '',
					   			'class' => 'form-control',
					   			'placeholder' => $this->lang->line('search_message'),
					   			'id' => ''
					   		)); ?>
					   		
					  	</div>
					  	<button type="submit" class="btn btn-default"><?php echo $this->lang->line('search_button')?></button>
					</form>
				</div>	
				
				<div class='col-sm-3'>
					<a href='<?php echo site_url('feeds/add');?>' class='btn btn-primary pull-right'><span class='glyphicon glyphicon-plus'></span> 
					<?php echo $this->lang->line('add_new_feed_button')?></a>
				</div>
			</div>
			
			<br/>
			
			<!-- Message -->
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success fade in">
					<?php echo $this->session->flashdata('success');?>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				</div>
			<?php elseif($this->session->flashdata('error')):?>
				<div class="alert alert-danger fade in">
					<?php echo $this->session->flashdata('error');?>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				</div>
			<?php endif;?>
			<div class="wrapper wrapper-content animated fadeInRight">
			<table class="table table-striped table-bordered">
				<tr>
					<th><?php echo $this->lang->line('no_label')?></th>
					<th><?php echo $this->lang->line('feed_title_label')?></th>
					
					<?php 
						if(!$this->session->userdata('is_shop_admin')) { 
							if(in_array('edit',$allowed_accesses)):?>
								<th><?php echo $this->lang->line('edit_label')?></th>
					<?php endif; } else {?>
								<th><?php echo $this->lang->line('edit_label')?></th>
					<?php } ?>
					
					<?php 
						if(!$this->session->userdata('is_shop_admin')) { 
							if(in_array('delete',$allowed_accesses)):?>
							<th><?php echo $this->lang->line('delete_label')?></th>
					<?php endif; } else { ?>
							<th><?php echo $this->lang->line('delete_label')?></th>
					<?php } ?>
					
					<?php 
						if(!$this->session->userdata('is_shop_admin')) { 
							if(in_array('publish',$allowed_accesses)):?>
								<th><?php echo $this->lang->line('publish_label')?></th>
					<?php endif; } else { ?>
								<th><?php echo $this->lang->line('publish_label')?></th>
					<?php } ?>
					
				</tr>
				<?php
					if(!$count=$this->uri->segment(3))
						$count = 0;
					if(isset($feeds) && count($feeds->result())>0):
						foreach($feeds->result() as $feed):					
				?>
						<tr>
							<td><?php echo ++$count;?></td>
							<td><?php echo $feed->title;?></td>
							
							<?php 
								if(!$this->session->userdata('is_shop_admin')) { 
									if(in_array('edit',$allowed_accesses)):?>
										<td><a href='<?php echo site_url("feeds/edit/".$feed->id);?>'><i class='glyphicon glyphicon-edit'></i></a></td>
							<?php endif; } else { ?>
										<td><a href='<?php echo site_url("feeds/edit/".$feed->id);?>'><i class='glyphicon glyphicon-edit'></i></a></td>
							<?php } ?>
							
							
							<?php 
								if(!$this->session->userdata('is_shop_admin')) { 
									if(in_array('delete',$allowed_accesses)):?>
									<td><a href='<?php echo site_url("feeds/delete/".$feed->id);?>'><i class='glyphicon glyphicon-trash'></i></a></td>
							<?php endif; } else {?>
									<td><a href='<?php echo site_url("feeds/delete/".$feed->id);?>'><i class='glyphicon glyphicon-trash'></i></a></td>
							<?php } ?>
							
							<?php 
								if(!$this->session->userdata('is_shop_admin')) { 
									if(in_array('publish',$allowed_accesses)):?>
										<td>
											<?php if($feed->status == 1):?>
											
												<button class="btn btn-sm btn-primary publish"   
													feedId='<?php echo $feed->id;?>'>Yes
												</button>
												
											<?php else:?>
											
												<button class="btn btn-sm btn-danger unpublish"
												feedId='<?php echo $feed->id;?>'>No</button>
											
											<?php endif;?>
										</td>
							<?php endif; } else {?>
										<td>
											<?php if($feed->status == 1):?>
											
												<button class="btn btn-sm btn-primary publish"   
													feedId='<?php echo $feed->id;?>'>Yes
												</button>
												
											<?php else:?>
											
												<button class="btn btn-sm btn-danger unpublish"
												feedId='<?php echo $feed->id;?>'>No</button>
											
											<?php endif;?>
										</td>
							<?php } ?>
						</tr>
						<?php
						endforeach;
					else:
				?>
						<tr>
							<td colspan='7'>
							<span class='glyphicon glyphicon-warning-sign menu-icon'></span>
							<?php echo $this->lang->line('no_sub_cat_data_message')?>
							</td>
						</tr>
				<?php
					endif;
				?>
			</table>
			</div>
			<?php 
				$this->pagination->initialize($pag);
				echo $this->pagination->create_links();
			?>
			<script>
			$(document).ready(function(){
				$(document).delegate('.publish','click',function(){
					
					var btn = $(this);
					var id = $(this).attr('feedId');
					
					$.ajax({
						url: '<?php echo site_url('feeds/publish');?>/'+id,
						method:'GET',
						success:function(msg){
							if(msg == 'true')
								btn.addClass('unpublish').addClass('btn-primary')
									.removeClass('publish').removeClass('btn-danger')
									.html('Yes');
							else
								alert('System error occured. Please contact your system administrator.');
						}
					});
				});
				
				$(document).delegate('.unpublish','click',function(){
					
					var btn = $(this);
					var id = $(this).attr('feedId');
					
					$.ajax({
						url: '<?php echo site_url('feeds/unpublish');?>/'+id,
						method:'GET',
						success:function(msg){
							if(msg == 'true')
								btn.addClass('publish').addClass('btn-danger')
									.removeClass('unpublish').removeClass('btn-primary')
									.html('No');
							else
								alert('System error occured. Please contact your system administrator.');
						}
					});
				});
			});
			</script>
			

