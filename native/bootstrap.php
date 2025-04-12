<?php

use Native\Laravel\Facades\Window;

Window::open()
    ->title('Toko Laravel Desktop')
    ->width(1024)
    ->height(768)
    ->resizable()
    ->frameless(false) // ubah ke true kalau kamu mau window tanpa frame
    ->showDevTools(false); // true kalau kamu mau buka devtools (debug)
