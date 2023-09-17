<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta tags-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    
    <!-- Bootstrap CSS files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <!-- Prism.js CSS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/themes/prism.min.css" integrity="sha384-PQRVhcIuoDbD2sVE+seIbyc6CzUw30zLYhlaJJt0Vw7Zyl7XfunpkeCANaW5A+XZ" crossorigin="anonymous">
    <!-- Custom CSS files -->
    <style>
        /* Sticky footer styles
        -------------------------------------------------- */
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px; /* Margin bottom by footer height */
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Set the fixed height of the footer here */
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }
    </style>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Bootstrap JS files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <title>Multi-URL</title>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #003399;">
        <div class="container">
            <a class="navbar-brand" href="https://multiurl.sftg.io">Multi-URL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <script src="https://scripts.gunner.online/themeswitcher.js"></script>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mt-3"><?php echo $title ?></h1>
                <p class="lead">Share this page: <?php echo '<a href="#" id="currenturl" class="copybtn" data-clipboard-target="#currenturl">https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'</a>';?> 
                <button class="btn copybtn" data-clipboard-target="#currenturl">
                    <i class="fas fa-copy"></i>
                </button>
                </p>
                <?php
                foreach ($links as $link=>$title){
                    if ($title == ""){
                        $title = $link;
                    }
                    echo '<a href="'.$link.'" target="_blank">'.$title.' <i class="fas fa-external-link-alt"></i></a><br>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script>

        $('.copybtn').tooltip({
  trigger: 'click',
  placement: 'bottom'
});

function setTooltip(message) {
  $('.copybtn').tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
}

function hideTooltip() {
  setTimeout(function() {
    $('.copybtn').tooltip('hide');
  }, 1000);
}

        var clipboard = new ClipboardJS('.copybtn');

        clipboard.on('success', function(e) {
  setTooltip('Copied!');
  hideTooltip();
});

clipboard.on('error', function(e) {
  setTooltip('Failed!');
  hideTooltip();
});
        </script>
    <footer class="footer">
            <div class="container">
                <span class="text-muted"><a href="LICENSE" class="text-secondary">MIT License</a> | <a href="https://github.com/sftgunner/Multi-URL" class="text-secondary">View Source</a> | Sebastian Gunner (<a href="https://github.com/sftgunner">@sftgunner</a>)</span>
            </div>
        </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
</body>
</html>
