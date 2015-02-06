<div class="general_voyage">
    <?php 
    	$etape_id = $etape['Etape']['etape_id']; 
        $etape_name = $_GET['etape_name'];
        $voyage_id = $_GET['voyage_id'];
        $days = $_GET['days'];
        $date_debut = $_GET['date_debut'];

        $base_url = $etape_id.
            '?voyage_id='.$voyage_id.
            '&days='.$days.
            '&date_debut='.$date_debut.
            '&etape_name='.$etape_name;
    ?>

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
        if (isset($_GET['tab']))
        {  // si tab existe
            $tab = $_GET['tab'];
        } else { // sinon tab 1
            $tab = 0;
        }
        
        echo $this->element('menu_etape', array('base_url' => $base_url, 'tab' => 0));
    ?>

    <div class="main">
        <div>
            <h3><?php echo __('Informations sur l\'étape'); ?></h3>
            <dl>
                <dt><?php echo __('Du'); ?></dt>
                <dd>
                    <?php echo h($etape['Etape']['date_debut']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Au'); ?></dt>
                <dd>
                    <?php echo h($etape['Etape']['date_fin']); ?>
                    &nbsp;
                </dd>
            </dl>
        </div>
        <div class="actions">
            <h3><?php echo __('Mes actions'); ?></h3>
            <ul>
                <li><?php echo $this->Html->link(__('Modifier l\'étape'), array('action' => 'edit', $base_url)); ?> </li>
                <li><?php echo $this->Form->postLink(__('Supprimer l\'étape'), array('action' => 'delete',$etape_id, $voyage_id), array(), __('Etes-vous sûr de vouloir supprimer l\'étape ?')); ?> </li>
            </ul>
        </div>
    </div>
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'days' => $days,
        'date_debut' => $date_debut,
        'etape_selected' => $etape_id
    ));
?>