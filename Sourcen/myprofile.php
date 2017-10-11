<?php

    // Authenticate user
    include_once './administration/authenticateUser.php';

    // Controller
    include_once './controller/myProfileController.php';

    // Userinterface
    include_once './class/userInterface.php';
    $userInterface = new UserInterface($myUser,'myProfile');
    $userInterface->renderHeader();

?>

    <!-- Wrapper -->
    <div class="container-fluid" id="wrapper">

        <div class="row justify-content-center">

            <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6">
        
                <?= $myprofileController->getMessages(); ?>

                <div class="jumbotron">
                    
                    <h1 class="display-3 h1">Mein Profil</h1>

                    <hr>

                    <label>Username: <?= $myprofileController->getUsername(); ?></label>

                    <hr>

                    <form action="myProfile.php" method="post">

                        <h2 class="display-3 h2">E-Mail ändern</h2>

                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                            <input type="email" class="form-control" id="myprofile-email" name="myprofile-email" placeholder="E-Mail" value="<?= $myprofileController->getEmail(); ?>">
                        </div>

                        <hr>

                        <h2 class="display-3 h2">Passwort ändern</h2>

                        <input type="password" class="form-control" id="myprofile-oldpassword" name="myprofile-oldpassword" placeholder="Altes Passwort">

                        <input type="password" class="form-control" id="myprofile-newpassword" name="myprofile-newpassword" placeholder="Neues Passwort">

                        <input type="password" class="form-control" id="myprofile-passwordconfirm" name="myprofile-passwordconfirm" placeholder="Passwort bestätigen">

                        <center><button type="submit" class="btn btn-primary">Speichern</button></center>

                    </form>

                </div>
            
            </div>

        </div>
    
    </div>

<?php
    $userInterface->renderFooter();
?>