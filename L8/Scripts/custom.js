$(document).ready(function(){

 $('body').backstretch('http://www.annflewelling.com/uploads/1/0/5/1/10516943/afloat_desktop.jpg');


$('#donationDate').Zebra_DatePicker({
	format: 'd.m.Y',
	days: ['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'],
	months: ['Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj', 'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac'],

});

$('#customPagination').twbsPagination({
    totalPages: 2,
    visiblePages: 5,
    onPageClick: function (event, page) {
		var searchText = $('#ajaxSearchText').val();
		var country = 'allCountries';
		getAllDonations(searchText, country, page);
    }
});

$( ".chooseLanguage" ).on( "click", function() {
	var l = $(this).attr('data-lang');
//	$.cookie('language', l, { expires : (jQuery.now() + (10 * 365 * 24 * 60 * 60)) });
	$.cookie('language', l, { expires : 60 });
	location.reload();
});

$('#ajaxSearch').on('click', function(){
	var searchText = $('#ajaxSearchText').val();
	var country = 'allCountries';
	var page = 1;
//	$('#donationList').empty();
	getAllDonations(searchText, country, page);
});

$('#hideSearch').on('click', function(){
	$('#search').slideToggle( "slow", function() {
    // Animation complete.
	});
});


$('.searchNav').on('click', function(){
	$('#search').slideToggle( "slow", function() {
    // Animation complete.
	});
});

/*
$('ul#customPagination > li').on('click', function(){
	var page = $(this).text();
	var searchText = $('#ajaxSearchText').val();
	var country = 'allCountries';
	alert(page + " " + searchText + " " + country);
	getAllDonations(searchText, country, page);
});
*/

$('#addCommentButton').on('click', function(){
	$('#donationComments').append('<div id="addCommentArea" style="margin-top: 15px;">' + 
		'<textarea id="addCommentAreaText" class="form-control" rows="5"> </textarea></br>' + 
		'<button type="button" id="submitComment" class="btn btn-default">Submit</button>' + 
		'<button type="buttoN" id="cancelComment" class="btn btn-default">Cancel</button>' + 
		'</div>');

	$(this).attr('disabled', true);
});

$('body').on('click', '#cancelComment', function(){
	$('#addCommentArea').remove();
	$('#addCommentButton').attr('disabled', false);
});

$('body').on('click', '#submitComment', function(){
	addComment($('#addCommentAreaText').val(), $('#hiddenValueId').val(), null);
});

$('#editProfileButton').on('click', function(){
	var language = $.cookie("language");
	$('#editProfileButton').remove();

	if(language == "hr")
	{	
		$('#user').append('<button type="button" id="editProfileButtonChangePassword" class="btn btn-default">Promijeni šifru</button>');
		$('#user').append('<button type="button" id="editProfileButtonSubmit" class="btn btn-default">Potvrdi</button>');
	}
	if(language == "en")
	{
		$('#user').append('<button type="button" id="editProfileButtonChangePassword" class="btn btn-default">Change password</button>');
		$('#user').append('<button type="button" id="editProfileButtonSubmit" class="btn btn-default">Submit</button>');
	}


	var val = $('#showProfileName').html();
	$('#showProfileName').html('<input type="text" id="showProfileNameText" class="form-control" value="'+val+'">');

	var val = $('#showProfileEmail').html();
	$('#showProfileEmail').html('<input type="text" id="showProfileEmailText" class="form-control" value="'+val+'">');

	var val = $('#showProfileSurname').html();
	$('#showProfileSurname').html('<input type="text" id="showProfileSurnameText" class="form-control" value="'+val+'">');

	
});

$('body').on('click', '#editProfileButtonChangePassword', function(){
	var language = $.cookie("language");
	$('#editProfileButtonChangePassword').remove();

	if(language == "hr")
	{	
		$('#showProfile').append('<tr><td style="border-right: 1px solid white;">Nova šifra</td><td><input type="password" id="newPassword1" class="form-control"></td></tr>');
		$('#showProfile').append('<tr><td style="border-right: 1px solid white;">Ponovite novu šifru</td><td><input type="password" id="newPassword2" class="form-control"></td></tr>');
	}
	if(language == "en")
	{
		$('#showProfile').append('<tr><td style="border-right: 1px solid white;">New password</td><td><input type="password" id="newPassword1" class="form-control"></td></tr>');
		$('#showProfile').append('<tr><td style="border-right: 1px solid white;">Retype new password</td><td><input type="password" id="newPassword2" class="form-control"></td></tr>');
	}
});

$('body').on('click', '#editProfileButtonSubmit', function(){
	var language = $.cookie("language");

	if($('#newPassword1').length == 1)
	{
		if($('#newPassword1').val() == $('#newPassword2').val() && $('#newPassword1').val().length >= 6)
		{
		if(language == "hr") var retVal = prompt("Unesi staru šifru : ", "");
		else var retVal = prompt("Enter your old password : ", "");

		if(retVal != null) editUser( $('#showProfileNameText').val(), $('#showProfileSurnameText').val(), $('#showProfileEmailText').val(), retVal, $('#newPassword1').val());
		}

		else if($('#newPassword1').val().length < 6 && $('#newPassword1').length == 1)
		{
			if(language == "hr") alert("Šifra mora biti dulja od 6 znakova.");
			else alert("Password must be longer than 6 characters.");
		}

		else if($('#newPassword1').val() != $('#newPassword2').val() && $('#newPassword1').length == 1){
			if(language == "hr") alert("Šifre se ne podudaraju");
			else alert("Passwords do not match.");
		}
	}

	if($('#newPassword1').length == 0)
	{
		if(language == "hr") var retVal = prompt("Unesi staru šifru : ", "");
		else var retVal = prompt("Enter your old password : ", "");

		if(retVal != null) editUser( $('#showProfileNameText').val(), $('#showProfileSurnameText').val(), $('#showProfileEmailText').val(), retVal, null);
		//editUser(name, surname, email, cpw, npw)
	}
});


$('.donateButton').on('click', function(){

//	
		var language = $.cookie("language");
		if(language == "hr") var retVal = prompt("Koliko želite donirati?\nTrenutno imate : " + $('#userCredits').html() + " kredita", "");
		else var retVal = prompt("How much do you want to donate?\nCurrently you have : " + $('#userCredits').html() + " kredita", "");

		if(retVal != null) donate($('#hiddenValueId').val(), retVal);
});



});

