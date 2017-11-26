<?php //$title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
    <div class="container">
      <img class="img-fluid mb-5 d-block mx-auto" src="img/profile.png" alt="">
      <h1 class="text-uppercase mb-0">Eric Codron</h1>
      <hr class="star-light">
      <h2 class="font-weight-light mb-0">Développeur Web, entrepreneur et rêveur à temps plein...</h2>
    </div>
    <div class="text-center mt-4" id="download-button">
      <a class="btn btn-xl btn-outline-light" href="download/CV_Eric_Codron.pdf" target="_blank">
        <i class="fa fa-download mr-2"></i>
        Téléchargez mon CV !
      </a>
    </div>
</header>

  <!-- Last posts Section -->
  <section class="bg-tertiary" id="last-posts">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0">Dernières publications</h2>
      <hr class="star-dark mb-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">
        <?php
          while ($data = $posts->fetch())
          {
          ?>
              <div class="news">
                  <h3>
                      <?= htmlspecialchars($data['title']) ?>
                      <em class="post-date">le <?= $data['last_modif_date_fr'] ?></em>
                  </h3>
                  
                  <p>
                      <?= nl2br(htmlspecialchars($data['intro'])) ?> <a href="index.php?action=post&id=<?= $data['id'] ?>">(voir plus)</a>
                      <br />
                  </p>
              </div>
          <?php
          }
          $posts->closeCursor();
        ?>
        </div>
      </div>
      <br>
      <h3 class="text-center">
        <a href="index.php?action=listPosts" target="_blank">Voir tous les billets</a>
      </h3>
    </div>
  </section>

  <!-- About Section -->
  <section class="bg-primary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">About</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
          </div>
        </div>
        <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="#">
            <i class="fa fa-download mr-2"></i>
            Download Now!
          </a>
        </div>
      </div>
    </section>
    
  <!-- Contact Section -->
  <section id="contact">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0">Contactez-moi</h2>
      <hr class="star-dark mb-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
          <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
          <form name="sentMessage" id="contactForm" novalidate="novalidate">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Nom</label>
                <input class="form-control" id="firstname" type="text" placeholder="Non" required="required" data-validation-required-message="Please enter your name.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Phone Number</label>
                <input class="form-control" id="lastname" type="text" placeholder="Prénom" required="required" data-validation-required-message="Please enter your phone number.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Email Address</label>
                <input class="form-control" id="email" type="email" placeholder="Adresse e-mail" required="required" data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Message</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Envoyer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
