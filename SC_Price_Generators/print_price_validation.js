// JavaScript Document
/********form validation code for blank price calculator function***********/
var validatePriceForm = function() {
		  
		//input from html form field values
		  var garmentQuantity=$('#quantity').val(); //input of garment quantity field
		  var colorQuantity=$('#colorQuantity').val();//input of Color Quantity field
		  var screensizeSelect = (!$("input[name='screensize']:checked").val());//radio button group for screensize checks to see if nothing is selected		  
	  
		//validation variables
		  var required = ["quantity"];//only 1 field in this array in this case
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
			} else {
				input.removeClass("invalid");
			}
			}
			//Validate the quantity input to make sure it's a number and is greater than 0
			if (numberRE.test(garmentQuantity) || (garmentQuantity<=0)) {
				alert("quantity invalid");
				$('#quantity').addClass("invalid");
				$('#quantity').val(emptyerror);
			}

			
		//validate radio buttons and number of colors for front print
			var printValue = false; //test that values have been entered for the front print
			if ((screensizeSelect)) {//check screensize radio has a valid selection
					alert('No Print Size Selected');
    			}
					else if((!screensizeSelect)){
						printValue = true;
    			}
		
					
			//if any inputs on the page have the class 'invalid' , or there is no checkbox selection or color quantity, the page will not display the results
			if (($(":input").hasClass("invalid")) || (printValue == false)) {
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