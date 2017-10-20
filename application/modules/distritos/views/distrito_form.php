<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="form" class="row">
    <?php
    echo form_open('rest/distrito_rest', array('role' => 'form', 'novalidate' => true), $hidden);
    ?>
    <div class="form-group {width_form_class}">
        {input_id_distrito}
    </div>
    <div class="form-group {width_form_class}">
        {input_distrito}
    </div>
    <div class="form-group {width_form_class}">
        {input_buttons}
    </div>
    <?php echo form_close(); ?>
</div>
