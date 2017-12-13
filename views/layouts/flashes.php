<?php if(Yii::$app->session->getAllFlashes()):?>
<div id="flashes" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">СООБЩЕНИЕ СИСТЕМЫ</h4>
      </div>
      <div class="modal-body">
        <?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
            <div class="alert alert-<?= $type ?> text-center text-uppercase" role="alert"><?= $messages ?></div>
        <?php endforeach ?>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
<script type="text/javascript">$('#flashes').modal('show');</script>
<?endif?>

