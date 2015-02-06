<?php 
    $voyage_id = $_GET['voyage_id'];
    $days = $_GET['days'];
    $date_debut = $_GET['date_debut'];

    $base_url = '?voyage_id='.$voyage_id.'&days='.$days.'&date_debut='.$date_debut;
?>

<div class="etapes form">
    <h3><?php echo __("Modifier l'étape"); ?></h3>

    <?php echo $this->Form->create('Etape'); ?>
    <fieldset>
        <?php 
        	echo $this->Form->input('etape_name');
        	echo $this->Form->input('date_debut');
        	echo $this->Form->input('date_fin');
            echo $this->Form->input('url',
                array('type'=>'hidden', 'default'=>$base_url));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Modifier')); ?>
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'days' => $days,
        'date_debut' => $date_debut,
        'etape_selected' => 0
    ));
?>