<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="form" class="row">
    <?php
    echo form_open('rest/administrador_rest', array('role' => 'form', 'novalidate' => true), $hidden);
    ?>
    <div class="form-group {width_form_class}">
        {input_id_ayuntamiento}
    </div>
    <div class="form-group {width_form_class}">
        {input_buttons}
    </div>
    <?php echo form_close(); ?>
</div>
