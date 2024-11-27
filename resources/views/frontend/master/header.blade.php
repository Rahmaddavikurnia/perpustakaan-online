<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Online</title>
    <link rel="stylesheet" href="{{asset('frontend/assets/libs/OwlCarousel-2/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/dist/css/iconfont/tabler-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/dist/css/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* input[type="radio"]:checked + label i {
            color: #FFD700; 
        .fa-star {
            font-size: 24px;
        } */

        .rating {
            direction: rtl;
            display: flex;
            justify-content: flex-end;
            cursor: pointer;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 2rem;
            color: #ddd; /* Warna bintang default (putih) */
            transition: color 0.3s;
        }

        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffc107; /* Warna bintang saat aktif (kuning) */
        }

        .stars .fa {
        font-size: 20px;
        color: #ccc;
        }
        .stars .fa.checked {
            color: #ffc107;
        }
        .review {
            margin-bottom: 15px;
        }
        .review p {
            margin-top: 5px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>