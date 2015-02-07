<?php 
    $voyage_id = $_GET['voyage_id'];
?>

<div class="general_voyage">
    <div class="etapes form">
        <h3><?php echo __("Ajouter une étape"); ?></h3>

        <?php echo $this->Form->create('Etape', array('action' => 'add')); ?>
        <fieldset>
            <?php 
            	$user_id = $this->session->read('Auth.User.user_id');

            	echo $this->Form->input('etape_name', array('label'=>'Nom de l\'étape'));
            	echo $this->Form->input('voyage_id',
            		array('type' => 'hidden', 'default' => $voyage_id));
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
            	echo $this->Form->input('createur_id',
            		array('type' => 'hidden', 'default' => $user_id));
                echo $this->Form->input('voyage_id',
                    array('type'=>'hidden', 'default'=>$voyage_id));
        	?>
        </fieldset>
    <?php echo $this->Form->end(__('Ajouter')); ?>
    </div>
    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
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
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'etape_selected' => 0
    ));
?>