<?php include 'header.php'; ?>
<body id="home" class="body">
    <div id="sign-up-page" class="">

        <?php include 'inc/menu.php'; ?>

        <div class="modal">
            <div id="sign-up-form" class="modal-content">
                <div class="header">
                    <div class="general-info">
                        <div>
                            <h1>Excel automatizálás</h1>
                            <a href="">részletes tematika és órarend</a>
                        </div>
                        <ul>
                            <li>
                                <i class="material-icons">access_time</i>
                                <span>8 óra</span>
                            </li>
                            <li>
                                <i class="material-icons">person</i>
                                <span>10 Fő</span>
                            </li>
                            <li>
                                <i class="material-icons">attach_money</i>
                                <span>67.000 $</span>
                            </li>

                        </ul>
                    </div>

                    <div class="sign-in-steps">
                        <div class="done">1</div>
                        <span class="done"></span>
                        <div class="current">2</div>
                        <span></span>
                        <div>3</div>
                        <span></span>
                        <div>4</div>
                        <span></span>
                        <div>5</div>
                    </div>
                    <div class="step-names">
                        <h2>Kapcsolattartó adatai</h2>
                        <h2>Résztvevő(k) adatai</h2>
                        <h2>Számlázási adatok</h2>
                        <h2>Fizetési mód</h2>
                        <h2>Összegzés</h2>
                    </div>
                </div>

                <ul class="sign-up-flow">
                    <li class="title">Jelentkező adatai</li>
                    <li class="p-input " id="field_7_1">
                        <label class="label" for="input_7_1">Email</label>
                        <div class="">
                            <input name="input_1" id="input_7_1" type="text" value="" class="medium" tabindex="1" placeholder="joh.doe@pentaschool.hu">
                        </div>
                    </li>

                    <li class="p-input " id="field_7_1">
                        <label class="label" for="input_7_1">Keresztnév</label>
                        <div class="">
                            <input name="input_1" id="input_7_1" type="text" value="" class="medium" tabindex="1" placeholder="János">
                        </div>
                    </li>

                    <li class="title">Jelentkező adatai</li>
                    <li class="p-input error" id="field_7_1">
                        <label class="label" for="input_7_1">Családnév</label>
                        <div class="">
                            <input name="input_1" id="input_7_1" type="text" value="" class="medium" tabindex="1" placeholder="Kovács">
                        </div>
                    </li>
                </ul>

                <footer>
                    <i class="material-icons b-button">keyboard_arrow_left</i>
                    <a class="p-button medium orange" href="">Jelentkezés</a>
                </footer>
            </div>
        </div>



    </div>
</body>