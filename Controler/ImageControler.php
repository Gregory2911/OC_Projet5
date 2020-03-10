<?php

class ImageControler
{

	public function resizeImage($image,$fileExtension,$lastPostId)
	{
		
		if ($fileExtension == 'png')
            {
                $source = imagecreatefrompng('../photoPost/' . $lastPostId ."/" . $image);
                $destination = imagecreatetruecolor(475,190);                
                //$fileNameMini = "post_mini" . $lastPostId . "." . $fileExtension;
                //$imagepng = imagepng('../photoPost/' . $newFile . $fileNameMini);
                $largeur_source = imagesx($source);
                $hauteur_source = imagesy($source);
                $largeur_destination = imagesx($destination);
                $hauteur_destination = imagesy($destination);

                // On crée la miniature
                imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                // On enregistre la miniature
                $fileMiniName = "post" . $lastPostId . "_mini." . $fileExtension;
                imagepng($destination, "../photoPost/" . $lastPostId . "/" . $fileMiniName);
            }
        else
        {
            $source = imagecreatefromjpeg('../photoPost/' . $lastPostId ."/" . $image);
            $destination = imagecreatetruecolor(475,190);                
            //$fileNameMini = "post_mini" . $lastPostId . "." . $fileExtension;
            //$imagepng = imagepng('../photoPost/' . $newFile . $fileNameMini);
            $largeur_source = imagesx($source);
            $hauteur_source = imagesy($source);
            $largeur_destination = imagesx($destination);
            $hauteur_destination = imagesy($destination);

            // On crée la miniature
            imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

            // On enregistre la miniature
            $fileMiniName = "post" . $lastPostId . "_mini." . $fileExtension;
            imagejpeg($destination, "../photoPost/" . $lastPostId . "/" . $fileMiniName);   
        }        
        return $fileMiniName;
	}

}
