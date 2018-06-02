<div class="form-group">
	<select class="form-control dynamic-select chosen-select" id="<?php echo $data['loc_id']; ?>" name="<?php echo $data['loc_id']; ?>" title="Будь ласка, оберіть <?php echo $data['loc_name']; ?>" required>
    	<option value="" selected disabled>Оберіть <?php echo $loc_name; ?>...</option>
    	<?php 
    		if (isset($data['res_arr'])) {
    			foreach ($data['res_arr'] as $ter) {
	    			echo '<option value="'.$ter['ter_id'].'">'.$ter['ter_name'].'</option>';
	    		}
    		}
    	?>
    </select>
    <script> $('.chosen-select').chosen({ width: '100%', height: '40px' }); </script>
</div>