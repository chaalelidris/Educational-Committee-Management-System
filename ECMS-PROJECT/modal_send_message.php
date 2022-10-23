<!-- Modal that pops up when you click on "New Message" -->
<div id="idSendMessage" class="modal" style="z-index:4">
  <div class="modal-content animate-zoom">
    <div class="container padding blue">
       <span onclick="document.getElementById('idSendMessage').style.display='none'"
       class="button blue right large"><i class="fa fa-remove"></i></span>
      <h2>Envoyer un message</h2>
    </div>
    <div class="panel">
      <form class="" action="send.php" method="post">
        
        <input type="hidden" name="meid" value="<?php echo $useridme; ?>">
        <input type="hidden" name="toid" value="<?php echo $userid; ?>">

        <label>à</label>
        <input type="text" name="" value="<?php echo $rowuserdata['user_name']; ?>" disabled>

        <label>Sujet</label>
        <input name="subject" class="input border margin-bottom" type="text">

        <textarea class="input border margin-bottom" name="message" rows="8" cols="80" placeholder="Message" required></textarea>

        <div class="section">
          <a class="button red" onclick="document.getElementById('idSendMessage').style.display='none'">Annuler</i></a>
          <button class="button blue right"  name="send_message">Envoyer <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
