
$(function () {
    $('#kipspaymentsetup-payment_type').change(function () {
        var payment_type = $('#kipspaymentsetup-payment_type').val();
        if (payment_type == 1) {
            $('#education_level-id').show();
            $('#transport_routes-id').hide();    
        }
        else if(payment_type == 2){
            $('#transport_routes-id').show();
            $('#education_level-id').hide(); 
        }
        else if(payment_type != 1 || payment_type != 2) {
             $('#transport_routes-id').hide();
            $('#education_level-id').hide(); 
        }
    })
    
//    $('#kipsusers-student_type').change(function () {
//        var student_type = $('#kipsusers-student_type').val();
//        if (student_type == 1) {
//            $('#transport_routes-id').hide();    
//        }
//        else if (student_type == 2) {
//            $('#transport_routes-id').show();    
//        }
//    })
    
    $('#kipspayments-student_type').change(function () {
       
        var student_type = $('#kipspayments-student_type').val();
        if (student_type == 1) {
            $('#transport_route-id').hide();  
            $('#transport_fee-id').hide();             
        }
        else if (student_type == 2) {
            $('#transport_route-id').show();  
             $('#transport_fee-id').show(); 
        }
    })
})









