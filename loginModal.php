<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel"><img src="image/svg/logo-no-background.svg" class="logoo">
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="handlelogin.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="loginEmail">Adresse Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail"
                            aria-describedby="emailHelp" placeholder="Entre votre email">
                        <small id="emailHelp" class="form-text text-muted">nous ne partagerons jamais votre adresse a
                            quelqu'un.</small>
                    </div>
                    <div class="form-group">
                        <label for="loginPass">Mot de Passe</label>
                        <input type="password" class="form-control" id="loginPass" name="loginPass"
                            placeholder="veuillez saisir votre mot de passe">
                    </div>

                    <button type="submit" class="btn mt-2 btn-primary">sousmettre</button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                </div>
            </form>

        </div>
    </div>
</div>