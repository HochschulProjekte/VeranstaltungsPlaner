<!DOCTYPE html>
<html lang="en">

  <!-- HEAD -->
  <head>
    <!-- Title -->
    <title>Installation</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS Includes -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/install.css">
  </head>

  <!-- BODY -->
  <body>

    <!-- Wrapper -->
    <div class="container-fluid">

      <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-6 col-xl-6">

          <!-- Installation-Card -->
          <div id="install-card">

            <h1>Veranstaltungsplaner</h1>

            <hr>

            <!-- Installation Form -->
            <form id="install-form" action="./installDatabase.php" method="post">

              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                <input type="text" class="form-control" id="install-hostname" name="install-hostname" placeholder="Hostname">
              </div>

              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-database"></i></div>
                <input type="text" class="form-control" id="install-database" name="install-database" placeholder="Database">
              </div>

              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control" id="install-username" name="install-username" placeholder="Username">
              </div>

              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                <input type="text" class="form-control" id="install-password" name="install-password" placeholder="Passwort">
              </div>

              <button type="submit" id="login-btn" class="btn btn-primary">Installieren</button>

            </form>

          </div>
        
        </div>

      </div>

    </div>

    <!-- Javascript Includes -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  </body>

</html>