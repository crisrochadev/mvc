<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="<?= ASSETS ?>/img/logo.png" alt="">
                            <span class="d-none d-lg-block">VidaraWebsites</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Entrar na sua Conta</h5>
                                <p class="text-center small">Digite seu nome de usuário e senha para entrar</p>
                            </div>

                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>

                            <form class="row g-3" id="form-login" method="POST" action="<?= URL ?>/auth">
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nome de usuário</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="username" id="username" class="form-control" id="yourUsername" required>
                                        <div class="invalid-feedback">Por favor digite seu nome de usuário.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Senha</label>
                                    <div class="input-group has-validation">
                                        <input id="password" type="password" name="password" class="form-control" id="yourPassword" required>
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-pass">Mostrar</button>
                                        <div class="invalid-feedback">Por favor digite sua senha!</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <p class="small mb-0">Esqueceu a senha? <a href="pages-register.html">Recuperar</a></p>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Manter conectado</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

