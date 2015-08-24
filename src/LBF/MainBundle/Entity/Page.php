<?php

namespace LBF\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LBF\MainBundle\Entity\PageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="dataBaseName", type="string", length=255)
     */
    private $dataBaseName;

    /**
     * @var string
     *
     * @ORM\Column(name="headerEs", type="string", length=255)
     */
    private $headerEs;

    /**
     * @var string
     *
     * @ORM\Column(name="headerFr", type="string", length=255, nullable=true)
     */
    private $headerFr;

    /**
     * @var string
     *
     * @ORM\Column(name="headerEn", type="string", length=255, nullable=true)
     */
    private $headerEn;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEs", type="text", nullable=true)
     */
    private $descriptionEs;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFr", type="text", nullable=true)
     */
    private $descriptionFr;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEn", type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="contentEs", type="text", nullable=true)
     */
    private $contentEs;

    /**
     * @var string
     *
     * @ORM\Column(name="contentFr", type="text", nullable=true)
     */
    private $contentFr;

    /**
     * @var string
     *
     * @ORM\Column(name="contentEn", type="text", nullable=true)
     */
    private $contentEn;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    private $file;

    private $tempFilename;


    /*   *********      construct  *************  */

    public function __construct()
    {
        $this->updatedAt        = new \Datetime;
        $this->type             = 'lhdc';  // meaning "logo-header-description-content". Others are mix of these.
    }


    /*   *********     Setter and getter Functions  *************  */


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set contentEs
     *
     * @param string $contentEs
     * @return Page
     */
    public function setContentEs($contentEs)
    {
        $this->contentEs = $contentEs;

        return $this;
    }

    /**
     * Get contentEs
     *
     * @return string 
     */
    public function getContentEs()
    {
        return $this->contentEs;
    }

    /**
     * Set contentFr
     *
     * @param string $contentFr
     * @return Page
     */
    public function setContentFr($contentFr)
    {
        $this->contentFr = $contentFr;

        return $this;
    }

    /**
     * Get contentFr
     *
     * @return string 
     */
    public function getContentFr()
    {
        return $this->contentFr;
    }

    /**
     * Set contentEn
     *
     * @param string $contentEn
     * @return Page
     */
    public function setContentEn($contentEn)
    {
        $this->contentEn = $contentEn;

        return $this;
    }

    /**
     * Get contentEn
     *
     * @return string 
     */
    public function getContentEn()
    {
        return $this->contentEn;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Page
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set headerEs
     *
     * @param string $headerEs
     * @return Page
     */
    public function setHeaderEs($headerEs)
    {
        $this->headerEs = $headerEs;

        return $this;
    }

    /**
     * Get headerEs
     *
     * @return string 
     */
    public function getHeaderEs()
    {
        return $this->headerEs;
    }

    /**
     * Set headerFr
     *
     * @param string $headerFr
     * @return Page
     */
    public function setHeaderFr($headerFr)
    {
        $this->headerFr = $headerFr;

        return $this;
    }

    /**
     * Get headerFr
     *
     * @return string 
     */
    public function getHeaderFr()
    {
        return $this->headerFr;
    }

    /**
     * Set headerEn
     *
     * @param string $headerEn
     * @return Page
     */
    public function setHeaderEn($headerEn)
    {
        $this->headerEn = $headerEn;

        return $this;
    }

    /**
     * Get headerEn
     *
     * @return string 
     */
    public function getHeaderEn()
    {
        return $this->headerEn;
    }

    /**
     * Set descriptionEs
     *
     * @param string $descriptionEs
     * @return Page
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * Get descriptionEs
     *
     * @return string 
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     * @return Page
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @return string 
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     * @return Page
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string 
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Page
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /*   *********     File  *************  */

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->file) {
          return;
        }

        // Le nom du fichier est son id, on doit juste stocker également son extension
        $this->url = $this->file->guessExtension();

        // Et on génère l'attribut 'alt' de la balise, à la valeur du nom du fichier sur le PC de l'internaute
        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->file) {
          return;
        }

        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename) {
          $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
          if (file_exists($oldFile)) {
            unlink($oldFile);
          }
        }

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move(
          $this->getUploadRootDir(), // Le répertoire de destination
          $this->id.'.'.$this->url   // Le nom du fichier à créer, ici "id.extension"
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier car il dépend de l'id
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFilename)) {
          // On supprime le fichier
          unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'img/icons';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin absolu vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

    /**
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function setFile($file)
    {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->url) {
          // On sauvegarde l'extension du fichier pour le supprimer plus tard
          $this->tempFilename = $this->url;

          // On réinitialise les valeurs des attributs url et alt
          $this->url = null;
          $this->alt = null;
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /*   *********   End  File  *************  */

    /**
     * Set dataBaseName
     *
     * @param string $dataBaseName
     * @return Page
     */
    public function setDataBaseName($dataBaseName)
    {
        $this->dataBaseName = $dataBaseName;

        return $this;
    }

    /**
     * Get dataBaseName
     *
     * @return string 
     */
    public function getDataBaseName()
    {
        return $this->dataBaseName;
    }
}
