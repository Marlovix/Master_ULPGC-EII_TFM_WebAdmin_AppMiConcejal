<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{site}">
        <!--<img src="{logoPage}" />-->
        <h4 style="width: 198px;">AppMiConcejal</h4>
    </a>
</div>
<ul class="nav navbar-top-links navbar-right">
    <span class="alert alert-sm alert-info">{user_group}</span>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            {user_nav_actions}
            <li>
                <a href="{site}">
                    <i class="fa {icon} fa-fw"></i>&nbsp;{label}
                </a>
            </li>
            {/user_nav_actions}
        </ul>
    </li>
</ul>