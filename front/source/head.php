<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Mon site de cocktails</title>
    <style> 
       main{
        background-color: #f8f9fa;
        min-height : 450px;
        height:100%;
        right : 5px;
        bottom: 8px;
        padding-left : 25%;
        padding-bottom : 8px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
       }
       #nav_index{
        position : fixed;
        float: left;
        background-color: #f8f9fa;
        width: auto;
        max-width: 24%;
        min-width: 24%;
        height: auto;
        max-height: 100%;
        margin-left: 5px;
       }
       header{
        position: sticky;
        top: 0px;
        z-index:1;
       }
       footer{
        position: sticky;
        height: 10%;
        text-align: center;
        margin-bottom: 10px;
        background-color: #f8f9fa;
       }
       form{
        display: block;
       }
       #card{
        border-color: #198754;
        border-width: 2px;
       }
       #card img{
        margin-left: auto;
        margin-right: auto;
        margin-top: 2px;
       }
       .card{
        border: var(--bs-card-border-width) solid #198754;
        align-items: center;
        --bs-card-bg: #f8f9fa;
        margin: 3px;
        margin-top: 5px;
        margin-bottom: 5px;
        height: 410px;
       }
       a{
        color: #198754;
       }
       a:hover {
        color: #11c974;
      }
       h5{
        text-align: center;
       }
       .navbar>.container-fluid{
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        flex-direction: row;
        flex-wrap: nowrap;
      }
      .form-control{
        width: 200px;
        padding: 0.3rem 0.2rem;
      }
      label{
        margin-right: 3px;
      }
      img{
        margin-top: 1rem
      }
      
      input[type="radio"].demo3 {
        display: none;
      }
      input[type="radio"].demo3 + label {
        display:none;
        border: 1px solid #000;
        padding: 0.5rem 1rem;
        min-width:50px;
        text-align:center;
      }
      input[type="radio"].demo3:checked + label {
        display: inline-block;
      }
      h3{
        color: #198754;
      }
      h4{
        color: #198754;
      }
      u{
        color: #198754;
      }
      #recipe{
        align-items: center;
      }
      ::marker{
        color: #198754;
      }
      table{
        display: flex;
      }
      table>* {
        margin: 0 10px;
        flex: 1;
      }
    </style>
</head>

<body>

