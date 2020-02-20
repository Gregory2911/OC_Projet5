<div class="container">

    <!--<?php if($message) :?>
        <?php echo $message; ?>
    <?php endif;?>-->

<section class="jumbotron text-center" id="formContact">
    <div class="container">
        <h1 class="jumbotron-heading">PAGE CONTACT</h1>
        <p class="lead text-muted mb-0">Page Contact de mon Blog</p>
    </div>
</section>

    
    <div class="row" id="formContact">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Me contacter
                    </div>
                    <div class="card-body">
                        <form action="./?action=contact.postEmail" method="POST">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" name="name" id="name" value="" placeholder="Votre nom">
                            </div>
                            <div class="form-group">
                                <label for="email">Courriel</label>
                                <input type="text" class="form-control" name="email" id="email" value="" placeholder="Votre courriel">

                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Votre message"></textarea>
                            </div>

                            <div class="form-group">
                                <!--<div class="g-recaptcha" data-sitekey="<?php echo CLEF_CLIENT; ?>"></div>-->
                            </div>

                            <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Envoyer</button></div>
                        </form>
                    </div>
                </div>
            </div>
     </div>
 
</div>