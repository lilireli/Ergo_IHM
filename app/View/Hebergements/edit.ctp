<?php 
    $voyage_id = $_GET['voyage_id'];
    $etape_name = $_GET['etape_name'];
    $etape_id = $_GET['etape_id'];

    $hebergement_id = strtok(basename($this->here), '%3F');

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
        echo $this->element('menu_etape', array('base_url' => $etape_id.$base_url, 'tab' => 1));
    ?>

    <div class="form">
        <h3><?php echo __("Modifier l'hébergement"); ?></h3>

        <?php echo $this->Form->create('Hebergement'); ?>
        <fieldset>
            <?php 
                $user_id = $this->session->read('Auth.User.user_id');

                $options = array(
                    'hôtel'=> 
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'hôtel')).
                        'hôtel</div>', 
                    'chambre d\'hôte'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'chambre d\'hôte')).
                        'chambre d\'hôte</div>', 
                    'camping'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'camping')).
                        'camping</div>', 
                    'autre'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'autre')).
                        'autre</div>'
                );


                echo $this->Form->radio('type', $options, array('label'=>'Type'));

                echo $this->Form->input('hebergement_name', array('label'=>'Nom'));
            ?>
                
            <div>
                <div class='float'>
                    <h5>Du</h5>
                    <?php echo $this->datePicker->flat('Hebergement][date_debut');?>
                </div>
                <div class='float'>
                    <h5>Au</h5>
                    <?php echo $this->datePicker->flat('Hebergement][date_fin');?>
                </div>
                <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
            </div>
                
            <?php
                echo $this->Form->input('lieu', array('label'=>'Adresse'));
                echo $this->Form->input('prix', array('label'=>'Prix'));

                echo $this->Form->input('url',
                    array('type'=>'hidden', 'default'=>$etape_id.$base_url));

                echo $this->Form->input('hebergement_id');
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Modifier')); ?>
    </div>

    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li>
                <?php 
                    echo $this->Html->link(__('Retourner aux hébergements'), 
                        array('action' => 'view', $etape_id.$base_url)); 
                ?> 
            </li>
        </ul>
    </div>
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'etape_selected' => $etape_id
    ));
?>