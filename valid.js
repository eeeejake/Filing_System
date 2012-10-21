// JavaScript Document
function startForm() {
	document.Find.qproject.focus();
}

function newForm() {
	document.addFile.snum.focus();
}

function checkWord(name) {
	//accepts only letters, numbers, period, hyphen, space, or underscore
	var reName = /^[0-9a-zA-Z \-\'\_\.]{2,40}$/;
	return reName.test(name);
}

function checkNum(num) {
	//accepts only numbers or numbers with a capital X
	var reNum = /^([0-9\X]*$)/;
	return reNum.test(num);
}


function checkYear(dat) {
	var reDat = /[0-9]{4}-[0-9]{2}-[0-9]{2}|[0-9]{4}\/[0-9]{2}\/[0-9]{2}/;
	return reDat.test(dat);
}


function checkScreen() {
	if (checkNum(document.addFile.snum.value) == false)
		{alert("Please enter a Screen Number, only Numbers and X allowed");
		document.addFile.snum.focus();
		return false;}
	else if (document.addFile.snum.value == "")
		{alert("Please enter a Screen Number, only Numbers and X allowed");
		document.addFile.snum.focus();
		return false;}
	else if (checkWord(document.addFile.sname.value) == false)
		{alert("Please a enter a Screen Name");
		document.addFile.sname.focus();
		return false;}
	else if (document.addFile.sname.value == "")
		{alert("Please enter a Screen Name");
		document.addFile.sname.focus();
		return false;}
	else
		alert("Record Created");
		return true;
}

function checkTerm() {
	if(checkWord(document.Find.qproject.value) == false)
		{alert("Please enter a valid search term");
		document.Find.qproject.focus();
		return false;}
	else if (document.Find.qproject.value == "")
		{alert("Please enter a valid search term");
		document.Find.qproject.focus();
		return false;}
	else 
		return true;
}

function checkInt() {
	if(checkNum(document.numFind.qnum.value) == false)
		{alert("Please enter a search number, Numbers and X only accepted");
		document.numFind.qnum.focus();
		return false;}
	else if (document.numFind.qnum.value == "")
		{alert("Please enter a search number, Numbers and X only accepted");
		document.numFind.qnum.focus();
		return false;}
	else 
		return true;
}

function checkDate() {
	if(checkYear(document.dateFind.qdate.value) == false)
		{alert("Please enter a date in format YYYY-MM-DD(numbers only)");
		document.dateFind.qdate.focus();
		return false;}
	else if (document.dateFind.qdate.value == "")
		{alert("Please enter a date in format YYYY-MM-DD(numbers only)");
		document.dateFind.qdate.focus();
		return false;}
	else 
		return true;
}

function checkUpdate() {
	if(checkNum(document.editform.snum.value) == false)
		{alert("Please enter a search number, Numbers and X only accepted");
		document.editform.snum.focus();
		return false;}
	else if (document.editform.snum.value == "")
		{alert("Please enter a search number, Numbers and X only accepted");
		document.editform.snum.focus();
		return false;}
	else if(checkWord(document.editform.project.value) == false)
		{alert("Please enter a search term, numbers are not accepted");
		document.Find.project.focus();
		return false;}
	else if (document.editform.project.value == "")
		{alert("Please enter a search term, numbers are not accepted");
		document.editform.project.focus();
		return false;}
	else
		alert("Record Updated");
		return true;
}

function confirmUpdate() {	
		alert("Record Updated");
		return true;
}