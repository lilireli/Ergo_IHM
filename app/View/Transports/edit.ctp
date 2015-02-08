<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Editer un transport
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<?php 
    $etape_debut = $_GET['etape_debut']; 
    $etape_fin = $_GET['etape_fin'];
    $voyage_id = $_GET['voyage_id'];
    $etape_name = $_GET['etape_name'];

    $base_url = '?voyage_id='.$voyage_id.'&etape_name='.$etape_name;

    $user_id = $this->session->read('Auth.User.user_id'); 

    $accepte = false;
    $i = 0;
?>

<div class="general_voyage">
    <div>
        <div>
            <h2><?php echo __('Transport de '.$etape_name); ?><h2>
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

    <div id="menu">   
        <ul class="onglets ">
            <li class="active">
                <?php 
                    // afficher les onglets
                
                    echo __($this->Html->link(__('Transports'), 
                        array(
                            'controller' => 'transports', 
                            'action' => 'view', 
                            $etape_debut,
                            $etape_fin.$base_url
                        ))); 
                ?>
            </li>
        </ul>
    </div>

    <div class="form">
        <h3><?php echo __("Modifier le transport"); ?></h3>

        <?php echo $this->Form->create('Transport'); ?>
        <fieldset>
            <?php   
                $options = array(
                        'avion' => 
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'avion')).
                            'avion</div>',
                        'bateau' => 
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'bateau')).
                            'bateau</div>',
                        'bus' => 
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'bus')).
                            'bus</div>',
                        'train' => 
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'train')).
                            'train</div>',
                        'voiture' => 
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'voiture')).
                            'voiture</div>',
                        'autre' =>
                            '<div class="float">'.
                                $this->element('pictograms', array('name' => 'autre')).
                            'autre</div>'
                    );

                echo $this->Form->radio('type', $options, array('label'=>'Type'));

                echo $this->Form->input('lieu_depart', array('label'=>'Lieu de départ'));
                    echo $this->Form->input('lieu_arrivee', array('label'=>'Lieu d\'arrivée'));
                ?>

                <div>
                    <div class='float'>
                        <h5>Du</h5>
                        <?php echo $this->datePicker->flat('Transport][date_debut');?>
                        <?php echo $this->Form->input('heure_debut', array('label'=>'Heure de départ')); ?>
                    </div>
                    <div class='float'>
                        <h5>Au</h5>
                        <?php echo $this->datePicker->flat('Transport][date_fin');?>
                        <?php echo $this->Form->input('heure_fin', array('label'=>'Heure d\'arrivée')); ?>
                    </div>
                    <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
                </div>

                <?php
                    echo $this->Form->input('prix', array('label'=>'Prix'));

                    echo $this->Form->input('url', 
                        array('type'=>'hidden', 'default' => $etape_debut.'/'.$etape_fin.$base_url));
                    echo $this->Form->input('transport_id');
                ?>
        </fieldset>
        <?php echo $this->Form->end(__('Modifier')); ?>
    </div>

    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li>
                <?php 
                    echo $this->Html->link(__('Retourner aux tranports'), 
                        array('action' => 'view', $etape_debut, $etape_fin.$base_url)); 
                ?> 
            </li>
        </ul>
    </div>
</div>

<?php
    // afficher la frise
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id, 
    ));
?>

<script>
    // selectionner le transport
    $('#transport<?php echo __($etape_debut); ?>').addClass("transport_selected");
</script>