function sweet(){

    swal({
        title: 'Input email address',
        input: 'email'
    }).then(function(email) {
        swal({
            type: 'success',
            html: 'Entered email: ' + email
        })
    })

}