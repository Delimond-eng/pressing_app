<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2>Gestion utilisateurs</h2>
                </div>
                <div class="col-sm-6 col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="iconly-Home icli svg-color"></i></a></li>
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active">Gestion utilisateurs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <h3>Création utilisateurs</h3>
                    </div>
                    <div class="card-body">
                        <?php displayFlashMessage(); ?>
                        <form method="post" action="/create_user" class="stepper-one row g-3 d-flex align-items-end needs-validation custom-input">
                            <div class="col-6">
                                <label class="form-label">Nom d'utilisateur<span class="text-danger">*</span></label>
                                <input class="form-control" name="username" type="text" required placeholder="ex: Gaston">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mot de passe<span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="text" required placeholder="**************">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Role<span class="text-danger">*</span></label>
                                <select class="form-select" name="role" id="firstnamewizard">
                                    <option value="admin">Admin</option>
                                    <option value="caissier">Caissier</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <button id="btnAction" type="submit" class="btn btn-primary">Créer utilisateur</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h3>Liste des utilisateurs</h3>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom </th>
                                        <th>Role </th>
                                        <th>Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $u) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-shrink-0"><img src="assets/images/dashboard-1/user/1.png" alt=""></div>
                                                <div class="flex-grow-1">
                                                    <h6><?= $u["username"]?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $u["role"]?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                                <ul class="dropdown-menu dropdown-block"> 
                                                    <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                                    <li><a class="dropdown-item" href="#">Modifier</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>