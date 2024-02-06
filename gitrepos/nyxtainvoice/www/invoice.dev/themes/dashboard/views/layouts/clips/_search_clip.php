<?php $this->beginClip('searchClip'); ?>
    <?php  $this->renderPartial('_ajax_search',array('results' => $results)); ?>
<?php $this->endClip(); ?>