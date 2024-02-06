<?php
//echo $this->layout;
/*You need to change the URL as per your requirements, else this will show error page*/
$model_name = Yii::app()->controller->id;
$current_url = $baseUrl . "/" . $model_name;

/*To Send the additional data if needed*/
$reference_id = 88;
$customer_id = 77;

//echo "Search   :".$current_url;
?>

<input type="hidden" id="current_url" value="<?php echo $current_url; ?>" />
<input type="hidden" id="doc_type" value="<?php echo $model->st_type; ?>" />

<?php if (!empty($header)): ?>
    <?php $this->renderPartial('_statement', array('statement' => $model, 'filepath' => $filepath, 'key' => $key, 'header' => $header)); ?>
<?php endif; ?>


<?php
Yii::app()->clientScript->registerScript('search-pdf', ' 
    $(".evDate").datepicker({
  onSelect: function(dateText) {
   
    var faq_search_input = dateText;
    var dataString = "keyword="+ faq_search_input;

    var ref_id = $("#ref_id").val(); 
    var customer_no = $("#customer_no").val(); 
    var current_url = $("#current_url").val(); 

    $.ajax({
        type: "GET",
        url: current_url+"/SearchEngine",
        data: dataString+"&doctype="+doc_type,
        beforeSend:  function() {
            $("input#Statement_ship_date").addClass("loading");
        },
        success: function(server_response){
            $("#searchresultdata").html(server_response).show();
            $("span#faq_category_title").html(faq_search_input);

            if ($("input#Statement_ship_date").hasClass("loading")) {
                $("input#Statement_ship_date").removeClass("loading");
            }
        }
    });   
    return false;
   
    }
    });', CClientScript::POS_END);