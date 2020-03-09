<div class="container" id="formContact">

    <div class="jumbotron text-center" id="FormContactTitle">
        <div class="container">
            <h1 class="jumbotron-heading">FORMULAIRE DE CONTACT</h1>       
        </div>
    </div>
    
    <div class="row" id="formContact">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">Me contacter</div>
                    <div class="card-body">
                        <form action="contact/sendEmail" method="post">
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

                            <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Envoyer</button></div>
                        </form>
                    </div>
                </div>
            </div>
     </div>
 
</div>