function donate(postId, amount)
{
    $.ajax({
      url: 'AjaxStuff/ajaxDonate.php',
      type: 'POST',
      data: { donationId : postId, donatedAmount : amount },
      dataType: 'html',
    })
    .done(function(data) {
    	alert(data);
		location.reload();

    	
    })
	.fail(function(request, status, error) {
		alert(request.responseText);
	});
}

function getAllDonations(searchText, selectedCountry, currentPage)
{
    $.ajax({
      url: 'AjaxStuff/getAjaxAllDonations.php',
      type: 'POST',
      data: { search: searchText, country: selectedCountry, page : currentPage },
      dataType: 'html',
    })
    .done(function(data) {
//    	window.location.replace("http://localhost:444/DWA/Seminar2/index.php");
		$('#donationListContent').empty();
		$('#donationListContent').append(data);
    })
	.fail(function(request, status, error) {
		alert(request.responseText);
	});
}

function addComment(text, donationId, replyTo)
{
    $.ajax({
      url: 'AjaxStuff/ajaxComments.php?type=insert',
      type: 'POST',
      data: { text : text, id : donationId, replyToId : replyTo },
      dataType: 'html',
    })
    .done(function(data) {
		$('#addCommentArea').remove();
		$('#addCommentButton').attr('disabled', false);
		alert(data);
    })
	.fail(function(request, status, error) {
		alert(request.responseText);
	});	
}

function editUser(name, surname, email, cpw, npw) 
{
    $.ajax({
      url: 'AjaxStuff/ajaxEditUser.php',
      type: 'POST',
      data: { name : name, surname : surname, email : email, cPw : cpw, nPw : npw },
      dataType: 'html',
    })
    .done(function(data) {
    	alert(data);
    	location.reload();
    })
	.fail(function(request, status, error) {
		alert(request.responseText);
	});
}
