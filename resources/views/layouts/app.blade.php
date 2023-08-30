<!DOCTYPE html>
<html>
<head>
    {{-- <link href="{{ url('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
.main-container{
    display: grid;
    grid-template-columns: 250px 1fr;
    background: #F4F5F6;
    height: 100vh;
}
.main-container nav {
    padding: 20px 10px 20px 20px;
}
.main-container nav ul{
    display: flex;
    border-radius: 10px;
    box-shadow: -2px 6px 20px rgba(0,0,0,0.1);
    flex-direction: column;
    gap: 2px;
    padding: 10px;
    list-style: none;
    height: 100%;
    background: #FFFFFF;
}
.main-container nav ul li{
    display: flex;
}
.main-container nav ul li a{
    padding: 8px 15px;
    border-radius: 8px;
    transition: all 0.25s ease;
    color: #333333;
    text-decoration: none;
    font-weight: 500;
    width: 100%;
}
.main-container nav ul li:hover a{
    background: #eeeeee;
}
.main-container .container{
    padding: 20px 20px 20px 10px;
}
.main-container .container > *{
    border: 1px solid #DDDDDD;
    border-radius: 10px;
    padding: 20px;
    height: 100%;
}
.form-main-container{
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.flex-column{
    flex-direction: column;
}
.form-main-container button{
    border: none;
    border-radius: 6px;
    outline: none;
    font-weight: 600;
    padding: 8px 15px;
    min-width: 100px;
    height: fit-content;
    color: #FFFFFF;
    align-self: flex-end;
    background: transparent;
}
.form-main-container button[type='submit']{
    background: #007bff;
}
.form-main-container button[type='button']{
    border: 1px solid #007bff;
    color: #007bff;
    background: #FFFFFF;
}
.form-container{
    display: grid;
    height: fit-content;
    gap: 5px;
    width: calc(33.3% - 13px)
}
.form-container label{
    font-size: 14px;
    font-weight: 500;
    color: #333333;
}
.form-container :is(input, textarea, select){
    background: #FFFFFF;
    border: 1px solid #DDDDDD;
    outline: none;
    border-radius: 6px;
    padding: 6px 12px;
    min-width: 170px;
}
.form-container select{
    /* appearance: none; */
    position: relative;
}
/* .form-container select::after{
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: #333333;
    top: 50%;
    right: 10px;
    transform: translateY(-50%)
} */
.table{
    width: 100%;
    border-radius: 10px;
    border: 1px solid #DDDDDD;
    overflow: hidden; 
}
.table table{
    width: 100%;
    color: #333333;
}
.table table thead{
    font-weight: 600;
}
.table table tr{
    border-bottom: 1px solid #DDDDDD; 
}
.table table tbody tr:last-child{
    border-bottom: none; 
}
.table table :is(th,td){
    padding: 5px 8px;
    text-align: left;
}
.table table :is(input, textarea, select){
    background: #FFFFFF;
    border: 1px solid #DDDDDD;
    outline: none;
    border-radius: 6px;
    padding: 6px 12px;
    width: 100%;
}
.error-message{
    width: 100%;
    color: #FF0000;
}
.dialog-popup{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 100%;
    height: fit-content;
    max-width: 400px;
    border: none;
    border-radius: 10px;
    box-shadow: -4px 10px 25px rgba(0,0,0,0.1);
    padding: 20px;
}
.dialog-popup .form-container{
    width: 100%;
}
.quota-summary {
    align-items: center;
    gap: 2px 40px;
    flex-wrap: wrap;
    width: 100%;
}
.quota-summary p{
    display: flex;
    gap: 5px;
    color: #333333;
}
.quota-summary p:first-child{
    width: 100%;
    font-size: 14px;
    font-weight: 500;
}
.quota-summary p:last-child{
    margin-bottom: 10px;
}

#quota-validation-error, #error-list {
    color:red;
}
        </style>
</head>
<body>
<div class="main-container">
    <nav>
        <ul>
            {{-- <li><a href="/">Home</a></li>
            <li><a href="{{ route('sports.index') }}">Sports</a></li>
            <li><a href="{{ route('genders.index') }}">Genders</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li> --}}
            <li><a href="{{ route('overall-quotas.create') }}">Create Overall Quota</a></li>
            <li><a href="{{ route('state-quotas.create') }}">Create State Quota</a></li>
        </ul>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</div>

<!-- Add your scripts and other body elements here -->
</body>
</html>
