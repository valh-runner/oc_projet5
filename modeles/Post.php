<?php
/**
 * Comment entity specification
 */
class Post
{
    /**
     * @var int
     */
    private $idPost;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $headnote;
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $creationTime;
    /**
     * @var string
     */
    private $revisionTime;
    /**
     * @var int
     */
    private $idUser;
    
    /**
     * Constructor
     * @param array $datas
     */
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
    
    /**
     * Getters
     */

    public function idPost()
    {
        return $this->idPost;
    }
    public function title()
    {
        return $this->title;
    }
    public function headnote()
    {
        return $this->headnote;
    }
    public function content()
    {
        return $this->content;
    }
    public function creationTime()
    {
        return $this->creationTime;
    }
    public function revisionTime()
    {
        return $this->revisionTime;
    }
    public function idUser()
    {
        return $this->idUser;
    }
    
    /**
     * Setters
     */

    public function setIdPost($id)
    {
        $this->idPost = $id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setHeadnote($headnote)
    {
        $this->headnote = $headnote;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
    }
    public function setRevisionTime($revisionTime)
    {
        $this->revisionTime = $revisionTime;
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
    
    /**
     * Fill each attribute of the entity with datas
     * @param array $datas
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $fieldName => $data) {
            $fieldNameParts = explode('_', $fieldName);
            $methodName = 'set';
            foreach ($fieldNameParts as $fieldNamePart) {
                $methodName .= ucfirst($fieldNamePart);
            }
            if (method_exists($this, $methodName)) {
                $this->$methodName($data);
            }
        }
    }
}
