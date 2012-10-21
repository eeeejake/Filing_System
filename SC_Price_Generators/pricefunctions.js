// JavaScript Document
//Price Functions for Shirt Circuit Price Calculations January 16,2012

function formatCurrency(num) {// Function to format currency from www.JavaScriptBank.com 
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
			num = "0"; 
			sign = (num == (num = Math.abs(num)));
			num = Math.floor(num*100+0.50000000001);
			cents = num%100;
			num = Math.floor(num/100).toString();
		if(cents<10)
			cents = "0" + cents;
			for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+','+
			num.substring(num.length-(4*i+3));
		return (((sign)?'':'-') + '$' + num + '.' + cents);
	}

/********* function for extracting garment price value from array********/
function findSelected(arr, value) {//converts an existing array to a string to search for a term which is matched to a price in a new array
  				var str=arr.toString();//convert selected array to string
				if (str.search(value) == -1){ //locate variable value(string) in new string
					alert('VALUE NOT FOUND!'); //if not found, alert
					}
				else{
					temp = str.split(","); //split string with comma delimiter
					var match = temp.indexOf(value); //make new array of comma delimited items
					price = temp[match +1]; //match value of price in array to selected string preceding it
					}
				return price;
			}

/********* function for garment price calculation********/
function findPriceBracket(quantity) {//make array of items with matching price to be selected and assigned to a variable
				var Blanks_1_5 = 
					[["T-shirt",9.00],
					["Kid's T-Shirt",8.20],
					["Longsleeve T-Shirt",13.75],
					["7oz Hooded Sweatshirt",24.75],
					["9oz Hooded Sweatshirt", 31.50],
					["7oz Crew",16.50],
					["9oz Crew",20.75]];   
                       
                var Blanks_6_11 = [["T-shirt",8.00],
					["Kid's T-Shirt",7.30],
					["Longsleeve T-Shirt",12.50],
					["7oz Hooded Sweatshirt",23.00],
					["9oz Hooded Sweatshirt", 28.50],
					["7oz Crew",15.00],["9oz Crew",19.00]];              
                       
                var Blanks_12_23 = [["T-shirt",7.25],
					["Kid's T-Shirt",6.60],
					["Longsleeve T-Shirt",11.50],
					["7oz Hooded Sweatshirt",21.25],
					["9oz Hooded Sweatshirt", 26.25],
					["7oz Crew",14.25],["9oz Crew",18.25]];

                var Blanks_24_35 = [["T-shirt",6.50],
					["Kid's T-Shirt",5.90],
					["Longsleeve T-Shirt",10.50],
					["7oz Hooded Sweatshirt",20.00],
					["9oz Hooded Sweatshirt", 24.75],
					["7oz Crew",13.25],
					["9oz Crew",16.75]];
                
                var Blanks_36_59 = [["T-shirt",5.80],
					["Kid's T-Shirt",5.35],
					["Longsleeve T-Shirt",10.00],
					["7oz Hooded Sweatshirt",18.50],
					["9oz Hooded Sweatshirt", 23.50],
					["7oz Crew",12.25],
					["9oz Crew",15.50]];

                var Blanks_60_95 = [["T-shirt",5.25],
					["Kid's T-Shirt",4.95],["Longsleeve T-Shirt",9.00],
					["7oz Hooded Sweatshirt",17.25],
					["9oz Hooded Sweatshirt", 22.00],
					["7oz Crew",11.25],
					["9oz Crew",14.25]];
                
                var Blanks_96_143 = [["T-shirt",4.85],
					["Kid's T-Shirt",4.55],
					["Longsleeve T-Shirt",8.25],
					["7oz Hooded Sweatshirt",16.00],
					["9oz Hooded Sweatshirt", 20.75],
					["7oz Crew",10.50],
					["9oz Crew",13.00]];
                
                var Blanks_144_239 = [["T-shirt",4.65],
					["Kid's T-Shirt",4.45],
					["Longsleeve T-Shirt",7.95],
					["7oz Hooded Sweatshirt",15.75],
					["9oz Hooded Sweatshirt", 20.25],
					["7oz Crew",10.00],
					["9oz Crew",12.75]];

                var Blanks_240_383 = [["T-shirt",4.55],
					["Kid's T-Shirt",4.40],
					["Longsleeve T-Shirt",7.85],
					["7oz Hooded Sweatshirt",15.50],
					["9oz Hooded Sweatshirt", 20.00],
					["7oz Crew",9.80],
					["9oz Crew",12.50]];
					
				if (quantity >0 && quantity<5) {
    					bracket = Blanks_1_5;
					} else if (quantity >=6 && quantity<=11) {
    					bracket = Blanks_6_11;
  					} else if (quantity >=12 && quantity<=23) {
    					bracket = Blanks_12_23;
					} else if (quantity >=24 && quantity<=35) {
    					bracket = Blanks_24_35;
					} else if (quantity >=36 && quantity<=59) {
    					bracket = Blanks_36_59;
					} else if (quantity >=60 && quantity<=95) {
    					bracket = Blanks_60_95;
					} else if (quantity >=96 && quantity<=143) {
    					bracket = Blanks_60_95;
					} else if (quantity >=144 && quantity<=239) {
    					bracket = Blanks_144_239;
					} else if (quantity >=240 && quantity<=383) {
    					bracket = Blanks_240_383;
					} else if (quantity >=384) {
    					bracket = Blanks_240_383;
					} else bracket = Blanks_1_5;
				
					return bracket;
				}

