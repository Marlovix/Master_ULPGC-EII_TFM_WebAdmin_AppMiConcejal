<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading center_img">
                <h3 class="panel-title">
                    <!--<img src="{logoPage}" />-->
                    <h3 style="width: 100%;">AppMiConcejal</h3>
                </h3>
            </div>
            <div class="panel-body">
                <?php
                $message = '';
                if ($this->session->flashdata('message') != '') {
                    $message = $this->session->flashdata('message');
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $message; ?>
                    </div>
                    <?php
                }
                echo form_open('auth/login', array('role' => 'form'));
                ?>
                <fieldset>
                    <div class="form-group">
                        <?php
                        $data_identity = array(
                            'name' => 'identity',
                            'id' => 'identity',
                            'class' => 'form-control',
                            'placeholder' => 'Correo electrónico'
                        );
                        echo form_input('identity', '', $data_identity);
                        echo form_error('identity', '<div class="alert alert-sm alert-danger">', '</div>');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $data_password = array(
                            'name' => 'password',
                            'id' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Contraseña'
                        );
                        echo form_password('password', '', $data_password);
                        echo form_error('password', '<div class="alert alert-sm alert-danger">', '</div>');
                        ?>
                    </div>
                    <?php echo form_submit('submit', 'Acceder', 'class="btn btn-success btn-lg btn-block"'); ?>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>