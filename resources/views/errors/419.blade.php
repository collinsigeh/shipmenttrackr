<!doctype html>
<html lang="en">
  <head>
      
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
      body{
        background-color: #f9f9f9;
      }
      
      #logo{
        max-width: 200px;
        margin: 50px 20px 80px 20px;
      }

      h2{
        margin-bottom: 20px;
      }

      #return-home{
        margin-top: 40px;
        margin-bottom: 80px;
      }
      
      #return-home a{
        color: #afafaf;
        font-style: italic;
        font-size: 90%;
        text-decoration: none;
      }

      #error-message{
        color: #cb0015;
        font-weight: bold;
      }

      .info-set{
          background-color: #fbfbfb;
            padding: 20px 20px 10px 20px;
          margin-bottom: 30px;
          border: 1px solid #ccc;
          border-radius: 5px;
      }

    .data-info-set{
        background-color: #fbfbfb;
        padding: 20px 20px 0 20px;
        border-radius: 3px;
        margin-bottom: 30px;
        border: 1px solid #ccc; 
        border-top: 3px solid #666; 
    }

    .data-log{
        background-color: #f6f6f6;
        padding: 20px 20px 10px 20px;
        margin-bottom: 30px;
    }

    .data-log .main-info{
        font-size: 110%;
    }
    </style>

    <title>Track Shipment</title>
    <link rel="shortcut icon" type="image/png" href="https://dotglobalgroup.com/wp-content/uploads/2021/06/cropped-Favicon-1.png"/>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="text-center">
                <a href="https://dotglobalgroup.com/">
                    <img src="https://dotglobalgroup.com/wp-content/uploads/2021/06/Logo_Dot_Global_Resources.png" alt="" id="logo">
                </a>
            </div>

        </div>
            
        <div class="col-md-4 offset-md-4">
          
            <div id="return-home">
                <div class="alert alert-info">
                    Your current section expired due to prolong inactivity.
                </div>
                <p>
                    <a href="https://dotglobalgroup.com/">&larr; Go back home</a>
                </p>
                <p>
                    <a href="https://dotglobalgroup.com/shipmentapp/">&larr; Relogin here</a>
                </p>
            </div>
        </div>

      </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>