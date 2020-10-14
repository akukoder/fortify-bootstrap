<?php

Route::view('/home', 'fort-bs::home')
    ->middleware(['web', 'auth']);