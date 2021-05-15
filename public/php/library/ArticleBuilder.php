<?php


class ArticleBuilder extends GenericBuilder {
    /**
     * @var string
     */
    private $Title;


    function getTemplatePath(): string {
        return 'template.phtml';
    }


    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->Title;
    }


    /**
     * @param mixed $Title
     */
    public function setTitle($Title): self {
        $this->Title = $Title;

        return $this;
    }


    function setParams(): array {
        return [
            '{{ Title }}' => $this->Title,
        ];
    }
}
