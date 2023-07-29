@extends('modules.auth.master')
@section('content')
<div class="music_app">
    <div class="ma_container" id="page" data-page="home">
        <!-- Content  -->
        <div id="container_content">
            <style>
                .music_app {
                    padding: 0;
                }
            </style>
            <div class="ma_home_nav">
                <nav class="navbar">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between info_part">
                            <div class="navbar-left">
                                <a class="active" href="#">Home
                                </a>
                            </div>
                            <div style="" class="navbar-mid">
                                <imgstyle="height: 30px;" src="{{ asset('/img/vocalno/icon.png') }}"
                                    alt="">
                            </div>
                            <div class="navbar-right">
                                <a class="btn" href="{{route('auth.login')}}">login </a> /
                                <a class="btn" href="{{route('auth.register')}}">register</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="ma_home_head">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="heading">
                                Music
                                <svg xmlns="http://www.w3.org/2000/svg" class="play" width="69.896"
                                    height="69.896" viewBox="0 0 69.896 69.896">
                                    <path
                                        d="M36.948,2A34.948,34.948,0,1,0,71.9,36.948,34.961,34.961,0,0,0,36.948,2Zm-6.99,50.675V21.221L50.927,36.948Z"
                                        transform="translate(-2 -2)" fill="var(--second-color)" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="wave" width="1281" height="68.9"
                                    viewBox="0 0 1281 68.9">
                                    <g id="Group_4610" data-name="Group 4610" transform="translate(-638 -386)">
                                        <g id="Sound_bar" data-name="Sound bar" transform="translate(-824 256.5)">
                                            <g id="Group_4609" data-name="Group 4609"
                                                transform="translate(1463.5 129.5)">
                                                <line id="Line_2" data-name="Line 2" y2="68.896"
                                                    fill="none" stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_8" data-name="Line 8" y2="68.896"
                                                    transform="translate(48)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_26" data-name="Line 26" y2="68.896"
                                                    transform="translate(240)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_14" data-name="Line 14" y2="47.5"
                                                    transform="translate(96)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_28" data-name="Line 28" y2="68.896"
                                                    transform="translate(320.5)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_9" data-name="Line 9" y2="58.849"
                                                    transform="translate(56 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_33" data-name="Line 33" y2="58.849"
                                                    transform="translate(280.5 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_25" data-name="Line 25" y2="58.849"
                                                    transform="translate(248 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_13" data-name="Line 13" y2="53.759"
                                                    transform="translate(88 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_29" data-name="Line 29" y2="58.849"
                                                    transform="translate(312.5 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_15" data-name="Line 15" y2="35.759"
                                                    transform="translate(104 5.741)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_10" data-name="Line 10" y2="43.06"
                                                    transform="translate(64 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_32" data-name="Line 32" y2="43.06"
                                                    transform="translate(288.5 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_24" data-name="Line 24" y2="43.06"
                                                    transform="translate(256 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_12" data-name="Line 12" y2="41"
                                                    transform="translate(80 15.5)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_30" data-name="Line 30" y2="43.06"
                                                    transform="translate(304.5 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_22" data-name="Line 22" y2="43.06"
                                                    transform="translate(272 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_16" data-name="Line 16" y2="25.147"
                                                    transform="translate(112 14.353)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_21" data-name="Line 21" y2="37.319"
                                                    transform="translate(152 17.224)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6988" data-name="Path 6988" d="M0-3.943V43.693"
                                                    transform="translate(160 15.507)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6989" data-name="Path 6989" d="M0-3.943V58.527"
                                                    transform="translate(168 8.822)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6990" data-name="Path 6990" d="M0-3.943v43.06"
                                                    transform="translate(176 18.297)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6991" data-name="Path 6991" d="M0-3.943v55.68"
                                                    transform="translate(184 11.726)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6992" data-name="Path 6992" d="M0-3.943V59.7"
                                                    transform="translate(192 7.652)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6993" data-name="Path 6993" d="M0-3.943V43.693"
                                                    transform="translate(200 15.507)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6994" data-name="Path 6994" d="M0-3.943V33.375"
                                                    transform="translate(208 21.167)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6995" data-name="Path 6995" d="M0-3.943V45.21"
                                                    transform="translate(216 14.991)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <path id="Path_6996" data-name="Path 6996" d="M0-3.943v43.06"
                                                    transform="translate(224 18.297)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_11" data-name="Line 11" y2="27.271"
                                                    transform="translate(72 22.965)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_31" data-name="Line 31" y2="27.271"
                                                    transform="translate(296.5 22.965)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_23" data-name="Line 23" y2="27.271"
                                                    transform="translate(264 22.965)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_17" data-name="Line 17" y2="17.535"
                                                    transform="translate(120 22.965)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_20" data-name="Line 20" y2="27.271"
                                                    transform="translate(144 22.965)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_18" data-name="Line 18" y2="12.918"
                                                    transform="translate(128 30.142)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_19" data-name="Line 19" y2="18.659"
                                                    transform="translate(136 27.271)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_3" data-name="Line 3" y2="51.672"
                                                    transform="translate(8 10.047)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_7" data-name="Line 7" y2="51.672"
                                                    transform="translate(40 10.047)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_27" data-name="Line 27" y2="51.672"
                                                    transform="translate(232 10.047)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_4" data-name="Line 4" y2="35.883"
                                                    transform="translate(16 18.659)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_6" data-name="Line 6" y2="35.883"
                                                    transform="translate(32 18.659)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                                <line id="Line_5" data-name="Line 5" y2="20.095"
                                                    transform="translate(24 27.271)" fill="none"
                                                    stroke="var(--second-color)" stroke-width="3" />
                                            </g>
                                        </g>
                                        <g id="Sound_bar-2" data-name="Sound bar"
                                            transform="translate(-188 256.5)">
                                            <line id="Line_2-2" data-name="Line 2" y2="68.9"
                                                transform="translate(1463.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_8-2" data-name="Line 8" y2="68.9"
                                                transform="translate(1511.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_26-2" data-name="Line 26" y2="68.9"
                                                transform="translate(1703.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_14-2" data-name="Line 14" y2="68.9"
                                                transform="translate(1559.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_28-2" data-name="Line 28" y2="68.9"
                                                transform="translate(1784 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_9-2" data-name="Line 9" y2="61.9"
                                                transform="translate(1519.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_33-2" data-name="Line 33" y2="61.9"
                                                transform="translate(1744 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_25-2" data-name="Line 25" y2="61.9"
                                                transform="translate(1711.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_13-2" data-name="Line 13" y2="61.9"
                                                transform="translate(1551.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_29-2" data-name="Line 29" y2="61.9"
                                                transform="translate(1776 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_15-2" data-name="Line 15" y2="61.9"
                                                transform="translate(1567.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_10-2" data-name="Line 10" y2="30"
                                                transform="translate(1527.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_32-2" data-name="Line 32" y2="30"
                                                transform="translate(1752 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_24-2" data-name="Line 24" y2="30"
                                                transform="translate(1719.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_12-2" data-name="Line 12" y2="30"
                                                transform="translate(1543.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_30-2" data-name="Line 30" y2="30"
                                                transform="translate(1768 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_22-2" data-name="Line 22" y2="30"
                                                transform="translate(1735.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_16-2" data-name="Line 16" y2="30"
                                                transform="translate(1575.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_21-2" data-name="Line 21" y2="26"
                                                transform="translate(1615.5 152.9)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6988-2" data-name="Path 6988" d="M0-3.943V29.245"
                                                transform="translate(1623.5 162.4)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6989-2" data-name="Path 6989" d="M0-3.943V60.48"
                                                transform="translate(1631.5 136.842)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6990-2" data-name="Path 6990" d="M0-3.943v30"
                                                transform="translate(1639.5 155.054)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6991-2" data-name="Path 6991" d="M0-3.943V55.749"
                                                transform="translate(1647.5 138.865)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6992-2" data-name="Path 6992" d="M0-3.943V61.295"
                                                transform="translate(1655.5 136.027)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6993-2" data-name="Path 6993" d="M0-3.943V29.245"
                                                transform="translate(1663.5 162.4)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6994-2" data-name="Path 6994" d="M0-3.943v26"
                                                transform="translate(1671.5 156.843)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6995-2" data-name="Path 6995" d="M0-3.943V57.171"
                                                transform="translate(1679.5 137.443)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6996-2" data-name="Path 6996" d="M0-3.943v30"
                                                transform="translate(1687.5 155.054)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_11-2" data-name="Line 11" y2="19"
                                                transform="translate(1535.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_31-2" data-name="Line 31" y2="19"
                                                transform="translate(1760 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_23-2" data-name="Line 23" y2="19"
                                                transform="translate(1727.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_17-2" data-name="Line 17" y2="19"
                                                transform="translate(1583.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_20-2" data-name="Line 20" y2="19"
                                                transform="translate(1607.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_18-2" data-name="Line 18" y2="9"
                                                transform="translate(1591.5 161.754)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_19-2" data-name="Line 19" y2="13"
                                                transform="translate(1599.5 159.846)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_3-2" data-name="Line 3" y2="56.9"
                                                transform="translate(1471.5 136.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_7-2" data-name="Line 7" y2="56.9"
                                                transform="translate(1503.5 136.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_27-2" data-name="Line 27" y2="56.9"
                                                transform="translate(1695.5 136.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_4-2" data-name="Line 4" y2="25"
                                                transform="translate(1479.5 154.313)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_6-2" data-name="Line 6" y2="25"
                                                transform="translate(1495.5 154.313)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_5-2" data-name="Line 5" y2="14"
                                                transform="translate(1487.5 160.179)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                        </g>
                                        <g id="Sound_bar-3" data-name="Sound bar"
                                            transform="translate(262 256.5)">
                                            <line id="Line_2-3" data-name="Line 2" y2="68.9"
                                                transform="translate(1463.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_8-3" data-name="Line 8" y2="68.9"
                                                transform="translate(1511.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_14-3" data-name="Line 14" y2="68.9"
                                                transform="translate(1559.5 129.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_9-3" data-name="Line 9" y2="61.9"
                                                transform="translate(1519.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_13-3" data-name="Line 13" y2="61.9"
                                                transform="translate(1551.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_15-3" data-name="Line 15" y2="61.9"
                                                transform="translate(1567.5 133.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_10-3" data-name="Line 10" y2="30"
                                                transform="translate(1527.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_12-3" data-name="Line 12" y2="30"
                                                transform="translate(1543.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_16-3" data-name="Line 16" y2="30"
                                                transform="translate(1575.5 151.111)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_21-3" data-name="Line 21" y2="26"
                                                transform="translate(1615.5 152.9)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6988-3" data-name="Path 6988" d="M0-3.943V29.245"
                                                transform="translate(1623.5 153.88)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6989-3" data-name="Path 6989" d="M0-3.943V48.568"
                                                transform="translate(1631.5 144.832)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6990-3" data-name="Path 6990" d="M0-3.943v41.1"
                                                transform="translate(1639.5 149.966)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6991-3" data-name="Path 6991" d="M0-3.943V23.846"
                                                transform="translate(1647.5 155.054)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <path id="Path_6992-3" data-name="Path 6992" d="M0-3.943V48.568"
                                                transform="translate(1655.5 144.832)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_11-3" data-name="Line 11" y2="19"
                                                transform="translate(1535.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_17-3" data-name="Line 17" y2="19"
                                                transform="translate(1583.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_20-3" data-name="Line 20" y2="19"
                                                transform="translate(1607.5 157.031)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_18-3" data-name="Line 18" y2="9"
                                                transform="translate(1591.5 161.754)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_19-3" data-name="Line 19" y2="13"
                                                transform="translate(1599.5 159.846)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_3-3" data-name="Line 3" y2="56.9"
                                                transform="translate(1471.5 136.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_7-3" data-name="Line 7" y2="56.9"
                                                transform="translate(1503.5 136.5)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_4-3" data-name="Line 4" y2="25"
                                                transform="translate(1479.5 154.313)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_6-3" data-name="Line 6" y2="25"
                                                transform="translate(1495.5 154.313)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                            <line id="Line_5-3" data-name="Line 5" y2="14"
                                                transform="translate(1487.5 160.179)" fill="none"
                                                stroke="var(--second-color)" stroke-width="3" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <p class="sub_heading">Discover, stream, and share a constantly expanding mix of music
                                from emerging and major artists around the world.</p>
                            <div class="d-none">
                                <h2 class="home_big_title">Most Popular This Week</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/hppcYoG3gXH261h.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2023/03/FJNvQqfgOlH4nZdYuCRg_04_7137a1b729def3a0c74a6169945782af_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>It&#039;s Your Birthday</h4>
                                                    <p>Donele Romero Bailey <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/NPApy5s4SCm6qFn.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2022/12/bWRv1Tuhb7LEk2BBNkBq_21_71f80ea7df0bc25c538148a8b387dc8d_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Weekend</h4>
                                                    <p>Deen Doughouz <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/bqDlwx13lz881WM.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2019/04/GOL14NGaeudrTiEvTaN6_30_b375d10fd4f9b593031462cdcf62a0a9_image.png">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Testing selling song</h4>
                                                    <p>Deen Doughouz <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/r97bPsfrRvFqxCN.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2023/03/AtqIHmHFOym2gc7MrUxM_06_40bf363387060db8d6e7157fb23a67df_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Cengiz Kurtoglu - Sevmek Kim Sen Kimsin</h4>
                                                    <p>Mehmet Ali Ayhan</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/k29cE825F4XPcMc.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2023/02/bUMUmR4W4mePgJqMhJqZ_25_35d1fd32fb38ea5808130616b7c91b72_image.png">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Shouse, dj - Love Tonight (Dj Cardi Mashup)</h4>
                                                    <p>erhsrthsr thsrthsrt <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/uxIRQ5QcwLnf8oh.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2019/04/9HrPXydf3oXcHchDJsLb_07_427ccdeba5a4eb88fe5ea0d07b8eef71_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Soundtrack - Main Theme (Official Version)</h4>
                                                    <p>Deen Doughouz <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/mmwmgTWfUNSuCTX.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2023/02/e9KECobmSPVEiC1WEjvn_25_7d222929960f6bb29c1b0dafec8be70e_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Amir Tataloo - Parvaz [320]</h4>
                                                    <p>tataloo <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="35.271" height="34.055"
                                                            viewBox="0 0 35.271 34.055">
                                                            <g transform="translate(-867.5 -1775)"
                                                                class="verified_ico" data-original-title=""
                                                                title="">
                                                                <g transform="translate(867.5 1775)"
                                                                    fill="var(--main-color)">
                                                                    <path
                                                                        d="M 22.03647232055664 33.35497283935547 C 21.90776252746582 33.35497283935547 21.77789306640625 33.34488296508789 21.65046310424805 33.32497406005859 L 18.17597198486328 32.78217315673828 C 17.99781227111816 32.75434112548828 17.8160514831543 32.740234375 17.6357421875 32.740234375 C 17.4554328918457 32.740234375 17.27367210388184 32.75434112548828 17.09552192687988 32.78217315673828 L 13.62102222442627 33.32497406005859 C 13.49364185333252 33.34487152099609 13.36376190185547 33.35496139526367 13.2350025177002 33.35496139526367 C 12.57409191131592 33.35498428344727 11.9277925491333 33.08604431152344 11.46182250976562 32.61711120605469 L 8.95156192779541 30.09098243713379 C 8.698522567749023 29.83634185791016 8.408892631530762 29.62286186218262 8.09072208404541 29.45648193359375 L 4.93339204788208 27.80550193786621 C 4.237522125244141 27.4416332244873 3.747802257537842 26.76151275634766 3.623402118682861 25.98616218566895 L 3.047582149505615 22.39740180969238 C 2.991642236709595 22.04881286621094 2.883692264556885 21.71174240112305 2.726702213287354 21.39554214477539 L 1.110132217407227 18.1392822265625 C 0.7645421624183655 17.44319343566895 0.7645421624183655 16.61202239990234 1.110132217407227 15.91593265533447 L 2.726712226867676 12.65968227386475 C 2.883682250976562 12.34350299835205 2.991642236709595 12.00643253326416 3.047582149505615 11.65783309936523 L 3.623412132263184 8.069052696228027 C 3.747812271118164 7.293712615966797 4.237522125244141 6.613582611083984 4.93339204788208 6.249712467193604 L 8.09072208404541 4.598742485046387 C 8.408872604370117 4.432382583618164 8.698502540588379 4.218912601470947 8.951572418212891 3.964242696762085 L 11.46183204650879 1.438102722167969 C 11.9277925491333 0.9691926836967468 12.57409191131592 0.7002527117729187 13.23501205444336 0.7002527117729187 C 13.3637523651123 0.7002527117729187 13.49363231658936 0.7103427052497864 13.62103176116943 0.7302526831626892 L 17.09552192687988 1.27305269241333 C 17.27367210388184 1.300882697105408 17.45544242858887 1.315002679824829 17.63576126098633 1.315002679824829 C 17.81607246398926 1.315002679824829 17.99784278869629 1.300882697105408 18.17599296569824 1.27305269241333 L 21.65046310424805 0.7302626967430115 C 21.77786254882812 0.7103526592254639 21.90774154663086 0.7002626657485962 22.03649139404297 0.7002626657485962 C 22.69741249084473 0.7002626657485962 23.34370231628418 0.9692026972770691 23.80966186523438 1.438112735748291 L 26.31992149353027 3.964242696762085 C 26.57298278808594 4.218912601470947 26.86262130737305 4.432392597198486 27.18077278137207 4.598752498626709 L 30.33809280395508 6.249722480773926 C 31.03396224975586 6.613592624664307 31.52367210388184 7.293722629547119 31.64809226989746 8.069072723388672 L 32.22390365600586 11.65782260894775 C 32.27983093261719 12.00640296936035 32.38779067993164 12.34348297119141 32.54477310180664 12.65969276428223 L 34.16136169433594 15.91594314575195 C 34.50694274902344 16.61203193664551 34.50694274902344 17.44320297241211 34.16136169433594 18.13930320739746 L 32.54477310180664 21.39554214477539 C 32.38779067993164 21.71173286437988 32.27984237670898 22.04881286621094 32.22390365600586 22.39741325378418 L 31.6480827331543 25.98616218566895 C 31.523681640625 26.76151275634766 31.03397178649902 27.4416332244873 30.33810234069824 27.80550193786621 L 27.18077278137207 29.45648193359375 C 26.86262130737305 29.62284278869629 26.5729923248291 29.83631324768066 26.31992149353027 30.09098243713379 L 23.80966186523438 32.61712265014648 C 23.34372138977051 33.08601379394531 22.69741249084473 33.35494232177734 22.03647232055664 33.35497283935547 Z"
                                                                        stroke="none"></path>
                                                                    <path
                                                                        d="M 13.23503494262695 1.200252532958984 L 13.23505210876465 1.200252532958984 C 12.70630264282227 1.200271606445312 12.18925285339355 1.415424346923828 11.81649208068848 1.790531158447266 L 9.306222915649414 4.316692352294922 C 9.016992568969727 4.607732772827148 8.685991287231445 4.851701736450195 8.322402954101562 5.04182243347168 L 5.165082931518555 6.692792892456055 C 4.608392715454102 6.983892440795898 4.216611862182617 7.527992248535156 4.117092132568359 8.148262023925781 L 3.54127311706543 11.73703193664551 C 3.477352142333984 12.13538360595703 3.353971481323242 12.5206127166748 3.174552917480469 12.88201332092285 L 1.557971954345703 16.13827323913574 C 1.281513214111328 16.69514274597168 1.281501770019531 17.36007308959961 1.557960510253906 17.91695213317871 L 3.174552917480469 21.17320251464844 C 3.353961944580078 21.53457260131836 3.47734260559082 21.91980361938477 3.541261672973633 22.31819152832031 L 4.117082595825195 25.90695190429688 C 4.216602325439453 26.5272216796875 4.608381271362305 27.07132339477539 5.165082931518555 27.36242294311523 L 8.322412490844727 29.01340293884277 C 8.686031341552734 29.20354270935059 9.01704216003418 29.44752311706543 9.306222915649414 29.7385425567627 L 11.81648254394531 32.26468276977539 C 12.18926239013672 32.63981246948242 12.7062931060791 32.85496139526367 13.23501205444336 32.85496139526367 C 13.33802223205566 32.85496139526367 13.44193267822266 32.84689331054688 13.54385185241699 32.83096313476562 L 17.01831245422363 32.28817367553711 C 17.42548370361328 32.22455596923828 17.84599304199219 32.22455978393555 18.25314140319824 32.28816223144531 L 21.72764205932617 32.83097076416016 C 21.82959175109863 32.84689331054688 21.93350219726562 32.85497283935547 22.0364818572998 32.85497283935547 C 22.56519317626953 32.85497283935547 23.08222198486328 32.63982391357422 23.45500183105469 32.26469421386719 L 25.96524238586426 29.73856353759766 C 26.25445175170898 29.44752311706543 26.58546257019043 29.20353317260742 26.94908142089844 29.01340293884277 L 30.10640335083008 27.36242294311523 C 30.66310119628906 27.07132339477539 31.05487251281738 26.5272216796875 31.1544017791748 25.90695190429688 L 31.73022270202637 22.31818389892578 C 31.79414176940918 21.91979217529297 31.91752243041992 21.5345630645752 32.09693145751953 21.17321395874023 L 33.7135124206543 17.91695213317871 C 33.98997116088867 17.36008262634277 33.98997116088867 16.69515228271484 33.7135124206543 16.13827323913574 L 32.09693145751953 12.88202285766602 C 31.91752243041992 12.52064323425293 31.79414176940918 12.13541221618652 31.73022270202637 11.73703193664551 L 31.1544017791748 8.148283004760742 C 31.05487251281738 7.52800178527832 30.66310119628906 6.983901977539062 30.10640335083008 6.692802429199219 L 26.94909286499023 5.041831970214844 C 26.58548355102539 4.851713180541992 26.25447082519531 4.607732772827148 25.96526336669922 4.316682815551758 L 23.45500183105469 1.790542602539062 C 23.08222198486328 1.415412902832031 22.56519317626953 1.200263977050781 22.03647232055664 1.200263977050781 C 21.93346214294434 1.200263977050781 21.82955169677734 1.208332061767578 21.72763252258301 1.224262237548828 L 18.25318145751953 1.767051696777344 C 17.84601402282715 1.830669403076172 17.42550086975098 1.830665588378906 17.01835250854492 1.767063140869141 L 13.54385185241699 1.224250793457031 C 13.44190788269043 1.208332061767578 13.33800888061523 1.200252532958984 13.23503494262695 1.200252532958984 M 13.23500823974609 0.20025634765625 C 13.38894653320312 0.2002487182617188 13.54370498657227 0.2121047973632812 13.69821166992188 0.2362442016601562 L 17.17270278930664 0.7790412902832031 C 17.47954177856445 0.8269844055175781 17.79197311401367 0.8269844055175781 18.09881210327148 0.7790412902832031 L 21.57328224182129 0.2362442016601562 C 22.52317237854004 0.087860107421875 23.48665237426758 0.4037055969238281 24.16433334350586 1.085674285888672 L 26.67459106445312 3.61180305480957 C 26.89123153686523 3.829822540283203 27.14009094238281 4.013252258300781 27.41245269775391 4.155662536621094 L 30.56978225708008 5.806642532348633 C 31.40900230407715 6.245471954345703 31.99173164367676 7.054792404174805 32.14177322387695 7.989852905273438 L 32.71759033203125 11.57861328125 C 32.76548385620117 11.87708282470703 32.85820388793945 12.16659355163574 32.99262237548828 12.43735313415527 L 34.60920333862305 15.693603515625 C 35.02643203735352 16.53401184082031 35.02643203735352 17.5212230682373 34.60920333862305 18.36163330078125 L 32.99262237548828 21.61788177490234 C 32.85820388793945 21.88863372802734 32.76548385620117 22.17815399169922 32.71759033203125 22.47661209106445 L 32.14177322387695 26.06537246704102 C 31.99173164367676 27.00044250488281 31.40900230407715 27.80975341796875 30.56978225708008 28.24858283996582 L 27.41246223449707 29.89956283569336 C 27.14009094238281 30.04198265075684 26.89123153686523 30.22540283203125 26.67459106445312 30.44342231750488 L 24.16433334350586 32.96956253051758 C 23.48665237426758 33.65152359008789 22.52317428588867 33.96738433837891 21.57328224182129 33.8189811706543 L 18.09879302978516 33.27618408203125 C 17.79195213317871 33.22825241088867 17.47953414916992 33.22825241088867 17.17268180847168 33.27618408203125 L 13.69820213317871 33.8189811706543 C 12.74828910827637 33.96737289428711 11.78483009338379 33.65152359008789 11.10715293884277 32.96955108642578 L 8.596891403198242 30.44342231750488 C 8.380252838134766 30.22540283203125 8.131391525268555 30.04198265075684 7.859031677246094 29.89956283569336 L 4.701702117919922 28.24858283996582 C 3.862482070922852 27.80975341796875 3.279741287231445 27.00043296813965 3.129711151123047 26.06537246704102 L 2.55389404296875 22.47661209106445 C 2.506000518798828 22.17814254760742 2.413280487060547 21.88863372802734 2.278861999511719 21.61788177490234 L 0.6622734069824219 18.36162185668945 C 0.2450523376464844 17.52121353149414 0.2450523376464844 16.53400230407715 0.6622810363769531 15.6935920715332 L 2.278861999511719 12.43734359741211 C 2.413280487060547 12.16658210754395 2.506011962890625 11.87707328796387 2.553901672363281 11.5786018371582 L 3.129722595214844 7.989843368530273 C 3.279752731323242 7.054782867431641 3.862491607666016 6.245462417602539 4.701702117919922 5.806632995605469 L 7.859031677246094 4.155662536621094 C 8.131391525268555 4.013242721557617 8.380252838134766 3.829813003540039 8.596902847290039 3.61180305480957 L 11.10716247558594 1.085662841796875 C 11.67461204528809 0.5146293640136719 12.44255638122559 0.2002830505371094 13.23500823974609 0.20025634765625 Z"
                                                                        stroke="none" fill="var(--second-color)">
                                                                    </path>
                                                                </g>
                                                                <path
                                                                    d="M3759.753,7404.812l8.833-8.833,1.365,1.355-10.2,10.2-6.114-6.111,1.357-1.365Z"
                                                                    transform="translate(-2876.66 -5609.132)"
                                                                    fill="#fff"></path>
                                                            </g>
                                                        </svg></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mus_home_top_song">
                                            <a href="track/bFYLNNwhzMOzOhu.html">
                                                <div class="art_song"><img
                                                        src="../deepsoundscript.fra1.cdn.digitaloceanspaces.com/upload/photos/2023/03/oAzZ2OJYIAyuBoTxt5TL_05_ce964e977d9ec180398bf8a06e5ed800_image.jpg">
                                                </div>
                                                <div class="art_details">
                                                    <h4>Shakira - Waka Waka (This Time For Africa) (Lyrics)</h4>
                                                    <p>Kabir Ahmad</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="main_img_first">
                                        <div class="img">
                                            <img src="{{ asset('/img/vocalno/home/man-rock.png') }}">
                                        </div>
                                        <div class="info_cont">
                                            <div class="info">
                                                <b>Total Listeners</b>
                                                <h2>{{$accounts->count()}} <span>Currently listening</span></h2>
                                                <div class="rating">
                                                    <div class="avatar">
                                                        <img src="{{ asset('/img/vocalno/auth/forgot.jpg') }}" alt="">
                                                        <img src="{{ asset('/img/vocalno/auth/register.png') }}" alt="">
                                                        <img src="{{ asset('/img/vocalno/home/man-rock.png') }}" alt="">
                                                        <img src="{{ asset('/img/vocalno/auth/singing.jpg') }}" alt="">
                                                       </div>
                                                    <div>
                                                        <p>People rated Music</p>
                                                        <div class="stars">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24">
                                                                <path fill="#FFA800"
                                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24">
                                                                <path fill="#FFA800"
                                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24">
                                                                <path fill="#FFA800"
                                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24">
                                                                <path fill="#FFA800"
                                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24">
                                                                <path fill="#DFDFDF"
                                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                                                            </svg>
                                                            4.5
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="main_img_last">
                                        <p class="d-none"><span class="circle"></span> Live Now</p>
                                        <div class="stats D-FLEX align-item-center justify-content-center">
                                            <div class="first">
                                                <b>Total Artists</b>
                                                <h2>{{count($artists)}}</h2>
                                            </div>
                                            <div class="last">
                                                <b>Total Songs</b>
                                                <h2>{{count($songs)}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content  -->
    </div>
</div>
@endsection
