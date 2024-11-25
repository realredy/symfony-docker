<?

namespace App\Document\BlogDocument;

use App\Document\Category;
use App\Document\Languajes;
use App\Document\Status;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;


/**
 * 
 * @MongoDB\Document(collection="Blog")
 */
class Blog
{
    /** @MongoDB\Id*/
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

    /**
     * @MongoDB\Field(type="string")
     */
    private $urlFriendly;
    /**
     * @MongoDB\Field(type="string")
     */
    private $body;

    /**
     * @MongoDB\Field(type="collection")
     */
    private $keyword; 

    /**
     * @MongoDB\Field(type="string")
     */
    private $imageUrl;

    // /**
    //  * @MongoDB\Field(type="bool")
    //  */
    // private $status;

    /**
     * @MongoDB\Field(type="date")
     */
    private $datePublished;


    /** @MongoDB\ReferenceOne(targetDocument=Languajes::class, inversedBy="post", storeAs="id") */
    private $languaje;

    /** @MongoDB\ReferenceOne(targetDocument=Category::class, inversedBy="post", storeAs="id") */
    private $category;

    /** @MongoDB\ReferenceOne(targetDocument=Status::class, inversedBy="post", storeAs="id") */
    private $status;

    public function __construct()
    {
        $this->keyword = new ArrayCollection();
    } 

    public function getId(): string
    {
        return $this->id;
    }

    // * titulo
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    // * $urlFriendly
    public function setUrlFriendly(string $urlFriendly): void
    {
        $this->urlFriendly = $urlFriendly;
    }
    public function getUrlFriendly(): string
    {
        return $this->urlFriendly;
    }
    // * $body
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    public function getBody(): string
    {
        return $this->body;
    }
    // * $keyword
    public function setKeyword($keyword): void
    {
        $this->keyword = $keyword;
    }
    public function getKeyword():string
    {
        return  $this->keyword[0];
    }
    // * $imageUrl
    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
     
    // * $datePublished   
    public function setDatePublished(\DateTime $datePublished): void
    {
        $this->datePublished = $datePublished;
    }
    public function getDatePublished(): \DateTime
    {
        return $this->datePublished;
    }
    public function setCategory($category): void
    {
        $this->category = $category;
    }
    public function getCategory(): Category
    {
        return $this->category;
    }
    public function setLanguaje($languaje): void
    {
        $this->languaje = $languaje;
    }

    public function getLanguaje(): Languajes
    {
        return $this->languaje;
    } 
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    public function getStatus(): Status
    {
        return $this->status;
    }
}
