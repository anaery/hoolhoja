<!DOCTYPE html>
<html lang="en">
<head>
    <title>LPA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<!--===============================================================================================--> 

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 col-5">

                <div>
                <center>

                    <button class="login100-form-btn" onclick="error();">
                        ERROR
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="info();">
                        INFO
                    </button>
                    
                    <br>

                    <button class="login100-form-btn" onclick="success1();">
                        SECCESS 1
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="success2();">
                        SECCESS 2
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="question();">
                        QUESTION
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="select();">
                        SELECT
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="warning();">
                        WARNING AND SUCCESS
                    </button>

                    <br>

                    <button class="login100-form-btn" onclick="timer();">
                        TIMER
                    </button>
                    
                    <?php 
                        if( isset($_GET['a']) ){
                            if($_GET['a'] == 'a'){
                    ?>
                            <script>
                                Swal.fire({
                                title: 'Error!',
                                text: 'Do you want to continue',
                                type: 'error',
                                confirmButtonText: 'Cool'
                                })
                            </script>
                    <?php
                            }    
                        }
                    ?>

                </center>
                </div>

            </div>
        </div>
    </div>
    
<!--===============================================================================================-->  
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    <!-- Mais exemplos em https://sweetalert2.github.io/ -->
    
    <script>
        function error(){
            Swal.fire({
            title: 'Error!',
            text: 'Do you want to continue',
            type: 'error',
            confirmButtonText: 'Cool'
            })
        }
    </script>

    <script>
        function info(){
            Swal.fire({
            title: 'Info!',
            text: 'Do you want to continue',
            type: 'info'
            })
        }
    </script>

    <script>
        function success1(){
            Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
            )
        }
    </script>

    <script>
        function success2(){
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>

    <script>
        function question(){
            Swal.fire(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
        }
    </script>

    <script>
        function select(){
            // inputOptions can be an object or Promise
            const inputOptions = new Promise((resolve) => {
            setTimeout(() => {
                resolve({
                '#ff0000': 'Red',
                '#00ff00': 'Green',
                '#0000ff': 'Blue'
                })
            }, 2000)
            })
            const {value: color} = await Swal.fire({
            title: 'Select color',
            input: 'radio',
            inputOptions: inputOptions,
            inputValidator: (value) => {
                return !value && 'You need to choose something!'
            }
            })

            if (color) {
            Swal.fire({html: 'You selected: ' + color})
            }
        }
    </script>

    <script>
        function warning(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>

    <script>
        function timer(){
            let timerInterval
            Swal.fire({
                title: 'Auto close alert!',
                html: 'I will close in <strong></strong> seconds.',
                timer: 2000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('strong')
                        .textContent = Swal.getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log('I was closed by the timer')
                }
            })
        }
    </script>
<!--===============================================================================================-->

</body>
</html>