/********* function for price range calculation********/				
function showRange(amountof){//lists the price range which applies to the selection based on quantity
				if (amountof >0 && amountof<=5) {
    				range = "1-5";
				} else if (amountof >=6 && amountof<=11) {
    				range = "6-11";
  				} else if (amountof >=12 && amountof<=23) {
    				range = "12-23";
				} else if (amountof >=24 && amountof<=35) {
    				range = "24-35";
				} else if (amountof >=36 && amountof<=59) {
    				range = "36-59";
				} else if (amountof >=60 && amountof<=95) {
    				range = "60-95";
				} else if (amountof >=96 && amountof<=143) {
    				range = "96-143";
				} else if (amountof >=144 && amountof<=239) {
    				range = "144-239";
				} else if (amountof>=240 && amountof<=383) {
    				range = "240-383";
				} else if (amountof >=384) {
    				range = "384+", alert("Items at this quantity are bid priced");
				} else range ="1-5";
				
				return range;
				}
				
/********* function for printing price calculation********/
function getPrintPrice(colorQuantity, garmentQuantity){
			/* quantity 1-5 */	
				if ((colorQuantity == 1) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 5.00;
				} else if ((colorQuantity == 2) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 10.00;
				} else if ((colorQuantity == 3) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 15.00;
				} else if ((colorQuantity == 4) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 20.00;
				} else if ((colorQuantity == 5) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 25.00;
				} else if ((colorQuantity == 6) && (garmentQuantity >0 && garmentQuantity<=5)) {
    				Price = 30.00;
			/* quantity 6-11 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 3.75;
				} else if ((colorQuantity == 2) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 5.10;
				} else if ((colorQuantity == 3) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 8.85;
				} else if ((colorQuantity == 4) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 12.60;
				} else if ((colorQuantity == 5) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 16.35;
				} else if ((colorQuantity == 6) && (garmentQuantity >=6 && garmentQuantity<=11)) {
    				Price = 20.10;
			/* quantity 12-23 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				Price = 2.75;
				} else if ((colorQuantity == 2) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				Price = 3.75;
				} else if ((colorQuantity == 3) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				Price = 4.75;
				} else if ((colorQuantity == 4) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				Price = 7.50;
				} else if ((colorQuantity == 5) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				Price = 10.25;
				} else if ((colorQuantity == 6) && (garmentQuantity >=12 && garmentQuantity<=23)) {
    				printPrice = 13.00;
			/* quantity 24-35 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 2.00;
				} else if ((colorQuantity == 2) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 2.75;
				} else if ((colorQuantity == 3) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 3.50;
				} else if ((colorQuantity == 4) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 4.25;
				} else if ((colorQuantity == 5) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 6.25, setupCost = 7.50;
				} else if ((colorQuantity == 6) && (garmentQuantity >=24 && garmentQuantity<=35)) {
    				Price = 8.25, setupCost = 15.00;	
			/* quantity 36-59 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 1.50;
				} else if ((colorQuantity == 2) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 2.10;
				} else if ((colorQuantity == 3) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 2.70;
				} else if ((colorQuantity == 4) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 3.30;
				} else if ((colorQuantity == 5) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 3.90;
				} else if ((colorQuantity == 6) && (garmentQuantity >=36 && garmentQuantity<=59)) {
    				Price = 4.50;
			/* quantity 60-95 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 1.25;
				} else if ((colorQuantity == 2) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 1.70;
				} else if ((colorQuantity == 3) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 2.15;
				} else if ((colorQuantity == 4) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 2.60;
				} else if ((colorQuantity == 5) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 3.05;
				} else if ((colorQuantity == 6) && (garmentQuantity >=60 && garmentQuantity<=95)) {
    				Price = 3.50;
			/* quantity 96-143 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 1.05;
				} else if ((colorQuantity == 2) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 1.40;
				} else if ((colorQuantity == 3) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 1.75;
				} else if ((colorQuantity == 4) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 2.10;
				} else if ((colorQuantity == 5) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 2.45;
				} else if ((colorQuantity == 6) && (garmentQuantity >=96 && garmentQuantity<=143)) {
    				Price = 2.80;
			/* quantity 144-239 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = .90;
				} else if ((colorQuantity == 2) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = 1.20;
				} else if ((colorQuantity == 3) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = 1.50;
				} else if ((colorQuantity == 4) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = 1.80;
				} else if ((colorQuantity == 5) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = 2.10;
				} else if ((colorQuantity == 6) && (garmentQuantity >=144 && garmentQuantity<=239)) {
    				Price = 2.30;
			/* quantity 240-383 */	
				} else if ((colorQuantity == 1) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				Price = .80;
				} else if ((colorQuantity == 2) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				Price = 1.05;
				} else if ((colorQuantity == 3) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				printPrice = 1.30;
				} else if ((colorQuantity == 4) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				Price = 1.55;
				} else if ((colorQuantity == 5) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				Price = 1.80;
				} else if ((colorQuantity == 6) && (garmentQuantity >=240 && garmentQuantity<=383)) {
    				Price = 2.05;
			/* quantity 384+ */	
				} else if ((colorQuantity == 1) && (garmentQuantity>383)) {
    				Price = .70;
				} else if ((colorQuantity == 2) && (garmentQuantity>383)) {
    				Price = .95;
				} else if ((colorQuantity == 3) && (garmentQuantity>383)) {
    				printPrice = 1.20;
				} else if ((colorQuantity == 4) && (garmentQuantity>383)) {
    				Price = 1.45;
				} else if ((colorQuantity == 5) && (garmentQuantity>383)) {
    				Price = 1.70;
				} else if ((colorQuantity == 6) && (garmentQuantity>383)) {
    				Price = 1.95;
				} else Price = 0;
			
			return Price;
			}
			
