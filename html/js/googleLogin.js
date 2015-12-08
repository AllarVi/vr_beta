function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    // Instead: var id_token = googleUser.getAuthResponse().id_token; // Not neccessary in our application for simplicity.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());

    document.getElementById('status-google').innerHTML =
        'Name: ' + profile.getName() + '<br>'
            + 'ID: ' + profile.getId()
            + 'E-mail: ' + profile.getEmail()
            + 'Picture link: ' + profile.getImageUrl();
}