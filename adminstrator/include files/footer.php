<?php

     if(isset($_GET['update'])){
      ?>
<input type="hidden" class = "hidden" value="1">
      <?php
     }
     ?> 
     <?php
     if(isset($_GET['delete'])){
      ?>
<input type="hidden" class = "hidden" value="2">
      <?php
     }
     ?> 
     <?php
     if(isset($_GET['add'])){
      ?>
<input type="hidden" class = "hidden" value="3">
      <?php
     }
     ?> 

<script src="./assets/js/bootstrap.bundle.js"></script>
    <script src="./assets/js/jquery-3.6.1.min.js"></script>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js "></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
 <script src="./assets/js/script.js"></script>
</body>
</html>