// JavaScript Document
/********form validation code for blank price calculator***********/
var validateBlankForm = function() {
	  
		//validation variables
		  var required = ["baseprice", "quantity"];//array of fields which must be filled
		  var errornotice = $("#error");//output error notice to selected div		
		  var emptyerror = "Please Enter a number";// The text to show up within a field when it is incorrect
		  var numberRE = /\D/; //regular expression to match any number
		  
		//Validate required fields
			for (i=0;i<required.length;i++) {
				var input = $('#'+required[i]);
					if ((input.val() == "") || (input.val() == emptyerror)) {
					input.addClass("invalid");
					input.val(emptyerror);
					errornotice.fadeIn(750);
			//Validate the quantity input to make sure it's a number and is greater than 0
			if (numberRE.test(input) || (input<=0)) {
					alert("quantity invalid");
					input.addClass("invalid");
					input.val(emptyerror);
			}
			} else {
				input.removeClass("invalid");
			}
			}
		
					
			//if any inputs on the page have the class 'invalid' , or there is no checkbox selection or color quantity, the page will not display the results
			if (($(":input").hasClass("invalid"))){
					$("#result").css("display", "none");
				} else {
					$("#result").css("display", "block");
					errornotice.hide();
				}	
				
			//Clears any fields in the form when the user clicks on them
				$(":input").focus(function(){		
	   				if ($(this).hasClass("invalid") ) {
						$(this).val("");
						$(this).removeClass("invalid");
	   			}
			});
		  	/***  end of clear input field ***/
     };
	 
/******** end form validation code ***********/