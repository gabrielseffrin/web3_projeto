<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('');
        height: 300px;
        "></div>
  <!-- Background image -->
<div class="row">
  <div class="col-4">
  </div>
  <div class="col-4">
  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Login</h2>
          <form method="POST" action="<?= URL_RAIZ . 'login'?>">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email"id="email" class="form-control" />
              <label class="form-label" for="email">Email</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="password" name="senha"class="form-control" />
              <label class="form-label" for="password">Password</label>
            </div>

            <div class="form-group has-error text-center">
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
              Logar
            </button>

            <p class="text-center">
            <a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
            </p>
            
          </form>
        </div>
      </div>
    </div>
    </div>
</div>
</div>
</section>