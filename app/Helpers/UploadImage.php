<?php

/* UploadImage helper

@param $request */

function UploadImage($image){

    //On donne un nom à l'image = timestamp en temps unix + extension
    $imageName = time() . '.' . $image->extension();

    //On déplace l'image dans le dosier public / images
    $image->move(public_path('images'), $imageName);

    //On retourne le nom de l'image
    return $imageName;
}