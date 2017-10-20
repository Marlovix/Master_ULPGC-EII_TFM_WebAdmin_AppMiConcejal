<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="form" class="row">
    <?php
    echo form_open('rest/user_rest', array('role' => 'form', 'novalidate' => true), $hidden);
    ?>
    <div class="form-group {width_form_class}">
        {input_id_administracion}
    </div>
    <div class="form-group {width_form_class}">
        {input_nombre}
    </div>
    <div class="form-group {width_form_class}">
        {input_apellidos}
    </div>
    <div class="form-group {width_form_class}">
        {input_email}
    </div>
    <div class="form-group {width_form_class}">
        {input_telefono}
    </div>
    <div class="form-group {width_form_class}">
        {input_perfil}
    </div>
    <div class="form-group {width_form_class}">
        {input_creacion}
    </div>
    <div class="form-group {width_form_class}">
        {input_ultimo_acceso}
    </div>
    <div class="form-group {width_form_class}">
        {input_password}
    </div>
    <div class="form-group {width_form_class}">
        {input_repeat_password}
    </div>
    <div class="form-group {width_form_class}">
        {input_state}
    </div>
    <div class="form-group {width_form_class}">
        {input_buttons}
    </div>
    <?php echo form_close(); ?>
</div>
