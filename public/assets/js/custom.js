function passwordShowHide(passwordInputID, passwordButtonID) 
{
    var passwordInputField = $('#' + passwordInputID);
    var passwordButtonText = $('#' + passwordButtonID).text();

    // Toggle between 'password' and 'text' types
    passwordInputField.attr('type', passwordButtonText === 'Show' ? 'text' : 'password');

    // Toggle between 'Show' and 'Hide'
    $('#' + passwordButtonID).text(passwordButtonText === 'Show' ? 'Hide' : 'Show');
}