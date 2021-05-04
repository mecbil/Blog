<?php 

// if (count($_POST)>0) echo'<script language="Javascript"> alert ( "Adresse Mail ou Mot de passe incorrect" )</script>' ; ?>

<section class="conninscri text-light">
<div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 mt-2">

<!-- zone de connexion -->

    <div class="login-form" >
        <form action="index.php?controller=User&task=connect" method="post" >
            <h2 class ="text-center" > Connexion </h2>  
            <div class="form-group" >
                <input  type = "email" name = "email" class = "form-control" placeholder = "Email" required = "required" autocomplete = "off" >
            </div >
            <div  class = " form-group " >
                <input  type = "password" name = "password" class = "form-control" placeholder = "Password" required = "required" autocomplete = "off" >
            </div >
            <div  class = " form-group " >
                <button  type = "submit" class = "btn btn-warning text-light btn-block mt-2" > Connexion </button>
            </div >   
        </form >
    </div>
</div>

<!-- zone de d'enregistrement -->
<div class="text-light col-11 col-lg-5 col-md-9 col-sm-11 mt-2">

    <div  class="login-form" >
        <form  action="" method = "post" >
            <h2  class=" text-center " > Enregistrement </h2> 
            <div  class=" form-group " >
                <input  type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete = "off" >
            </div >      
            <div  class = "form-group" >
                <input  type="email" name="email" class ="form-control" placeholder="Email" required = "required" autocomplete = "off" >
            </div >
            <div  class = "form-group" >
                <input  type = "password" name = "password" class = "form-control" placeholder = "Password" required = "required" autocomplete = "off" >
            </div >
            <div  class = " form-group " >
                <button  type = " submit " class = "btn btn-warning text-light btn-block mt-2" > Enregistrer </button>
            </div >   
        </form >
    </div>
</div>