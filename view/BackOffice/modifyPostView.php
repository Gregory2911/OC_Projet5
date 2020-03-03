<div class="modal" id="connexion">
  		<div class="modal-dialog"> <!--Intégration du formulaire-->
    		<div class="modal-content">
      			<div class="modal-header">							        
        			<h4 class="modal-title">Connexion</h4>
        			<button type="button" class="close" data-dismiss="modal">x</button>
      			</div>
     			<div class="modal-body">
        			<form method="post" action="connexion/connexion">
        				<p>
	        				<label class="" for="login">login : </label>
	        				<input type="text" name="login" id="login" placeholder="login"/>
						</p>					        
	        			<p>
	        				<label class="" for="password">Mot de passe : </label>
        					<input type="text" name="password" id="password" placeholder="mot de passe"/>
						</p>			    
        				<p>
    						<input type="submit" value="Connexion">
        				</p>        					
       				</form>
       				<button data-toggle="modal" href="#inscription" class="btn btn-primary inscription" id="suivant">Inscription</button>       				
	      		</div>
	    	</div>
	  	</div>
	 </div>