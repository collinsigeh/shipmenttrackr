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
            
            @if ($query)
            <div class="shipment">
                <h5>Shipment no.:</h5>
                <div class="info-set">
                    <h4>{{ strtoupper($shipment->tracking_code) }}</h4>
                </div>

                <h5>Tracking history:</h5>
                <div class="data-info-set">
                    <div class="data-log">
                        @if ($shipment->locations->count())
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">                
                                    <tbody>
                                        @foreach ($shipment->locations as $location)
                                            <tr>
                                                <td><img src="{{ asset('images/info-icon.png') }}" alt=""></td>

                                                <td style="padding-bottom: 20px;">
                                                    <p>
                                                        <strong>{{ $location->name }}</strong>
                                                    </p>

                                                    <div class="row">        
                                                        <div class="col-md-3">
                                                            <small class="text-muted"><em>Date: &nbsp;</em> {{ $location->date }}</small>
                                                        </div>
                                                            
                                                        <div class="col-md-3">
                                                            <small class="text-muted"><em>Time: &nbsp;</em> @if ($location->time)
                                                                {{ $location->time }}
                                                            @else
                                                                --
                                                            @endif</small>
                                                        </div>

                                                        <div class="col-md-6">
                                                            @if ($location->remark)
                                                                <small class="text-muted">{{ $location->remark }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="badge badge-pill 
                                                            @php
                                                                if($location->status->name == 'Pending')
                                                                {
                                                                    echo 'badge-light';
                                                                }
                                                                elseif($location->status->name == 'Complete' OR
                                                                        $location->status->name == 'Completed' OR
                                                                        $location->status->name == 'Order Complete' OR
                                                                        $location->status->name == 'Order Completed')
                                                                {
                                                                    echo 'badge-success';
                                                                }
                                                                else
                                                                {
                                                                    echo 'badge-primary';
                                                                }
                                                            @endphp">{{ $location->status->name }}
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @else
                            <div class="alert alert-info">
                                No history found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <hr style="margin: 40px 0;">
            @endif

            <div class="text-center">
                <h2>Track Shipment</h2>
            </div>

        </div>
            
        <div class="col-md-4 offset-md-4">
            
            <form action="{{ route('shipments.track') }}" method="get" role="search">
                <div class="input-group mb-3">
                    <input type="text" id="tracking-code" name="tc" class="form-control" placeholder="Enter tracking code" aria-label="Enter tracking code" aria-describedby="button-addon2">
                    
                    <button type="submit" class="btn btn-secondary" type="button" id="button-addon2">Submit</button>
                </div>
            </form>

            @if (strlen($error_message) > 10)
                
                <span class="text-danger" role="alert">
                    {!! $error_message !!}
                </span>

            @endif
          
            <div id="return-home">
                <a href="https://dotglobalgroup.com/">&larr; Go back</a>
            </div>
        </div>

      </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>