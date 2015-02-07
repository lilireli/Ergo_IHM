<?php 
    $voyage_id = $_GET['voyage_id'];
    $etape_name = $_GET['etape_name'];
    $etape_id = $_GET['etape_id'];

    $activite_id = strtok(basename($this->here), '%3F');

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
        echo $this->element('menu_etape', array('base_url' => $etape_id.$base_url, 'tab' => 2));
    ?>

    <div class="form">
        <h3><?php echo __("Ajouter une activité"); ?></h3>

        <?php echo $this->Form->create('Activite', array('action' => 'add/'.$base_url.'&etape_id='.$etape_id)); ?>
	    <fieldset>
	        <?php 
                $options = array(
                    'restaurant & bar'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'restaurant & bar')).
                        'restaurant & bar</div>',
                    'culture'=> 
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'culture')).
                        'culture</div>',
                    'nature'=> 
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'nature')).
                        'nature</div>',
                    'attraction'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'attraction')).
                        'attraction</div>',
                    'sport'=> 
                            '<div class="float">'.
                            $this->element('pictograms', array('name' => 'sport')).
                        'sport</div>',
                    'autre'=>
                        '<div class="float">'.
                            $this->element('pictograms', array('name' => 'autre')).
                        'autre</div>'
                );

                $attributes = array(
                    'legend' => false,
                    'value' => 'restaurant & bar'
                );

                echo $this->Form->radio('type', $options, $attributes, array('label'=>'Type'));

                echo $this->Form->input('activite_name', array('label'=>'Nom'));
            ?>
                
            <div>
                <div class='float'>
                    <h5>Du</h5>
                    <?php echo $this->datePicker->flat('Activite][date_debut');?>
                </div>
                <div class='float'>
                    <h5>Au</h5>
                    <?php echo $this->datePicker->flat('Activite][date_fin');?>
                </div>
                <p><i><?php echo __('(Les dates doivent être supérieures à aujourd\'hui, avec la date de fin postérieure à la date de début.)'); ?></p></i>
            </div>
	        	
	        <?php
	        	echo $this->Form->input('lieu', array('label'=>'Adresse'));
	        	echo $this->Form->input('prix', array('label'=>'Prix'));

	        	echo $this->Form->input('etape_id',
	        		array('type' => 'hidden', 'default' => $etape_id));

	        	$user_id = $this->session->read('Auth.User.user_id');
	        	echo $this->Form->input('createur_id',
	        		array('type' => 'hidden', 'default' => $user_id));
	        	echo $this->Form->input('url',
                    array('type'=>'hidden', 'default'=> $etape_id.$base_url));
	    	?>
	    </fieldset>
		<?php echo $this->Form->end(__('Ajouter')); ?>
	</div>

    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li>
                <?php 
                    echo $this->Html->link(__('Retourner aux activités'), 
                        array('action' => 'view', $etape_id.$base_url)); 
                ?> 
            </li>
        </ul>
    </div>
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id
    ));
?>

<script>
    $('#etape<?php echo __($etape_id); ?>').addClass("etape_selected");
</script>