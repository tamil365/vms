$(document).ready(function() {

    $('#visitorcreateForm').validate({ 
        rules : {
            visitorname : {required : true , minlength :3},
            fromwhichcompany : {required : true ,minlength : 1},
            email : {required : true , email : true },
            mobile : {required : true , mobile :true,maxlength:10},
            address : {required : true },
            whomtomeet:{required : true, selectcheck: true},
            appointmentrequired:{required : true , selectcheck:true},
            govtid:{required : true}
        },
        messages : {
            visitorname : {required : "Enter visitor name" ,  minlength : "Enter atleat 3 char"},
            fromwhichcompany : {required : "Enter company",minlength : "Enter atleat 1 char"},
            email : {required : "Enter email" , email:"Enter valid Email address"},
            mobile : {required : "Enter mobile" , mobile :"Enter valid mobile",maxlength:"Enter valid mobile number"},
            address : {required : "Enter Address"},
            whomtomeet : {required : "Select whom to meet" , selectcheck: "Select whom to meet" },
            appointmentrequired:{required : "Select appointment" , selectcheck:"Select appointment"},
            govtid:{required : "Enter govt id" }
        }
    });
 


    var myObj = {};
    $( "#createVisitorBtn" ).click(function() {
        

            
            var imagedata;
            imagedata = document.getElementById("mydata").value;
            if (imagedata == "") {
                alert("please take a proper photo!");
            return false;
            }
            if ($('#visitorcreateForm').valid() == false) return false;
            if ($('#mobile').val() != null) {
                //alert("call ajax"+$('#mobile').val());
                var mob= $('#mobile').val();
                $.ajax({
                    url:"../user/sendOTP.php", //the page containing php script
                    type: "POST",  
                    data:({mobile :mob}) ,  
                    success: function(res) { 
                    console.log(res);
                        $('#otpModal').modal('show');   
                    }
                    
                });
    
            }
         });
        
        });

        function verifyOTP() {
            $(".error").html("").hide();
            $(".success").html("").hide();
            var otp = $("#mobileOtp").val();
            var input = {
                "otp" : otp,
                "action":"verify"
            };
            if (otp.length == 6 && otp != null) {
                $.ajax({
                    url : '../user/verifyOTP.php',
                    type : 'POST',
                    dataType : "json",
                    data : input,
                    success : function(response) {
                        
                        if(response==1){
                            //$(".success").html("Your mobile number is verified!");
                            alert("Your mobile number is verified!"); 
                            $('#otpModal').modal('hide');
                            createVisitor();   
                        }
                        
                    },
                    error : function() {
                      //  alert("ss");
                    }
                });
            } else {
                alert("You have entered wrong OTP."); 
                // $(".error").html('You have entered wrong OTP.');
                // $(".error").show();
            }
        }

        function createVisitor(){
            var visitorname= $('#visitorname').val();
            var fromwhichcompany= $('#fromwhichcompany').val();
            var address= $('#address').val();
            var mobile= $('#mobile').val();
            var email= $('#email').val();
            var whomtomeet= $('#whomtomeet').val();
            var appointmentrequired= $('#appointmentrequired').val();
            var govtid= $('#govtid').val();
            var image= $('#mydata').val();

            $.ajax({
                url:"../user/visitorDataCreate.php", //the page containing php script
                type: "POST",  
                data:({visitorname :visitorname,fromwhichcompany:fromwhichcompany,address:address,mobile:mobile,email:email,whomtomeet:whomtomeet,appointmentrequired:appointmentrequired,govtid:govtid,image:image}) ,  
                success: function(res) { 
                console.log(res);
                    $("#visitorcreateForm")[0].reset();
                      
                }
                
            });

            
        }
        