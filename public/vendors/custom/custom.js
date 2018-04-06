/**
 * Created by phyrum on
 */

$(function()
{
    // in document where #role_selected_edit is on change
    $(document).on('change', "#role_selected_edit", function(){
        if($(this).val() == 2){
            $.ajax({
                type: "GET",
                url: "getfacility",
                success: function(result)
                {
                   $("#div_existing_facility_edit").html(result);
                }
            });
        }
        else{
            // reset selected option
            $("#div_existing_facility_edit").html("");
            $("#div_existing_facility_edit").hide();
        }
    });



});


