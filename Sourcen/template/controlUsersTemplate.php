<!-- Autoren: Matthias Fischer, Fabian Hagengers, Jonathan Hermsen -->

<!-- Wrapper -->
<div class="container-fluid" id="wrapper">

    <!-- Table showing users -->
    <div class="row users">
        <!-- Message -->
        <div class="col-12">
            <div id="edit-message" class="alert alert-danger" role="alert"></div>
        </div>
        <!-- Table -->
        <table class="table table-responsive">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>
                    <center>Sachbearbeiter</center>
                </th>
                <th>E-Mail</th>
            </tr>
            </thead>
            <tbody id="tbody-users"></tbody>
        </table>
    </div>

    <!-- Form for adding a new user -->
    <div class="row add-user">

        <!-- Heading -->
        <div class="col-12">
            <h4>Nutzer hinzufügen</h4>
        </div>

        <!-- Message -->
        <div class="col-12">
            <div id="new-message" class="alert alert-danger" role="alert"></div>
        </div>

        <!-- Name -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
            <input type="text" class="form-control" name="new-name" id="new-name" maxlength="12" placeholder="Name">
        </div>

        <!-- Password -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
            <input type="password" class="form-control" name="new-password" id="new-password" maxlength="45"
                   placeholder="Passwort">
        </div>

        <!-- Confirm Password -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2">
            <input type="password" class="form-control" name="new-password-confirm" id="new-password-confirm"
                   maxlength="45" placeholder="Passwort bestätigen">
        </div>

        <!-- personnal Manager -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-2 col-xl-2">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="new-personnal-manager"
                           id="new-personnal-manager" value="yes"> Sachbearbeiter
                </label>
            </div>
        </div>

        <!-- E-Mail -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-4">
            <input type="email" class="form-control" name="new-email" id="new-email" maxlength="45"
                   placeholder="E-Mail (optional)">
        </div>

        <!-- Submit -->
        <div class="col-12">
            <center><a class="btn btn-danger" id="new-submit" href="#" role="button">Speichern</a></center>
        </div>

    </div>

</div>
