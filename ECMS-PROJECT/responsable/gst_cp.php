<?php
  require_once("../control/config/dbcon.php");
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/sidebar.php");

  if (isset($_SESSION["current_session"])) {
    unset($_SESSION["current_session"]);
    $_SESSION["current_session"] = "responsable";
  }else {
    $_SESSION["current_session"] = "responsable";
  }

 ?>


<!-- =====================================                  contenus               ======================================= -->

<?php if (isset($_SESSION['switch_facp'])): ?>
<div id="idpcp" class="main hide">
  <?php elseif (isset($_SESSION['switch_fmdcp'])): ?>
  <div id="idpcp" class="main hide">
    <?php else: ?>
    <div id="idpcp" class="main show">
      <?php endif; ?>
      <!--                                                    breadcrumb                                                       -->
      <ul class="breadcrumb round-large">
        <li><a href="responsable.php"><?=$translations['home']?></a></li>
        <li>
          <?php echo $_SESSION['responsable_prom_name']; ?>
        </li>
      </ul>
      <hr class="rounded">


      <div class="container">
        <h1>Table des Réunions programmé</h1>
        <!-- <p><?=$translations['sort_table']?></p> -->

        <?php if (empty($_SESSION['responsable_prom_id'])): ?>
        <div class="panel yellow round-large">
          <h3>Attention!</h3>
          <p>Si vous n'avez pas été affecté à une promotion, vous n'êtes pas autorisé à ajouter un CP. Veuillez contacter l'administrateur pour demander cette action.</p>
        </div>
          <p><button id="activer_cp" class="button green hover-green round-large" <?php
              if(empty($_SESSION['responsable_prom_id'])) { ?> disabled
              <?php } ?> ><?=$translations['add_cp']?> <i class="fa fa-calendar"></i>
            </button>
          </p>
        <?php else: ?>
        <div class="cell-row">
          <div class="container cell">
            <p><button id="activer_cp" class="button green hover-green round-large"><?=$translations['add_cp']?> <i
                  class="fa fa-calendar"></i>
              </button></p>
          </div>
          <div class="container  cell">
          </div>
        </div>
        <?php endif; ?>



        <?php if (isset($_SESSION['message_success'])): ?>
        <div class="panel green display-container round-large">
          <span onclick="this.parentElement.style.display='none'" class="button large display-topright">&times;</span>
          <br>
          <p>
            <?php echo $_SESSION['message_success']; unset($_SESSION['message_success']);unset($_SESSION['message_type']); ?>
          </p>
        </div>
        <?php endif; ?>


        <div class="responsive">
          <table class="table-all hoverable" id="myTable_del">
            <tr>
              <th class="pntr" onclick="sortTable(0)">ID</th>
              <th class="pntr" onclick="sortTable(1)"><?=$translations['cp_title']?></th>
              <th class="pntr" onclick="sortTable(2)"><?=$translations['cp_datetime']?></th>
              <th class="pntr" onclick="sortTable(3)"><?=$translations['cp_location']?></th>
              <th class="pntr" onclick="sortTable(4)"><?=$translations['semester']?></th>
              <th class="pntr" onclick="sortTable(5)"><?=$translations['cp_agenda']?></th>
              <th class="pntr" onclick="sortTable(5)"><?=$translations['cp_details']?></th>
              <th class="pntr" onclick="sortTable(5)"><?=$translations['extra_info']?></th>
              <th class="pntr" onclick="sortTable(5)"><?=$translations['status']?>.</th>
              <th colspan="3"><?=$translations['action']?></th>
            </tr>

            <?php
                $id = $_SESSION['responsable_user_id'];
                $sql = "SELECT * FROM tbl_cp INNER JOIN tbl_promo ON tbl_cp.cp_prom_id = tbl_promo.prom_id AND tbl_promo.prom_resp_id = $id ORDER BY cp_datetime DESC";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_array($result)): ?>

                  <tr class="<?php echo $row['cp_status'] == '1' ? 'pale-green' : 'pale-red'; ?>">
                    <td><?= htmlspecialchars($row['cp_id']) ?></td>
                    <td><?= htmlspecialchars($row['cp_title']) ?></td>
                    <td><?= htmlspecialchars($row['cp_datetime']) ?></td>
                    <td><?= htmlspecialchars($row['cp_location']) ?></td>
                    <td><?= htmlspecialchars($row['cp_semestre']) ?></td>
                    <td><?= htmlspecialchars($row['cp_ordre']) ?></td>
                    <td><?= htmlspecialchars($row['cp_detail']) ?></td>
                    <td><?= htmlspecialchars($row['cp_intervension']) ?></td>
                    
                    <td><p class="round-xxlarge <?php echo $row['cp_status'] == '1' ? 'green' : 'red'; ?>"><?php echo $row['cp_status'] == '1' ? $translations['activated'] : $translations['desactivated']; ?></p></td>
                    <td>
                      <?php if ($row['cp_status'] == 1): ?>
                        <a class="button yellow hover-yellow round-large margin-right" href="activer_cp.php?desactiv_cp=<?= htmlspecialchars($row['cp_id']) ?>"> <?=$translations['desactivate']?> </a>
                      <?php elseif ($row['cp_status'] == 0): ?>
                        <a class="button blue round-large margin-right" href="activer_cp.php?activer_cp=<?= htmlspecialchars($row['cp_id']) ?>"> <?=$translations['activate']?> </a>
                      <?php endif; ?>
                    </td>
                    <td><a class="button green round-large" href="edit_cp.php?edit=<?= htmlspecialchars($row['cp_id']) ?>"><?=$translations['edit']?></a></td>
                    <td><button class="button red round-large btn_delet_cp" type="button"><?=$translations['delete']?></button></td>
                  </tr>
                  
                  <tr><td colspan="9" style="height: 10px;"></td></tr>';
                <?php endwhile; ?>

          </table>
        </div>
      </div>

    </div>


    <?php include("Form_activer_cp.php"); ?>
    <?php include("form_modifier_cp.php"); ?>
    <?php include("modal_delete_cp.php"); ?>

    <?php include("../modal_deconnexion.php"); ?>
    <?php include("includes/scripts.php"); ?>






    <script type="text/javascript">
      // Cache the elements to improve performance
      const page1 = document.getElementById('idpcp');
      const page2 = document.getElementById('idfacp');
      const page3 = document.getElementById('idfmdcp');
      const modal_del_cp = document.getElementById('iddcp');

      // Close the delete modal if clicked outside of it
      window.onclick = function (event) {
        if (event.target == modal_del_cp) {
          modal_del_cp.style.display = "none";
        }
      };

      // Set up event listeners for the buttons
      $('#activer_cp').click(function () {
        page1.classList.replace("show", "hide");
        page2.classList.replace("hide", "show");

        $.post("set_switch_page.php", { setfacp: 'ok' }, function (data, status) {
          // Handle the response as needed
        });
      });

      $('#programmer_cp').click(function () {
        page1.classList.replace("hide", "show");
        page2.classList.replace("show", "hide");

        $.post("set_switch_page.php", { setpcpprg: 'ok' }, function (data, status) {
          // Handle the response as needed
        });
      });

      $('#modifier_cp').click(function () {
        page1.classList.replace("hide", "show");
        page3.classList.replace("show", "hide");

        $.post("set_switch_page.php", { setpcpmdf: 'ok' }, function (data, status) {
          // Handle the response as needed
        });
      });

      $(".btn_delet_cp").click(function () {
        modal_del_cp.style.display = "block";

        // Get the ID of the CP to delete from the row
        const $tr = $(this).closest('tr');
        const cpId = $tr.find('td:eq(0)').text();

        console.log(cpId);

        $('#delete_cp_id').val(cpId);
      });


    </script>






    <?php
    if (isset($_SESSION['message'])) {
      unset($_SESSION['message']);
    }
  ?>
    </body>

    </html>