// JavaScript Document
/******** form validation code 1-17-2012***********/
var validateForm = function() {
          //alert("Is this valid?");//for testing purposes
		  
		//input from html form field values
		  var garmentQuantity=$('#quantity').val(); //input of garment quantity field
		  var colorQuantity=$('#colorQuantity').val();//input of Color Quantity field
		  var colorQuantity2=$('#colorQuantity2').val();//input of Color Quantity field
		  var screensizeSelect1 = (!$("input[name='screensize']:checked").val());//radio button group for screensize checks to see if nothing is selected
		  var screensizeSelect2 = (!$("input[name='screensize2']:checked").val());//radio button group for screensize2 checks to see if nothing is selected
		  var noSelect1 = ($("input[name='screensize']:checked").val());//radio button group for screensize checks to see if nothing is selected
		  var noSelect2 = ($("input[name='screensize2']:checked").val());//radio button group for screensize2 checks to see if nothing is selected
		  
		  
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
			var frontprintValue = false; //test that values have been entered for the front print
			if ((screensizeSelect1) && (colorQuantity == "Select")) {//check screensize radio has a valid selection
					alert('No Front Print selection made');
    			}
    				else if((!screensizeSelect1) && (colorQuantity == "Select") && (noSelect1 != "none")){
      					alert('no color quantity selected for the front print');
						frontprintValue = false;
						$('#colorQuantity').addClass("invalid");
				}
    				else if((screensizeSelect1) && (colorQuantity != "Select")){
      					alert('no print size selection made for the front print');
    			}	
					else if((noSelect1 == "none") && (colorQuantity == "Select")){
      					//alert('No Front Print');//for testing purposes
						frontprintValue = true;
				}	
					else if((noSelect1 == "none") && (colorQuantity != "Select")){
      					alert('Invalid input for Front Print');
						frontprintValue = false;
						$('#colorQuantity').addClass("invalid");
    			}
					else if((!screensizeSelect1) && (colorQuantity != "Select") && (noSelect1 != "none")){
      					//alert('Front Print radio button is checked and Number of colors in Front Print is selected!');//for testing purposes
						frontprintValue = true;
    			}
			
		//validate radio buttons and number of colors for back print
			var backprintValue = false; //test that values have been entered for the back print
			if ((screensizeSelect2) && (colorQuantity2 == "Select")) {//check screensize radio2 has a valid selection
					alert('No Back Print selection made');
    			}
    				else if((!screensizeSelect2) && (colorQuantity2 == "Select") && (noSelect2 != "none")){
      					alert('no color quantity selected for the back print');
						$('#colorQuantity2').addClass("invalid");
						backprintValue = false;
				}
    				else if((screensizeSelect2) && (colorQuantity2 != "Select")){
      					alert('no print size selection made for the back print');
    			}	
					else if((noSelect2 == "none") && (colorQuantity2 == "Select")){
      					//alert('No Back Print');//for testing purposes
						backprintValue = true;
				}	
					else if((noSelect2 == "none") && (colorQuantity2 != "Select")){
      					alert('Invalid input for Back Print');
						$('#colorQuantity2').addClass("invalid");
						backprintValue = false;
    			}
					else if((!screensizeSelect2) && (colorQuantity != "Select") && (noSelect2 != "none")){
      					//alert('Back Print radio button is checked and Number of colors in Back Print is selected!');//for testing purposes
						backprintValue = true;
    			}
		
					
			//if any inputs on the page have the class 'invalid' , or there is no checkbox selection or color quantity, the page will not display the results
			if (($(":input").hasClass("invalid")) || (frontprintValue == false) || (backprintValue == false)) {
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