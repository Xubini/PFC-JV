<div class="container">
	<div class="row">
		<div style="margin: 0 auto; max-width:350px;">
			<h1>LOGIN</h1>
			
			<?php if(!isempty_array($var_errors)){?>
				<div class="error danger">
					<?php print_errors($var_errors)?>	
				</div>
			<?php }?>
			<form method="POST" action="<?php echo base_url("login")?>">
				<div class="form-group required" >
					<label for="user">Email</label> 
					<input type="email" name="user" value="<?php echo $var_user?>" class="form-control" id="email" required>
				</div>
				<div class="form-group required	 ">
					<label for="pwd">Password</label>
					<input type="password" name="password" class="form-control" id="pwd" required>
				</div>
				<div class="form-group">
					<label for="user_type">Tipo de usuario</label>
					<select class="form-control" name="user_type" id="user_type" required>
					   <option value="S" <?php echo $var_user_type=='S' ? "selected" :'' ?>>SuperAdmin</option> 
					   <option value="A"<?php echo $var_user_type == 'A' ?  "selected" :''   ?>>AdminGrupo</option> 
					   <option value="P"<?php echo $var_user_type=='P' ?  "selected" :''  ?>>Propietario</option>
					   <option value="E"<?php echo $var_user_type=='E' ? "selected":'' ?>>Empleado</option> 
					</select>
				</div>
				<div class="checkbox">
					<label><input type="checkbox"> Recordarme</label>
				</div>
				<button type="submit" class="btn btn-success">Acceder</button>
				
			</form>
		</div>
	</div>
</div>