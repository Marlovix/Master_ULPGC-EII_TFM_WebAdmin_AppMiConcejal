<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
    {header}
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <header>
                    {navigation}
                </header>
                <aside>
                    <div class="navbar-default sidebar" role="navigation">
                        {sidebar}
                    </div>
                </aside>
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>
                            <i class = "{iconPage}"></i>&nbsp;
                            {titlePage}
                        </h3>
                        <h4>
                        </h4>
                    </div>
                    <div class="col-xs-4">
                        <h3>
                            {backButton}
                        </h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        {contentView}
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay">
            <div>
                <i class="fa fa-gear fa-spin fa-3x fa-fw"></i>
            </div>
        </div>
        {footer}
    </body>
</html>