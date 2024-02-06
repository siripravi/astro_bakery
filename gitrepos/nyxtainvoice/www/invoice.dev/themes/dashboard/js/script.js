
   $('#venId').on("change", function () {

        $.ajax({
            url: "<?php echo "/statement/chgShip/id/" . $stmt->id; ?>",
            type: "POST",
            // beforeSend : function(){$(that).text("Working..");$(that).prop('disabled', true);},

            success: function (data) {
                console.log(data);
                // alert(JSON.stringify(data));
                // js:$("#cust-detail-adrs").html(data.FIRST_NAME);
                // location.reload();
                var obj = jQuery.parseJSON(data);
                //$("#user-sel2").val("something");
                var result = $("#ven-details-adrs");
                result.find(".org").text(obj.SHIP_NAME);
                result.find(".ven-street-address").text(obj.SHIP_ADD1);
                result.find(".ven-locality").text(obj.SHIP_ADD2);
                result.find(".ven-locality2").text(obj.SHIP_STATE);
                result.find(".ven-state-name").text(obj.SHIP_STATE + "-" + obj.SHIP_ZIP);
                result.find(".ven-tel").text(obj.SHIP_PHONE1);

                // Then we show it up
                result.fadeIn();
                // $(".msg-cust-success").show();
                //      js:$(".msg-cust-success").html("Customer changed successfully!");
                BootstrapDialog.alert({title: "success!", message: "Venue Changed Successfully!"});
            },
            data: $("#chg_venue_form").serialize()
                    //   update: '#cust-detail-adrs'


                    // 
                    //     }

        });
    });
     
// Delivery and Pickup script

    $('.new-func').on("change", function () {
        var val = $(this).val();
        //alert (val.length);

        $.ajax({
            url: "<?php echo "/invoice/chgDelivery/id/" . $stmt->id; ?>",
            type: "POST",
            // beforeSend : function(){$(that).text("Working..");$(that).prop('disabled', true);},
            success: function (data) {
                console.log(data);
                // alert(JSON.stringify(data));
                // js:$("#cust-detail-adrs").html(data.FIRST_NAME);
                // location.reload();
                var obj = jQuery.parseJSON(data);
                //$("#user-sel2").val("something");
                var result = $("#delivery-details");
                result.find(".delivery-from").text(obj.delv_from);
                result.find(".delivery-to").text(obj.delv_to);
                result.find(".pickup-from").text(obj.pick_from);
                result.find(".pickup-from").text(obj.pick_to);
                // Then we show it up
                result.fadeIn();
                // $(".msg-cust-success").show();
                //      js:$(".msg-cust-success").html("Customer changed successfully!");
                BootstrapDialog.alert({title: "success!", message: "Delivery and Pickup times Changed Successfully!"});
            },
            data: $("#chg_delivery_form").serialize()
                    //   update: '#cust-detail-adrs'


                    // 
                    //     }

        });
    });
  
     
   $('*[data-poload]').hover(function () {
            var e = $(this);
            e.off('hover');
            $.get(e.data('poload'), function (d) {
                e.popover({content: d}).popover('show');
            });
        });
        $('#sandbox-container .input-daterange').datepicker({});

    

        jQuery('#submit_item_button').click(function () {
            $(this).attr("value", "Saving...");
            //$("#btn-done").
            //alert("Data saved");
            return false;
        });


    //Package action
    $('#pack-btn').on("click", function () {

        $.ajax({
            url: "<?php echo "/invoice/chgPackInstructions/id/" . $this->stmt->id; ?>",
            type: "POST",
            //beforeSend : function(){alert($(this).closest().find("form").id);},  //check this!!


            success: function (data) {
                console.log(data);
                // alert(JSON.stringify(data));
                // js:$("#cust-detail-adrs").html(data.FIRST_NAME);
                // location.reload();
                //var obj = jQuery.parseJSON(data);
                //$("#user-sel2").val("something");
                /* var result = $("#delivery-details");
                 
                 result.find(".delivery-from").text(obj.delv_from);
                 result.find(".delivery-to").text(obj.delv_to);
                 result.find(".pickup-from").text(obj.pick_from);
                 result.find(".pickup-from").text(obj.pick_to);*/

                // Then we show it up
                // result.fadeIn();
                // $(".msg-cust-success").show();
                //      js:$(".msg-cust-success").html("Customer changed successfully!");
                BootstrapDialog.alert({title: "success!", message: "Package Instructions Changed Successfully!"});
            },
            data: $("#package-form").serialize()
                    //   update: '#cust-detail-adrs'


                    // 
                    //     }

        });
});