/********* function for setup cost calculation********/
function getSetUpPrice(colorAmt, garmentAmt){
			/* quantity 1-5 */	
				if ((colorAmt == 2) && (garmentAmt >0 && garmentAmt<=5)) {
    				setupPrice = 7.50;
				} else if ((colorAmt == 3) && (garmentAmt >0 && garmentAmt<=5)) {
    				setupPrice = 15.00;
				} else if ((colorAmt == 4) && (garmentAmt >0 && garmentAmt<=5)) {
    				setupPrice = 22.50;
				} else if ((colorAmt == 5) && (garmentAmt >0 && garmentAmt<=5)) {
    				setupPrice = 30.00;
				} else if ((colorAmt == 6) && (garmentAmt >0 && garmentAmt<=5)) {
    				setupPrice = 37.50;
			/* quantity 6-11 */	
				} else if ((colorAmt == 3) && (garmentAmt >=6 && garmentAmt<=11)) {
    				setupPrice = 7.50;
				} else if ((colorAmt == 4) && (garmentAmt >=6 && garmentAmt<=11)) {
    				setupPrice = 15.00;
				} else if ((colorAmt == 5) && (garmentAmt >=6 && garmentAmt<=11)) {
    				setupPrice = 22.50;
				} else if ((colorAmt == 6) && (garmentAmt >=6 && garmentAmt<=11)) {
    				setupPrice = 30.00;
			/* quantity 12-23 */	
				} else if ((colorAmt == 4) && (garmentAmt >=12 && garmentAmt<=23)) {
    				setupPrice = 7.50;
				} else if ((colorAmt == 5) && (garmentAmt >=12 && garmentAmt<=23)) {
    				Price = 10.25, setupCost = 15.00;
				} else if ((colorAmt == 6) && (garmentAmt >=12 && garmentAmt<=23)) {
    				setupPrice = 22.50;
			/* quantity 24-35 */	
				} else if ((colorAmt == 5) && (garmentAmt >=24 && garmentAmt<=35)) {
    				setupPrice = 7.50;
				} else if ((colorAmt == 6) && (garmentAmt >=24 && garmentAmt<=35)) {
    				setupPrice = 15.00;
				} else setupPrice = 0;
			return setupPrice;
			}