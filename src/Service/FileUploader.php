<?php
namespace App\Service;

use App\Entity\Image;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function uploadImage(UploadedFile $image)
    {
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

        try {
            $image->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadImages(ArrayCollection $images)
    {
        $newImages = new ArrayCollection();
        foreach($images as $image) {
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $fileName = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

            try {
                $image->move($this->getTargetDirectory(), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $newImages->add($fileName);
        }

        return $newImages;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
