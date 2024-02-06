<div class="logo" style="margin-top:28px;">
    <a
        href="/" 
        style="font-family:verdana;font-size: 21px; color: #fff;">
        Prime Invoicing
    </a>
</div>

 <?php $this->widget('bootstrap.widgets.TbMenu',array(
             'type'=>'pills',
            'stacked' => true,
            'encodeLabel' => false,
            'htmlOptions'=>array('class'=>'nav'),
            'items'=>array(
                    array('label'=>'<i class="pe-7s-home"></i><p>Home</p>', 'url'=>array('/site/index')), 
                    array('label'=>'<i class="pe-7s-note2"></i><p>Quotes</p>', 'url'=>array('/quotation/search')), 
                    array('label'=>'<i class="pe-7s-news-paper"></i> <p>Invoices</p>', 'url'=>array('/invoice/search')),
                    array('label'=>'<i class="pe-7s-safe"></i><p>Payments</p>', 'url'=>array('/payments/admin')),
            ),
        ));
        ?> 
