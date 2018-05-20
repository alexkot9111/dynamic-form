<?php 
switch ($data['ter_type']) {
    case '1':
        $new_ter_type = 3;
        $new_ter_level = 3;
        $loc_id = 'city';
        $loc_name = 'місто';
        break;

    case '3':
        $new_ter_type = 0;
        $new_ter_level = 0;
        $loc_id = 'territory';
        $loc_name = 'район';
        break;
}
?>
<div class="form-group">
	<select class="form-control dynamic-select" id="<?php echo $loc_id; ?>" name="<?php echo $loc_id; ?>" title="Будь ласка, оберіть <?php echo $loc_name; ?>" data-ter_type="<?php echo $new_ter_type; ?>" data-ter_level="<?php echo $new_ter_level; ?>" required>
    	<option value="" selected disabled>Оберіть <?php echo $loc_name; ?>...</option>
    	<?php 
    		if (isset($data['select_info'])) {
    			foreach ($data['select_info'] as $ter) {
	    			echo '<option value="'.$ter['ter_id'].'">'.$ter['ter_name'].'</option>';
	    		}
    		}else{
    			echo '<option value="'.$data['ter_pid'].'">В межах міста</option>';
    		}
    	?>
    </select>
</div>