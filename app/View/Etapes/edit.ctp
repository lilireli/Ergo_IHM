<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Modifier une étape
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<?php 
    $voyage_id = $_GET['voyage_id'];
    $etape_name = $_GET['etape_name'];
    $etape_id = strtok(basename($this->here), '%3F');

    $base_url = '?voyage_id='.$voyage_id.'&etape_name='.$etape_name;
?>

<div class="general_voyage">
    <div>
        <div>
            <h2><?php echo __('Etape '.ucfirst(strtolower($etape_name))); ?><h2>
        </div>
        <div class="actions" id="top_left_etape">
            <ul>
                <li>
            <?php
                echo $this->Html->link(__('Retourner au voyage'), 
                    array(
                        'controller' => 'voyages',
                        'action' => 'view',
                        $voyage_id
                    )); 
            ?>
                </li>
            </ul>
        </div>
    </div>

    <?php
        // afficher les onglets
        echo $this->element('menu_etape', array('base_url' => $etape_id.$base_url, 'tab' => 0));
    ?>

    <div class="form">
        <h3><?php echo __("Modifier l'étape"); ?></h3>

        <?php echo $this->Form->create('Etape'); ?>
        <fieldset>
            <?php 
            	echo $this->Form->input('etape_name', array('label'=>'Nom de l\'étape'));
            ?>
                
            <div>
                <div class='float'>
                    <h5>Du</h5>
                    <?php echo $this->datePicker->flat('Etape][date_debut');?>
                </div>
                <div class='float'>
                    <h5>Au</h5>
                    <?php echo $this->datePicker->flat('Etape][date_fin');?>
                </div>
                <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
            </div>

            <?php
                echo $this->Form->input('url',
                    array('type'=>'hidden', 'default'=>$base_url));
                echo $this->Form->input('etape_id');
        	?>
        </fieldset>
        <?php echo $this->Form->end(__('Modifier')); ?>
    </div>

    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li>
                <?php 
                    echo $this->Html->link(__('Retourner à l\'étape'), 
                        array('action' => 'index', $etape_id.$base_url)); 
                ?> 
            </li>
        </ul>
    </div>
</div>

<?php
    // afficher la frise
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id
    ));
?>

<script>
    // selectionner l'étape
    $('#etape<?php echo __($etape_id); ?>').addClass("etape_selected");
</script>