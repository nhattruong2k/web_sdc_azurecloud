<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('consultations.title')}}</title>
    <style>
        .titleEmail{
            text-align: center;
        }
        .headEmail {
            width: 500px;
            margin: 0 auto;
        }
        .borderEmail{
            border: 1px solid #d23d1178; 
            width: 500px;
        }
        .ulEmail {
            padding: 0px 30px;
        }
        .Register{
            display: block;
            padding: 10px 30px;
            font-size: 17px;
            text-align: center;
        }
        .hrefRigister{
            text-decoration: none;
        }
        .details{
            color: #d23d11e0;
        }
        .details:hover{
            color: slateblue;
        }
        .spRegister{
            text-align: initial;
        }
    </style>
</head>
<body>
    <div class="headEmail">
        <div class="borderEmail">
            <div class="title">
                <h2 class="titleEmail">{{__('consultations.titleEmail')}}</h2>
            </div>
            <ul class="ulEmail">
                <li><p><b>{{__('consultations.name')}}:</b> <span>{{$details['name']}}</span></p></li>
                <li><p><b>{{__('consultations.email')}}:</b> <span>{{$details['email']}}</span></p></li>
                <li> <p><b>{{__('consultations.phone')}}:</b> <span>{{$details['phone']}}</span></p></li>
                <li><p><b>{{__('consultations.address')}}:</b> <span>{{$details['address']}}</span></p></li>
                <li><p><b>{{__('consultations.year_of_birth')}}:</b> <span>{{$details['year_of_birth']}}</span></p></li>
                <li><p><b>{{__('consultations.course')}}:</b> <span>{{$course}}</span></p></li>
            </ul> 
            <div>
                <div class="Register">
                    <div class="spRegister">
                        <a href="{{Route(\App\Models\Consultation::LIST)}}" class="hrefRigister">
                            <span class="details">
                                {{__('consultations.details')}}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>