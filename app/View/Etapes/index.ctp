<?php $etape_id = $etape; ?>

<?php echo $this->element('transport',  array('etape_id' => $etape_id)); ?>

<?php echo $this->element('hebergement',  array('etape_id' => $etape_id)); ?>

<?php echo $this->element('activite',  array('etape_id' => $etape_id)); ?>