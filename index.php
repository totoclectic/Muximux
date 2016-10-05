<?php
error_reporting (E_ALL ^ E_NOTICE); /* Turn off notice errors */
require 'muximux.php';
?><!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Muximux - Application Management Console">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URLADDR;?>images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo URLADDR;?>images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo URLADDR;?>images/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo URLADDR;?>images/favicon/manifest.json">
    <link rel="mask-icon" href="<?php echo URLADDR;?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff"> 
    <link rel="stylesheet" type="text/css" href="<?php echo URLADDR;?>css/cssreset.min.css"> <!-- Yahoo YUI HTML5 CSS reset -->
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/bootstrap.min.css"> <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/bootstrap-iconpicker.min.css"/>
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/font-pt_sans.css"> <!-- Font -->
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/style.css"> <!-- Resource style -->
    <link rel="stylesheet" href="<?php echo URLADDR;?>css/jquery-ui.min.css">
    <script src="<?php echo URLADDR;?>js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <title><?php echo getTitle(); ?></title>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="cd-tabs">
    <?php echo menuItems(); ?>

    <ul class="cd-tabs-content">
        <div class="constrain">
            <?php echo frameContent(); ?>
        </div>
    </ul>
</div>
<!-- Modal -->
<div id="settingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title"><h1>Settings</h1></div>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="Buttons" id="topButtons">
                        <a class="btn btn-primary" id="showInstructions"><span class="fa fa-book"></span> Show Instructions</a>
                        <a class="btn btn-primary" id="showChangelog"><span class="fa fa-github"></span> Show Updates</a>
                    </div>
                </div>

                <div id="instructionsContainer" class="alert alert-info">
                    <h3>Instructions</h3>
                    <p>The order that you put these blocks in determine in what order they will be listed in the
                        menu.<br>
                        Enable or disable each block and edit the URL to point to your desired location.<br/><br/></p>
                    <h3>Bookmarking apps contained within Muximux</h3>
                    <p>If you want to go directly to a specific app within Muximux you can use hashes (<code>#</code>) in the URL.
                        For instance, if you have an app called "My app" you could use:<br/>
                        <code><script>document.write(location.href.replace(location.hash,""))</script>#My app</code><br/><br/>
                        This is great for when you want to bookmark specific services contained within Muximux.<br/>
                        Please note that the hashname should be the exact same as the <code>Name</code> you have configured in the settings below.<br/>
                        If you need to, you can replace spaces with underscores (i.e <code>#My_app</code>).
                        <br/><br/></p>
                    <h3>Running Muximux from SSL-enabled / HTTPS server</h3>
                    <p>Please note that if Muximux is served via HTTPS, any services that are NOT served via HTTPS might
                        be blocked by your web-browser.<br><br>
                        Loading of unsecured content in the context of an SSL encrypted website where you see a green
                        lock would be misleading, therefore the browser blocks it.<br>
                        One work-around is to serve Muximux via an unsecured website, or to make sure all the
                        services/urls you link to use https://</p>

                    <p>Alternatively, if you use Chrome or Opera (or any Chromium-based browser), you can install
                        the plugin "Ignore X-Frame headers", which<br>
                        drops X-Frame-Options and Content-Security-Policy HTTP response headers, allowing ALL pages to
                        be
                        iframed (like we're doing in Muximux).</p>

                    <p>See:
                        <a href="https://chrome.google.com/webstore/detail/ignore-x-frame-headers/gleekbfjekiniecknbkamfmkohkpodhe"
                           target="_blank">https://chrome.google.com/webstore/detail/ignore-x-frame-headers/gleekbfjekiniecknbkamfmkohkpodhe</a>
                    </p>

                    <p>See <a href="https://github.com/mescon/Muximux/" target="_blank">https://github.com/mescon/Muximux/</a>
                        for more information.</p>

                </div>
                <div id="changelogContainer" class="alert alert-warning">
                    <h3>Updates</h3>
                    <div id="changelog"></div>
                </div>
                <div id="backupiniContainer" class="alert alert-warning">
                    <h3>backup.ini.php Contents</h3>
                    <div class="text-center">
                        <a class="btn btn-danger" id="removeBackup"><span class="fa fa-trash"></span> Remove backup.ini.php</a>
                    </div>
                    <hr/>
                    <div id="backupContents"><pre><?php if (file_exists('backup.ini.php')) echo htmlentities(file_get_contents('backup.ini.php')); ?></pre></div>
                </div>

                <?php echo parse_ini(); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type='button' class="btn btn-primary" id='settingsSubmit' value='Submit Changes'>Save and Reload
            </button>
        </div>
    </div>
</div>
<div id="upgradeModal" class="modal fade" role="dialog">
    <div class="modal-dialog upgradeDialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title"><h1>Update Notification</h1></div>
            </div>
            <div class="modal-body upgradeBody">
                <div class="alert alert-info">
                    There has been an update. We removed <code>config.ini.php</code> and copied it into <code>backup.ini.php</code>
                    This is the last time we will have to do this kind of change.
                    This is due to the fact that we made major changes to the config.ini.php
                    and it is now called settings.ini.php. Do not copy your old config into
                    the new settings.ini.php. It needs to be written by the settings menu that
                    can be now be found in the dropdown in the top right. Thank you for your understanding.
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type='button' class="btn btn-primary" data-dismiss="modal">Okay</button>
        </div>
    </div>
</div>
<div id="updateContainer"></div>

<script src="<?php echo URLADDR;?>js/jquery-2.2.0.min.js"></script>
<script src="<?php echo URLADDR;?>js/jquery-ui.min.js"></script>
<script src="<?php echo URLADDR;?>js/jquery.form.min.js"></script>
<script src="<?php echo URLADDR;?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URLADDR;?>js/iconset-fontawesome-4.2.0.min.js"></script>
<script type="text/javascript" src="<?php echo URLADDR;?>js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="<?php echo URLADDR;?>js/main.js"></script>
<script type="text/javascript" src="<?php echo URLADDR;?>js/functions.js"></script>
<?php if ($upgrade) echo "<script type=\"text/javascript\">$('#upgradeModal').modal();</script>"; ?>
<?php
$config = new Config_Lite(CONFIG);
if ($config->get('general', 'updatepopup', 'false') == "true") {
    echo "<script type=\"text/javascript\">$(document).ready(function ($) { var updateCheck = setInterval(updateBox(),1000); })</script>";
}
?>
<meta id='gitData'>
<meta id='secret'>
<meta id='branch'>
</body>
</html>
