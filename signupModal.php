<!-- Modal -->
<div class="modal fade" id="signupModal" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel"><img src="image/svg/logo-no-background.svg" class="logoo">
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>



      <form action="handlesignup.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputname">Nom Complet</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Moussa Gouba">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp"
              placeholder="Entre votre email">
            <small id="emailHelp" class="form-text text-muted">nous ne partagerons jamais votre adresse a
              quelqu'un.</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword"
              placeholder="Ex. abcd@1234">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirmer votre Mot de passe</label>
            <input type="password" class="form-control" id="cPassword" name="cPassword" placeholder="Confirm Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">se souvenir de moi</label>
          </div>
          <button type="submit" class="btn btn-warning">sousmettre</button>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>

        </div>
      </form>

    </div>
  </div>
</div>