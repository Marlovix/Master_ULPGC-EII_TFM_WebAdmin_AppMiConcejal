<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="form" class="row">
    <?php echo form_open_multipart('rest/partido_politico_rest', array('role' => 'form', 'novalidate' => true)); ?>
    <div class="form-group {width_form_class}">
        {input_id_partido_politico}
    </div>
    <div class="form-group {width_form_class}">
        {input_partido_politico}
    </div>
    <div class="form-group {width_form_class}">
        {input_acronimo}
    </div>
    <div class="form-group {width_form_class}">
        {input_logotipo}
    </div>
    <div class="form-group {width_form_class}">
        {input_color}
    </div>
    <div class="form-group {width_form_class}">
        {input_buttons}
    </div>
    <?php echo form_close(); ?>
</div>
